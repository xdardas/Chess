<?php

require 'database.php';
require 'models/account.php';

class Authenticator {

	public static function connect($user, $pass) {
		//Checking if the username and password are strings
		if (!is_string($user) || !is_string($pass))
			return false;
		//Checking if the username string is of valid length.
		else if (strlen($user) < 4 || strlen($user) > 11)
			return false;
		//Checking if the password string is of valid length
		else if (strlen($pass) < 4 || strlen($pass) > 11)
			return false;

		$db = Database::getInstance();
		$dbresults = $db->query("SELECT account_id, wins, losses, ties FROM tbl_account WHERE (username = ? AND password = ?)", array($user, $pass));
		if ($db->no_results()) {
			return false;
		}

		self::startSession();
		$_SESSION['timestamp'] = time();

		foreach ($dbresults as $row) {
			$row['username'] = $user;
			$_SESSION['account'] = Account::fromArray($row);
			break;
		}

		return true;
	}

	public static function create($user, $pass) {
		//Checking if the username and password are strings
		if (!is_string($user) || !is_string($pass))
			return false;
		//Checking if the username string is of valid length.
		else if (strlen($user) < 4 || strlen($user) > 11)
			return false;
		//Checking if the password string is of valid length
		else if (strlen($pass) < 4 || strlen($pass) > 11)
			return false;

		$db = Database::getInstance();
		$db->query("INSERT INTO tbl_account (username, password) VALUES (?, ?)", array($user, $pass));
		return true;
	}

	public static function disconnect() {
		self::startSession();
		unset(
			$_SESSION['account'],
			$_SESSION['timestamp']
		);
	}

	public static function isConnected() {
		self::startSession();
		if (isset($_SESSION['account'])) {
			if (time() - $_SESSION['timestamp'] > 15 /* minutes */ * 60 /* seconds */) {
				self::disconnect();
				return false;
			} else {
				$_SESSION['timestamp'] = time();
				return true;
			}
		}

		return false;
	}

	private static function startSession() {
		if(!isset($_SESSION)) 
	        session_start(); 
	}

	public static function getAccount() {
		if (self::isConnected()) {
			return $_SESSION['account'];
		}
		return null;
	}
}

?>