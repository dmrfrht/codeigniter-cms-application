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

    $config["allowed_types"] = "jpg|jpeg|png|pdf|doc|docx|xls|xlsx|txt";
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

  public function refreshFileList($galleryId, $galleryType)
  {
    $viewData = new stdClass();
    $modelName = ($galleryType == "image") ? "image_model" : "file_model";

    $items = $this->$modelName->get_all(
      array(
        "gallery_id" => $galleryId
      )
    );

    $viewData->viewFolder = $this->viewFolder;
    $viewData->subViewFolder = "image";
    $viewData->items = $items;
    $viewData->gallery_type = $galleryType;

    echo $this->load->view("{$viewData->viewFolder}/{$viewData->subViewFolder}/render_elements/file_list_v", $viewData, true);
  }

  public function fileIsActiveSetter($galleryId, $galleryType)
  {
    if ($galleryId && $galleryType) {
      $isActive = ($this->input->post("data") == "true") ? 1 : 0;
      $modelName = ($galleryType == "image") ? "image_model" : "file_model";

      $this->$modelName->update(
        array(
          "id" => $galleryId
        ),
        array(
          "isActive" => $isActive
        )
      );
    }
  }

  public function fileRankSetter($galleryType)
  {
    $data = $this->input->post("data");
    parse_str($data, $order);
    $items = $order["ord"];
    $modelName = ($galleryType == "image") ? "image_model" : "file_model";

    foreach ($items as $rank => $id) {
      $this->$modelName->update(
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

  public function fileDelete($id, $parent_id, $galleryType)
  {
    $modelName = ($galleryType == "image") ? "image_model" : "file_model";
    $fileName = $this->$modelName->get(array("id" => $id));
    $delete = $this->$modelName->delete(array("id" => $id));

    if ($delete) {
      unlink($fileName->url);

      // TODO -> Alert Sistemi Eklenecek
      redirect(base_url("galleries/uploadForm/$parent_id"));
    } else {
      // TODO -> Alert Sistemi Eklenecek
      redirect(base_url("galleries/uploadForm/$parent_id"));
    }
  }

  public function galleryVideoList($id)
  {
    $viewData = new stdClass();

    $items = $this->video_model->get_all(
      array("gallery_id" => $id), "rank ASC"
    );

    $galleryDetail = $this->gallery_model->get(array("id" => $id));

    $viewData->viewFolder = $this->viewFolder;
    $viewData->subViewFolder = "video/list";
    $viewData->items = $items;
    $viewData->galleryDetail = $galleryDetail;

    $this->load->view("{$viewData->viewFolder}/{$viewData->subViewFolder}/index", $viewData);
  }

  public function newGalleryVideoForm($galleryId)
  {
    $viewData = new stdClass();

    $viewData->viewFolder = $this->viewFolder;
    $viewData->subViewFolder = "video/add";
    $viewData->galleryId = $galleryId;

    $this->load->view("{$viewData->viewFolder}/{$viewData->subViewFolder}/index", $viewData);
  }

  public function galleryVideoSave($galleryId)
  {
    $this->load->library("form_validation");

    $this->form_validation->set_rules("url", "Video URL", "required|trim");

    $this->form_validation->set_message(
      array(
        "required" => "<b>{field}</b> alanı doldurulmalıdır"
      )
    );

    $validate = $this->form_validation->run();

    if ($validate) {
      $insert = $this->video_model->add(
        array(
          "url" => $this->input->post("url"),
          "gallery_id" => $galleryId,
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
      redirect(base_url("galleries/galleryVideoList/$galleryId"));
    } else {
      $viewData = new stdClass();

      $viewData->viewFolder = $this->viewFolder;
      $viewData->subViewFolder = "video/add";
      $viewData->form_error = true;
      $viewData->galleryId = $galleryId;

      $this->load->view("{$viewData->viewFolder}/{$viewData->subViewFolder}/index", $viewData);
    }
  }

  public function updateGalleryVideoForm($videoId)
  {
    $viewData = new stdClass();

    $item = $this->video_model->get(
      array(
        "id" => $videoId
      )
    );

    $viewData->viewFolder = $this->viewFolder;
    $viewData->subViewFolder = "video/update";
    $viewData->item = $item;

    $this->load->view("{$viewData->viewFolder}/{$viewData->subViewFolder}/index", $viewData);
  }

  public function galleryVideoUpdate($videoId, $galleryId)
  {
    $this->load->library("form_validation");

    $this->form_validation->set_rules("url", "Video URL", "required|trim");

    $this->form_validation->set_message(
      array(
        "required" => "<b>{field}</b> alanı doldurulmalıdır"
      )
    );

    $validate = $this->form_validation->run();

    if ($validate) {

      $update = $this->video_model->update(
        array(
          "id" => $videoId
        ),
        array(
          "url" => $this->input->post("url"),
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
      redirect(base_url("galleries/galleryVideoList/$galleryId"));
    } else {
      $viewData = new stdClass();

      $item = $this->video_model->get(
        array(
          "id" => $videoId
        )
      );

      $viewData->viewFolder = $this->viewFolder;
      $viewData->subViewFolder = "video/update";
      $viewData->form_error = true;

      $viewData->item = $item;

      $this->load->view("{$viewData->viewFolder}/{$viewData->subViewFolder}/index", $viewData);
    }
  }

  public function rankGalleryVideoSetter()
  {
    $data = $this->input->post("data");
    parse_str($data, $order);
    $items = $order["ord"];

    foreach ($items as $rank => $id) {
      $this->video_model->update(
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

  public function galleryVideoIsActiveSetter($id)
  {
    if ($id) {
      $isActive = ($this->input->post("data") == "true") ? 1 : 0;

      $this->video_model->update(
        array(
          "id" => $id
        ),
        array(
          "isActive" => $isActive
        )
      );
    }
  }

  public function galleryVideoDelete($id, $galleryId)
  {
    $delete = $this->video_model->delete(
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
    redirect(base_url("galleries/galleryVideoList/$galleryId"));
  }
}