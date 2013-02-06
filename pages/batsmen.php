<?php
	include("config.lib.php");
		
		$query = "SELECT * FROM batsmen";
		$res = mysql_query($query);
		while($info = mysql_fetch_array($res)){
			$txt1 = "<div id='page-wrap'>
		<figure class='cap-left'>";
			$txt3 = "addToList('$info[0]','$info[1]')";
			$txt2 = "<figcaption align='center'>".$info[1]."<br/> <a class=".$info[0]." onclick=".$txt3." href='javascript:void' style='font-size:9px'> +Add Player+ </a><span class='Added".$info[0]."' style='font-size:9px;color:#6CCF4B;font-family:Trajan Pro;' > </span>
			</figcaption>
		</figure>
    </div>";
			$src = "./images/players/batsmen/".$info[0].".jpg";
			echo $txt1."<img id='img".$info[0]."' src=".$src." alt=".$info[0]."/>".$txt2;
			}

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