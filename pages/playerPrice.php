<?php
	include("config.lib.php");
	
	$playerID = mysql_real_escape_string($_POST['playerID']);
		
	$category = array('batsmen','keepers','allrounders','bowlers','coaches');
	$i = array('1','2','3','4','5');
	
	for($m=0; $m < count($i); $m++){
		if($playerID[0]==$i[$m]){
		
		$query = "SELECT * FROM ".$category[$m];
		$res = mysql_query($query);		
		while($info = mysql_fetch_array($res)){			
			if (strval($info[0])==$playerID){
				echo $info[3];
				break;
				}
			}//while loop
		}
	}//for loop	
	
?>