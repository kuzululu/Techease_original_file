<?php

require_once "../inc/config.php";
require_once "../inc/sessions.php";
include("../class/class.php");
require_once "../inc/showalert.php";

$dbConn = new DatabaseConnection($server, $user, $pass, $dbName);
$conn = $dbConn->connectDb();

require_once "../controller/modal_department.php";
?>

<!DOCTYPE html>
<html lang="en">
<?php require_once "template-parts/head.php"; ?>
<body>

<?php 
	require_once "template-parts/navbar.php"; 
	require_once "modal/modal.php";
?>

<section id="records" class="mt-5 pt-3">
	<div class="container-fluid">
			<div class="row">
			<div class="col-md-12">
				<h3 class="fw-bolder text-success text-uppercase">Department</h3>
			</div>
		</div>
	</div>

	<div class="container">

	
  <div class="row">
<div class="col-md-7">
<a href="#" class="btn btn-sm btn-outline-primary mt-md-4" type="button" data-bs-toggle="modal" data-bs-target="#modalAddDepartment">Add Department</a>
</div>

<div class="col-md-4">
    <small class="text-primary fw-bold">By Category</small>
    <div class="d-flex">
      <label class="fw-bolder mt-2 me-1">Filter:</label>
      <input type="text" id="filterDepartment" class="form-control resetSearch">
    </div>
</div>

<div class="col-md-1 text-md-center">
  <a href="department" type="button" class="btn btn-outline-danger btn-sm mt-md-4 mt-3 d-md-block d-none">Reset</a>
    <a href="department" type="button" class="btn btn-outline-danger btn-sm mt-md-4 mt-3 d-md-none">Reset</a>
</div>

</div>

		<div class="row">
			<div class="col-md-12">
			<div class="table-responsive" id="showDataDept">
				<table class="table table-hover">
					<thead>
						<tr class="text-center">
							<th>No.</th>
							<th>Department</th>
							<th>Options</th>
						</tr>
					</thead>
					<tbody>
<?php 

class ViewDepartmentRecords{
	private $records;

	public function __construct($records){
		$this->records = $records;	
	}

	public function displayRecords(){

		$ctr = 1;
		while ($row = $this->records->fetch_assoc()) {
	?>		

	<tr class="text-center">
		<td><?= $ctr ?></td>
		<td><?= $row["department"] ?></td>
		<td>
			<a id="<?= $row['dept_id'] ?>" href="#" type="button" class="btn btn-outline-primary btn-sm edit-deptdata" data-bs-toggle="modal" data-bs-target="#modalUpdateDept">Update</a> <a id="<?= $row['dept_id'] ?>" href="#" type="button" class="btn btn-outline-danger btn-sm del-deptdata" data-bs-toggle="modal" data-bs-target="#modalDelDept">Delete</a>
		</td>
	</tr>
<?php
$ctr++;	
		}

	}
}

$recordsManager = new DepartmentManager($conn);
$records = $recordsManager->getDepartment();

$viewRecords = new ViewDepartmentRecords($records);
$viewRecords->displayRecords();

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