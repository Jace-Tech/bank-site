<?php
@session_start();
require_once("../inc/functions/helpers.php");
require_once("../inc/functions/user_func.php");
require_once("../inc/functions/db.php");


if (isset($_POST['upload'])) {
  // Get users transaction history
  $id = $_POST['id'];
  $account = $_POST['account'];

  $file = $_FILES['file'];
  $handler = fopen($file['tmp_name'], "r");
  // Loop to the end
  while (!feof($handler)) {
    $rows = fgetcsv($handler, filesize($file['size']));
    $modified = 
    $rows = array_map(function ($item){
      if(!$item) return NULL;
      return $item;
    }, $rows);

    var_dump($rows);
    die();

    // Check type
    $type = $rows[1];
    $amount = $rows[2];
  }

  // Add to Database

  // Redirect
}
