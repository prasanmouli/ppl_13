<?php
	include("config.lib.php");
		
		$id_List = $_POST['list'];
		$playerList = explode(";",$id_List);				
		$data = "";
					
	$category = array('batsmen','keepers','allrounders','bowlers','coaches');
	$i = array('1','2','3','4','5');
	for($m=0; $m < count($i); $m++){
	  for ($k=0; $k < count($playerList); $k++){	
		if($playerList[$k][0]==$i[$m]){
		
		$query = "SELECT * FROM ".$category[$m];
		$res = mysql_query($query);
		
		while($info = mysql_fetch_array($res)){	
		
		if (strval($info[0])==$playerList[$k]){
			/*$txt1 = "<div id='page-wrap'><figure class='cap-left'>";
            $txt2="</div>";*/
			
			if(floor($info[0]/100)==1)
				$src = "./images/bat.jpg";
			else if (floor($info[0]/100)==4)
					$src = "./images/ball.jpg";
				else if (floor($info[0]/100)==3)
						$src = "./images/all.jpg";
					else if (floor($info[0]/100)==5)
							$src = "./images/coach.jpg";
						else
							$src = "./images/keeper.jpg";	
							
			$txt = "addToPlayingEleven('$info[0]','$info[1]')";
			$txt2 = "addToTraining('$info[0]','$info[1]')";
			
			if (floor($info[0]/100)!=5)
				echo "<tr> <td id='player".$info[0]."'> <img src=".$src." width='18px' style='margin-right:5px; border-radius: 4px;'/>".$info[1]." </td> <td style='text-align: center;'> <span id='send".$info[0]."' style='font-size:10px;margin-left: 10px;'> Send to </span> <a onclick=".$txt." id='link".$info[0]."' style='font-size:10px' href='javascript:void'> Match </a> <span style='font-size: 12px;' id='pipe".$info[0]."'>|</span> <a onclick=".$txt2." id='train".$info[0]."' style='font-size:10px' href='javascript:void'> Training </a> <span id='Added".$info[0]."' style='font-size:10px;color:green;font-family:Trajan Pro;'> </span> <span id='trainMess".$info[0]."' style='font-size:10px;color: #c65821;font-family:Trajan Pro;'> </span> </td> </tr> ";
			else
				echo "<tr> <td id='player".$info[0]."'> <img src=".$src." width='18px' style='margin-right:5px; border-radius: 4px;'/>".$info[1]." (Coach) </td> </tr>";
			}
			
		}//while loop
		
		}
	  }//inner for loop
	}//outer for loop

?>