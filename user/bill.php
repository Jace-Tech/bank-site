<?php
require_once '../admin/inc/functions/config.php';
$title = "bill";
require_once 'inc/header.php';



if (isset($_POST['submit'])) {
    if (isset($_SESSION['user'])) {
        $id = $_SESSION['user'];
    }

    $response = wire_transfer($_POST, $id);
    if ($response === true) {
        echo "Transfer Successful";
        echo "<script>window.location.href = 'pending'</script>";
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

if (isset($_GET['bill'])) {
    $title = $_GET['bill'];
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
            <i class="fa fa-angle-right text-muted mr-1"></i> <?php echo ucfirst($title); ?> Payment
        </h2>

        <div class="row">

            <div class="col-lg-12 col-xl-12">
                <form action="" method="post" id="wire" onsubmit="handleStartLoading(event)">
                    <div class="form-group">
                        <label for="recipent" class="form-input-label">Biller</label>
                        <input required type="text" name="biller" class="form-control form-input-field" id="recipent" />
                    </div>

                    <div class="form-group">
                        <label for="account_name" class="form-input-label">Reference Number</label>
                        <input required type="text" name="acc_name" id="reference_num" class="form-control form-input-field" />
                    </div>

                    <div class="form-group">
                        <label for="account_name" class="form-input-label">Amount</label>
                        <input required type="text" name="amount" id="account_name" class="form-control form-input-field" />
                    </div>

                    <input type="hidden" id="user" value="<?= $_SESSION['user'] ?>" />

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
<?php require_once 'inc/footer.php'; ?>
<script src="js/get_recipent.js"></script>
<script src="js/transfer.js"></script>