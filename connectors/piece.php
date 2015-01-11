<?php

	require '../authenticator.php';
	require '../models/chessboard.php';

	if (Authenticator::isConnected()) {
		switch ($_SERVER['REQUEST_METHOD']) {
			case 'GET':

				if (isset($_GET['match_id'])) {
					retrieve_pieces($_GET['match_id']);
				}

				break;
			case 'POST':

				if (isset($_POST['match_id'])) {
					retrieve_pieces($_POST['match_id']);
				}

				break;
			case 'PUT':

				if (isset($_PUT['piece_id'], $_PUT['location'])) {
					$acc = Authenticator::getAccount();
					//Of course, this has to make sure the move is possible and all.
					echo Database::getInstance()->query(
						"UPDATE tbl_piece SET (location=?) WHERE (account_id=?, piece_id=?)",
						array($_PUT['location'], $acc->account_id(), $_PUT['piece_id'])
					);
				}

				break;
			default:
				echo 'false';
				break;
		}
	} else {
		echo 'false';
	}

	function retrieve_pieces($match_id) {
		$acc = Authenticator::getAccount();
		$account_id = $acc->account_id();
		$db = Database::getInstance();
		$result =
			$db->query(
				 "SELECT tbl_piece.account_id, tbl_piece.type, tbl_piece.location "
				."FROM tbl_piece "
				."INNER JOIN tbl_match ON tbl_piece.match_id = tbl_match.match_id "
				."WHERE (tbl_piece.match_id = ? AND (tbl_match.white_account_id = ? OR tbl_match.black_account_id = ?));"
			, array($match_id, $account_id, $account_id));
		if ($db->no_results()) {
			echo 'false';
			return;
		}

		echo json_encode($result);
	}

?>