<?php

function convert_to_seo($text = "")
{
  $turkce = array("ç", "Ç", "ğ", "Ğ", "ü", "Ü", "ö", "Ö", "ı", "İ", "ş", "Ş", ".", ",", "!", "'", "\"", " ", "?", "*", "|", "_", "=", "^", "+", "%", "&", "/", "(", ")", "[", "]", "{", "}");
  $convert = array("c", "c", "g", "g", "u", "u", "o", "o", "i", "i", "s", "s", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-");
  $seo = strtolower(str_replace($turkce, $convert, $text));

  return $seo;
}

function get_file_name($id)
{
  $t = get_instance();

  return $t->product_image_model->get(
    array(
      "id" => $id
    )
  );
}