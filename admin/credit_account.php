<?php
require_once 'inc/functions/config.php';
require_once 'inc/header.php';


$USERS = mysqli_fetch_all(returnQuery("SELECT * FROM users"), MYSQLI_ASSOC);
$ACCOUNTS = mysqli_fetch_all(returnQuery("SELECT * FROM accounts"), MYSQLI_ASSOC);

if (isset($_POST['submit'])) {
	if (isset($_SESSION['user'])) {
		$id = $_SESSION['user'];
	}
	$response = credit_user_account($_POST);
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
							<label for="user-accounts" class="label">User Account</label>
							<select name="acc" class="form-control" id="user-accounts">
								<option value="" selected disabled>Select User Account</option>
							</select>
						</div>
					</div>

					<div class="col-sm-12 col-md-6">
						<div class="form-group">
							<input type="text" name="recipent" onblur="getRecipent()" class="form-control" id="account_number" placeholder="Account Number">
						</div>
					</div>

					<div class="col-sm-12 col-md-6">
						<div class="form-group">
							<div class="input-group">
								<div class="input-group-prepend">
									<span class="input-group-text">
										<i class="fa fa-dollar-sign"></i>
									</span>
								</div>
								<input type="text" amount class="form-control text-center" id="example-group2-input3" name="amount" placeholder="Amount">
								<div class="input-group-append">
									<span class="input-group-text">.00</span>
								</div>
							</div>
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