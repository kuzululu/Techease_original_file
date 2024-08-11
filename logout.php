<?php

class SessionManager{

public static function startSession(){
	session_start();
} 

public static function destroySession(){
	self::startSession();
	unset($_SESSION["user_id"]);
	session_unset();
	session_destroy();

	header("refresh: 1; url=index");
}

}

SessionManager::destroySession();

?>