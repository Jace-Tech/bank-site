<?php
require_once 'inc/functions/config.php';
require_once 'inc/header.php';
require_once "../user/inc/banks.php";

$USERS = mysqli_fetch_all(returnQuery("SELECT * FROM users"), MYSQLI_ASSOC);
$ACCOUNTS = mysqli_fetch_all(returnQuery("SELECT * FROM accounts"), MYSQLI_ASSOC);
if (isset($_GET['acc'])) {
  $acc_no = $_GET['acc'];
  $TRANSACTIONS = mysqli_fetch_all(returnQuery("SELECT * FROM transactions WHERE account_num = '$acc_no'"), MYSQLI_ASSOC);
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
        <form action="" class="w-100" method="get">
          <input type="hidden" value='<?= json_encode($ACCOUNTS); ?>' id="accounts" />
          <div class="row">
            <div class="col-sm-12 col-md-6">
              <div class="form-group">
                <label for="user" class="label">User</label>
                <select name="" onchange="handleFetchUsersAccount(event)" class="form-control" id="user">
                  <option value="" selected disabled>Select User</option>
                  <?php foreach ($USERS as $user) : ?>
                    <option value="<?= $user['id']; ?>">
                      <?= $user['fullname']; ?>
                    </option>
                  <?php endforeach; ?>
                </select>
              </div>
            </div>

            <div class="col-sm-12 col-md-6">
              <div class="form-group">
                <label for="user-accounts" class="label">User Accounts</label>
                <select name="acc" class="form-control" id="user-accounts">
                  <option value="" selected disabled>Select User Account</option>
                </select>
              </div>
            </div>
            <div class="col-12">
              <div class="mt-3">
                <button type="submit" name="generate" class="btn btn-sm btn-primary">View History</button>
              </div>
            </div>
          </div>

          <?php if (isset($_GET['acc'])) : ?>
            <div class="col-12">
              <div class="d-flex justify-content-end">
                <!-- <button class="btn btn-sm btn-primary">Print</button> -->
              </div>
            </div>
            <div class="col-12">
              <div class="table-responsive">
              <table class="table w-100 table-striped">
                <!-- Amount | Type | Status | Date | Narrative -->
              <thead>
                  <tr>
                    <td>Amount</td>
                    <td>Type</td>
                    <td>Status</td>
                    <td>Date</td>
                    <td>Narrative</td>
                  </tr>
                </thead>

                <tbody>
                  <?php if (count($TRANSACTIONS)) : ?>
                    <?php foreach ($TRANSACTIONS as $transaction) : ?>
                      <tr>
                        <td class="font-weight-light font-size-h5"> $<?= number_format($transaction['amount']); ?> </td>
                        <td class="font-weight-light font-size-h5"> <?= $transaction['kind']; ?> </td>
                        <td class="font-weight-light font-size-h5">
                          <?php $badge = ($transaction['status'] == "approved" ? "badge-success" : ($transaction['status'] == "pending" ? "badge-warning" : "badge-danger")) ?>
                          <span class="badge <?= $badge ?>"><?= $transaction['status'] == 'approved'? "success" : $transaction['status']; ?></span>
                        </td>
                        <td class="font-weight-light font-size-h5">
                          <?= date("d M Y", strtotime($transaction['created_at'])) ?>
                        </td>
                        <td class="font-weight-light font-size-h5"> <?= $transaction['description']; ?> </td>
                      </tr>
                    <?php endforeach; ?>
                  <?php else : ?>
                    <tr>
                      <td class="py-4 text-center text-muted" colspan="5">No transaction records</td>
                    </tr>
                  <?php endif; ?>
                </tbody>

              </table>
              </div>
            </div>
          <?php endif; ?>

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