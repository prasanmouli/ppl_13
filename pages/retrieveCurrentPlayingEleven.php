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
			for($k=8; $k>=1; $k--)
				if(!(($info['ppl_playingEleven'.$k]=="")||($info['ppl_playingEleven'.$k]==NULL))){
					$data = $info['ppl_playingEleven'.$k];
					break;
				}
		}
	}
	echo $data;
?>