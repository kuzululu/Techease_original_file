<?php

if (isset($_POST["btnRegister"])) {
	$insert = new UserRegistration($conn);

	$result = $insert->register($_POST["lname"], $_POST["fname"], $_POST["username"], $_POST["password"], $_POST["account_type"]);
	if ($result) {
		showAlertSuccess($result);
	}
}

?>