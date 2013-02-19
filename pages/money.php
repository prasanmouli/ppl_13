<?php
	include("config.lib.php");
	
	$choice = ($_POST['choice']);
	$playerPrice = ($_POST['playerPrice']);
	
		$query1 = "SELECT * from userdetails";
		$res1 = mysql_query($query1);
		while($info = mysql_fetch_array($res1)){
			if ($info[1]==$_SESSION['username']){
				$balance = $info['ppl_amount'];
				$id = $info[0];
			}
		}
		
	if($choice==1)
		$balance -= $playerPrice;
	else{
		if($choice==2)
			$balance += $playerPrice;
	}
	
	$query2 = "UPDATE userdetails SET ppl_amount=".$balance." WHERE ppl_id='$id'";
	$res2 = mysql_query($query2);	
	echo $balance;	
?>