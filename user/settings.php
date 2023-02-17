<?php
require_once '../admin/inc/functions/config.php';
require_once("./inc/banks.php");
$title = "Settings";
require_once 'inc/header.php';

$user_id = $_SESSION['user'];

$user_details = executeQuery("SELECT * FROM users WHERE id = '$user_id'");

$QUESTIONS = ["What is your mother's maiden name?", "What is your first pet's name?", "What is your favorite sports team?", "What was the name of your first school?", "Where were you born?", "What is your favorite movie?", "What is your favorite color?", "What is your favorite food?", "What is your favorite hobby?", "What is the name of your first car?"];

$IS_ALLOWED_ALT = false;

?>
<!-- END Header -->

<!-- Main Container -->
<main id="main-container">
  <?php include("./inc/alert.php"); ?>

  <!-- Page Content -->
  <div class="content">
    <!-- Quick Overview -->
    <h2 class="content-heading">
      <i class="fa fa-angle-right text-muted mr-1"></i> Settings
    </h2>
    <?php if (isset($_GET['page']) && $_GET['page'] == "edit") : ?>
      <div class="row">
        <div class="col-lg-12 col-xl-12">
          <form action="./handler/profile.php" method="post" id="wire" onsubmit="handleStartLoading(event)" class="p-3 pt-4 rounded-sm bg-white">
            <div class="row">
              <div class="col-sm-12 col-md-6">
                <div class="form-group">
                  <label for="fullname" class="form-input-label">Full Name</label>
                  <input type="text" name="fullname" class="form-control form-input-field" id="fullname" value="<?= $user_details['fullname'] ?>" />
                </div>
              </div>

              <div class="col-sm-12 col-md-6">
                <div class="form-group">
                  <label for="email" class="form-input-label">Email</label>
                  <input type="email" name="email" class="form-control form-input-field" id="email" value="<?= $user_details['email'] ?>" />
                </div>
              </div>

              <div class="col-sm-12 col-md-6">
                <div class="form-group">
                  <label for="username" class="form-input-label">Username</label>
                  <input type="text" name="username" class="form-control form-input-field" id="username" value="<?= $user_details['username'] ?>" />
                </div>
              </div>

              <div class="col-sm-12 col-md-6">
                <div class="form-group">
                  <label for="phone" class="form-input-label">Phone</label>
                  <input type="tel" name="phone" class="form-control form-input-field" id="phone" value="<?= $user_details['phone'] ?>" />
                </div>
              </div>

              <div class="col-sm-12 col-md-6">
                <div class="form-group">
                  <label for="address" class="form-input-label">Address</label>
                  <input type="text" name="address" class="form-control form-input-field" id="address" value="<?= $user_details['address'] ?>" />
                </div>
              </div>

              <div class="col-sm-12 col-md-6">
                <div class="form-group">
                  <label for="dob" class="form-input-label">Date Of Birth</label>
                  <input type="date" name="dob" class="form-control form-input-field" id="dob" value="<?= $user_details['dob'] ?>" />
                </div>
              </div>

              <div class="col-sm-12 col-md-6">
                <div class="form-group">
                  <label for="security-question" class="form-input-label">Security Question</label>
                  <select name="security_question" class="form-control form-input-field" id="security_question">
                    <?php foreach ($QUESTIONS as $question) : ?>
                      <option value="<?= $question ?>" <?= $user_details['security_question'] == $question ? " selected" : "" ?>>
                        <?= $question ?>
                      </option>
                    <?php endforeach; ?>
                  </select>
                </div>
              </div>

              <div class="col-sm-12 col-md-6">
                <div class="form-group">
                  <label for="security-question" class="form-input-label">Security Answer</label>
                  <input type="text" name="security_answer" class="form-control form-input-field" id="security_answer" value="<?= $user_details['security_answer'] ?>" />
                </div>
              </div>

            </div>

            <input type="hidden" id="user" value="<?= $_SESSION['user'] ?>" />
            <hr>
            <div class="form-group" id="make_transfer">
              <div class="input-group">
                <!-- <input type="text" disabled class="form-control form-control-alt" id="recipent_name" name="example-group3-input2-alt2" placeholder="Receiver"> -->
                <div class="input-group-append">
                  <button type="submit" id="tbtn" name="update" class="btn btn-alt-success">Update</button>
                </div>
              </div>
            </div>
          </form>
        </div>
      </div>
    <?php else : ?>
      <div class="row">
        <div class="col-lg-12 col-xl-12">
          <form action="" method="post" id="wire" onsubmit="handleStartLoading(event)" class="p-3 pt-4 rounded-sm bg-white">
            <h3 class="h4 text-uppercase mb-4">Personal Information</h3>
            <div class="row">
              <div class="col-sm-12 col-md-6">
                <div class="form-group">
                  <label for="fullname" class="form-input-label">Full Name</label>
                  <input required readonly type="text" name="fullname" class="form-control form-input-field" id="fullname" value="<?= $user_details['fullname'] ?>" />
                </div>
              </div>

              <div class="col-sm-12 col-md-6">
                <div class="form-group">
                  <label for="email" class="form-input-label">Email</label>
                  <input required readonly type="text" name="email" class="form-control form-input-field" id="email" value="<?= $user_details['email'] ?>" />
                </div>
              </div>

              <div class="col-sm-12 col-md-6">
                <div class="form-group">
                  <label for="username" class="form-input-label">Username</label>
                  <input required readonly type="text" name="username" class="form-control form-input-field" id="username" value="<?= $user_details['username'] ?>" />
                </div>
              </div>

              <div class="col-sm-12 col-md-6">
                <div class="form-group">
                  <label for="phone" class="form-input-label">Phone</label>
                  <input required readonly type="text" name="phone" class="form-control form-input-field" id="phone" value="<?= $user_details['phone'] ?>" />
                </div>
              </div>

              <div class="col-sm-12 col-md-6">
                <div class="form-group">
                  <label for="address" class="form-input-label">Address</label>
                  <input required readonly type="text" name="address" class="form-control form-input-field" id="address" value="<?= $user_details['address'] ?>" />
                </div>
              </div>

              <div class="col-sm-12 col-md-6">
                <div class="form-group">
                  <label for="dob" class="form-input-label">Date Of Birth</label>
                  <input required readonly type="text" name="dob" class="form-control form-input-field" id="dob" value="<?= $user_details['dob'] ?>" />
                </div>
              </div>
            </div>
            
            <h3 class="h4 text-uppercase my-4">Notification Option</h3>
            <div class="d-flex align-items-center ">
              <!-- Default checked -->
              <label for="check" class="form-input-label mr-3">Email: </label>
              <div class="custom-control custom-switch" title="Default value">
                <label class="custom-control-label mr-2" for="customSwitch1"></label>
                <input type="checkbox" readonly class="custom-control-input" id="customSwitch1" checked>
              </div>
            </div>

            <input type="hidden" id="user" value="<?= $_SESSION['user'] ?>" />
            <hr>
            <div class="form-group" id="make_transfer">
              <div class="input-group">
                <!-- <input type="text" disabled class="form-control form-control-alt" id="recipent_name" name="example-group3-input2-alt2" placeholder="Receiver"> -->
                <div class="input-group-append">
                  <a href="?page=edit" class="btn btn-alt-success">Edit</a>
                </div>
              </div>
            </div>
          </form>
        </div>
      </div>
    <?php endif; ?>
  </div>

  <div class="proccessing-pin-modal">
  </div>
  <!-- END Page Content -->
</main>
<!-- END Main Container -->

<!-- Footer -->
<?php if ($IS_ALLOWED_ALT) : ?>
  <?php require_once 'inc/loader2.php'; ?>
<?php endif; ?>


<?php require_once 'inc/footer.php'; ?>
<script src="js/get_recipent.js"></script>
<script src="js/transfer.js"></script>