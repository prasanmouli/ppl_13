<?php
	include("config.lib.php");
		$id_List = mysql_real_escape_string($_POST['list']);
		$balance = mysql_real_escape_string($_POST['balance']);
		/*echo "<script type=\"text/javascript\"> console.log(".$id_List.") </script>";*/
		$query1 = "SELECT * from userdetails";
		$res1 = mysql_query($query1);
		while($info = mysql_fetch_array($res1)){
			if ($info[1]==$_SESSION['username'])
				$id = $info[0];
		}
		$query2 = "UPDATE usersplayerdetails SET pplFinalPlayerList='{$id_List}' WHERE ppl_id='$id'";
		$res2 = mysql_query($query2);
		
		if($balance>=0){
			$query2 = "UPDATE userdetails SET ppl_amount=".$balance." WHERE ppl_id='$id'";
			$res2 = mysql_query($query2);
		}
		else 
			echo "Failed!"
?>