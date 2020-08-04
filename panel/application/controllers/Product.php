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
}