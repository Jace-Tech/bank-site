<?php
require_once 'inc/functions/config.php';
require_once 'inc/header.php';
require_once "../user/inc/banks.php";

$USERS = mysqli_fetch_all(returnQuery("SELECT * FROM users"), MYSQLI_ASSOC);

if (isset($_POST['generate'])) {
  $user = $_POST['user'];
  $start_date = $_POST['startdate'];
  $end_date = $_POST['enddate'];

  $start_date = date_create($start_date);
  $end_date = date_create($end_date);

  $transactionType = [
    [
      "kind" => "deposit",
      "type" => 0
    ],
    [
      "kind" => "transfer",
      "type" => 1
    ],
    [
      "kind" => "wire transfer",
      "type" => 1
    ],
  ];

  $sql = "INSERT INTO transactions(user_id, type, kind, amount, to_user, bank_name, approved, created_at) VALUES (?, ?, ?, ?, ?, ?, ?, ?)";
  $stmt = mysqli_prepare($link, $sql);
  $success = [];

  for ($date = $start_date; $date <= $end_date; date_add($date, date_interval_create_from_date_string(rand(1, 9) . " days"))) {
    $created =  date_format($date, 'Y-m-d');
    $amount = rand(1000, 999999);
    $to = rand(10000000000, 9999999999);
    $bank = $us_banks[rand(0, (count($us_banks) - 1))];
    $transactType = $transactionType[rand(0, (count($transactionType) - 1))];
    $approved = 1;
    extract($transactType);

    mysqli_stmt_bind_param($stmt, 'ssssssss', $user, $type, $kind, $amount, $to, $bank, $approved, $created);
    array_push($success, mysqli_stmt_execute($stmt));
  }

  $notSuccessful = array_filter($success, function ($item) { return !$item; });

  if ($notSuccessful) {
    echo "<script>alert(`Error generating history`)</script>";
  } else {
    echo "<script>alert(`History generated!`)</script>";
  }
}


// $array = array(
//   array('value1', 'value2', 'value3'),
//   array('value4', 'value5', 'value6'),
// );
// // Prepare an SQL statement
// $sql = "INSERT INTO table (column1, column2, column3) VALUES (?, ?, ?)";
// $stmt = mysqli_prepare($conn, $sql);

// // Bind the variables to the parameter as strings
// mysqli_stmt_bind_param($stmt, 'sss', $value1, $value2, $value3);

// // Execute the statement for each row of data
// foreach ($array as $row) {
//     // Set the variables to the current values
//     list($value1, $value2, $value3) = $row;

//     // Execute the statement
//     mysqli_stmt_execute($stmt);
// }

// // Close the prepared statement
// mysqli_stmt_close($stmt);

// }

?>
<!-- END Header -->

<!-- Main Container -->
<main id="main-container">

  <!-- Page Content -->
  <div class="content">
    <!-- Quick Overview -->
    <div class="row row-deck">
      <div class="col-12">
        <form action="" class="w-100" method="post">
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

            <div class="col-12">
              <div class="form-group">
                <label for="user-accounts">User Accounts</label>
                <select name="user" class="form-control" id="user-accounts">
                  <option value="" selected disabled>Select User Account</option>
                  
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