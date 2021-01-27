<?php
function _redirect($route, $params = array(), $crypt = false) {
  $dataParams = "";

  if (count($params)) {
    foreach ($params as $key => $param) {
      if ($crypt) {
        $key = base64_encode($key);
        $param = base64_encode($param);
      } else {
        $param = urlencode($param);
      }

      $dataParams .= "&{$key}={$param}";
    }

    header("location: {$route}{$dataParams}");
  } else {
    header("location: {$route}");
  }
}

function _get($name, $decrypt = false) {
  $get = $_GET;
  $arrReturn = array();

  foreach ($get as $key => $param) {
    if ($decrypt) {
      $key = base64_decode($key);
      $param = base64_decode($param);
    }

    $arrReturn[$key] = $param;
  }

  if (isset($arrReturn[$name])) {
    return $arrReturn[$name];
  }
}