<?php

class Userop extends CI_Controller
{
  public $viewFolder = "";

  public function __construct()
  {
    parent::__construct();
    $this->viewFolder = "users_v";
    $this->load->model("user_model");
    $this->load->library("form_validation");
  }

  public function login()
  {
    if (get_active_user()) redirect(base_url("dashboard"));

    $viewData = new stdClass();

    $viewData->viewFolder = $this->viewFolder;
    $viewData->subViewFolder = "login";

    $this->load->view("{$viewData->viewFolder}/{$viewData->subViewFolder}/index", $viewData);
  }

  public function do_login()
  {
    if (get_active_user()) redirect(base_url("dashboard"));

    $this->form_validation->set_rules("user_email", "E-posta adresi", "required|trim|valid_email");
    $this->form_validation->set_rules("user_password", "Şifre", "required|trim|min_length[6]|max_length[8]");

    $this->form_validation->set_message(
      array(
        "required" => "<b>{field}</b> alanı doldurulmalıdır",
        "valid_email" => "Lütfen geçerli bir e-posta adresi giriniz.",
        "min_length" => "Şifre en az <b>{field}</b> karakterden oluşmalıdır.",
        "max_length" => "Şifre en fazla <b>{field}</b> karakterden oluşmalıdır.",
      )
    );

    $validate = $this->form_validation->run();

    if ($validate == FALSE) {
      $viewData = new stdClass();

      $viewData->viewFolder = $this->viewFolder;
      $viewData->subViewFolder = "login";
      $viewData->form_error = true;

      $this->load->view("{$viewData->viewFolder}/{$viewData->subViewFolder}/index", $viewData);
    } else {
      $user = $this->user_model->get(
        array(
          "email" => $this->input->post("user_email"),
          "password" => md5($this->input->post("user_password")),
          "isActive" => true
        )
      );

      if ($user) {
        $alert = array(
          "title" => "İşlem Başarılıdır",
          "text" => "$user->full_name Hoşgeldiniz",
          "type" => "success"
        );

        $this->session->set_userdata("user", $user);
        $this->session->set_flashdata("alert", $alert);
        redirect(base_url());
      } else {
        $alert = array(
          "title" => "İşlem Başarısızdır",
          "text" => "Lütfen giriş bilgilerinizi kontrol edinizi",
          "type" => "error"
        );

        $this->session->set_flashdata("alert", $alert);
        redirect(base_url("login"));
      }
    }

  }

  public function logout()
  {
    $this->session->unset_userdata("user");
    redirect(base_url("login"));
  }

  public function reset_password_form()
  {
    if (get_active_user()) redirect(base_url("dashboard"));

    $viewData = new stdClass();

    $viewData->viewFolder = $this->viewFolder;
    $viewData->subViewFolder = "forgot-password";

    $this->load->view("{$viewData->viewFolder}/{$viewData->subViewFolder}/index", $viewData);
  }

  public function reset_password()
  {
    $this->form_validation->set_rules("email", "E-posta adresi", "required|trim|valid_email");

    $this->form_validation->set_message(
      array(
        "required" => "<b>{field}</b> alanı doldurulmalıdır",
        "valid_email" => "Lütfen geçerli bir e-posta adresi giriniz.",
      )
    );

    $validate = $this->form_validation->run();

    if ($validate == FALSE) {
      $viewData = new stdClass();

      $viewData->viewFolder = $this->viewFolder;
      $viewData->subViewFolder = "forgot-password";
      $viewData->form_error = true;

      $this->load->view("{$viewData->viewFolder}/{$viewData->subViewFolder}/index", $viewData);
    } else {
      $user = $this->user_model->get(
        array(
          "isActive" => true,
          "email" => $this->input->post("email")
        )
      );

      if ($user) {
        $this->load->helper("string");
        $temp_password = random_string();

        $send = send_email($user->email, "Şifremi Unuttum", "CMS sistemine giriş şifreniz sıfırlanmıştır geçici olarak <b>$temp_password</b>  şifresi ile giriş yapabilirsiniz.");

        if ($send) {
          $this->user_model->update(
            array("id" => $user->id),
            array(
              "password" => md5($temp_password)
            )
          );

          $alert = array(
            "title" => "İşlem Başarılıdır",
            "text" => "Şifreniz başarılı bir şekilde sıfırlanmıştır. E-postasınızı kontrol ediniz",
            "type" => "success"
          );

          $this->session->set_flashdata("alert", $alert);
          redirect(base_url("login"));
          die();
        } else {
          $alert = array(
            "title" => "İşlem Başarısızdır",
            "text" => "E-posta gönderilirken bir problem oluştu.",
            "type" => "error"
          );

          $this->session->set_flashdata("alert", $alert);
          redirect(base_url("sifremi-sifirla"));
          die();
        }

      } else {
        $alert = array(
          "title" => "İşlem Başarısızdır",
          "text" => "Böyle bir kullanıcı bulunamamıştır.",
          "type" => "error"
        );

        $this->session->set_flashdata("alert", $alert);
        redirect(base_url("sifremi-sifirla"));
        die();
      }
    }


  }
}