<?php

function alias_to_name($alias) {
  $arr = array();

  foreach (explode('-', $alias) as $key => $val) {
    $arr[] = ucfirst($val);
  }
  return implode(" ", $arr);
}

function to_img($fid, $img_style, $is_uri = null, $is_avatar = false) {
  if ($is_avatar) {
  }
  if (!$is_uri) {
    // so is fid, not uri
    $url = image_style_url($img_style, file_load($fid)->uri);
    return $url;
  } else {
    // uri
    return image_style_url($img_style, $fid);
  }
}

function to_id($id) {
  return preg_replace('/--+\d/', '', strtolower(drupal_clean_css_identifier($id)));
}

function object_to_array($d) {
  if (is_object($d))
    $d = get_object_vars($d);
  return is_array($d) ? array_map(__FUNCTION__, $d) : $d;
}

function array_to_object($d) {
  return is_array($d) ? (object) array_map(__FUNCTION__, $d) : $d;
}

function get_block($module, $id) {
  return drupal_render(_block_get_renderable_array(_block_render_blocks(array(block_load($module, $id)))));
}

function get_lang() {
  global $language;
  return $language->language;
}

function recursive_unset(&$array, $unwanted_key) {
  unset($array[$unwanted_key]);
  foreach ($array as &$value) {
    if (is_array($value)) {
      recursive_unset($value, $unwanted_key);
    }
  }
}
