<?php

class News extends CI_Controller
{
  public $viewFolder = "";

  public function __construct()
  {
    parent::__construct();
    $this->viewFolder = "news_v";
    $this->load->model("news_model");
    $this->load->model("product_image_model");
  }

  public function index()
  {
    $viewData = new stdClass();

    $items = $this->news_model->get_all(
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

    $news_type = $this->input->post("news_type");

    if ($news_type == "image") {
      if ($_FILES["img_url"]["name"] == "") {
        $alert = array(
          "title" => "İşlem Başarısızdır",
          "text" => "Lütfen bir görsel seçiniz.",
          "type" => "error"
        );
        $this->session->set_flashdata("alert", $alert);
        redirect(base_url("news/new_form"));
        die();
      }
    } else if ($news_type == "video") {
      $this->form_validation->set_rules("video_url", "Video URL", "required|trim");
    }

    $this->form_validation->set_rules("title", "Başlık", "required|trim");

    $this->form_validation->set_message(
      array(
        "required" => "<b>{field}</b> alanı doldurulmalıdır"
      )
    );

    $validate = $this->form_validation->run();

    if ($validate) {
      if ($news_type == "image") {

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
            "url" => convert_to_seo($this->input->post("title")),
            "description" => $this->input->post("description"),
            "news_type" => $news_type,
            "img_url" => $uploaded_file,
            "video_url" => "#",
            "rank" => 0,
            "isActive" => true,
            "createdAt" => date("Y-m-d H:i:s")
          );
        } else {
          $alert = array(
            "title" => "İşlem Başarısızdır",
            "text" => "Görsel yüklenirken bir problem oluştu.",
            "type" => "error"
          );
          $this->session->set_flashdata("alert", $alert);
          redirect(base_url("news/new_form"));
          die();
        }

      } else if ($news_type == "video") {
        $data = array(
          "title" => $this->input->post("title"),
          "url" => convert_to_seo($this->input->post("title")),
          "description" => $this->input->post("description"),
          "news_type" => $news_type,
          "img_url" => "#",
          "video_url" => $this->input->post("video_url"),
          "rank" => 0,
          "isActive" => true,
          "createdAt" => date("Y-m-d H:i:s")
        );
      }
      $insert = $this->news_model->add($data);

      if ($insert) {
        $alert = array(
          "title" => "İşlem Başarılıdır",
          "text" => "Kayıt başarılı bir şekilde eklendi",
          "type" => "success"
        );
      } else {

      }
      $this->session->set_flashdata("alert", $alert);
      redirect(base_url("news"));
    } else {
      $viewData = new stdClass();

      $viewData->viewFolder = $this->viewFolder;
      $viewData->subViewFolder = "add";
      $viewData->form_error = true;
      $viewData->news_type = $news_type;

      $this->load->view("{$viewData->viewFolder}/{$viewData->subViewFolder}/index", $viewData);
    }
  }

  public function update_form($id)
  {
    $viewData = new stdClass();

    $item = $this->news_model->get(
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

    $this->form_validation->set_message(
      array(
        "required" => "<b>{field}</b> alanı doldurulmalıdır"
      )
    );

    $validate = $this->form_validation->run();

    if ($validate) {
      $update = $this->news_model->update(
        array(
          "id" => $id
        ),
        array(
          "title" => $this->input->post("title"),
          "url" => convert_to_seo($this->input->post("title")),
          "description" => $this->input->post("description"),
        )
      );

      if ($update) {
        $alert = array(
          "title" => "İşlem Başarılıdır",
          "text" => "Kayıt başarılı bir şekilde güncellendi",
          "type" => "success"
        );
      } else {
        $alert = array(
          "title" => "İşlem Başarısızdır",
          "text" => "Kayıt güncellenirken bir hata oluştu",
          "type" => "error"
        );
      }
      $this->session->set_flashdata("alert", $alert);
      redirect(base_url("product"));
    } else {
      $viewData = new stdClass();

      $item = $this->news_model->get(
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
    $delete = $this->news_model->delete(
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
    redirect(base_url("product"));
  }

  public function isActiveSetter($id)
  {
    if ($id) {
      $isActive = ($this->input->post("data") == "true") ? 1 : 0;

      $this->news_model->update(
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
      $this->news_model->update(
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

  public function imageForm($id)
  {
    $viewData = new stdClass();

    $item = $this->news_model->get(
      array(
        "id" => $id
      )
    );

    $item_images = $this->product_image_model->get_all(
      array(
        "product_id" => $id
      ), "rank ASC"
    );

    $viewData->viewFolder = $this->viewFolder;
    $viewData->subViewFolder = "image";
    $viewData->item = $item;
    $viewData->item_images = $item_images;

    $this->load->view("{$viewData->viewFolder}/{$viewData->subViewFolder}/index", $viewData);
  }

  public function imageUpload($id)
  {
    $file_name = convert_to_seo(pathinfo($_FILES["file"]["name"], PATHINFO_FILENAME)) . '.' . pathinfo($_FILES["file"]["name"], PATHINFO_EXTENSION);

    $config["allowed_types"] = "jpg|jpeg|png";
    $config["upload_path"] = "uploads/$this->viewFolder/";
    $config["file_name"] = $file_name;

    $this->load->library("upload", $config);

    $upload = $this->upload->do_upload("file");

    if ($upload) {
      $uploaded_file = $this->upload->data("file_name");

      $this->product_image_model->add(
        array(
          "img_url" => $uploaded_file,
          "rank" => 0,
          "isActive" => true,
          "isCover" => 0,
          "createdAt" => date("Y-m-d H:i:s"),
          "product_id" => $id
        )
      );

    } else {
      echo "basarısız";
    }

  }

  public function refreshImageList($id)
  {
    $viewData = new stdClass();

    $item_images = $this->product_image_model->get_all(
      array(
        "product_id" => $id
      )
    );

    $viewData->viewFolder = $this->viewFolder;
    $viewData->subViewFolder = "image";
    $viewData->item_images = $item_images;

    echo $this->load->view("{$viewData->viewFolder}/{$viewData->subViewFolder}/render_elements/image_list_v", $viewData, true);
  }

  public function isCoverSetter($id, $parent_id)
  {
    if ($id && $parent_id) {
      $isCover = ($this->input->post("data") == "true") ? 1 : 0;

      $this->product_image_model->update(
        array(
          "id" => $id,
          "product_id" => $parent_id
        ),
        array(
          "isCover" => $isCover
        )
      );

      $this->product_image_model->update(
        array(
          "id !=" => $id,
          "product_id" => $parent_id
        ),
        array(
          "isCover" => 0
        )
      );

      $viewData = new stdClass();

      $item_images = $this->product_image_model->get_all(
        array(
          "product_id" => $parent_id
        ), "rank ASC"
      );

      $viewData->viewFolder = $this->viewFolder;
      $viewData->subViewFolder = "image";
      $viewData->item_images = $item_images;

      echo $this->load->view("{$viewData->viewFolder}/{$viewData->subViewFolder}/render_elements/image_list_v", $viewData, true);
    }
  }

  public function imageIsActiveSetter($id)
  {
    if ($id) {
      $isActive = ($this->input->post("data") == "true") ? 1 : 0;

      $this->product_image_model->update(
        array(
          "id" => $id
        ),
        array(
          "isActive" => $isActive
        )
      );
    }
  }

  public function imageRankSetter()
  {
    $data = $this->input->post("data");
    parse_str($data, $order);
    $items = $order["ord"];

    foreach ($items as $rank => $id) {
      $this->product_image_model->update(
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

  public function imageDelete($id, $parent_id)
  {
    $fileName = get_file_name($id);

    $delete = $this->product_image_model->delete(array("id" => $id));

    if ($delete) {
      unlink("uploads/{$this->viewFolder}/$fileName->img_url");
      redirect(base_url("product/imageForm/$parent_id"));
    } else {
      redirect(base_url("product/imageForm/$parent_id"));
    }
  }

}