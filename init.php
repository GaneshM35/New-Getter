<?php
	include 'database/config.php';
	include 'user.php';
	include 'follow.php';
	include 'tweet.php';

	global $dbh;

	session_start();

	$getFromUser = new User($dbh);
	$getFromTweet = new Tweet($dbh);
	$getFromFolow = new Follow($dbh);

	define("BASE_URL", "http://localhost/twinkle/");

?>