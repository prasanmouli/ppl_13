<?php
	include("config.lib.php");
		
		$list = $_POST['list'];
		
		$playerList = explode(";", $list);
						
		$data = "";
		/*
		for ($k=0; $k < count($probablePlayerList); $k++){
			if($probablePlayerList[k]=='1'){
				//batsmen				
				$data += "<div onmouseover='playerInfo(".$probablePlayerList[k].")'> <img style='float:left;width:115px;margin:0 5px 10px 0;' src='./images/players/batsmen/".$probablePlayerList[k].".jpeg' /> </div>";
				}
			else if(Math.floor(probablePlayerList[k]/100)==4){
				//bowlers
					$('#pool').append("<div> <img style='float:left;width:115px;margin:0 5px 10px 0;' src='./images/players/bowlers/"+probablePlayerList[k]+".jpeg' /> </div>");
				}
				else if(Math.floor(probablePlayerList[k]/100)==3){
				//allrounders
					$('#pool').append("<div> <img style='float:left;width:115px;margin:0 5px 10px 0;' src='./images/players/allrounders/"+probablePlayerList[k]+".jpeg' /> </div>");
				}
				else if(Math.floor(probablePlayerList[k]/100)==5){
				//coaches
					$('#pool').append("<div> <img style='float:left;width:115px;margin:0 5px 10px 0;' src='./images/players/coaches/"+probablePlayerList[k]+".jpeg' /> </div>");
				}
				else {
				//keepers
					$('#pool').append("<div> <img style='float:left;width:115px;margin:0 5px 10px 0;' src='./images/players/keepers/"+probablePlayerList[k]+".jpeg' /> </div>");
				}
				}*/
			
	$category = array('batsmen','keepers','allrounders','bowlers','coaches');
	$i = array('1','2','3','4','5');
	for($m=0; $m < count($i); $m++){
	  for ($k=0; $k < count($playerList); $k++){	
		if($playerList[$k][0]==$i[$m]){
		
		$query = "SELECT * FROM ".$category[$m];
		$res = mysql_query($query);
		
		while($info = mysql_fetch_array($res)){	
		
		if (strval($info[0])==$playerList[$k]){
			$txt1 = "<div id='page-wrap'>
		<figure class='cap-left'>";
			$txt3 = "addToList('$info[0]','$info[1]')";
			$txt2 = "<figcaption align='center'>".$info[1]."<br/> <a class=".$info[0]." onclick=".$txt3." href='javascript:void' style='font-size:9px'> +Add Player+ </a><span class='Added".$info[0]."' style='font-size:9px;color:#6CCF4B;font-family:Trajan Pro;' > </span>
			</figcaption>
		</figure>
    </div>";
			$src = "./images/players/".$category[$m]."/".$info[0].".jpeg";
			echo $txt1."<img id='img".$info[0]."' src=".$src." alt=".$info[0]."/>".$txt2;
			}
			
		}//while loop
		
		}
	  }//inner for loop
	}//outer for loop

   echo "<section id='learninz'>
		
	  <style>
figure { 
  display: block; 
  position: relative; 
  float: left; 
  overflow: hidden; 
  margin: 0 5px 10px 0;
}
figcaption { 
  position: absolute; 
  background: rgba(0,0,0,0.9); 
  width: 115px;
  height: 28px;
  font-size: 12px;
  color: white; 
  opacity: 0;
  -webkit-transition: all 0.6s ease;
  -moz-transition:    all 0.6s ease;
  -o-transition:      all 0.6s ease;
}
figure:hover figcaption {
  opacity: 1;
}
.cap-left:before {  bottom: 10px; left: 10px; }
.cap-left figcaption { bottom: 0; left: -30%; }
.cap-left:hover figcaption { left: 0; }
</style>
    </section>
";

?>