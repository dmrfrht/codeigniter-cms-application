<?php

class Galleries extends CI_Controller
{
  public $viewFolder = "";

  public function __construct()
  {
    parent::__construct();
    $this->viewFolder = "galleries_v";
    $this->load->model("gallery_model");
    $this->load->model("image_model");
    $this->load->model("video_model");
    $this->load->model("file_model");
  }

  public function index()
  {
    $viewData = new stdClass();

    $items = $this->gallery_model->get_all(
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

    $this->form_validation->set_rules("title", "Başlık", "required|trim");

    $this->form_validation->set_message(
      array(
        "required" => "<b>{field}</b> alanı doldurulmalıdır"
      )
    );

    $validate = $this->form_validation->run();

    if ($validate) {
      $gallery_type = $this->input->post("gallery_type");
      $path = "uploads/$this->viewFolder/";
      $folder_name = "";

      if ($gallery_type == "image") {
        $folder_name = convert_to_seo($this->input->post("title"));
        $path = "$path/images/$folder_name";
      } else if ($gallery_type == "file") {
        $folder_name = convert_to_seo($this->input->post("title"));
        $path = "$path/files/$folder_name";
      }

      if ($gallery_type != "video") {
        if (!mkdir($path, 0755)) {
          $alert = array(
            "title" => "İşlem Başarısızdır",
            "text" => "Galeri üretilirken bir hata oluştu. (Yetki Hatası)",
            "type" => "error"
          );
          $this->session->set_flashdata("alert", $alert);
          redirect(base_url("galleries"));
          die();
        }
      }

      $insert = $this->gallery_model->add(
        array(
          "title" => $this->input->post("title"),
          "url" => convert_to_seo($this->input->post("title")),
          "gallery_type" => $gallery_type,
          "folder_name" => $folder_name,
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
          "text" => "Kayıt eklenirken bir hata oluştu",
          "type" => "error"
        );
      }
      $this->session->set_flashdata("alert", $alert);
      redirect(base_url("galleries"));
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

    $item = $this->gallery_model->get(
      array(
        "id" => $id
      )
    );

    $viewData->viewFolder = $this->viewFolder;
    $viewData->subViewFolder = "update";
    $viewData->item = $item;

    $this->load->view("{$viewData->viewFolder}/{$viewData->subViewFolder}/index", $viewData);
  }

  public function update($id, $galleryType, $oldFolderName = "")
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
      $path = "uploads/$this->viewFolder/";
      $folder_name = "";

      if ($galleryType == "image") {
        $folder_name = convert_to_seo($this->input->post("title"));
        $path = "$path/images";
      } else if ($galleryType == "file") {
        $folder_name = convert_to_seo($this->input->post("title"));
        $path = "$path/files";
      }

      if ($galleryType != "video") {
        if (!rename("$path/$oldFolderName", "$path/$folder_name")) {
          $alert = array(
            "title" => "İşlem Başarısızdır",
            "text" => "Galeri üretilirken bir hata oluştu. (Yetki Hatası)",
            "type" => "error"
          );
          $this->session->set_flashdata("alert", $alert);
          redirect(base_url("galleries"));
          die();
        }
      }

      $update = $this->gallery_model->update(
        array(
          "id" => $id
        ),
        array(
          "title" => $this->input->post("title"),
          "url" => convert_to_seo($this->input->post("title")),
          "folder_name" => $folder_name
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
      redirect(base_url("galleries"));
    } else {
      $viewData = new stdClass();

      $item = $this->gallery_model->get(
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
    $gallery = $this->gallery_model->get(
      array(
        "id" => $id
      )
    );

    if ($gallery) {
      if ($gallery->gallery_type != "video") {
        if ($gallery->gallery_type == "image") {
          $path = "uploads/$this->viewFolder/images/$gallery->folder_name";
        } else if ($gallery->gallery_type == "file") {
          $path = "uploads/$this->viewFolder/files/$gallery->folder_name";
        }

        $delete_folder = rmdir($path);

        if (!$delete_folder) {
          $alert = array(
            "title" => "İşlem Başarısızdır",
            "text" => "Kayıt silinirken bir hata oluştu",
            "type" => "error"
          );

          $this->session->set_flashdata("alert", $alert);
          redirect(base_url("galleries"));
        }

        $delete = $this->gallery_model->delete(
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
        redirect(base_url("galleries"));
      } else {
        $delete = $this->gallery_model->delete(
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
        redirect(base_url("galleries"));
      }
    }
  }

  public function isActiveSetter($id)
  {
    if ($id) {
      $isActive = ($this->input->post("data") == "true") ? 1 : 0;

      $this->gallery_model->update(
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
      $this->gallery_model->update(
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

  public function uploadForm($id)
  {
    $viewData = new stdClass();

    $item = $this->gallery_model->get(
      array(
        "id" => $id
      )
    );

    if ($item->gallery_type == "image") {
      $items = $this->image_model->get_all(
        array(
          "gallery_id" => $id
        ), "rank ASC"
      );
    } else if ($item->gallery_type == "file") {
      $items = $this->file_model->get_all(
        array(
          "gallery_id" => $id
        ), "rank ASC"
      );
    } else {
      $items = $this->video_model->get_all(
        array(
          "gallery_id" => $id
        ), "rank ASC"
      );
    }

    $viewData->viewFolder = $this->viewFolder;
    $viewData->subViewFolder = "image";
    $viewData->item = $item;
    $viewData->items = $items;
    $viewData->gallery_type = $item->gallery_type;

    $this->load->view("{$viewData->viewFolder}/{$viewData->subViewFolder}/index", $viewData);
  }

  public function fileUpload($galleryId, $galleryType, $folderName)
  {
    $file_name = convert_to_seo(pathinfo($_FILES["file"]["name"], PATHINFO_FILENAME)) . '.' . pathinfo($_FILES["file"]["name"], PATHINFO_EXTENSION);

    $config["allowed_types"] = "jpg|jpeg|png|pdf|doc|docx|xls|txt";
    $config["upload_path"] = ($galleryType == "image") ? "uploads/$this->viewFolder/images/$folderName" : "uploads/$this->viewFolder/files/$folderName";
    $config["file_name"] = $file_name;

    $this->load->library("upload", $config);

    $upload = $this->upload->do_upload("file");

    if ($upload) {
      $uploaded_file = $this->upload->data("file_name");

      $modelName = ($galleryType == "image") ? "image_model" : "file_model";

      $this->$modelName->add(
        array(
          "url" => "{$config["upload_path"]}/$uploaded_file",
          "rank" => 0,
          "isActive" => true,
          "createdAt" => date("Y-m-d H:i:s"),
          "gallery_id" => $galleryId
        )
      );

    } else {
      echo "basarısız";
    }

  }

  public function refreshFileList($id)
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

      // TODO -> Alert Sistemi Eklenecek
      redirect(base_url("product/imageForm/$parent_id"));
    } else {
      // TODO -> Alert Sistemi Eklenecek
      redirect(base_url("product/imageForm/$parent_id"));
    }
  }

}