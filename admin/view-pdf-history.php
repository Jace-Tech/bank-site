<?php
require_once 'inc/functions/config.php';
require_once 'inc/header.php';
require_once "../user/inc/banks.php";

$TRANSACTIONS = mysqli_fetch_all(returnQuery("SELECT * FROM pdf ORDER BY date DESC"), MYSQLI_ASSOC);

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

            <div class="col-12">
              <div class="d-flex justify-content-end">
                <!-- <button class="btn btn-sm btn-primary">Print</button> -->
              </div>
            </div>
            <div class="col-12">
              <div class="table-responsive table-responsive-lg mt-4">
                <table class="table w-100 table-striped">
                  <thead>
                    <tr>
                      <td style="font-weight: 600; font-size: .9rem;">Date</td>
                      <td style="font-weight: 600; font-size: .9rem;">Name</td>
                      <td style="font-weight: 600; font-size: .9rem;">Description</td>
                      <td style="font-weight: 600; font-size: .9rem;">Account Type</td>
                      <td style="font-weight: 600; font-size: .9rem;">Amount</td>
                    </tr>
                  </thead>

                  <tbody>
                    <?php if (count($TRANSACTIONS)) : ?>
                      <?php foreach ($TRANSACTIONS as $transaction) : ?>
                        <tr>
                          <td style="font-size: .9rem; font-weight: 300;"> <?= date("M j, Y", strtotime($transaction['date'])); ?> </td>
                          <td style="font-size: .9rem; font-weight: 300;"> <?= ucwords($transaction['name']); ?> </td>
                          <td style="font-size: .9rem; font-weight: 300;"> <?= ucfirst($transaction['description']); ?> </td>
                          <td style="font-size: .9rem; font-weight: 300;"> <?= ucfirst($transaction['account_type']); ?> </td>
                          <td style="font-size: .9rem; font-weight: 500;"> $<?= number_format($transaction['amount']); ?> </td>
                        </tr>
                      <?php endforeach; ?>
                      <tr>
                        <div class="d-flex justify-content-end py-5">
                          <button class="btn btn-sm btn-primary" id="hide">Print</button>
                          <small>Still working on it!</small>
                        </div>
                      </tr>
                    <?php else : ?>
                      <tr>
                        <td class="py-4 text-center text-muted" colspan="5">No transaction records</td>
                      </tr>
                    <?php endif; ?>
                  </tbody>
                </table>
              </div>
            </div>
        </form>
      </div>
    </div>
  </div>
  <!-- END Page Content -->
</main>

<div class="print-page container-lg">
  <table class="table w-100 table-striped">
    <thead>
      <tr>
        <td style="font-weight: 600; font-size: .9rem;">Amount</td>
        <td style="font-weight: 600; font-size: .9rem;">Type</td>
        <td style="font-weight: 600; font-size: .9rem;">Status</td>
        <td style="font-weight: 600; font-size: .9rem;">Date</td>
        <td style="font-weight: 600; font-size: .9rem;">Narrative</td>
      </tr>
    </thead>

    <tbody>
      <?php if (count($TRANSACTIONS)) : ?>
        <?php foreach ($TRANSACTIONS as $transaction) : ?>
          <tr>
            <td style="font-size: .9rem; font-weight: 600;"> $<?= number_format($transaction['amount']); ?> </td>
            <td style="font-size: .9rem; font-weight: 300;"> <?= ucfirst($transaction['kind']); ?> </td>
            <td style="font-size: .9rem; font-weight: 300;">
              <?php $badge = ($transaction['status'] == "approved" ? "badge-success" : ($transaction['status'] == "pending" ? "badge-warning" : "badge-danger")) ?>
              <span class="badge <?= $badge ?>"><?= $transaction['status'] == 'approved' ? "success" : $transaction['status']; ?></span>
            </td>
            <td style="font-size: .9rem; font-weight: 300;">
              <?= date("d M Y", strtotime($transaction['created_at'])) ?>
            </td>
            <td style="font-size: .9rem; font-weight: 300;"> <?= ucfirst($transaction['description']); ?> </td>
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
<script src="./js/get_recipent.js"></script>
<!-- END Main Container -->
<script>
  const printBtn = document.querySelector("#hide")
  printBtn.addEventListener("click", (e) => {
    e.preventDefault()
    printBtn.style.display = "none"
    window.print()

    setTimeout(() => {
      printBtn.style.display = "flex"
    }, 10000)
  })
</script>
<!-- Footer -->
<?php require_once 'inc/footer.php'; ?>