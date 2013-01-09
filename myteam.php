<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<?php 
	global $m; 
	include("pages/config.lib.php");
?>
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>PPL13</title>
<link href="./css/main.css" rel="stylesheet" type="text/css" />
<script type="text/javascript" src="./js/main.js"></script>
<script type="text/javascript" src="./js/jquery-1.8.3.js"></script>
<script type="text/javascript">
var list = Array ('batsmen','bowlers','allrounders','coaches','keepers');
function playerList(n){
	if (n==0){
		k = "pages/" + list[n] + ".php";
		$.ajax({
			url: k,
			success: function(html) {$('#batsmen_list').append(html);} 
		});
		}
	else if(n==1) {
		playerList(n-1);
		k = "pages/" + list[n] + ".php";
		$.ajax({
			url: k,
			success: function(html) {
				$('#bowler_list').append(html);
				$('#bowler_list').hide();
			} 
		});
		}
		else if(n==2) {
		playerList(n-1);
		k = "pages/" + list[n] + ".php";
		$.ajax({
			url: k,
			success: function(html) {
				$('#allrounder_list').append(html);
				$('#allrounder_list').hide();
			} 
		});
		}
		else if(n==3) {
		playerList(n-1);
		k = "pages/" + list[n] + ".php";
		$.ajax({
			url: k,
			success: function(html) {
				$('#coach_list').append(html);
				$('#coach_list').hide();
			} 
		});
		}
		else {
		playerList(n-1);
		k = "pages/" + list[n] + ".php";
		$.ajax({
			url: k,
			success: function(html) {
				$('#keeper_list').append(html);
				$('#keeper_list').hide();
			} 
		});
		}
}
window.onload = playerList(4);
</script>
<script type="text/javascript">

</script>
<style></style>
</head>

<body>
<div align="right" style="margin-right:0px;">
<table>
	<?php 
		if (isset($_SESSION['username'])){
		echo "<tr> <td class='user'>";	
		if (isset($_SESSION['views']))
			echo $_SESSION['username'] . "<a href='./pages/logout.php'> Sign Out </a> </td> </tr>";
		else {
			$_SESSION['views']=1;
			echo "Hello! " . $_SESSION['username'] . "<a href='./pages/logout.php'> Sign Out </a> </td> </tr>";
			}
		}
		else $m=1;
	?>
</table>
</div>

<div align="center">
	<div id="header">
	<img src="./images/ppl13_header2c.png" width="1100px" height="120px"/>
	</div>
	<div class="menu">
	<table>
	<tr>
	<td> <a href="./"> Home </a> </td>
	<td class="current_page"> <a href=""> my TEAM </a> </td>
	<td> <a href=""> my SCORE </a> </td>
	<td> <a href=""> The Guide </a> </td>
	<td> <a href=""> Rules & Regulations </a> </td>
	<td> <a href=""> Contact Us </a> </td>
	</tr>
	</table>
	</div>

	<div id="content" style="height: 450px;">
	<div id="box1"  style="width: 160px; height:450px;float: left">
		<table class="team_select" style="padding: 80px 20px 50px 0px;">
		<tr> <td> <button onclick="make_visible('batsmen_list')"> Batsmen </button> </td> </tr>
		<tr> <td> <button onclick="make_visible('bowler_list')"> Bowlers </button> </td> </tr>
		<tr> <td> <button onclick="make_visible('allrounder_list')"> All-Rounders </button> </td> </tr>
		<tr> <td> <button onclick="make_visible('keeper_list')"> Keepers </button> </td> </tr>
		<tr> <td> <button onclick="make_visible('coach_list')"> Coaches </button> </td> </tr>
		</table>
	</div>
    
    <div id="pool" style="width: 630px; float:left; overflow: auto; margin-right:20px; height: 450px;">
    <div id="batsmen_list" align="center">
	</div>
	<div id="bowler_list" style="display: none; visibility: hidden;" align="center">
	</div>
    <div id="allrounder_list" style="display: none; visibility: hidden;" align="center">
	</div>
	<div id="coach_list" style="display: none; visibility: hidden;" align="center">
	</div>
    <div id="keeper_list" style="display: none; visibility: hidden;" align="center">
	</div>
	</div>
    
    <div style="width: 180px; overflow: auto; height: 400px;">
    <div id="selection" style="overflow: auto; height: 360px;">
    </div>
    <div align="center"> <button id="confirmation" onclick="onConfirmation()" disabled="true"> Confirm List </button></div>
    </div>

</div>

<div align="center">
&copy; Pragyan CSG Team 2012-2013
<div id="test" > </div>
</div>

</body>
</html>