<?php
require_once '../admin/inc/functions/config.php';
$title = "transfer";
require_once 'inc/header.php';

$IS_ALLOWED = false;



if (isset($_POST["submit"])) {
  if (isset($_SESSION['user'])) {
    $id = $_SESSION['user'];
    $account = $_POST['account'];
    $amount = $_POST['amount'];
    $userAccount = $_POST['sender_account'];
    $routing_number = $_POST['routing_number'];
    $bank = NULL;

    $query = returnQuery("SELECT * FROM allowed WHERE user_id = '$id' AND account = '$account' OR bank = '$bank'");
    $check = mysqli_num_rows($query);

    if (!$check) {
      $IS_ALLOWED = true;
    } else {
      $IS_ALLOWED = false;
      // 
      $response = returnQuery("INSERT INTO transactions (user_id, type, account_num, amount, to_user, routing_number, created_at, kind) 
      VALUES ('$id', 1, '$userAccount', $amount, '$account', '$routing_number', now(), 'direct deposit')");
      if ($response === true) {
        echo "<script>swal(`Transaction request sent`, `Transaction awaiting approval`, `success`)</script>";
      } else {
        $errors = $response;
        if (is_array($errors)) {
          foreach ($errors as $err) {
            echo "<script>swal(`$err`, '', `error`)</script>";
          }
        } else {
          echo "<script>swal('$errors', '', `error`)</script>";
        }
      }
    }
  }
}



?>
<!-- END Header -->

<!-- Main Container -->
<main id="main-container">

  <!-- Page Content -->
  <div class="content">
    <!-- Quick Overview -->
    <h2 class="content-heading">
      <i class="fa fa-angle-right text-muted mr-1"></i> Direct Deposit
    </h2>

    <div class="row">

      <div class="col-lg-12 col-xl-12">
        <form action="" method="post" onsubmit="handleStartLoading(event)" class="p-3 pt-4 rounded-sm bg-white">

          <div class="form-group">
            <label for="sender" class="form-input-label">Sender's Account</label>
            <select required name="sender_account" id="sender" class="form-control form-input-field">
              <?php foreach ($userAccounts as $account) : ?>
                <option value="<?= $account['acc_number'] ?>">
                  <?= $account['acc_number'] . " - " . $account['acc_type'] ?>
                </option>
              <?php endforeach; ?>
            </select>
          </div>

          <div class="form-group">
            <label for="" class="form-input-label">Account Number</label>
            <input required type="text" maxLength="9" name="account" class="form-control form-input-field" required>
          </div>

          <div class="form-group">
            <label for="" class="form-input-label">Routing / ABA</label>
            <input required type="text" maxLength="9" name="routing_number" class="form-control form-input-field" required>
          </div>

          <div class="form-group">
            <label for="" class="form-input-label">Amount</label>
            <input required type="text" class="form-control form-input-field" name="amount" required />
          </div>

          <hr>
          <div class="form-group" id="make_transfer">
            <div class="input-group">
              <div class="input-group-append">
                <button type="submit" id="tbtn" name="submit" class="btn btn-alt-success">Proceed</button>
              </div>
            </div>
          </div>
        </form>
      </div>
    </div>
  </div>
  <!-- END Page Content -->
</main>
<!-- END Main Container -->

<!-- Footer -->
<?php if ($IS_ALLOWED) : ?>
  <?php require_once 'inc/loader.php'; ?>
<?php endif; ?>


<?php require_once 'inc/footer.php';     ?>
<script src="js/get_recipent.js"></script>