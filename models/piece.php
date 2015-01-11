<?php

class Piece {
	private $piece_id;
	private $match_id;
	private $account_id;
	private $type;
	private $location;

	public function __construct($piece_id, $match_id, $account_id, $type, $location) {
		$this->piece_id 	= $piece_id;
		$this->match_id 	= $match_id;
		$this->account_id 	= $account_id;
		$this->type 		= $type;
		$this->location 	= $location;
	}

	public function piece_id() {
		return $this->piece_id;
	}

	public function match_id() {
		return $this->match_id;
	}

	public function account_id() {
		return $this->account_id;
	}

	public function type() {
		return $this->type;
	}

	public function location() {
		return $this->location;
	}
}

?>