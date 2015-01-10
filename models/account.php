<?php

class Account {
	private $account_id;
	private $username;
	private $wins;
	private $losses;
	private $ties;

	public function __construct($account_id, $username, $wins, $losses, $ties) {
		$this->account_id 	= $account_id;
		$this->username 	= $username;
		$this->wins 		= $wins;
		$this->losses 		= $losses;
		$this->ties 		= $ties;
	}

	public function account_id() {
		return $this->account_id;
	}

	public function username() {
		return $this->username;
	}

	public function wins() {
		return $this->wins;
	}

	public function losses() {
		return $this->losses;
	}

	public function ties() {
		return $this->ties;
	}
}

?>