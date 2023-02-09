<?php
require_once 'inc/functions/config.php';
require_once 'inc/header.php';
require_once "../user/inc/banks.php";

$USERS = mysqli_fetch_all(returnQuery("SELECT * FROM users"), MYSQLI_ASSOC);
$ACCOUNTS = mysqli_fetch_all(returnQuery("SELECT * FROM accounts"), MYSQLI_ASSOC);

if (isset($_POST['generate'])) {
  $sender_account = $_POST['sender-account'];
  $recipient_name = $_POST['recipient-name'];
  $recipient_account = $_POST['recipient-account'];
  $bank = $_POST['bank'];
  $amount = $_POST['amount'];
  $swift_code = $_POST['swift-code'];
  $kind = $_POST['kind'];
  $type = $_POST['type'];
  $sender = $_POST['sender'];
  $date = $_POST['date'];
  $description = $_POST['description'];


  $sql = "INSERT INTO transactions(user_id, sender, type, kind, amount, account_num, to_user, bank_name, beneficiary, description, status, created_at) 
    VALUES ('usr_11111111', '$sender', '$type', '$kind', '$amount', '$sender_account', '$recipient_account', '$bank', '$recipient_name' , '$description', 'approved', '$date')";
  $res = returnQuery($sql);

  if (!$res) {
    echo "<script>swal(`Error generating history`, ``, `error`)</script>";
  } else {
    echo "<script>swal(`History generated!`, '', 'success')</script>";
  }
}

?>
<!-- END Header -->

<!-- Main Container -->
<main id="main-container">

  <!-- Page Content -->
  <div class="content">
    <!-- Quick Overview -->
    <div class="row row-deck">
      <div class="col-12">
        <form action="" class="w-100" method="post">
          <div class="row">
            <div class="col-sm-12 col-md-6">
              <div class="form-group">
                <label for="sender">Sender Name</label>
                <input required type="text" class="form-control" name="sender" id="sender">
              </div>
            </div>

            <div class="col-sm-12 col-md-6">
              <div class="form-group">
                <label for="sender-account">Sender Account</label>
                <input required type="text" class="form-control" name="sender-account" id="sender-account">
              </div>
            </div>

            <div class="col-sm-12 col-md-6">
              <div class="form-group">
                <label for="recipient-name">Recipient Name</label>
                <input required type="text" class="form-control" name="recipient-name" id="recipient-name">
              </div>
            </div>

            <div class="col-sm-12 col-md-6">
              <div class="form-group">
                <label for="recipient-account">Recipient Account</label>
                <input required type="text" class="form-control" name="recipient-account" id="recipient-account">
              </div>
            </div>

            <div class="col-sm-12 col-md-6">
              <div class="form-group">
                <label for="bank">Recipient Bank</label>
                <input required type="text" list="banks" class="form-control" name="bank" id="bank">
                <datalist id="banks">
                  <?php foreach ($us_banks as $bank) : ?>
                    <option value="<?= $bank; ?>"></option>
                  <?php endforeach; ?>
                </datalist>
              </div>
            </div>

            <div class="col-sm-12 col-md-6">
              <div class="form-group">
                <label for="amount">Amount</label>
                <input required type="number" class="form-control" name="amount" id="amount">
              </div>
            </div>


            <div class="col-sm-12 col-md-6">
              <div class="form-group">
                <label for="swift-code" class="form-input-label">Swift Code</label>
                <input required required type="text" id="swift-code" class="form-control form-input-field" name="swift-code" />
              </div>
            </div>

            <div class="col-sm-12 col-md-6">
              <div class="form-group">
                <label for="kind">Transaction Kind</label>
                <select name="kind" class="form-control" id="kind" required>
                  <option value="" selected disabled>Select Transaction Type</option>
                  <option value="wire tranfer">Wire</option>
                  <option value="tranfer">Transfer</option>
                  <option value="international transfer">International Transfer</option>
                </select>
              </div>
            </div>

            <div class="col-sm-12 col-md-6">
              <div class="form-group">
                <label for="type">Transaction Type</label>
                <select name="type" class="form-control" id="type">
                  <option value="" selected disabled>Select Transaction Kind</option>
                  <option value="0">Credit</option>
                  <option value="1">Debit</option>
                </select>
              </div>
            </div>

            <div class="col-sm-12 col-md-6">
              <div class="form-group">
                <label for="date">Description</label>
                <textarea class="form-control" class="form-control" name="description"></textarea>
              </div>
            </div>

            <div class="col-sm-12 col-md-6">
              <div class="form-group">
                <label for="date">Date</label>
                <input required type="date" class="form-control" name="date" id="date">
              </div>
            </div>

            <div class="col-12">
              <div class="mt-3">
                <button type="submit" name="generate" class="btn btn-primary">Generate History</button>
              </div>
            </div>
          </div>

        </form>
      </div>
    </div>
  </div>
  <!-- END Page Content -->
</main>
<script src="./js/get_recipent.js"></script>
<!-- END Main Container -->

<!-- Footer -->
<?php require_once 'inc/footer.php'; ?>