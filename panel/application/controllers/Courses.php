<?php

class Courses extends CI_Controller
{
  public $viewFolder = "";

  public function __construct()
  {
    parent::__construct();
    $this->viewFolder = "courses_v";
    $this->load->model("course_model");

    if (!get_active_user()) redirect(base_url("login"));
  }

  public function index()
  {
    $viewData = new stdClass();

    $items = $this->course_model->get_all(
      array(), "rank ASC"
    );

    $viewData->viewFolder = $this->viewFolder;
    $viewData->subViewFolder = "list";
    $viewData->items = $items;

    $this->load->view("{$viewData->viewFolder}/{$viewData->subViewFolder}/index", $viewData);
  }

  public function new_form()
  {
    $viewData = new stdClass();

    $viewData->viewFolder = $this->viewFolder;
    $viewData->subViewFolder = "add";

    $this->load->view("{$viewData->viewFolder}/{$viewData->subViewFolder}/index", $viewData);
  }

  public function save()
  {
    $this->load->library("form_validation");

    if ($_FILES["img_url"]["name"] == "") {
      $alert = array(
        "title" => "İşlem Başarısızdır",
        "text" => "Lütfen bir görsel seçiniz.",
        "type" => "error"
      );
      $this->session->set_flashdata("alert", $alert);
      redirect(base_url("courses/new_form"));
      die();
    }

    $this->form_validation->set_rules("title", "Başlık", "required|trim");
    $this->form_validation->set_rules("event_date", "Eğitim Tarihi", "required|trim");

    $this->form_validation->set_message(
      array(
        "required" => "<b>{field}</b> alanı doldurulmalıdır"
      )
    );

    $validate = $this->form_validation->run();

    if ($validate) {

      $file_name = convert_to_seo(pathinfo($_FILES["img_url"]["name"], PATHINFO_FILENAME)) . '.' . pathinfo($_FILES["img_url"]["name"], PATHINFO_EXTENSION);

      $config["allowed_types"] = "jpg|jpeg|png";
      $config["upload_path"] = "uploads/$this->viewFolder/";
      $config["file_name"] = $file_name;

      $this->load->library("upload", $config);

      $upload = $this->upload->do_upload("img_url");

      if ($upload) {
        $uploaded_file = $this->upload->data("file_name");

        $insert = $this->course_model->add(
          array(
            "title" => $this->input->post("title"),
            "description" => $this->input->post("description"),
            "url" => convert_to_seo($this->input->post("url")),
            "event_date" => $this->input->post("event_date"),
            "img_url" => $uploaded_file,
            "rank" => 0,
            "isActive" => true,
            "createdAt" => date("Y-m-d H:i:s")
          )
        );

        if ($insert) {
          $alert = array(
            "title" => "İşlem Başarılıdır",
            "text" => "Kayıt başarılı bir şekilde eklendi",
            "type" => "success"
          );
        } else {
          $alert = array(
            "title" => "İşlem Başarısızdır",
            "text" => "Kayıt eklenirken bir problem oluştu.",
            "type" => "error"
          );
        }
      } else {
        $alert = array(
          "title" => "İşlem Başarısızdır",
          "text" => "Görsel yüklenirken bir problem oluştu.",
          "type" => "error"
        );
        $this->session->set_flashdata("alert", $alert);
        redirect(base_url("courses/new_form"));
        die();
      }

      $this->session->set_flashdata("alert", $alert);
      redirect(base_url("courses"));
    } else {
      $viewData = new stdClass();

      $viewData->viewFolder = $this->viewFolder;
      $viewData->subViewFolder = "add";
      $viewData->form_error = true;

      $this->load->view("{$viewData->viewFolder}/{$viewData->subViewFolder}/index", $viewData);
    }
  }

  public function update_form($id)
  {
    $viewData = new stdClass();

    $item = $this->course_model->get(
      array(
        "id" => $id
      )
    );

    $viewData->viewFolder = $this->viewFolder;
    $viewData->subViewFolder = "update";
    $viewData->item = $item;

    $this->load->view("{$viewData->viewFolder}/{$viewData->subViewFolder}/index", $viewData);
  }

  public function update($id)
  {
    $this->load->library("form_validation");

    $this->form_validation->set_rules("title", "Başlık", "required|trim");
    $this->form_validation->set_rules("event_date", "Eğitim Tarihi", "required|trim");

    $this->form_validation->set_message(
      array(
        "required" => "<b>{field}</b> alanı doldurulmalıdır"
      )
    );

    $validate = $this->form_validation->run();

    if ($validate) {

      if ($_FILES["img_url"]["name"] != "") {
        $file_name = convert_to_seo(pathinfo($_FILES["img_url"]["name"], PATHINFO_FILENAME)) . '.' . pathinfo($_FILES["img_url"]["name"], PATHINFO_EXTENSION);

        $config["allowed_types"] = "jpg|jpeg|png";
        $config["upload_path"] = "uploads/$this->viewFolder/";
        $config["file_name"] = $file_name;

        $this->load->library("upload", $config);

        $upload = $this->upload->do_upload("img_url");

        if ($upload) {
          $uploaded_file = $this->upload->data("file_name");

          $data = array(
            "title" => $this->input->post("title"),
            "img_url" => $uploaded_file,
            "description" => $this->input->post("description"),
            "url" => convert_to_seo($this->input->post("url")),
            "event_date" => $this->input->post("event_date"),
          );
        } else {
          $alert = array(
            "title" => "İşlem Başarısızdır",
            "text" => "Görsel yüklenirken bir problem oluştu.",
            "type" => "error"
          );
          $this->session->set_flashdata("alert", $alert);
          redirect(base_url("courses/update_form/$id"));
          die();
        }
      } else {
        $data = array(
          "title" => $this->input->post("title"),
          "description" => $this->input->post("description"),
          "url" => convert_to_seo($this->input->post("url")),
          "event_date" => $this->input->post("event_date"),
        );
      }

      $update = $this->course_model->update(array("id" => $id), $data);

      if ($update) {
        $alert = array(
          "title" => "İşlem Başarılıdır",
          "text" => "Kayıt başarılı bir şekilde güncellendi",
          "type" => "success"
        );
      } else {
        $alert = array(
          "title" => "İşlem Başarısızdır",
          "text" => "Kayıt güncellenirken bir problem oluştu.",
          "type" => "error"
        );
      }
      $this->session->set_flashdata("alert", $alert);
      redirect(base_url("courses"));
    } else {
      $viewData = new stdClass();

      $item = $this->course_model->get(
        array(
          "id" => $id
        )
      );

      $viewData->viewFolder = $this->viewFolder;
      $viewData->subViewFolder = "update";
      $viewData->form_error = true;
      $viewData->item = $item;

      $this->load->view("{$viewData->viewFolder}/{$viewData->subViewFolder}/index", $viewData);
    }
  }

  public function delete($id)
  {
    $delete = $this->course_model->delete(
      array(
        "id" => $id
      )
    );

    if ($delete) {
      $alert = array(
        "title" => "İşlem Başarılıdır",
        "text" => "Kayıt başarılı bir şekilde silindi",
        "type" => "success"
      );
    } else {
      $alert = array(
        "title" => "İşlem Başarısızdır",
        "text" => "Kayıt silinirken bir hata oluştu",
        "type" => "error"
      );
    }
    $this->session->set_flashdata("alert", $alert);
    redirect(base_url("courses"));
  }

  public function isActiveSetter($id)
  {
    if ($id) {
      $isActive = ($this->input->post("data") == "true") ? 1 : 0;

      $this->course_model->update(
        array(
          "id" => $id
        ),
        array(
          "isActive" => $isActive
        )
      );
    }
  }

  public function rankSetter()
  {
    $data = $this->input->post("data");
    parse_str($data, $order);
    $items = $order["ord"];

    foreach ($items as $rank => $id) {
      $this->course_model->update(
        array(
          "id" => $id,
          "rank !=" => $rank
        ),
        array(
          "rank" => $rank
        )
      );
    }
  }

}