<?php
require_once 'inc/functions/config.php';
require_once 'inc/header.php';

$USERS = mysqli_fetch_all(returnQuery("SELECT * FROM users"), MYSQLI_ASSOC);

if(isset($_POST['generate'])) {
  $user = $_POST['user'];
  $start = $_POST['startdate'];
  $end = $_POST['enddate'];
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
        <form action="">
          <div class="form-group">
            <label for="user">User</label>
            <select name="user" class="form-control" id="user">
              <option value="" selected disabled>Select User</option>
              <?php foreach($USERS AS $user): ?>
                <option value="<?= $user['id']; ?>">
                  <?= $user['fullname']; ?>
                </option>
              <?php endforeach; ?>
            </select>
          </div>

          <div class="form-group">
            <label for="startdate">Start Date</label>
            <input type="date" class="form-control" name="startdate" id="startdate">
          </div>

          <div class="form-group">
            <label for="enddate">End Date</label>
            <input type="date" class="form-control" name="enddate" id="enddate">
          </div>

          <div class="mt-3">
            <button type="submit" name="generate" class="btn btn-primary">Generate History</button>
          </div>
        </form>
      </div>
    </div>
    <!-- END Quick Overview -->

    <!-- Orders Overview -->

    <!-- END Orders Overview -->

    <!-- Top Products and Latest Orders -->
    <div class="row">

      <div class="col-xl-12">
        <!-- Latest Orders -->
        <div class="block block-rounded">
          <div class="block-header block-header-default">
            <h3 class="block-title"></h3>
            <div class="block-options">
              <button type="button" class="btn-block-option" data-toggle="block-option" data-action="state_toggle" data-action-mode="demo">
                <i class="si si-refresh"></i>
              </button>
            </div>
          </div>
          <div class="block-content">
            <table class="table table-borderless table-striped table-vcenter font-size-sm">
              <tbody>
                <?php
                $all_transactions = fetchAllDesc("transactions", "id", 0, 10000);
                foreach ($all_transactions as $transactions) {
                  extract($transactions);

                  $get_users = where("users", "id", $user_id, 11);
                  foreach ($get_users as $users) {

                    if ($type == 0) {
                      $class = "btn btn-sm btn-success";
                      $message = "Received from";
                    } else if ($type == 1) {
                      $class = "btn btn-sm btn-danger";
                      $message = "Delivered to";
                    }


                ?>

                    <tr>
                      <td class="font-w600 text-center" style="width: 100px;">
                        <a href="users"><?= $users['acc_number']; ?></a>
                      </td>
                      <td class="d-none d-sm-table-cell">
                        <a href="users"><?= $users['fullname']; ?></a>
                      </td>
                      <td>
                        <span class="<?= $class; ?>"><?= $message; ?></span>
                      </td>
                      <td class="font-w600 text-center" style="width: 100px;">
                        <a href="users"><?= $to_user; ?></a>
                      </td>
                      <td class="font-w600 text-right">$<?= $amount; ?></td>
                      <td class="font-w600 text-right"><a href="backdate"><strong><?= date("M d, Y - h:i", strtotime($created_at)); ?></a></td>
                      <td class="font-w600 text-right"><a href="backdate?id=<?= $id; ?>" class="shadow btn btn-sm btn-primary">Backdate Transaction</a></td>
                    </tr>
                <?php }
                } ?>
              </tbody>
            </table>
          </div>
        </div>
        <!-- END Latest Orders -->
      </div>
    </div>
    <!-- END Top Products and Latest Orders -->
  </div>
  <!-- END Page Content -->
</main>
<!-- END Main Container -->

<!-- Footer -->
<?php require_once 'inc/footer.php'; ?>