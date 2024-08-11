<div class="modal fade" id="modalAddDepartment" aria-hidden="true" tabindex="-1">

<div class="modal-dialog modal-lg">
<div class="modal-content">

<div class="modal-header">
<h3 class="text-uppercase text-primary fw-bolder modal-title">Add Department</h3>
<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
</div>

<div class="modal-body">
<form class="row needs-validation" novalidate="" method="POST" action="<?php htmlspecialchars($_SERVER['PHP_SELF']); ?>">

<div class="col-md-8 mb-3">
	<label class="fw-bolder">Department</label>
	<input type="text" name="add_dept" class="form-control" required="">
</div>

<div class="col-md-4 mt-4 pt-md-1">
	<input type="submit" class="btn btn-outline-primary btn-sm" name="btnAddModalDept" value="Add">
</div>

</form>
</div>

</div>
</div>

</div>
<!-- -->

<div class="modal fade" id="modalUpdateDept" aria-hidden="true" tabindex="-1">

<div class="modal-dialog modal-lg">
<div class="modal-content">

<div class="modal-header">
<h3 class="text-uppercase text-primary fw-bolder modal-title">Update Department</h3>
<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
</div>

<div class="modal-body">
<form class="row needs-validation" novalidate="" method="POST" action="<?php htmlspecialchars($_SERVER['PHP_SELF']); ?>">
<input type="hidden" name="update_deptId" id="update_deptId">
<div class="col-md-8 mb-3">
	<label class="fw-bolder">Department</label>
	<input type="text" name="update_dept" id="update_dept" class="form-control" required="">
</div>

<div class="col-md-4 mt-4 pt-md-1">
	<input type="submit" class="btn btn-outline-success btn-sm" name="btnUpdateModalDept" value="Update">
</div>

</form>
</div>

</div>
</div>

</div>

<!-- -->
<div class="modal fade" id="modalDelDept" aria-hidden="true" tabindex="-1">

<div class="modal-dialog modal-lg">
<div class="modal-content">

<div class="modal-header">
<h3 class="text-uppercase text-danger fw-bolder modal-title">Delete Department</h3>
<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
</div>

<div class="modal-body">

<h4>You will delete the <em><span class="text-danger fw-bolder" id="del_dept"></span></em> deparment?</h4>

<form class="row needs-validation" novalidate="" method="POST" action="<?php htmlspecialchars($_SERVER['PHP_SELF']); ?>">
<input type="hidden" name="del_deptId" id="del_deptId">
<div class="col-md-12 text-end">
	<input type="submit" class="btn btn-outline-danger btn-sm" name="btnDelModalDept" value="Delete">
</div>

</form>
</div>

</div>
</div>

</div>


<!-- -->

<div class="modal fade" id="modalLogsPending" aria-hidden="true" tabindex="-1">

<div class="modal-dialog modal-lg">
<div class="modal-content">

<div class="modal-header">
<h3 class="text-uppercase text-primary fw-bolder modal-title">Update Pending Request</h3>
<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
</div>

<div class="modal-body">
<form class="row needs-validation" novalidate="" method="POST" enctype="multipart/form-data" action="<?php htmlspecialchars($_SERVER['PHP_SELF']); ?>">
<input type="hidden" name="update_logId" id="update_logId" required="">
<input type="hidden" name="update_techLog" required="" value="<?= $full_name ?>">
<div class="col-md-4 mb-3">
	<label class="fw-bolder">Status</label>
	<select name="update_statsLog" required="" class="form-control" required="">
		<option name="update_statsLog" value=""></option>
		<option name="update_statsLog" value="Pending">Pending</option>
		<option name="update_statsLog" value="Complete">Complete</option>
	</select>
</div>

<div class="col-md-4 mb-3">
	<label class="fw-bolder">Date Finish</label>
	<input type="text" id="time" name="update_dateFinLog" class="form-control" required="" readonly="">
	<script type="text/javascript" src="js/systemTime.js"></script>
</div>

<div class="col-md-4 mb-3">
	<label>Upload</label>
	<input type="file" name="update_fileLog" class="form-control" accept="image/*" required="">
</div>

<div class="col-md-12">
	<input type="submit" class="btn btn-outline-success btn-sm" name="btnUpdatePendLog" value="Update">
</div>

</form>
</div>

</div>
</div>

</div>