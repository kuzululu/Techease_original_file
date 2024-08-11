<!DOCTYPE html>
<?php

require_once "../inc/config.php";
require_once "../inc/sessions.php";
include("../class/class.php");
require_once "../inc/showalert.php";
require_once "../inc/shortLink.php";

$dbConn = new DatabaseConnection($server, $user, $pass, $dbName);
$conn = $dbConn->connectDb();

?>
<html lang="en">
<?php require_once "template-parts/head.php"; ?>
<body>

<?php require_once "template-parts/navbar.php"; ?>

<section id="records" class="mt-5 pt-3">
	<div class="container-fluid">

		<div class="row">
			<div class="col-md-12">
				<h3 class="fw-bolder text-success text-uppercase">Request Records</h3>
			</div>
		</div>

		<div class="row">
			
			<div class="col-md-6">
				<small class="text-primary fw-bold">By Category</small>
    <div class="d-flex">
      <label class="fw-bolder mt-2 me-1">Filter:</label>
      <input type="text" id="filterRecords" class="form-control resetSearch">
    </div>
			</div>

			<div class="col-md-1 text-md-center">
		  <a href="records" type="button" class="btn btn-outline-danger btn-sm mt-md-4 mt-3 d-md-block d-none">Reset</a>
		    <a href="records" type="button" class="btn btn-outline-danger btn-sm mt-md-4 mt-3 d-md-none">Reset</a>
			</div>

		</div>

		<div class="row">
			<div class="col-md-12">
			<div class="table-responsive" id="showdataRecords">
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
							<th>Date Finished</th>
							<th>Technician</th>
							<th>Image</th>
						</tr>
					</thead>
					<tbody>
<?php 

class ViewLogsRecords{
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

			$origDate = $row["date_finish"];
			$dateTimeFin = new DateTime($origDate);
			$formatDateFin = $dateTimeFin->format("M d, Y : h:i:A");
		?>
			
		<tr class="text-center align-middle">
			<td><?= $ctr ?></td>
			<td><?= $row["requestor_name"] ?></td>
			<td><?= $row["department"] ?></td>
			<td><?= $row["product_model"] ?></td>
			<td><?= $formatdate ?></td>
			<td><?= $row["problem_desc"] ?></td>
			<td><?= $row["status"] ?></td>
			<td><?= $formatDateFin ?></td>
			<td><?= $row["technician"] ?></td>
			<td>
				<img class="img-fluid w-75" src="../uploads/<?= $row['image'] ?>">
			</td>
		</tr>
		<?php
			$ctr++;	
		 }

		}
	}

$logsRecordsManager = new LogsRecordsManager($conn);
$records = $logsRecordsManager->records();

$viewLogs = new ViewLogsRecords($records);
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