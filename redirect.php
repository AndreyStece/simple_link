<?php
require_once('connect.php');

if(!empty($_GET['key'])){
  $key = mysqli_real_escape_string($dbConn, trim($_GET['key']));
  $select = mysqli_query($dbConn, "SELECT * FROM `short_links` WHERE `token` = '".$key."'");
  if (!mysqli_num_rows($select)) { ?>
    <!DOCTYPE html>
    <html lang="ru">
    <head>
      <meta charset="UTF-8">
      <meta http-equiv="X-UA-Compatible" content="IE=edge">
      <meta name="viewport" content="width=device-width, initial-scale=1.0">
      <title>Страница не найдена</title>
      <link rel="stylesheet" href="style.css">
    </head>
    <body>
      <div class="container not-found">
        <h1>404 | Page not found</h1>
      </div>
    </body>
    </html>
  <?php } else {
    $row = mysqli_fetch_assoc($select);
    header("Location: " . $row['link']);
  }
}
