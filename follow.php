<?php
	class Follow extends User{
		protected $pdo;

		function __construct($dbh){
			$this->pdo = $dbh;
		}
	}
?>