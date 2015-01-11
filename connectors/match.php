<?php

	require '../authenticator.php';

	if (Authenticator::isConnected()) {
		switch ($_SERVER['REQUEST_METHOD']) {
			case 'GET':

				if (isset($_GET['match_id'])) {
					retrieve_match($_GET['match_id']);
				}

				break;
			case 'POST':

				if (isset($_POST['match_id'])) {
					retrieve_match($_POST['match_id']);
				}

				break;
			case 'PUT':

				if (isset($_PUT['white_account_id'], $_PUT['black_account_id'])) {
					create_match($_PUT['white_account_id'], $_PUT['black_account_id']);
				}

				break;
			default:
				echo 'false';
				break;
		}
	} else {
		echo 'false';
	}

	function retrieve_match($match_id) {
		$db = Database::getInstance();
		$result = $db->query("SELECT white_account_id, black_account_id, current_turn FROM tbl_match WHERE (match_id = ?)", array($match_id));
		if ($db->no_results()) {
			echo 'false';
			return;
		}

		$acc = Authenticator::getAccount();
		$result = $result[0];
		if ($result['white_account_id'] == $acc->account_id() || 
			$result['black_account_id'] == $acc->account_id()) {
			echo json_encode($result);
		} else {
			echo 'false';
		}
	}

	function create_match($white_account_id, $black_account_id) {
		$db = Database::getInstance();
		$result = $db->query("INSERT INTO tbl_match (white_account_id, black_account_id) VALUES (?, ?)", array($white_account_id, $black_account_id));
		if ($result === false) {
			echo 'false';
		}

		//TODO: Create the pieces for each player.

		echo 'true';
	}

?>