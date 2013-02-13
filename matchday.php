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
var linkList = new Array();
var n=0;
var playingEleven = new Array();
var training = new Array();
var m=0;
pplPlayingEleven = "";
pplTraining = "";

var numberPlayingList = new Array(5);
for(j=0;j<5;j++)
	numberPlayingList[j]=0;


var list = Array ('batsmen','bowlers','allrounders','coaches','keepers');
var contentLoad = 0;

$.ajax({
       url: "./pages/checkFinalListConfirmation.php",
       type: "GET",
       success: function(data){
	       if(data){
    		   $('#finalSquad').empty();
			   listSquadDisplay(data);
       		}
	   		else {
				$('#poolDay').empty();
				$('#content').css( {height: 300} );
				$('#message').append("Oops! Seems like you haven't finalised your squad!<br/>You'll need to confirm your final eighteen @ <a href='./myteam.php'> MyTeam </a>");
				//window.location.replace("./myteam.php");
			}
		}
});

function listSquadDisplay(pList){
	$.ajax({
           url: "./pages/matchDaySquad.php",
           type : 'post' ,
           data : {'list' : pList},
           success: function(data) {
               $("#finalSquad").append(data);
           }
           });
	/*$.ajax({
	success: function(){
		/*console.log($('.abcdef').attr('id'));
				console.log($('.abcdef').attr('id'));

	  for(k=0;k<document.getElementsByClassName("abcdef").length;k++){
		var temp = document.getElementsByClassName("abcdef")[k];
		console.log(temp.attr('id'))
		document.getElementById(temp).addEventListener("click", addToPlayingEleven(document.getElementsByClassName("link")[k]));
		}
	}
});	*/   
}

$.ajax({
	success: function(){
		$('#finalTeam').empty();
		listTeamDisplay();
		}
	});

function listTeamDisplay(){
	$.ajax({
		 url: "./pages/matchDayTeam.php",
         type : 'post',
         success: function(data) {
			 if(data){
             	$("#finalTeam").append(data);
				numberPlayingList[0] = 4;
				numberPlayingList[1] = 4;
				numberPlayingList[2] = 2;
				numberPlayingList[3] = 1;
				numberPlayingList[4] = 1;
				}
         }
	});
	
	$.ajax({
		url: "./pages/retrieveCurrentPlayingEleven.php",
		type: 'get',
		success: function(data){
			console.log(data);
			playingEleven = data.split(";");
			console.log(playingEleven);
			$("#finalElevenConfirmation").show();
			for(b=0; b<playingEleven.length; b++){
			$("#player"+playingEleven[b]).css({opacity: 0.5});	
			$("#send"+playingEleven[b]).empty();
			$("#train"+playingEleven[b]).empty();
			$("#pipe"+playingEleven[b]).empty();	
			$("#finalElevenMessage").empty();
			$("#link"+playingEleven[b]).empty();	
			$("#trainMess"+playingEleven[b]).empty();
			$("#Added"+playingEleven[b]).empty();
			$("#Added"+playingEleven[b]).append("+Sent For Match+");
			}
		}
	});

}


function addToTraining(pId, name){
	
var sml = "<tr id='tr"+pId+"'> <td id="+pId+" class='box2_player' style='display:none;'>"+name+"</td> <td> <a href='javascript:void' onclick='removeFromTraining("+pId+")'> <img src='./images/close_popup.png' width='10px' style='margin-left:10px' title='Remove'/> </a> </td> </tr>";
	
$.ajax({
		success : function(){
		$('#training').append(sml);	
		$('#'+pId).fadeIn('3000', function(){});
		$("#player"+pId).css({opacity: 0.5});	
		$("#send"+pId).empty();
		$("#train"+pId).empty();	
		$("#pipe"+pId).empty();	
		$("#link"+pId).empty();	
		$("#Added"+pId).empty();
		$("#trainMess"+pId).empty();
		$("#trainMess"+pId).append("+Sent For Training+");
		
		if(playingEleven.length!=0 && training.length!=0){			
			for (l=0; l<training.length; l++)
		  	   	if (training[l]==pId){
					flag = 2;
					break;
					}
			for (l=0; l<playingEleven.length; l++)
		  	  if(flag!=2)
			  	if (playingEleven[l]==pId){
					flag = 3;
			  		break;
			  	}
			if (flag!=3 && flag!=2){
				training[m++] = pId;
				flag = 1;
				}		
			}	
		else {
			flag = 1;
			training[m++] = pId;
			}
		
		console.log(training);	
		console.log(playingEleven);	
		
		if (training.length>=1){
				$("#finalTrainingConfirmation").fadeIn('3000', function(){});
				}
			else	
				$("#finalTrainingConfirmation").hide();
	
	}
});	
}


function addToPlayingEleven(pId, name){
	console.log(pId);
	var tml = "<tr id='ma"+pId+"'> <td id="+pId+" class='box2_player' style='display:none;'>"+name+"</td> <td> <a href='javascript:void' onclick='removeFromPlayingEleven("+pId+")'> <img src='./images/close_popup.png' onclick='' width='10px' style='margin-left:10px' title='Remove'/> </a> </td> <br/> </tr>";
	flag=0;
	$.ajax({
		success : function(){
		$('#finalTeam').append(tml);	
		$('#'+pId).fadeIn('3000', function(){});	
		$("#player"+pId).css({opacity: 0.5});	
		$("#send"+pId).empty();
		$("#train"+pId).empty();
		$("#pipe"+pId).empty();	
		$("#finalElevenMessage").empty();
		$("#link"+pId).empty();	
		$("#trainMess"+pId).empty();
		$("#Added"+pId).empty();
		$("#Added"+pId).append("+Sent For Match+");
		
		if(playingEleven.length!=0 && training.length!=0){
			for (l=0; l<playingEleven.length; l++)
		  	  if (playingEleven[l]==pId){
				flag = 2;
			  	break;
			  }
			
			for (l=0; l<training.length; l++)
		  	  if(flag!=2)
			  	if (training[l]==pId){
					flag = 3;
					break;
					}
			if (flag!=3 && flag!=2){
				playingEleven[n++] = pId;
				flag = 1;
				}		
			}	
		else {
			flag = 1;
			playingEleven[n++] = pId;
			}
		console.log(playingEleven);	
		console.log(training);	

	if(flag==1){		
		if(Math.floor(pId/100)==1){ 
			//batsmen
			numberPlayingList[0]++;
			console.log(numberPlayingList[0]);
			}
		else if(Math.floor(pId/100)==4){
			//bowlers
			numberPlayingList[1]++;
			console.log(numberPlayingList[1]);
			}
			else if(Math.floor(pId/100)==3){
				//allrounders
				numberPlayingList[2]++;
				console.log(numberPlayingList[2]);
				}
				else if(Math.floor(pId/100)==5){
					//coaches
					numberPlayingList[3]++;
					console.log(numberPlayingList[3]);
					}
				else {
					//keepers
					numberPlayingList[4]++;
					console.log(numberPlayingList[4]);
					}
			console.log(playingEleven.length);
			
			if (playingEleven.length==11){
				$("#finalElevenConfirmation").fadeIn('3000', function(){});
				}
			else	
				$("#finalElevenConfirmation").hide();
	}
}
		
});
}

function removeFromTraining(pId){
	$.ajax({
		success : function() {
			for(k=0; k<training.length; k++){
				if(pId==training[k]){	
					training.splice(k,1);
					m--;
					break;
					}	
				//console.log(probablePlayerList[j]);
			}
			$('#tr'+pId).remove();
			$("#player"+pId).css({opacity: 1});	
			$("#Added"+pId).empty();
			$("#trainMess"+pId).empty();
			$("#link"+pId).empty();
			$("#send"+pId).empty();
			$("#pipe"+pId).empty();
			$("#train"+pId).empty();
			$("#link"+pId).append("Match");
			$("#send"+pId).append("Send to");
			$("#pipe"+pId).append("|");	
			$("#train"+pId).append("Training");
			
			if (training.length>=1){
				$("#finalTrainingConfirmation").fadeIn('3000', function(){});
				}
			else	
				$("#finalTrainingConfirmation").hide();
		}
	});
}

function removeFromPlayingEleven(pId){
	$.ajax({
		success : function() {
			for(k=0; k<playingEleven.length; k++){
				if(pId==playingEleven[k]){	
					playingEleven.splice(k,1);
					n--;
					break;
					}	
				//console.log(probablePlayerList[j]);
			}
			$('#ma'+pId).remove();
			$("#player"+pId).css({opacity: 1});	
			$("#Added"+pId).empty();
			$("#trainMess"+pId).empty();
			$("#link"+pId).empty();
			$("#send"+pId).empty();
			$("#pipe"+pId).empty();
			$("#finalElevenMessage").empty();
			$("#train"+pId).empty();
			$("#link"+pId).append("Match");
			$("#send"+pId).append("Send to");
			$("#pipe"+pId).append("|");
			$("#train"+pId).append("Training");
			
			if(Math.floor(pId/100)==1){ 
			//batsmen
			numberPlayingList[0]--;
			console.log(numberPlayingList[0]);
			}
		else if(Math.floor(pId/100)==4){
			//bowlers
			numberPlayingList[1]--;
			console.log(numberPlayingList[1]);
			}
			else if(Math.floor(pId/100)==3){
				//allrounders
				numberPlayingList[2]--;
				console.log(numberPlayingList[2]);
				}
				else if(Math.floor(pId/100)==5){
					//coaches
					numberPlayingList[3]--;
					console.log(numberPlayingList[3]);
					}
				else {
					//keepers
					numberPlayingList[4]--;
					console.log(numberPlayingList[4]);
					}
			console.log(playingEleven.length);
			
			if (playingEleven.length==11){
				$("#finalElevenConfirmation").show();
				}
			else	
				$("#finalElevenConfirmation").hide();
			
		}
	});
}


function onfinalTeamConfirmation(){
	
	d=0;
	if(numberPlayingList[0]!=4){
		console.log("Batsmen!=4");
	    d=1;
	    }
	else if(numberPlayingList[1]!=4){
			console.log("Bowlers!=4");
			d=1;
			}
		else if(numberPlayingList[2]!=2){
			console.log("All-rounders!=2");
			d=1;
			}
			else if(numberPlayingList[4]!=1){ 
				console.log("Keepers!=1");
				d=1;	
				}
	
	if(d==0){
		for (k=0; k<playingEleven.length; k++)
			pplPlayingEleven += playingEleven[k] + ";";	
		$.ajax({
			url: "./pages/finalPlayingEleven.php",
			type : 'post' ,
			data : {'list' : pplPlayingEleven},
			success: function(data){
				if(!data){
					$("#finalElevenMessage").empty();
					$("#finalElevenMessage").append("Changes Saved!");
				}
				else{
					$("#finalElevenMessage").empty();
					$("#finalElevenMessage").append("Changes NOT saved! Recheck selection!");
				}
				}
		});
	}
	
}


</script>

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
		echo $_SESSION['username'] . "<a href='./pages/logout.php'> Sign Out </a> </td> </tr>";
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
<td> <a href="./myteam.php"> My Team </a> </td>
<td  class="current_page"> <a href="./matchday.php"> Match Day </a> </td>
<td> <a href=""> My Score </a> </td>
<td> <a href=""> The Guide </a> </td>
<td> <a href=""> Rules & Regulations </a> </td>
<td> <a href=""> Contact Us </a> </td>
</tr>
</table>
</div>

<div id="content" style="width:1050px; height: 550px;">

<div id="message" style="width: 1000px; margin-right:20px; margin-top: 20px; text-align: center;"> </div> 

<div id="poolDay" style="width: 1000px; overflow: auto; margin-right:20px; margin-top: 20px; height: 550px;">
<table align="center">
<tr>
<td style="width:450px; vertical-align: top;"> Your Squad <table id="finalSquad"> </table>  </td>
<td style="width:350px; vertical-align: top;"> Your Playing Eleven <table id="finalTeam"> </table> <button id="finalElevenConfirmation" style="display: none;margin-top: 20px;" onclick="onfinalTeamConfirmation()"> Save Team </button> <p id="finalElevenMessage"> </p> </td>
<td style="width:350px; vertical-align: top;"> Training <table id="training"> </table> <button id="finalTrainingConfirmation" style="display: none; margin-top: 20px;" onclick="onTrainingConfirmation()"> Save </button> </td>
</tr>
</table>

</div>

<!--<div align="center"> <button id="confirmation" onclick="onConfirmation()" disabled="true"> Confirm List </button> -->


</div>


<div align="center">
&copy; Pragyan CSG Team 2012-2013
<div id="test" > </div>
</div>

</body>
</html>