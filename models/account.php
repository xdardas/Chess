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

	public function toArray() {
		return array (
			'account_id' 	=> $this->account_id(),
			'username' 		=> $this->username 	(),
			'wins' 			=> $this->wins 		(),
			'losses' 		=> $this->losses 	(),
			'ties' 			=> $this->ties 		(),
		);
	}

	public static function fromArray($arr) {
		return new Account(
			$arr['account_id'	],
			$arr['username'		],
			$arr['wins'			],
			$arr['losses'		],
			$arr['ties'			]
		);
	}
}

?>