<?php
require_once 'inc/functions/config.php';
require_once 'inc/header.php';

$USERS = mysqli_fetch_all(returnQuery("SELECT * FROM users"), MYSQLI_ASSOC);

if (isset($_POST['generate'])) {
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
        <form action="" class="w-100">
          <div class="row">
            <div class="col-12">
              <div class="form-group">
                <label for="user">User</label>
                <select name="user" class="form-control" id="user">
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
                <label for="startdate">Start Date</label>
                <input type="date" class="form-control" name="startdate" id="startdate">
              </div>
            </div>

            <div class="col-sm-12 col-md-6">
              <div class="form-group">
                <label for="enddate">End Date</label>
                <input type="date" class="form-control" name="enddate" id="enddate">
              </div>
            </div>
            <div class="col-12">
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
<!-- END Main Container -->

<!-- Footer -->
<?php require_once 'inc/footer.php'; ?>