<?php

class Database {

/*-------------------------------------------------------------------------------*
	Database API
 *-------------------------------------------------------------------------------*
	Made by Dor Ben Moshe
	Inspired By Oded Antar
 *-------------------------------------------------------------------------------*
 static Database 			getInstance();
 		PDOStatement		query($sql, $values);

		void 				clear();
		PDOStatement		results();
		boolean				no_results();
		int 				count();
/*------------------------------------------------------------------------------*/

	private static $dbname 	= 'PRIVATE_INFO',		//The name of the database to connect to.

				   $host   	= 'PRIVATE_INFO',	//The host IP of the database.

				   $user	= 'PRIVATE_INFO',			//The username used to access the database.

				   $pass	= 'PRIVATE_INFO';				//The password used to access the database.

	private static $_instance;					//The instance of the class, used to ensure a single class
												//is used throughout the code.

		   private $_pdo,						//The PDO object used to access the database.

		   		   $_results;					//The results of the last query are stored here.

	//The constructor of the class, private in this case, to ensure the use of getInstance.
	private function __construct() {
		try {
			$this->_pdo = new PDO(
				'mysql:dbname='.self::$dbname.';host:'.self::$host, self::$user, self::$pass
			);
		}
		catch (PDOException $e) {
			echo 'Connection failed. '.$e->getMessage();
		}
	}

	//Creates a new instance of the Database class and returns it, or just returns the existing instance.
	//Made to ensure a single Database throughout the code.
	public static function getInstance() {
		if (is_null(self::$_instance)) {
			self::$_instance = new Database();
		}
		return self::$_instance;
	}

	//Runs the given SQL query on the database.
	public function query($sql, $values = array()) {
		if (!is_array($values) || !is_string($sql))
			return false;

		unset($this->_results);
		if ($st = $this->_pdo->prepare($sql))
		{
			for ($i = 0; $i < count($values); ++$i) {
				$st->bindValue($i+1, $values[$i]);
			}
			
			if ($st->execute()) {
				if ($st->columnCount() > 0) {
					$this->_results = $st->fetchAll(PDO::FETCH_ASSOC);
					return $this->_results;
				}

				if ($st->rowCount() > 0)
					return true;
				return false;
			}
		}

		return false;
	}

	//Clears all the memory used by the database.
	public function clear() {
		if (isset($this->_results)) {
			$this->_results = null;
		}
	}

	//Returns the results of the latest query.
	public function results() {
		if (isset($this->_results))
			return $this->_results;
		return;
	}

	//Returns whether or not there were any results to the latest query.
	public function no_results() {
		return !isset($this->_results) || !$this->_results || count($this->_results) <= 0;
	}

	//Returns the amount of rows that were obtained in the last query.
	public function count() {
		if ($this->no_results())
			return 0;
		return count($this->_results);
	}
}

?>
