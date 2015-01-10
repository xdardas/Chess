<?php

	require '../authenticator.php';

	if (!Authenticator::isConnected()) {
		switch ($_SERVER['REQUEST_METHOD']) {
			case 'GET':

				if (isset($_GET['username'], $_GET['password'])) {
					Authenticator::connect($_GET['username'], $_GET['password']);
				}

				break;
			case 'POST':

				if (isset($_POST['username'], $_POST['password'])) {
					Authenticator::connect($_POST['username'], $_POST['password']);
				}

				break;
			case 'PUT':

				if (isset($_PUT['username'], $_PUT['password'])) {
					Authenticator::create($_PUT['username'], $_PUT['password']);
				}

				break;
		}
	}

	header('Location: ../index.php');

?>