<?php
require_once('connect.php');

if(isset($_SERVER['HTTP_X_REQUESTED_WITH']) && !empty($_SERVER['HTTP_X_REQUESTED_WITH']) && strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) == 'xmlhttprequest') {
  if (isset($_POST['long_url'])) {
    $requset = mysqli_real_escape_string($dbConn, trim($_POST['long_url']));
    $arr = array();
    if (empty($requset)) {
      $arr['error'] = 'Пустое поле ввода';
    } elseif (!filter_var($requset, FILTER_VALIDATE_URL)) {
      $arr['error'] = 'Неверный формат URL';
    } else {
      $select = mysqli_query($dbConn, "SELECT * FROM `short_links` WHERE `link` = '".$requset."'");
      $arr['solution'] = 'http://' . $_SERVER['HTTP_HOST'] . '/';
      if (mysqli_num_rows($select)) {
        $row = mysqli_fetch_assoc($select);
        $arr['success'] = 'Такой URL уже есть';
        $arr['solution'] .= $row['token'];
      } else {
        $flag = false;
        while (!$flag) {
          $token = genToken(6);
          $select = mysqli_query($dbConn, "SELECT * FROM `short_links` WHERE `token` = '".$token."'");
          if (!mysqli_num_rows($select)) {
              $flag = true;
              break;
          }
        }
        $insert = mysqli_query($dbConn, "INSERT INTO `short_links` (`link`, `token`) VALUES ('".$requset."','".$token."')");
        $arr['success'] = 'Добавлен новый URL';
        $arr['solution'] .= $token;
      }
    }
    echo json_encode($arr);
    return;
  }
}

function genToken($count = 5) {
  $chars = str_split('abcdefghijklmnopqrstuvwxyzABCDFEGHIJKLMNOPRSTUVWXYZ0123456789');
  $token = '';

  for ($i = 0; $i < $count; $i++) {
      $token .= $chars[mt_rand(0, sizeof($chars) - 1)];
  }

  return $token;
}
