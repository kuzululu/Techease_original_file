<?php
ob_start();
session_start();

$user_id = $_SESSION["user_id"];
$fname = $_SESSION["first_name"];
$lname = $_SESSION["last_name"];
$account_type = $_SESSION["account_type"];
$full_name = $fname . " " . $lname;

if (!isset($user_id)) {
	header("../logout");
}

if (!isset($fname) AND !isset($lname)) {
	header("../logout");
}


// check if the session username is set if not automatic logout
	if (isset($user_id)) {
		// $message =  $_SESSION["first_name"] . " " . $_SESSION["last_name"];
		
		$first_initials = substr($fname, 0,1);
		$last_initials = substr($lname, 0,1);
		$initials = $first_initials . $last_initials;
	
	}else{
		header("location: ../logout");
	}

	if (isset($user_id)) {
		// $message =  $_SESSION["first_name"] . " " . $_SESSION["last_name"];
		
		$first_initials = substr($fname, 0,1);
		$last_initials = substr($lname, 0,1);
		$initials = $first_initials . $last_initials;
	
	}else{
		header("location: ../logout");
	}
?>