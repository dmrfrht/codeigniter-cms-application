<?php

class Home extends CI_Controller
{
  public $viewFolder = "";

  public function __construct()
  {
    parent::__construct();
    $this->viewFolder = "homepage";
  }

  public function index()
  {
    // anasayfa
    echo $this->viewFolder;
  }

  public function product_list()
  {
    echo 'Urun listesi';
  }
}