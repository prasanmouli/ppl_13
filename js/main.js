
var probablePlayerList = new Array ();
var i=0;
var numberList = new Array(5);
for(j=0;j<5;j++){
	numberList[j]=0;
console.log(numberList[j]);
}

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
			console.log();
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
		$.ajax({
			success: function() {
			$('#pool').empty();
			$('#pool').append("adasdas");
			}
		});
	}	
	else
	    alert("Select a minimum of 7Batsmen, 6Bowlers, 2AllRounders, 2Keepers & 1Coach");
}