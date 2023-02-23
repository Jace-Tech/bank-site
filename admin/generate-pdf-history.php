<?php
require_once 'inc/functions/config.php';
require_once 'inc/header.php';
require_once "../user/inc/banks.php";

if (isset($_POST['generate'])) {
  $account = $_POST['account-type'];
  $name = $_POST['recipient-name'];
  $amount = $_POST['amount'];
  $date = $_POST['date'];
  $description = $_POST['description'];


  $sql = "INSERT INTO pdf(name, account_type, amount, description, date) VALUES ('$name', '$account', $amount, '$description', '$date')";
  $res = returnQuery($sql);

  if (!$res) {
    echo "<script>swal(`Error generating history`, ``, `error`)</script>";
  } else {
    echo "<script>swal(`History generated!`, '', 'success')</script>";
  }
}

?>
<link href="./assets/date/jquery.datetimepicker.min.css" rel="stylesheet" />
<script src="./assets/date/jquery.js"></script>
<!-- END Header -->

<!-- Main Container -->
<main id="main-container">

  <!-- Page Content -->
  <div class="content pb-5">
    <!-- Quick Overview -->
    <div class="row row-deck">
      <div class="col-12">
        <form action="" class="w-100" method="post">
          <div class="row">

            <div class="col-sm-12 col-md-6">
              <div class="form-group">
                <label for="recipient-name">Name</label>
                <input required type="text" class="form-control" name="recipient-name" id="recipient-name">
              </div>
            </div>

            <div class="col-sm-12 col-md-6">
              <div class="form-group">
                <label for="account-type">Account Type</label>
                <input required type="text" class="form-control" name="account-type" id="account-type">
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
                <label for="date">Date</label>
                <input required type="datetime" class="form-control date-picker" name="date" id="date">
              </div>
            </div>

            <div class="col-sm-12">
              <div class="form-group">
                <label for="date">Description</label>
                <textarea class="form-control" class="form-control" name="description"></textarea>
              </div>
            </div>

            <div class="col-12 ">
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
<script src="./assets/date/jquery.datetimepicker.full.min.js"></script>
<script>
    $('.date-picker').datetimepicker();
  </script>
<!-- END Main Container -->

<!-- Footer -->
<?php require_once 'inc/footer.php'; ?>