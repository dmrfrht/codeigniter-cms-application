<?php

class Product extends CI_Controller
{
  public $viewFolder = "";

  public function __construct()
  {
    parent::__construct();
    $this->viewFolder = "product_v";
    $this->load->model("product_model");
  }

  public function index()
  {
    $viewData = new stdClass();

    $items = $this->product_model->get_all();

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
          "url" => "test",
          "description" => $this->input->post("description"),
          "rank" => 0,
          "isActive" => true,
          "createdAt" => date("Y-m-d H:i:s")
        )
      );

      if ($insert) {
        echo 'Kayıt İşlemi başarılırdır';
      } else {
        echo 'İşlem başarısızdır';
      }

    } else {
      $viewData = new stdClass();

      $viewData->viewFolder = $this->viewFolder;
      $viewData->subViewFolder = "add";
      $viewData->form_error = true;

      $this->load->view("{$viewData->viewFolder}/{$viewData->subViewFolder}/index", $viewData);
    }
  }
}