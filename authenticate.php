<?php

function connectUser($user, $pass) {
	startSession();

	if ($user == 'admin' && $pass == 'admin') {
		$_SESSION['user'] = $_SERVER['PHP_AUTH_USER'];
		$_SESSION['pass'] = $_SERVER['PHP_AUTH_PW'];
		return true;
	}

	return false;
}

function disconnectUser() {
	startSession();
	session_unset();
}

function isUserConnected() {
	startSession();
	return (isset($_SESSION['user']) && isset($_SESSION['pass']));
}

function startSession() {
	if(!isset($_SESSION)) 
        session_start(); 
}

function getUsername() {
	startSession();
	if (isset($_SESSION['user']))
		return $_SESSION['user'];
	return "";
}

?>