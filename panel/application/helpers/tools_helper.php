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

function get_readable_date($date)
{
  return strftime('%e %B %Y', strtotime($date));
}

function get_active_user()
{
  $t = &get_instance();

  $user = $t->session->userdata("user");

  if ($user)
    return $user;
  else
    return false;
}