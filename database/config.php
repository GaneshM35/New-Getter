<?php
	
	$database = 'twinkle';
   $host = 'localhost';
   $user = 'root';
   $pass = '';

   // try to conncet to database
   try{
   		$dbh = new PDO("mysql:dbname={$database};host={$host};port={3306}", $user, $pass);
   }catch(PDOException $e){
		echo "unable to connect to database " .$e->getMessage();
   }

?>