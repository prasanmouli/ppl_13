<?php
	include("config.lib.php");
		
		$id_List_Str = mysql_real_escape_string($_POST['list']);
		
		$idList = explode(";",$id_List_Str);
		$flag = 0;
		
	for ($m=0; $m<sizeof($idList)-1; $m++)
		for($n=$m+1; $n<sizeof($idList); $n++)  
		  if ($idList[$n]==$idList[$m]){
			$flag = 1;
			break;
			}	
			
	$query1 = "SELECT * from userdetails";
	$res1 = mysql_query($query1);
	while($info = mysql_fetch_array($res1)){
		if ($info[1]==$_SESSION['username'])
			$id = $info[0];
		}
		
	$query3 = "SELECT * from usersplayerdetails";
	$res3 = mysql_query($query3);
	while($info = mysql_fetch_array($res3)){
		if($info[0] == $id)
			$trainingStr = $info['ppl_trainingSession1'];
	}
	
	if(!($trainingStr==NULL || $trainingStr=="")){
		$trainingList = explode(";", $trainingStr);
		for($j=0; $j<sizeof($idList)-1; $j++)
			if(in_array($idList[$j], $trainingList))
				$flag = 2;
	}
	
	if($flag==0){	
			$query2 = "UPDATE usersplayerdetails SET ppl_playingEleven1 = '{$id_List_Str}' WHERE ppl_id='$id'";
			$res2 = mysql_query($query2);
			echo "";
	}
	else{
		if($flag == 1)
			echo "Repetition!";	
		else
			echo "Training!";
	}
?>