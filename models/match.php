<?php

class Match {
	private $match_id;
	private $white_account_id;
	private $black_account_id;
	private $current_turn;

	public function __construct($match_id, $white_account_id, $black_account_id, $current_turn) {
		$this->match_id 			= $match_id;
		$this->white_account_id 	= $white_account_id;
		$this->black_account_id 	= $black_account_id;
		$this->current_turn 		= $current_turn;
	}

	public function match_id() {
		return $this->match_id;
	}

	public function white_account_id() {
		return $this->white_account_id;
	}

	public function black_account_id() {
		return $this->black_account_id;
	}

	public function current_turn() {
		return $this->current_turn;
	}
}

?>