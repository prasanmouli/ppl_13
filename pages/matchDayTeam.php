<?php

include("config.lib.php");
		
	$query = "SELECT * from userdetails";
	$res = mysql_query($query);
	while($info = mysql_fetch_array($res)){
		if ($info[1] == $_SESSION['username'])
			$id = $info[0];
		}
	
	$query = "SELECT * FROM usersplayerdetails";
	$res = mysql_query($query);
	while($info = mysql_fetch_array($res)){
		if($info['0']==$id)
			for($k=8; $k>=1; $k--)
				if(!(($info['ppl_playingEleven'.$k]=="")||($info['ppl_playingEleven'.$k]==NULL))){
					$id_List = $info['ppl_playingEleven1'];
					break;
				}
			}

$playerList = explode(";", $id_List);

$category = array('batsmen','keepers','allrounders','bowlers','coaches');
$i = array('1','2','3','4','5');
	
if(!($id_List==""||$id_List=NULL)){
	for($m=0; $m < count($i); $m++){
	  for ($k=0; $k < count($playerList); $k++){	
		if($playerList[$k][0]==$i[$m]){
		
		$query = "SELECT * FROM ".$category[$m];
		$res = mysql_query($query);
		
		while($info = mysql_fetch_array($res)){			
			if (strval($info[0])==$playerList[$k]){
					$sml .= "<tr id='tr".$info[0]."'> <td id=".$info[0]." class='box2_player'>".$info[1]."</td> <td> <a href='javascript:void' onclick='removeFromTraining(".$info[0].")'> <img src='./images/close_popup.png' width='10px' style='margin-left:10px' title='Remove'/> </a> </td> </tr>";
				}
			
		}//while loop
		
		}
	  }//inner for loop
	}//outer for loop
echo $sml;
}
?>