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
                        <div class="input-group">
                            <div class="input-group-prepend">
                                <span class="input-group-text">
                                    <i class="fa fa-address-card"></i>
                                </span>
                            </div>
                            <input type="text" name="recipent" onblur="getRecipent()" class="form-control" id="account_number" placeholder="Account Number">
                        </div>
                    </div>

                    <div class="form-group">
                        <div class="input-group">
                            <div class="input-group-prepend">
                                <span class="input-group-text">
                                    <i class="far fa-user"></i>
                                </span>
                            </div>
                            <input type="text" name="acc_name" class="form-control" placeholder="Enter account beneficiary name">
                        </div>
                    </div>
                    
                    <div class="form-group">
                        <div class="input-group">
                            <div class="input-group-prepend">
                                <span class="input-group-text">
                                    <i class="fa fa-building"></i>
                                </span>
                            </div>
                            <input type="text" name="bank_name" class="form-control" placeholder="Enter bank name">
                        </div>
                    </div>
                    
                    <div class="form-group">
                        <div class="input-group">
                            <div class="input-group-prepend">
                                <span class="input-group-text">
                                    <i class="fa fa-terminal"></i>
                                </span>
                            </div>
                            <input type="text" name="swift_code" class="form-control" placeholder="Enter swift code">
                        </div>
                    </div>

                    <div class="form-group">
                        <div class="input-group">
                            <div class="input-group-prepend">
                                <span class="input-group-text">
                                    <i class="fa fa-terminal"></i>
                                </span>
                            </div>
                            <input type="hidden" name="kind" value="bill payment ">
                            <input type="text" maxLength="9" name="routing_number" class="form-control" placeholder="Enter Routing number">
                        </div>
                    </div>

                    <div class="form-group">
                        <div class="input-group">
                            <div class="input-group-prepend">
                                <span class="input-group-text">
                                    <i class="fa fa-piggy-bank"></i>
                                </span>
                            </div>
                           
                            <select name="type" name="type" class="form-control">
                                <option value="" selected disabled>Select account type</option>
                                <?php while($accountType = mysqli_fetch_assoc($accountTypes)): ?>
                                    <option value="<?= $accountType['type']?>"> 
                                        <?= $accountType['type'] ?>
                                    </option>
                                <?php endwhile; ?>
                            </select>
                            
                        </div>
                    </div>

                    <div class="form-group">
                        <div class="input-group">
                            <div class="input-group-prepend">
                                <span class="input-group-text">
                                    <i class="fa fa-dollar-sign"></i>
                                </span>
                            </div>
                            <input type="text" class="form-control" name="amount" placeholder="Amount">
                            <div class="input-group-append">
                                <span class="input-group-text">.00</span>
                            </div>
                        </div>
                    </div>

                    <div class="form-group">
                        <div class="input-group">
                            <div class="input-group-prepend">
                                <span class="input-group-text">
                                    <i class="fa fa-edit"></i>
                                </span>
                            </div>
                            <textarea name="desc" class="form-control" placeholder="Enter transaction description"></textarea>
                        </div>
                    </div>

                    <input type="hidden" id="user" value="<?= $_SESSION['user']?>" />

                    <hr>
                    <div class="form-group" id="make_transfer" style="display: none;">
                        <div class="input-group">
                            <input type="text" disabled class="form-control form-control-alt" id="recipent_name" name="example-group3-input2-alt2" placeholder="Receiver">
                            <div class="input-group-append">
                                <button type="submit" id="tbtn" name="submit" class="btn btn-alt-success">Make Transfer</button>
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