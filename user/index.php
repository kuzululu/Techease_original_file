<?php

require_once "../inc/config.php";
require_once "../inc/sessions.php";
include("../class/class.php");
require_once "../inc/showalert.php";

$dbConn = new DatabaseConnection($server, $user, $pass, $dbName);
$conn = $dbConn->connectDb();

require_once "../controller/request.php";

?>

<!DOCTYPE html>
<html lang="en">
<?php require_once "template-parts/head.php"; ?>
<body>

<?php 
	require_once "template-parts/navbar.php"; 
	require_once "modal/modal.php";
?>

<section id="dashboard" class="mt-5 pt-3">
	<div class="container-fluid">

		<div class="row">
			<div class="col-md-12">
				<h3 class="fw-bolder text-success text-uppercase">Pending Request</h3>
			</div>
		</div>

		<div class="row">
			
			<div class="col-md-6">
				<small class="text-primary fw-bold">By Category</small>
    <div class="d-flex">
      <label class="fw-bolder mt-2 me-1">Filter:</label>
      <input type="text" id="filterPendingLogs" class="form-control resetSearch">
    </div>
			</div>

			<div class="col-md-1 text-md-center">
		  <a href="index" type="button" class="btn btn-outline-danger btn-sm mt-md-4 mt-3 d-md-block d-none">Reset</a>
		    <a href="index" type="button" class="btn btn-outline-danger btn-sm mt-md-4 mt-3 d-md-none">Reset</a>
			</div>

		</div>

		<div class="row">
			<div class="col-md-12">
			<div class="table-responsive" id="showLogsPending">
				<table class="table table-hover">
					<thead>
						<tr class="text-center">
							<th>No.</th>
							<th>Requestor Name</th>
							<th>Department</th>
							<th>Product / Model</th>
							<th>Date / Time Request</th>
							<th>Problem Description</th>
							<th>Status</th>
							<th>Options</th>
						</tr>
					</thead>
					<tbody>
<?php
	
	class ViewLogsPending{
		private $get;

		public function __construct($get){
			$this->get = $get;
		}

		public function displayRecords(){
		$ctr = 1;
		while ($row = $this->get->fetch_assoc()) { 
			$origdateTime = $row["date_time"];
			$dateTime = new DateTime($origdateTime);
			$formatdate = $dateTime->format("M d, Y : h:i:A");
		?>
			
		<tr class="text-center">
			<td><?= $ctr ?></td>
			<td><?= $row["requestor_name"] ?></td>
			<td><?= $row["department"] ?></td>
			<td><?= $row["product_model"] ?></td>
			<td><?= $formatdate ?></td>
			<td><?= $row["problem_desc"] ?></td>
			<td><?= $row["status"] ?></td>
			<td>
				<a href="#" id="<?= $row['log_id'] ?>" class="btn btn-outline-primary btn-sm edit-pendLog" data-bs-toggle="modal" data-bs-target="#modalLogsPending">Update</a>
			</td>
		</tr>
		<?php
			$ctr++;	
		 }

		}
	}

$logsPendingManager = new PendingRecordsManager($conn);
$records = $logsPendingManager->records();

$viewLogs = new ViewLogsPending($records);
$viewLogs->displayRecords();
?>

					</tbody>
				</table>
			</div>

			</div>
		</div>

	</div>
</section>

<?php
	require_once "../template-parts/footer.php"; 
	require_once "template-parts/bottom.php"; 
?>

</body>
</html>