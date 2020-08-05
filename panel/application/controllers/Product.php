<?php

class Product extends CI_Controller
{
  public $viewFolder = "";

  public function __construct()
  {
    parent::__construct();
    $this->viewFolder = "product_v";
    $this->load->model("product_model");
    $this->load->model("product_image_model");
  }

  public function index()
  {
    $viewData = new stdClass();

    $items = $this->product_model->get_all(
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
      $insert = $this->product_model->add(
        array(
          "title" => $this->input->post("title"),
          "url" => convert_to_seo($this->input->post("title")),
          "description" => $this->input->post("description"),
          "rank" => 0,
          "isActive" => true,
          "createdAt" => date("Y-m-d H:i:s")
        )
      );

      if ($insert) {
        // TODO -> Alert Sistemi Eklenecek
        redirect(base_url("product"));
      } else {
        // TODO -> Alert Sistemi Eklenecek
        redirect(base_url("product"));
      }

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

    $item = $this->product_model->get(
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
      $update = $this->product_model->update(
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
        // TODO -> Alert Sistemi Eklenecek
        redirect(base_url("product"));
      } else {
        // TODO -> Alert Sistemi Eklenecek
        redirect(base_url("product"));
      }

    } else {
      $viewData = new stdClass();

      $item = $this->product_model->get(
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
    $delete = $this->product_model->delete(
      array(
        "id" => $id
      )
    );

    if ($delete) {
      // TODO -> Alert Sistemi Eklenecek
      redirect(base_url("product"));
    } else {
      // TODO -> Alert Sistemi Eklenecek
      redirect(base_url("product"));
    }
  }

  public function isActiveSetter($id)
  {
    if ($id) {
      $isActive = ($this->input->post("data") == "true") ? 1 : 0;

      $this->product_model->update(
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
      $this->product_model->update(
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

    $item = $this->product_model->get(
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

      // TODO -> Alert Sistemi Eklenecek
      redirect(base_url("product/imageForm/$parent_id"));
    } else {
      // TODO -> Alert Sistemi Eklenecek
      redirect(base_url("product/imageForm/$parent_id"));
    }
  }

}