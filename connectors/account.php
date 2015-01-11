<?php

	require '../authenticator.php';

	if (!Authenticator::isConnected()) {
		switch ($_SERVER['REQUEST_METHOD']) {
			case 'GET':

				if (isset($_GET['username'], $_GET['password'])) {
					connect_user($_GET['username'], $_GET['password']);
				}

				break;
			case 'POST':

				if (isset($_POST['username'], $_POST['password'])) {
					connect_user($_POST['username'], $_POST['password']);
				}

				break;
			case 'PUT':

				if (isset($_PUT['username'], $_PUT['password'])) {
					if (Authenticator::create($_PUT['username'], $_PUT['password'])) {
						echo json_encode( Authenticator::getAccount()->toArray() );
					} else {
						echo 'false';
					}
				}

				break;
			default:
				echo 'false';
				break;
		}

	} else {
		echo 'false';
	}

	function connect_user($user, $pass) {
		if (Authenticator::connect($user, $pass)) {
			echo json_encode( Authenticator::getAccount()->toArray() );
		} else {
			echo 'false';
		}
	}
	
?>