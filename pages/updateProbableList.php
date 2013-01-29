<?php
	include("config.lib.php");
		$id_List = $_POST['list'];/*
		echo "<script type=\"text/javascript\"> console.log(".$id_List.") </script>";*/
		$query1 = "SELECT * from userdetails";
		$res1 = mysql_query($query1);
		while($info = mysql_fetch_array($res1)){
			if ($info[1]==$_SESSION['username'])
				$id = $info[0];
		}
		$query2 = "UPDATE usersplayerdetails SET pplProbablePlayerList='{$id_List}' WHERE ppl_id='$id'";
		$res2 = mysql_query($query2);
?>