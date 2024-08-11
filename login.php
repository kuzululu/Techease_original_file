<?php

if (session_status() == PHP_SESSION_NONE) {
	session_start();
}

require_once "inc/config.php";
include("class/class.php");
require_once "inc/showalert.php";

$dbConn = new DatabaseConnection($server, $user, $pass, $dbName);
$conn = $dbConn->connectDb();

require_once "controller/login.php";

?>
<!DOCTYPE html>
<html lang="en">
<?php require_once "template-parts/head.php"; ?>
<body>

<section id="registration" class="mt-5">
	<div class="container">
		<div class="row">
			
			<div class="col-md-4"></div>
			
			<div class="col-md-4  border border-2 border-success p-3">
			<h3 class="text-center fw-bolder text-success">Login</h3>
				<form class="row needs-validation" method="POST" novalidate="" action="<?php htmlspecialchars($_SERVER['PHP_SELF']); ?>">
					<div class="col-md-12 mb-3">
						<label class="fw-bolder">Username:</label>
						<input class="form-control" name="userLog" type="text" required="">
					</div>

					<div class="col-md-12 mb-3">
						<label class="fw-bolder">Password:</label>
						<div class="input-group">
							<input class="form-control togglePassword" name="userPass" type="password" required="">
							<span class="bg-dark bg-gradient input-group-text toggleIcon">
							<i class="text-light fa fa-eye-slash d-none hide_eyes"></i>
							<i class="text-light fa fa-eye show_eyes"></i>
						</span>
						</div>
					</div>

					<div class="col-md-12 text-end">
						<input type="submit" class="btn btn-outline-success btn-sm" name="btnLogin" value="Login"> <a href="registration" type="button" class="btn btn-outline-primary btn-sm">Register</a>
						<a href="index" type="button" class="btn btn-outline-secondary btn-sm">Main</a>
					</div>

				</form>
			</div>
			<div class="col-md-4"></div>

		</div>
	</div>
</section>



<?php 
	require_once "template-parts/footer.php";
	require_once "template-parts/bottom.php"; 
?>
</body>
</html>