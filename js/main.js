
var probablePlayerList = new Array ();
var i=0, src;
var numberList = new Array(5);
for(j=0;j<5;j++){
	numberList[j]=0;
console.log(numberList[j]);
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
		$.ajax({
			success: function() {
			$('#selection').append(tml);

			$('#'+player_id).fadeIn('3000', function(){
				}
			);

			probablePlayerList[i++] = player_id;
			/*if(localStorage.pplLocalStorage) 
				localStorage.pplLocalStorage += probablePlayerList[i-1]+';';
			else
				localStorage.pplLocalStorage = probablePlayerList[i-1]+';';*/
				
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
		});		
		
		$.ajax({
			success: function() {
			$('.'+player_id).empty();
			$('.Added'+player_id).append("+Added+");
			}
		});
}

function removeFromList(player_id){
		$.ajax({
			success: function(){
			$('#'+player_id).remove();
			
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
		});
		
		$.ajax({
			success: function() {
			$('.Added'+player_id).empty();
			$('.'+player_id).append("+Add Player+");
			}
		});
}



function onConfirmation(){
	var d=0;
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
		pplProbablePlayerList = "";
		for (k=0; k<probablePlayerList.length; k++)
			pplProbablePlayerList += probablePlayerList[k] + ";";	
		$.ajax({
			url: "./pages/updateProbableList.php",
			type : 'post' ,
			data : {'list' : pplProbablePlayerList},
			success: function(data) {
					$("#pool").append(data);
				}
		});
		$.ajax({
			success: function() {
			$('#pool').empty();		
			$('#box1').empty();	
			$('#selection').empty();
			$('#confirmation').hide();
			}
		});
		$.ajax({
		  url: "./pages/probablePlayerList.php",
		  type : 'post' ,
		  data : {'list' : pplProbablePlayerList},		
		  success: function(data) {
			  $("#pool").append(data);
			  /*
		  for (k=0; k<probablePlayerList.length; k++){
			if(Math.floor(probablePlayerList[k]/100)==1){
				//batsmen				
				$('#pool').append("<div onmouseover='playerInfo("+probablePlayerList[k]+")'> <img style='float:left;width:115px;margin:0 5px 10px 0;' src='./images/players/batsmen/"+probablePlayerList[k]+".jpeg' /> </div>");
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
				}
			*/}
		});
		
		
	}	
	else
	    alert("Select a minimum of 7Batsmen, 6Bowlers, 2AllRounders, 2Keepers & 1Coach");
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