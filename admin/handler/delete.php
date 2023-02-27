<?php
@session_start();
require_once("../inc/functions/helpers.php");
require_once("../inc/functions/user_func.php");


if (isset($_GET['delete'])) {
  $del_id = $_GET['delete'];
  $response = returnQuery("DELETE FROM transactions WHERE id = '$del_id'");
  if ($response) {
    $_SESSION['A_ALERT'] = json_encode(['type' => "success", 'message' => "Transaction deleted successfully"]);
    header("Location:" . $_SERVER["HTTP_REFERER"]);
  } else {
    $_SESSION['A_ALERT'] = json_encode(['type' => "error", 'message' => "Failed to delete transaction"]);
    header("Location:" . $_SERVER["HTTP_REFERER"]);
  }
}