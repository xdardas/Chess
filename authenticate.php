<?php

function connectUser($user, $pass) {
	startSession();

	//hardcoded testing
	if ($user == 'admin' && $pass == 'admin') {
		$_SESSION['user'] = $user;
		$_SESSION['pass'] = $pass;
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

//probably gonna add a utils file to handle these type of methods
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