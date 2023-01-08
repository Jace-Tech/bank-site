<?php @session_start();  ?>
<?php require("./SET_UP.php") ?>
<?php
$errors = [];
require_once './admin/inc/functions/config.php';
// echo generateNumber(2);

if (isset($_POST['submit'])) {
  $response = user_login($_POST);

  if ($response === true) {
    redirect_to("./user/validate-login");
  } else {
    $errors = $response;
    if (is_array($errors)) {
      foreach ($errors as $err) {
        echo "<script>alert('$err')</script>";
      }
    } else {
      echo "<script>alert('$errors')</script>";
    }
  }
}
?>

<div class="show-for-large grid-x header-main">
  <div class="cell shrink logo-container">
    <a href="index.php">
      <h1 class="show-for-sr">Beko Federal Credit Union (BEKOFCU)</h1>
      <img src="./logo.png" alt="Home">
    </a>
  </div>
  <div class="cell auto desktop-login">
    <div class="grid-x align-right">
      <div class="cell small-12">
        <div class="login-links-container">
          <ul class="login-links">
            <li><a href="#">Forgot password?</a></li>
            <li><a href="/user/signup">Enroll Now</a></li>
          </ul>
        </div>
        <form name="Q2OnlineLogin" action="" method="post">
          <div class="grid-x">
            <div class="cell shrink input-group">
              <input id="desktop-user-id" name="accNum" placeholder="Account number" type="text" autocomplete="username" required>
            </div>
            <div class="cell shrink input-group">
              <input id="desktop-password" name="password" placeholder="Password" type="password" autocomplete="current-password">
            </div>
            <div class="cell auto">
              <button class="button" name="submit" type="submit">Login</button>
            </div>
          </div>
        </form>
      </div>
    </div>
  </div>
</div>