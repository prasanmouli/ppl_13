<?php
	include("config.lib.php");
		
	$data = "";	
	$query = "SELECT * from userdetails";
	$res = mysql_query($query);
	while($info = mysql_fetch_array($res)){
		if ($info[1] == $_SESSION['username'])
			$id = $info[0];
	}
	
	$query1 = "SELECT * from usersplayerdetails";
	$res1 = mysql_query($query1);
	while($info1 = mysql_fetch_array($res1)){
		if ($info1[0] == $id){	
			if (!($info1[2]=="" || $info1[2]==NULL)) 
				$data = $info1[2];
			break;
		}
	}
	echo $data;
//				$data = json_encode(array("value" => $info1[1]));
	
?>