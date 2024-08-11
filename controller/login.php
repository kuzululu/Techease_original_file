<?php

if (isset($_POST["btnLogin"])) {
	$user = new UserLogin($conn);

	$result = $user->login($conn, $_POST["userLog"], $_POST["userPass"]);

	if ($result) {
		showAlertSuccess($result);
	}
}

$dbConn->closeConnection();

?>