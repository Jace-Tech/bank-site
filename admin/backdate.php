<?php
require_once 'inc/functions/config.php';
require_once 'inc/header.php';

if (isset($_GET['id'])) {
    $transaction_id = $_GET['id'];

    if (isset($_POST['submit'])) {
        
        $response = backdate($_POST, $transaction_id);
        if ($response === true) {
            echo "<script>alert('Backdate was successfull!')</script>";
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
}



?>
<!-- END Header -->

<!-- Main Container -->
<main id="main-container">

    <!-- Page Content -->
    <div class="content">
        <!-- Quick Overview -->
        <h2 class="content-heading">
            <i class="fa fa-angle-right text-muted mr-1"></i> Backdate Transaction
        </h2>

        <div class="row">

            <div class="col-lg-12 col-xl-12">
                <form action="" method="post">
                    <div class="form-group">
                        <div class="input-group">
                            <div class="input-group-prepend">
                                <span class="input-group-text">
                                    <i class="far fa-gear"></i>
                                </span>
                            </div>
                            <input type="text" name="date" class="form-control date-picker" placeholder="Backdate Transaction">
                        </div>
                    </div>
                    <hr>
                    <div class="form-group">
                        <div class="input-group">
                            <div class="input-group-append">
                                <button type="submit" name="submit" class="btn btn-alt-success">Backdate Transaction</button>
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
<?php require_once 'inc/footer.php'; ?>
<script src="js/delete_user.js"></script>
<script src="js/get_recipent.js"></script>
<script src="./assets/date/jquery.datetimepicker.full.min.js"></script>
<script>
    $('.date-picker').datetimepicker();
  </script>