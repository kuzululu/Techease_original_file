<?php

if (isset($_POST["btnAddRequest"])) {
	// add_req_name, $add_department, $add_prod_model, $add_date_time, $add_prob_desc, $add_status
	$insert = new AddRequest($conn);
	$result = $insert->addRequest($_POST["add_req_name"], $_POST["add_department"], $_POST["add_prod_model"], $_POST["add_date_time"], $_POST["add_prob_desc"], $_POST["add_tech"], $_POST["add_status"]);
	if ($result) {
		showAlertSuccess($result);
	}
}

// pending Logs Request
if (isset($_POST["btnUpdatePendLog"])) {
	$data = new UpdatePendLogWithFileUpload($conn);

	if (!empty($_POST["update_logId"])) {
		$id = $conn->escape_string(trim($_POST["update_logId"]));
		$update_statsLog = $conn->escape_string(trim($_POST["update_statsLog"]));
		$update_dateFinLog = $conn->escape_string(trim($_POST["update_dateFinLog"]));
		$update_techLog = $conn->escape_string(trim($_POST["update_techLog"]));
		$update_fileLog = $_FILES["update_fileLog"];

		if (!empty($update_fileLog["name"])) {
			$newFile = $data->uploadFileUpdate($update_fileLog);
			$result = $data->updatewithFile($id, $update_techLog, $update_statsLog, $update_dateFinLog, $newFile);
			if ($result) {
				showAlertSuccess($result);
			}
		}
	}
}

?>