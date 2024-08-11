<?php

if (session_status() == PHP_SESSION_NONE) {
	session_start();
}

if (isset($_SESSION["user_id"])) {
	if ($_SESSION["account_type"] == "admin") {
		header("location: admin");
	}else{
		header("location: user");
	}
}

require_once "inc/config.php";
include("class/class.php");
require_once "inc/showalert.php";

$dbConn = new DatabaseConnection($server, $user, $pass, $dbName);
$conn =$dbConn->connectDb();


require_once "controller/register.php";

?>
<!DOCTYPE html>
<html lang="en">
<?php require_once "template-parts/head.php"; ?>
<body>

<section id="registration" class="mt-5">
	<div class="container">
		
		<div class="row">
			
		<div class="col-md-2"></div>
		<div class="col-md-8 border border-2 border-success p-3">
			<h3 class="text-center text-success fw-bolder">Registration</h3>
			<form class="row needs-validation" method="POST" novalidate="" action="<?php htmlspecialchars($_SERVER['PHP_SELF']) ?>">
			<input type="hidden" name="account_type" value="user">
			<div class="col-md-6 mb-3">
				<label class="fw-bolder">Last Name</label>
				<input type="text" name="lname" class="form-control" required="">
			</div>

			<div class="col-md-6 mb-3">
				<label class="fw-bolder">First Name</label>
				<input type="text" name="fname" class="form-control" required="">
			</div>

			<div class="col-md-6 mb-3">
				<label class="fw-bolder">Username</label>
				<input type="text" name="username" class="form-control" required="">
			</div>

			<div class="col-md-6 mb-3">
				<label class="fw-bolder">Password</label>
					<div class="input-group">
						<input type="password" name="password" class="form-control togglePassword" required="">
						<span class="bg-dark bg-gradient input-group-text toggleIcon">
							<i class="text-light fa fa-eye-slash d-none hide_eyes"></i>
							<i class="text-light fa fa-eye show_eyes"></i>
					</span>
					</div>
			</div>

				<div class="col-md-12">
						<input type="submit" name="btnRegister" class="btn btn-outline-primary btn-sm" value="Register"> <a href="login" class="btn btn-outline-danger btn-sm">Back</a>
					</div>

		</form>
		</div>	
		<div class="col-md-2"></div>

		</div>

	</div>
</section>


<?php 
	require_once "template-parts/footer.php";
	require_once "template-parts/bottom.php"; 
?>
</body>
</html>