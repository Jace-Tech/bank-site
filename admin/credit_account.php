<?php
require_once 'inc/functions/config.php';
require_once 'inc/header.php';


$USERS = mysqli_fetch_all(returnQuery("SELECT * FROM users"), MYSQLI_ASSOC);
$ACCOUNTS = mysqli_fetch_all(returnQuery("SELECT * FROM accounts"), MYSQLI_ASSOC);

if (isset($_POST['submit'])) {
	if (isset($_SESSION['user'])) {
		$id = $_SESSION['user'];
		$account = $_SESSION['account'];
		$amount = $_SESSION['amount'];
	}
	$response = credit_user_account(["id" => $id, "amount" => $amount, "account" => $account]);
	if ($response === true) {
		echo "<script>alert('Account have been credited!')</script>";
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
			<i class="fa fa-angle-right text-muted mr-1"></i> Credit Account
		</h2>

		<div class="row">

			<div class="col-lg-12 col-xl-12">
				<form action="" method="post" class="row">
					<div class="col-12">
						<div class="form-group">
							<label for="user" class="label">User</label>
							<select name="user" onchange="handleFetchUsersAccount(event)" class="form-control" id="user">
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
							<label for="user-accounts" class="label">User Account</label>
							<select name="account" class="form-control" id="user-accounts">
								<option value="" selected disabled>Select User Account</option>
							</select>
						</div>
					</div>

					<div class="col-12">
						<div class="form-group">
							<label for="amount" class="label">Amount</label>
							<input type="text" id="amount" class="form-control" name="amount" placeholder="Amount">
						</div>
					</div>

					<div class="col-12">
						<div class="input-group mt-4">
							<button type="submit" name="submit" class="btn btn-alt-success">Make Transfer</button>
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