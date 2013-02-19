<?php
	include("redirect.php");

include("config.lib.php");
session_start();
$flag = 0;
$email = mysql_real_escape_string($_POST['email']);
$pwd = mysql_real_escape_string($_POST['pwd']);
$check = mysql_query("SELECT * FROM userDetails WHERE ppl_teamName='$email'", $connection);
if(!$check){
	die ("Database query failed: " . mysql_error());
	}
$check2 = mysql_num_rows($check);
if($check2 == 0){
	$flag=1;
	}
while($info = mysql_fetch_array($check)){
	$info['ppl_password'] = mysql_real_escape_string($info['ppl_password']);
	$pwd = md5($pwd);
	if ($pwd != $info['ppl_password'])
		$flag=1;
	}
if($flag!=1){
	$_SESSION['username'] = $email;
	header("location: .././");
	}
?>