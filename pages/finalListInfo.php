<?php
	include("config.lib.php");
		
		$list = $_POST['list'];		
		$playerList = explode(";", $list);
						
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
			$txt1 = "<div id='page-wrap'><figure class='cap-left'>";
			$txt2 = "<figcaption align='center'>".$info[1]."</figcaption></figure></div>";
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
  height: 20px;
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