
var probablePlayerList = new Array ();
var finalPlayerList = new Array ();
pplProbablePlayerList = "";
pplFinalPlayerList = "";

var i=0, src;
var numberList = new Array(5);
for(j=0;j<5;j++){
	numberList[j]=0;
console.log(numberList[j]);
}

var finalNumberList = new Array(5);
for(j=0;j<5;j++){
	finalNumberList[j]=0;
console.log(finalNumberList[j]);
}

/*window.onload = function(){
var player_name;
if(localStorage.pplLocalStorage){
var tmp_list = localStorage.pplLocalStorage.split(";");
var tml="";
while(i<tmp_list.length){
	$.ajax({	
		url: "./pages/localStorage.php?id="+tmp_list[i],
		success: function(data) {
			player_name = data;
		}
	});
	tml += "<div id="+tmp_list[i]+" style='display:none;'>"+player_name+"<a href='javascript:void' onclick=''> <img src='./images/close_popup.png' onclick='removeFromList("+tmp_list[i]+")' width='10px' style='margin-left:10px' title='Remove'/> </a> </div>";
	i+=1;
}
	$.ajax({
		success: function(){
			$('#selection').empty();
			$('#selection').append(tml);
			}
	});
}
}*/


function hide(get) {
	if (!document.getElementById) {
	return false;
	}
	var divID = document.getElementById(get);
	divID.style.display     = "none";
	divID.style.visibility  = "hidden";         
}	

		
function make_visible(get){
	if (!document.getElementById){
		return false;
	}
	
	var list = Array ('#batsmen_list','#bowler_list','#allrounder_list','#coach_list','#keeper_list');

	var divID = document.getElementById(get);
	divID.style.display = "block";
	divID.style.visibility = "visible";
	
	for(l=0; l<5; l++){
		if((list[l])!= ("#"+get))
			$(list[l]).hide();
	}	
}

function addToList(player_id, name){
		var tml = "<div id="+player_id+" style='display:none;'>"+name+"<a href='javascript:void' onclick=''> <img src='./images/close_popup.png' onclick='removeFromList("+player_id+")' width='10px' style='margin-left:10px' title='Remove'/> </a> </div>";
		flag=0;	
$.ajax({
	url: "./pages/checkProbableListConfirmation.php",
	type: "GET",
	success: function(data){
		$('#img'+player_id).css({opacity: 0.2});
	if(!data){
		if(probablePlayerList.length!=0){
			for (m=0; m<probablePlayerList.length; m++)
		  	  if (probablePlayerList[m]!=player_id){
				probablePlayerList[i++] = player_id;	
				flag = 1;	
				break;
			}
		}
		else {
			probablePlayerList[i++] = player_id;	
			flag = 1;
			}
			
		if(flag==1){
			$('#selection').append(tml);
			$('#'+player_id).fadeIn('3000', function(){
				}
			);
			
			if(player_id[0]=='1'){ 
				//batsmen
				numberList[0]++;
				console.log(numberList[0]);
				}
			else if(player_id[0]=='4'){
				//bowlers
				numberList[1]++;
				console.log(numberList[1]);
				}
				else if(player_id[0]=='3'){
				//allrounders
				numberList[2]++;
				console.log(numberList[2]);
				}
				else if(player_id[0]=='5'){
				//coaches
				numberList[3]++;
				console.log(numberList[3]);
				}
				else {
				//keepers
				numberList[4]++;
				console.log(numberList[4]);
				}
			console.log(probablePlayerList.length);
			
			if (probablePlayerList.length>17){
				console.log("Paoskdlamskldnskldf ,adkjfns");
				document.getElementById('confirmation').disabled = false; 
				}
			}
		}
		
		
	else {
		if(finalPlayerList.length!=0){
			for (m=0; m<finalPlayerList.length; m++)
		  	  if (finalPlayerList[m]!=player_id){
				finalPlayerList[i++] = player_id;	
				flag = 1;	
				break;
			}
		}
		else {
			finalPlayerList[i++] = player_id;	
			flag = 1;
			}
			
		if(flag==1){
			$('#selection').append(tml);
			$('#'+player_id).fadeIn('3000', function(){
				}
			);
			
			if(player_id[0]=='1'){ 
				//batsmen
				finalNumberList[0]++;
				console.log(finalNumberList[0]);
				}
			else if(player_id[0]=='4'){
				//bowlers
				finalNumberList[1]++;
				console.log(finalNumberList[1]);
				}
				else if(player_id[0]=='3'){
				//allrounders
				finalNumberList[2]++;
				console.log(finalNumberList[2]);
				}
				else if(player_id[0]=='5'){
				//coaches
				finalNumberList[3]++;
				console.log(finalNumberList[3]);
				}
				else {
				//keepers
				finalNumberList[4]++;
				console.log(finalNumberList[4]);
				}
			console.log(finalPlayerList.length);
			
			if (finalPlayerList.length>17){
				console.log("Paoskdlamskldnskldf ,adkjfns");
				document.getElementById('confirmation').disabled = false; 
				}
			}
		
		}
		}
		});
		
		$.ajax({
				success: function() {
					$('.'+player_id).empty();
					$('.Added'+player_id).empty();
					$('.Added'+player_id).append("+Added+");
				}
			});
			/*if(localStorage.pplLocalStorage) 
				localStorage.pplLocalStorage += probablePlayerList[i-1]+';';
			else
				localStorage.pplLocalStorage = probablePlayerList[i-1]+';';*/
}

function removeFromList(player_id){
$.ajax({
	url: "./pages/checkProbableListConfirmation.php",
	type: "GET",
	success: function(data){
		$('#'+player_id).remove();
		$('#img'+player_id).css({opacity: 1});
	if(!data){
			for(k=0; k<probablePlayerList.length; k++){
				if(player_id==probablePlayerList[k]){	
					probablePlayerList.splice(k,1);
					i--;
					break;
					}	
				//console.log(probablePlayerList[j]);
			}
			/*tmp = localStorage.pplLocalStorage.split(";");
			var tmplocalStorage="";
			for(k=0;k<tmp.length;k++){
				if(tmp[k]==player_id){
					tmp.splice(k,1);
					break;
					}
				}
			for(k=0;k<tmp.length;k++)
				tmplocalStorage += tmp[k]+';';
			localStorage.pplLocalStorage = tmplocalStorage;*/
			
		   if(Math.floor(player_id/100)==1){ 
				//batsmen
				
				numberList[0]--;
				console.log(numberList[0]);
				}
			else if(Math.floor(player_id/100)==4){
				//bowlers
				numberList[1]--;
				console.log(numberList[1]);
				}
				else if(Math.floor(player_id/100)==3){
				//allrounders
				numberList[2]--;
				console.log(numberList[2]);
				}
				else if(Math.floor(player_id/100)==5){
				//coaches
				numberList[3]--;
				console.log(numberList[3]);
				}
				else {
				//keepers
				numberList[4]--;
				console.log(numberList[4]);
				}
			console.log(probablePlayerList.length);
			if (probablePlayerList.length<18){
				document.getElementById('confirmation').disabled = true; 
				}
			
			}
			
		else{
				for(k=0; k<finalPlayerList.length; k++){
				if(player_id==finalPlayerList[k]){	
					finalPlayerList.splice(k,1);
					i--;
					break;
					}	
				//console.log(probablePlayerList[j]);
			}
			
		   if(Math.floor(player_id/100)==1){ 
				//batsmen
				
				finalNumberList[0]--;
				console.log(finalNumberList[0]);
				}
			else if(Math.floor(player_id/100)==4){
				//bowlers
				finalNumberList[1]--;
				console.log(finalNumberList[1]);
				}
				else if(Math.floor(player_id/100)==3){
				//allrounders
				finalNumberList[2]--;
				console.log(finalNumberList[2]);
				}
				else if(Math.floor(player_id/100)==5){
				//coaches
				finalNumberList[3]--;
				console.log(finalNumberList[3]);
				}
				else {
				//keepers
				finalNumberList[4]--;
				console.log(finalNumberList[4]);
				}
			console.log(finalPlayerList.length);
			if (finalPlayerList.length<18){
				document.getElementById('confirmation').disabled = true; 
				}
			
			}
			}
		});
		
		$.ajax({
			success: function() {
			$('.Added'+player_id).empty();
			$('.'+player_id).empty();
			$('.'+player_id).append("+Add Player+");
			}
		});
}



function onConfirmation(){
	var d=0;
	console.log(pplProbablePlayerList+"asdfasd");
	
$.ajax({
	url: "./pages/checkProbableListConfirmation.php",
	type: "GET",
	success: function(data){
if(!data){
	
	if(numberList[0]<7){
		console.log("Batsmen<7");
	    d=1;
	    }
	else if(numberList[1]<6){
			console.log("Bowlers<6");
			d=1;
			}
		else if(numberList[2]<2){
			console.log("All-rounders<2");
			d=1;
			}
			else if(numberList[3]<1){
					console.log("Coaches<1");
					d=1;
					}
				else if(numberList[4]<2){ 
						console.log("Keepers<2");
						d=1;	
						}
	if(d==0){
		alert("Success");
		
		for (k=0; k<probablePlayerList.length; k++)
			pplProbablePlayerList += probablePlayerList[k] + ";";	
		$.ajax({
			url: "./pages/updateProbableList.php",
			type : 'post' ,
			data : {'list' : pplProbablePlayerList},
			success: function(){
				location.reload();
				}
		});
		/*$.ajax({
			success: function() {
			$('#pool').empty();		
			$('#box1').empty();	
			$('#selection').empty();
			}
		});
		$.ajax({
		  url: "./pages/playerList.php",
		  type : 'post' ,
		  data : {'list' : pplProbablePlayerList},		
		  success: function(data) {
			  $("#pool").append(data);
			}
		});*/
		
	}	
	else
	    alert("Select a minimum of 7Batsmen, 6Bowlers, 2AllRounders, 2Keepers & 1Coach");
}

else{
	
	if(finalNumberList[0]<7){
		console.log("Batsmen<7");
	    d=1;
	    }
	else if(finalNumberList[1]<6){
			console.log("Bowlers<6");
			d=1;
			}
		else if(finalNumberList[2]<2){
			console.log("All-rounders<2");
			d=1;
			}
			else if(finalNumberList[3]<1){
					console.log("Coaches<1");
					d=1;
					}
				else if(finalNumberList[4]<2){ 
						console.log("Keepers<2");
						d=1;	
						}
						else if(finalPlayerList.length>18){
							console.log("TotalNum>18");
							d=1;
							}
	if(d==0){
		alert("Success");
		
		for (k=0; k<finalPlayerList.length; k++)
			pplFinalPlayerList += finalPlayerList[k] + ";";	
			
		$.ajax({
			url: "./pages/updateFinalPlayerList.php",
			type : 'post' ,
			data : {'list' : pplFinalPlayerList},
			success: function(){
			  window.location = "matchday.php";
			}
		});
		
		/*$.ajax({
			success: function() {
			$('#pool').empty();		
			$('#box1').empty();	
			$('#selection').empty();
			$('#confirmation').hide();
			}
		});
		
		$.ajax({
		  url: "./pages/finalListInfo.php",
		  type : 'post' ,
		  data : {'list' : pplFinalPlayerList},		
		  success: function(data) {
			$("#pool").append(data);
			window.location = "matchDay.php";
			}
		});*/
		
	}	
	else
	    alert("Select a minimum of 7Batsmen, 6Bowlers, 2AllRounders, 2Keepers & 1Coach and a total of only eighteen players");
		
	}

}
	
});


}



function playerInfo(clickedId){
	$(document).ready(function() {
				console.log("YEAAA")

		$.ajax({
		url : "./pages/newphp.php?id="+clickedId,
		success : function(){
				console.log("YEAAAS")

			}
		});
		});
	}
	
	
function b(){
			
	}