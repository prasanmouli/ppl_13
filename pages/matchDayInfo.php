<?php 

include ('config.lib.php');
$sendData = "";
$tableName = array("batsmen" , "keepers" , "allrounders","bowlers","coaches");
$infoName = array(array("ppl ID: " , "Name: " , "T20 Club: ", "Price: ", "Matches: "),
array("ppl ID: " , "Name: " , "T20 Club: ", "Price: ", "Matches: "), 
array("ppl ID: " , "Name: " , "T20 Club: ", "Price: ", "Matches: "),
array("ppl ID: " , "Name: " , "T20 Club: ", "Price: ", "Matches: "),
array("ppl ID: " , "Name: " , "Price: "));
$data = "";
$rec_val = mysql_real_escape_string($_POST['playerid']);
$val =floor($rec_val/100)-1;
$query = "SELECT * FROM ".$tableName[$val]." WHERE pl_id=".$rec_val;
		$res = mysql_query($query);
		while($info = mysql_fetch_array($res)){
        for($o=0;$o<20;$o++){
         $data.=$info[$o].';';
      }
        
         }
     $infoArray = explode(';',$data);
     $src = "./images/players/".$tableName[$val]."/".$infoArray[0].".jpeg";
		$sendData.="<table class='playerInfo'><tr><td rowspan='6'><img src='".$src."' alt='".$infoArray[0]."'></img></td>";
     for($o=0;$o<5;$o++){
     $y=$o;
	 if($val==4)
     	if($o==2)
			$y=3;
		else if($o==3)
	 		break;
     $sendData.="<td><span class='categ'>".$infoName[$val][$o]."</span><span class='categ_value'>".$infoArray[$y]."</span></td></tr>";
     }
	$sendData.="</table>";
echo $sendData;

?>