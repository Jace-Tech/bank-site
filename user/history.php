<?php
require_once '../admin/inc/functions/config.php';

if (!isset($_GET['trx-id'])) header("Location: ./index");
$id = $_GET['trx-id'];
$title = "History - $id";

// Get transaction details
$real_id = explode("-r", $id)[1];

$details = executeQuery("SELECT * FROM transactions WHERE id = $real_id");
$user_id = $details['user_id'];
$user = executeQuery("SELECT * FROM users WHERE id = '$user_id'");

require_once 'inc/header.php';

?>
<!-- END Header -->

<!-- Main Container -->
<main id="main-container">

  <!-- Page Content -->
  <div class="content">
    <!-- Quick Overview -->
    <h2 class="content-heading">
      <i class="fa fa-angle-right text-muted mr-1"></i> Transactions Details [<?= $id ?>]</h2>
    </h2>

    <div class="row">
      <div class="col-lg-12">
        <div class="block block-rounded">
          <div class="block-header block-header-default">
            <h3 class="block-title">Transaction</h3>
            <button class="btn btn-info btn-sm shadow" id="printBtn">Print Statement</button>
          </div>

          <div class="block-content">
            <!-- All Products Table -->
            <div class="table-responsive">
              <table class="table table-borderless table-striped table-vcenter">
                <tbody>
                  <tr>
                    <th class="text-center bg-info-lighter">Transaction ID</th>
                    <td><?= $id ?></td>
                  </tr>

                  <tr>
                    <th class="bg-info-lighter text-center">Account Name</th>
                    <td><?= $id ?></td>
                  </tr>

                  <tr>
                    <th class="bg-info-lighter text-center">Account Number</th>
                    <td><?= $details['account_num']; ?></td>
                  </tr>

                  <tr>
                    <th class="bg-info-lighter text-center">Amount</th>
                    <td><?= $details['amount']; ?></td>
                  </tr>

                  <tr>
                    <th class="bg-info-lighter text-center">Beneficiary Name</th>
                    <td><?= $details['beneficiary']; ?></td>
                  </tr>

                  <tr>
                    <th class="bg-info-lighter text-center">Beneficiary Account</th>
                    <td><?= $details['to_user']; ?></td>
                  </tr>

                  <tr>
                    <th class="bg-light text-center">Bank Name</th>
                    <td><?= $details['bank_name']; ?></td>
                  </tr>

                  <tr>
                    <th class="bg-light text-center">Swift Code</th>
                    <td><?= $details['swift_code']; ?></td>
                  </tr>

                  <tr>
                    <th class="bg-light text-center">Transaction Type</th>
                    <td><?= $details['type']; ?></td>
                  </tr>

                  <tr>
                    <th class="bg-light text-center">Transaction Kind</th>
                    <td><?= $details['kind']; ?></td>
                  </tr>

                  <tr>
                    <th class="bg-light text-center">Transaction Date</th>
                    <td><?= date("D d, M Y", strtotime($details['created_at'])); ?></td>
                  </tr>

                  <tr>
                    <th class="bg-light text-center">Description</th>
                    <td><?= $details['description'];  ?></td>
                  </tr>

                </tbody>
              </table>
            </div>
            <!-- END All Products Table -->

          </div>
        </div>
      </div>

    </div>
  </div>
  <!-- END Page Content -->
</main>
<!-- END Main Container -->

<!-- Footer -->
<?php require_once 'inc/footer.php'; ?>
<script src="js/get_recipent.js"></script>