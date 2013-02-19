<?php 
include ('config.lib.php');
$query = "SELECT * FROM batsmen WHERE pl_id=".mysql_real_escape_string($_GET['id']);
		$res = mysql_query($query);
		echo "<script type='text/javascript'> console.log('Yea'); </script>";
		while($info = mysql_fetch_array($res)){
		echo "<div id=".$_GET['id']."12".">".$info[1]."</div>";
		echo "<script type='text/javascript'> console.log('Yea'); </script>";
		}
?>