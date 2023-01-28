<?php
require_once '../admin/inc/functions/config.php';
$title = "transfer";
require_once 'inc/header.php';



if (isset($_POST['submit'])) {
    if (isset($_SESSION['user'])) {
        $id = $_SESSION['user'];
    }

    $response = make_transfer($_POST, $id);
    if ($response === true) {
        echo "<script>alert('Transfer Successful!')</script>";
        echo "<script>window.location.href = 'pending'</script>";
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
<!-- END Header -->

<!-- Main Container -->
<main id="main-container">

    <!-- Page Content -->
    <div class="content">
        <!-- Quick Overview -->
        <h2 class="content-heading">
            <i class="fa fa-angle-right text-muted mr-1"></i> Domestic Transfer
        </h2>

        <div class="row">

            <div class="col-lg-12 col-xl-12">
                <form action="" method="post" onsubmit="handleStartLoading(event)" class="p-3 bg-white">
                
                    <div class="form-group">
                        <label for="" class="form-input-label">Sender's Account</label>
                        <select required name="sender_account" id="" class="form-control form-input-field">
                            <?php foreach($userAccounts as $account): ?>
                                <option value="<?= $account['acc_number'] ?>">
                                    <?= $account['acc_number'] ?>
                                </option>
                            <?php endforeach; ?>
                        </select>
                    </div>
                
                    <div class="form-group">
                        <label for="" class="form-input-label">Recipent's Account</label>
                        <input required type="text" name="recipent" class="form-control form-input-field" id="account_number">
                    </div>

                    <div class="form-group">
                        <label for="" class="form-input-label">Routing Number</label>
                        <input required type="text" maxLength="9" name="routing_number" class="form-control form-input-field">
                    </div>

                    <div class="form-group">
                        <label for="" class="form-input-label">Amount</label>
                        <input required type="text" class="form-control form-input-field" name="amount" />
                    </div>

                    <div class="form-group">
                        <label for="desc" class="form-input-label">Description</label>
                        <textarea name="desc" class="form-control" placeholder="Enter transaction description"></textarea>
                    </div>

                    <hr>
                    <div class="form-group" id="make_transfer">
                        <div class="input-group">
                            <!-- <input type="text" disabled class="form-control form-control-alt" id="recipent_name" name="example-group3-input2-alt2" placeholder="Receiver"> -->
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
<?php require_once 'inc/loader.php'; ?>

<?php require_once 'inc/footer.php';     ?>
<script src="js/get_recipent.js"></script>