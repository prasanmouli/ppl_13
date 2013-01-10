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
	
	for(i=0; i<5; i++){
		if((list[i])!= ("#"+get))
			$(list[i]).hide();
	}	
}

function addToList(player_id, name){
		var tml = "<div id="+player_id+">"+name+"<a href='javascript:void' onclick=''> <img src='./images/close_popup.png' onclick='removeFromList("+player_id+")' width='10px' style='margin-left:10px' title='Remove'/> </a> </div>";
		$.ajax({
			success: function() {
			$('#selection').append(tml);
			probablePlayerList[i++] = player_id;
			
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
/*
function onConfirmation(){
	var d=0;
	if(numberList[0]<7)
		d=1;
	else if(numberList[1]<6)
			d=1;
		else if(numberList[2]<2)
				d=1;
			else if(numberList[2]<2)
					d=1;
				else 
					d=1;	
	if(d==1)
		alert("osdmfksm!")									
}*/

function removeFromList(player_id){
		$.ajax({
			success: function() {
			$('#'+player_id).remove();
			
			for(k=0; k<probablePlayerList.length; k++){
				if(player_id==probablePlayerList[k]){	
					probablePlayerList.splice(k,1);
					i--;
					break;
					}
				//console.log(probablePlayerList[j]);
			}
			
			if(player_id[0]=='1'){ 
				//batsmen
				numberList[0]--;
				console.log(numberList[0]);
				}
			else if(player_id[0]=='4'){
				//bowlers
				numberList[1]--;
				console.log(numberList[1]);
				}
				else if(player_id[0]=='3'){
				//allrounders
				numberList[2]--;
				console.log(numberList[2]);
				}
				else if(player_id[0]=='5'){
				//coaches
				numberList[3]--;
				console.log(numberList[3]);
				}
				else {
				//keepers
				numberList[4]--;
				console.log(numberList[4]);
				}
			trial ();
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

function trial(){
		console.log(numberList[0]);
	}
	
probablePlayerList = Array ();
var i=0;
numberList = Array();
for(j=0;j<5;j++)
	numberList[j]=0;	
