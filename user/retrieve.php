<?php

include("../inc/config.php");
include("../class/class.php");

$dbConn = new DatabaseConnection($server, $user, $pass, $dbName);
$conn = $dbConn->connectDb();

if (isset($_POST["retrieveDeptId"])) {
	$fetch = new DataDeptFetcher($conn);
	$id = $_POST["retrieveDeptId"];
	$row = $fetch->fetchData($id);

	header("Content-Type: application/json");
	echo json_encode($row);

	$dbConn->closeConnection();
}

if (isset($_POST["retrieveDelDeptId"])) {
	$fetch = new DataDeptFetcher($conn);
	$id = $_POST["retrieveDelDeptId"];
	$row = $fetch->fetchData($id);

	header("Content-Type: application/json");
	echo json_encode($row);

	$dbConn->closeConnection();
}

if (isset($_POST["retreiveLogId"])) {
	$fetch = new DataLogFetcher($conn);
	$id = $_POST["retreiveLogId"];
	$row = $fetch->fetchData($id);

	header("Content-Type: application/json");
	echo json_encode($row);

	$dbConn->closeConnection();
}

?>