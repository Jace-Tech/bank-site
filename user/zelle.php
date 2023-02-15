<?php
require_once '../admin/inc/functions/config.php';
require_once("./inc/banks.php");
$title = "transfer";
require_once 'inc/header.php';

$IS_ALLOWED = false;


if (isset($_POST['submit'])) {
    if (isset($_SESSION['user'])) {
        $id = $_SESSION['user'];
        $account = $_POST['recipent'];
        $bank = $_POST['bank_name'];

        $query = returnQuery("SELECT * FROM allowed WHERE user_id = '$id' AND account = '$account' AND bank = '$bank'");
        $check = mysqli_num_rows($query);

        $data = mysqli_fetch_assoc($query);

        if (!$check) {
            $IS_ALLOWED = true;
        } else {
            $response = wire_transfer($_POST, $id);
            if ($response === true) {
                echo "<script>swal(`Transaction request sent`, `Transaction awaiting approval`, `success`)</script>";
            } else {
                $errors = $response;
                if (is_array($errors)) {
                    foreach ($errors as $err) {
                        echo "<script>alert('$err')</s>";
                    }
                } else {
                    echo "<script>alert('$errors')</script>";
                }
            }
        }
    }
}

$accountTypes = returnQuery("SELECT * FROM `account_type`");

?>
<!-- END Header -->

<!-- Main Container -->
<main id="main-container">

    <!-- Page Content -->
    <div class="content">
        <!-- Quick Overview -->
        <h2 class="content-heading">
            <i class="fa fa-angle-right text-muted mr-1"></i> Zelle
        </h2>

        <p class="mb-4">Choose any of these options below to continue</p>

        <div class="container">
          <div class="row">
            <a class="col-sm-12 col-md-4">
              <div class="d-flex align-items-center justify-content-center">
                Email
              </div>
            </a>

            <a class="col-sm-12 col-md-4">
              <div class="d-flex align-items-center justify-content-center">
                Phone
              </div>
            </a>

            <a class="col-sm-12 col-md-4">
              <div class="d-flex align-items-center justify-content-center">
                Routing Number
              </div>
            </a>
          </div>
        </div>
    </div>

    <div class="proccessing-pin-modal">

    </div>
    <!-- END Page Content -->
</main>
<!-- END Main Container -->

<!-- Footer -->
<?php if($IS_ALLOWED):?>
    <?php require_once 'inc/loader.php'; ?>
<?php endif; ?>

<?php require_once 'inc/footer.php'; ?>
<script src="js/get_recipent.js"></script>
<script src="js/transfer.js"></script>

<!-- 1. Direct Deposit -->
<!-- Account Number -->
<!-- Routing / ABA -->
<!-- Amount -->

<!-- 2. ACH Transfer -->
<!-- Routing / ABA -->
<!-- 1. Direct Deposit -->

