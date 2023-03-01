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

  $isDone = [];
  // Loop to the end
  while (!feof($handler)) {
    $rows = fgetcsv($handler, 1000);
    $rows = array_map(function ($item) {
      if (!$item) return NULL;
      return $item;
    }, $rows);

    // Check type
    $sender = $rows[0];
    $type = $rows[1];
    $amount = $rows[2];
    $kind = $rows[3];
    $to_user = $rows[4];
    $beneficiary = $rows[5];
    $bank_name = $rows[6];
    $swift_code = $rows[7];
    $routing_number = $rows[8];
    $account_type = $rows[9];
    $description = $rows[10];
    $status = $rows[11];
    $is_pdf = $rows[12];
    $created_at = $rows[13];
    $is_credit = $rows[14];


    // Update Balance
    $accountDetails = executeQuery("SELECT * FROM accounts WHERE acc_number = '$account' AND user_id = '$id'");
    $balance = floatval($accountDetails['acc_balance']);

    if ($type == 1) {
      $balance = $balance + floatval($amount);
    } else {
      $balance = $balance - floatval($amount);
    }

    // Update balance
    returnQuery("UPDATE accounts SET acc_balance = $balance WHERE acc_number = '$account' AND user_id = '$id'");
    $query = returnQuery("INSERT INTO `transactions`(`user_id`, `sender`, `type`, `amount`, `account_num`, `kind`, `to_user`, `beneficiary`, `bank_name`, `swift_code`, `routing_number`, `account_type`, `description`, `status`, `is_pdf`, `created_at`, `is_credit`) VALUES ('$id', '$sender', '$type', $amount, '$account', '$kind', '$to_user', '$beneficiary', '$bank_name', '$swift_code', '$routing_number', '$account_type', '$description', '$status', '$is_pdf', '$created_at', '$is_credit')");
    array_push($isDone, $query);
  }

  if(!array_filter($isDone,  function($bool) { return $bool === false; })) {
    $_SESSION['A_ALERT'] = json_encode(['type' => "success", 'message' => "Transaction uploaded successfully"]);
    header("Location:" . $_SERVER["HTTP_REFERER"]);
  }
  else {
    $_SESSION['A_ALERT'] = json_encode(['type' => "error", 'message' => "Failed to upload transaction"]);
    header("Location:" . $_SERVER["HTTP_REFERER"]);
  } 
}
