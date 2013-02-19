<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<?php 
	global $m; 
	include("pages/config.lib.php");
?>
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<link rel="icon" href="./images/ppl13.png" type="image/png">
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>PPL13</title>

<link href="./css/main.css" rel="stylesheet" type="text/css" />
<script type="text/javascript" src="./js/jquery.min.js"></script>

</head>

<body>
<div align="right" style="margin-right:0px;">
<table>
	<?php 
		if(!$_SESSION['username']){
		header("location: ./");
		}
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
	<img src="./images/ppl13_header2c.png"/>
	</div>

	<div class="menu">
	<table>
	<tr>
	<td> <a href="./"> Home </a> </td>
	<td class="current_page"> <a href=""> My Team </a> </td>
   	<td> <a href="./matchday.php"> Match Day </a> </td>
	<td> <a href=""> My Score </a> </td>
	<td> <a href=""> The Guide </a> </td>
	<td> <a href="http://www.pragyan.org/13/home/events/manigma/pragyan_premier_league/" target="_blank"> Rules & Regulations </a> </td>
	<td> <a href="http://www.pragyan.org/13/home/events/manigma/pragyan_premier_league/" target="_blank"> Contact Us </a> </td>
	</tr>
	</table>
	</div>

	<div id="content" align="center">
	<div id="box1" align="center" style="width: 170px; height: 600px; margin-right: 10px; float: left;">
		<table class="team_select" style="padding: 80px 20px 50px 0px;">
		<tr> <td> <button onclick="make_visible('batsmen_list')"> BATSMEN </button> </td> </tr>
		<tr> <td> <button onclick="make_visible('bowler_list')"> BOWLERS </button> </td> </tr>
		<tr> <td> <button onclick="make_visible('allrounder_list')"> ALL-ROUNDERS </button> </td> </tr>
		<tr> <td> <button onclick="make_visible('keeper_list')"> KEEPERS </button> </td> </tr>
		<tr> <td> <button onclick="make_visible('coach_list')"> COACHES </button> </td> </tr>
		</table>
	</div>
    

    <div id="stage" align="center" style=" width: 725px; float:left;"> </div>
    <div id="pool" class='flexcroll' align="center" style="width: 770px; float:left; overflow: auto; height:620px;">
    <div id="batsmen_list" align="center"></div>
	<div id="bowler_list" align="center"></div>
    <div id="allrounder_list"  align="center"></div>
	<div id="coach_list"  align="center"></div>
    <div id="keeper_list"  align="center"></div>
    </div>
    
    <div style="width: 230px; margin: 0;float: left;">
    <p id="balanceMessage" style="margin-top: -40px; text-align: center;"> </p>
    <p align="center" id="balance"></p>
    <div align="center" style="overflow: auto; margin-top: 10px; height: 420px;">
    <table id="selection"> </table>
    </div>
    <div align="center" id="currentSelection" style="margin-top:5px;"> </div>
    <div align="center"> <button id="confirmation" onclick="onPreConfirmation()" disabled="true"> CONFIRM </button></div>
    <div id="message" style="text-align:center;"> </div>
    </div>
    </div>

</div>

<div id="login-box" class="login-popup">
                <a href="#" class="close">
                    <img src="./images/close_popup.png" class="btn_close" title="Close Window" alt="Close" />
                </a>
                <div id="playInfo" align="center"></div>
</div>

<div align="center">
&copy; Pragyan CSG Team 2012-2013. Best in <img width="18px" style="vertical-align:middle" src="./images/chrome.jpg" alt="Chrome" />
</div>
<script type="text/javascript" src="./js/main.js"></script>

<script type="text/javascript">
/*document.getElementById("bowler_list").style="display: none; visibility: hidden;" ;
document.getElementById("allrounder_list").style="display: none; visibility: hidden;";
document.getElementById("keeper_list").style="display: none; visibility: hidden;" ;
document.getElementById("coaches_list").style="display: none; visibility: hidden;" ;*/
var list = Array ('batsmen','bowlers','allrounders','coaches','keepers');
var contentLoad = 0;

$.ajax({
	url: "./pages/money.php",
	type: 'post',
	data: {'choice' : 1, 'playerPrice': 0},
	success: function(data){
		moneyDisplay(data);
		}
	});	

//Check for Final Squad Confirmation
$.ajax({
	url: "./pages/checkFinalListConfirmation.php",
	type: "GET",
	success: function(data){
		if(data !=""){
			$('#pool').empty();		
			$('#box1').empty();	
			$('#selection').empty();
			$('#selection').append("<div style='margin-top: 50px; font-family: Exo; font-size: 18px;'> This is your squad for PPL!<br/> Go to <a href='matchDay.php'> Match Day </a> for team selection. </div>");
			$('#confirmation').hide();
			$('#pool').css({width: 630});
			$('#stage').css({width: 600});
			$('#content').css({width: 1050, height: 650});
			$('#balanceMessage').remove();
			$('#balance').remove();
			finalListDisplay(data);
		}
		else{
			contentLoad = 1;
			//Check for Probable List Confirmation
$.ajax({
	url: "./pages/checkProbableListConfirmation.php",
	type: "GET",
	success: function(data){
	  if(contentLoad == 1){
		if(data){
			$('#pool').empty();		
			$('#box1').empty();	
			$('#selection').empty();
			//$('#stage').css({width: 600});
			checkConfirmation(data);
			}
		else{
			$.ajax({
				success: function(){
 				  $('#stage').append("Make a list of probables for your squad!");
 				  $('#balanceMessage').empty();
		  	  	  $('#balanceMessage').append("<span id='balanceMessage' style='font-family: Segoe UI; color: #17526d; font-size: 12px;'> Money will not be deducted from your account for the selection of probable players! Just an estimate is shown below to help in your future selection of the squad.(You have ₹70,00,000 for player purchases) </span>");
			  
				}
			});	
			window.onload = playerList(4);
			}
		}
	}
});
		}
	}
});

/*Check for Probable List Confirmation
$.ajax({
	url: "./pages/checkProbableListConfirmation.php",
	type: "GET",
	success: function(data){
	  if(contentLoad == 1){
		if(data){
			$('#pool').empty();		
			$('#box1').empty();	
			$('#selection').empty();
			checkConfirmation(data);
			}
		else{
			$.ajax({
				success: function(){
 				  $('#stage').append("Make a list of probables for your squad!");
				}
			});			

			window.onload = playerList(4);
			}
		}
	}
});*/

</script>

</body>
</html>