<?php
	session_start();
	include("redirect.php");

	unset($_SESSION['username']);
	unset($_SESSION['views']);
	header("location: .././");
?>