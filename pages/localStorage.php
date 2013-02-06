<?php
	include("config.lib.php");	
	$id = $_GET['id'];		
	$category = array('batsmen','keepers','allrounders','bowlers','coaches');
	$i = array('1','2','3','4','5');
	for($m=0; $m < count($i); $m++){
		if($id[0]==$i[$m]){		
			$query = "SELECT * FROM ".$category[$m];
			$res = mysql_query($query);		
			while($info = mysql_fetch_array($res)){	
				if (strval($info[0])==$id){
					echo $info[1];
					break;
					}
				}
			}
		}
?>