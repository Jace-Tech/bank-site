<?php 

require_once '../../admin/inc/functions/config.php';

if(isset($_POST['update'])) {
  $fullname = sanitize($_POST['fullname']);
  $email = sanitize($_POST['email']);
  $username = sanitize($_POST['username']);
  $phone = sanitize($_POST['phone']);
  $address = sanitize($_POST['address']);
  $dob = sanitize($_POST['dob']);
  $ssn = sanitize($_POST['ssn']);
  $security_question = sanitize($_POST['security_question']);
  $security_answer = sanitize($_POST['security_answer']);
  $user_id = $_SESSION['user'];

  $result = returnQuery("UPDATE users SET fullname = '$fullname', ssn = '$ssn', email = '$email', username = '$username', phone = '$phone', address = '$address', dob = '$dob', security_question = '$security_question', security_answer = '$security_answer' WHERE id = '$user_id'");

  if($result) {
    $_SESSION['ALERT'] = json_encode(["msg" => "Profile Updated", "type" => "success"]);
    header("Location: ../settings");
  }
  else {
    $_SESSION['ALERT'] = json_encode(["msg" => "Failed to update profile", "type" => "error"]);
    header("Location: ../settings");
  }
}