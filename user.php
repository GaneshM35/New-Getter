<?php
	class User{
		protected $pdo;

		function __construct($dbh){
			$this->pdo = $dbh;
		}

		public function checkInput($var){
		$var = htmlspecialchars($var);
		$var = trim($var);
		$var = stripcslashes($var);
		return $var;
	}

	}

?>