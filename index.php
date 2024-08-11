<!DOCTYPE html>
<?php

require_once "inc/config.php";
include("class/class.php");
require_once "inc/showalert.php";

$dbConn = new DatabaseConnection($server, $user, $pass, $dbName);
$conn = $dbConn->connectDb();

require_once "controller/request.php";

?>
<html lang="en">
<?php require_once "template-parts/head.php"; ?>
<body>

<section id="main" class="mt-5">
	<div class="container">
		<div class="row mb-3">
			<h3 class="text-center fw-bolder text-success">TechEase: Technical Assistance for End-user problems</h3>
		</div>
		<form class="row needs-validation p-3 mb-5" method="POST" novalidate="" action="<?php htmlspecialchars($_SERVER['PHP_SELF']); ?>">
			
			<div class="col-md-8 mb-3">
				<label class="fw-bolder">Requestor Name:</label>
				<input type="text" name="add_req_name" class="form-control" required="">
			</div>

			<div class="col-md-4 mb-3">
				<label class="fw-bolder">Department:</label>
				<select name="add_department" class="form-control" required="">
					<option name="add_department" value=""></option>
					<?php
					$category = new DepartmentCategory($conn);
					$departments = $category->getDepartment();
					foreach ($departments as $department) { ?>
						<option name="add_department" value="<?= $department ?>"><?= $department ?></option>
				<?php	}
					?>
				</select>
			</div>

			<div class="col-md-7 mb-3"> 
				<label class="fw-bolder">Product / Model</label>
				<input type="text" name="add_prod_model" class="form-control" required="">
			</div>

			<div class="col-md-5 mb-3">
					<label class="fw-bolder">Date / Time Request</label>
				<input type="datetime-local" name="add_date_time" class="form-control" required="">
			</div>

			<input type="hidden" name="add_status" value="Pending" required="">

			<div class="col-md-12 mb-3">
				<label class="fw-bolder">Problem Description</label>
				<textarea name="add_prob_desc" class="form-control h-100" required=""></textarea>
			</div>

			<div class="col-md-12 mt-5">
				<input type="hidden" name="add_tech" value="0" required="">
				<input type="submit" name="btnAddRequest" class="btn btn-outline-primary btn-sm" value="Submit">
			</div>

		</form>
		</div>
</section>



<?php
	require_once "template-parts/footer.php"; 
	require_once "template-parts/bottom.php"; 
?>

</body>
</html>