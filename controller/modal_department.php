<?php

if (isset($_POST["btnAddModalDept"])) {
	$insert = new AddDepartModal($conn);

	$result = $insert->add_department($_POST["add_dept"]);
	if ($result) {
		showalertSuccess($result);
	}
}

if (isset($_POST["btnUpdateModalDept"])) {
	$data = new UpdateModalDept($conn);

	if (!empty($_POST["update_deptId"])) {
		$id = $conn->escape_string(trim($_POST["update_deptId"]));
		$update_dept = $conn->escape_string(trim($_POST["update_dept"]));

		$result = $data->update($id, $update_dept);
		if ($result) {
			showalertSuccess($result);
		}

	}
}

if (isset($_POST["btnDelModalDept"])) {
	if (!empty($_POST["del_deptId"])) {
		$id = intval($_POST["del_deptId"]);

		$data = new DeleteModalDept($conn);
		$result = $data->delete($id);
		if ($result) {
			showalertSuccess($result);
		}
	}
}

?>