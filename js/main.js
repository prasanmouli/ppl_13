
var probablePlayerList = new Array ();
var finalPlayerList = new Array ();
pplProbablePlayerList = "";
pplFinalPlayerList = "";
var balance = 0;
var singlePlayerPrice = 0;



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



//Display Final Squad
function finalListDisplay(pList){
	$.ajax({
		  url: "./pages/finalListInfo.php",
		  type : 'post' ,
		  data : {'list' : pList},		
		  success: function(data) {
			  $("#pool").append(data);
			  $('#stage').append("<strong> SQUAD </strong>");
		  	}
		});
	}

function checkConfirmation(pList){
	$.ajax({
		  url: "./pages/playerList.php",
		  type : 'post' ,
		  data : {'list' : pList},		
		  success: function(data) {
		  	  $("#pool").append(data);
  			  $('#stage').append("Form your squad!");
		  	}
		});
		$.ajax({
				url: "./pages/money.php",
				type: 'post',
				data: {'choice' : 1, 'playerPrice': 0},
				success: function(data){
				$('#balanceMessage').empty();
     		  	$('#balanceMessage').append("<span id='balanceMessage' style='font-family: Segoe UI; color: #17526d; font-size: 12px;'> --IMPORTANT-- <br/> Money will be deducted from your account in this stage. You should strictly adhere to the budget constraints while selecting the players for your squad. (You have ₹70,00,000 for player purchases) </span>");
				$("#balance").empty();
				$("#balance").append("MONEY LEFT: "+"₹"+data);
				}
			});	
	
	}
	
//Display players in the pool	
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


function moneyDisplay(data){
	balance = parseInt(data);	
	$("#balance").empty();
	$("#balance").append("MONEY LEFT: "+"₹"+balance);
}


function moneyBalance(player_id, choice){
		$.ajax({
			url: "./pages/playerPrice.php",
			type: 'post',
			data: {'playerID' : player_id},
			success: function(data){
				console.log(data);
				changeBalance(parseInt(data),choice);
			}
			});	
}

function changeBalance(singlePlayerPrice, ch){			
			$.ajax({
				url: "./pages/money.php",
				type: 'post',
				data: {'choice' : ch, 'playerPrice': singlePlayerPrice},
				success: function(data){
				balance = parseInt(data);
				console.log(balance);
				$("#balance").empty();
				if(balance>=0){
					$("#balance").append("MONEY LEFT: "+"<span style='color: #17526d;'> ₹"+balance+"</span>");
					}
				else{					
					$("#balance").append("MONEY LEFT: "+"<span style='color: #B20000;'> - ₹"+((-1)*balance)+"</span>");					
					}	
				}
				});	
}



function addToList(player_id, name){
	
	if(Math.floor(player_id/100)==1) 
		src = "./images/bat.jpg";
	else if(Math.floor(player_id/100)==4)
		src = "./images/ball.jpg";
		else if(Math.floor(player_id/100)==3)
			src = "./images/all.jpg";
			else if(Math.floor(player_id/100)==5)
				src = "./images/coach.jpg";
			else 
				src = "./images/keeper.jpg";
	
		var tml = "<tr id='tr"+player_id+"'> <td id="+player_id+" class='box2_player' style='display:none;'><img src="+src+" width='18px' style='vertical-align: middle; margin-right:5px; border-radius: 4px;' />"+name+"</td> <td> <a href='javascript:void' onclick=''> <img src='./images/close_popup.png' onclick='removeFromList("+player_id+")' width='10px' style='margin-left:10px' title='Remove'/> </a> </td> <br/> </tr>";
		flag=0;	
$.ajax({
	url: "./pages/checkProbableListConfirmation.php",
	type: "GET",
	success: function(data){

	if(!data){
		
		if(probablePlayerList.length!=0){
			for (m=0; m<probablePlayerList.length; m++)
		  	  if (probablePlayerList[m]==player_id){
				flag = 2;
				break;	
				}
			if(flag!=2){
				flag = 1;
				probablePlayerList[i++] = player_id;			
				}	
		}
		else {
			probablePlayerList[i++] = player_id;	
			flag = 1;
			}
			
		if(flag==1){
			$('#img'+player_id).css({opacity: 0.4});
			$('#selection').append(tml);
			$('#'+player_id).fadeIn('3000', function(){});
			
			$.ajax({
				url: "./pages/playerPrice.php",
				type: 'post',
				data: {'playerID' : player_id},
				success: function(data){
				balance -= parseInt(data);
				$("#balance").empty();
				if(balance>=0){
					$("#balance").append("MONEY LEFT: "+"<span style='color: #17526d;'> ₹"+balance+"</span>");
					}
				else{					
					$("#balance").append("MONEY LEFT: "+"<span style='color: #B20000;'> - ₹"+((-1)*balance)+"</span>");					
					}	
				}
			});	
			
			if(Math.floor(player_id/100)==1){ 
				//batsmen
				numberList[0]++;
				console.log(numberList[0]);
				}
			else if(Math.floor(player_id/100)==4){
				//bowlers
				numberList[1]++;
				console.log(numberList[1]);
				}
				else if(Math.floor(player_id/100)==3){
				//allrounders
				numberList[2]++;
				console.log(numberList[2]);
				}
				else if(Math.floor(player_id/100)==5){
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
			
			$("#currentSelection").empty();			
			currentSelectionMessage = "Total:  "+probablePlayerList.length+" (";
			currentSelectionMessage += numberList[0]+":"+numberList[1]+":"+numberList[2]+":"+numberList[4]+":"+numberList[3];
			currentSelectionMessage += ")";	
			$("#currentSelection").append(currentSelectionMessage);
			
			if (probablePlayerList.length>17){
				console.log("Paoskdlamskldnskldf ,adkjfns");
				document.getElementById('confirmation').disabled = false; 
				document.getElementById('confirmation').style.opacity = "1";
				}
			}
		}
		
		
	else {
		if(finalPlayerList.length!=0){
			for (m=0; m<finalPlayerList.length; m++)
		  	  if (finalPlayerList[m]==player_id){
				flag = 2;
				break;
				}
			if(flag!=2){
				finalPlayerList[i++] = player_id;	
				flag = 1;
				}
		}
		else {
			finalPlayerList[i++] = player_id;	
			flag = 1;
			}
			
		if(flag==1){
				
			$('#img'+player_id).css({opacity: 0.4});
			$('#selection').append(tml);
			$('#'+player_id).fadeIn('3000', function(){});
			
			//moneyBalance(player_id, 1);
			$.ajax({
				url: "./pages/playerPrice.php",
				type: 'post',
				data: {'playerID' : player_id},
				success: function(data){
				balance -= parseInt(data);
				$("#balance").empty();
				if(balance>=0){
					$("#balance").append("MONEY LEFT: "+"<span style='color: #17526d;'> ₹"+balance+"</span>");
					}
				else{					
					$("#balance").append("MONEY LEFT: "+"<span style='color: #B20000;'> - ₹"+((-1)*balance)+"</span>");					
					}	
				}
			});	
					
			if(Math.floor(player_id/100)==1){ 
				//batsmen
				finalNumberList[0]++;
				console.log(finalNumberList[0]);
				}
			else if(Math.floor(player_id/100)==4){
				//bowlers
				finalNumberList[1]++;
				console.log(finalNumberList[1]);
				}
				else if(Math.floor(player_id/100)==3){
				//allrounders
				finalNumberList[2]++;
				console.log(finalNumberList[2]);
				}
				else if(Math.floor(player_id/100)==5){
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
			
			$("#currentSelection").empty();			
			currentSelectionMessage = "Total:  "+finalPlayerList.length+" (";
			currentSelectionMessage += finalNumberList[0]+":"+finalNumberList[1]+":"+finalNumberList[2]+":"+finalNumberList[4]+":"+finalNumberList[3];
			currentSelectionMessage += ")";	
			$("#currentSelection").append(currentSelectionMessage);
			
			if (finalPlayerList.length>17){
				console.log("Paoskdlamskldnskldf ,adkjfns");
				document.getElementById('confirmation').disabled = false; 
				document.getElementById('confirmation').style.opacity = "1";
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
		//$('#tr'+player_id).fadeOut('3000', function(){});
		$('#tr'+player_id).remove();
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
			$.ajax({
				url: "./pages/playerPrice.php",
				type: 'post',
				data: {'playerID' : player_id},
				success: function(data){
				balance += parseInt(data);
				$("#balance").empty();
				if(balance>=0){
					$("#balance").append("MONEY LEFT: "+"<span style='color: #17526d;'> ₹"+balance+"</span>");
					}
				else{					
					$("#balance").append("MONEY LEFT: "+"<span style='color: #B20000;'> - ₹"+((-1)*balance)+"</span>");					
					}
				}
			});	
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
			
			$("#currentSelection").empty();			
			currentSelectionMessage = "Total:  "+probablePlayerList.length+" (";
			currentSelectionMessage += numberList[0]+":"+numberList[1]+":"+numberList[2]+":"+numberList[4]+":"+numberList[3];
			currentSelectionMessage += ")";	
			$("#currentSelection").append(currentSelectionMessage);
			
			if (probablePlayerList.length<18){
				document.getElementById('confirmation').disabled = true; 
				document.getElementById('confirmation').style.opacity = "0.5";
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
			
			//moneyBalance(player_id, 2);
			$.ajax({
				url: "./pages/playerPrice.php",
				type: 'post',
				data: {'playerID' : player_id},
				success: function(data){
				balance += parseInt(data);
				$("#balance").empty();
				if(balance>=0){
					$("#balance").append("MONEY LEFT: "+"<span style='color: #17526d;'> ₹"+balance+"</span>");
					}
				else{					
					$("#balance").append("MONEY LEFT: "+"<span style='color: #B20000;'> - ₹"+((-1)*balance)+"</span>");					
					}
				}
			});			
			
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
			
			$("#currentSelection").empty();			
			currentSelectionMessage = "Total:  "+finalPlayerList.length+" (";
			currentSelectionMessage += finalNumberList[0]+":"+finalNumberList[1]+":"+finalNumberList[2]+":"+finalNumberList[4]+":"+finalNumberList[3];
			currentSelectionMessage += ")";	
			$("#currentSelection").append(currentSelectionMessage);
			
			if (finalPlayerList.length<18){
				document.getElementById('confirmation').disabled = true; 
				document.getElementById('confirmation').style.opacity = "0.5";
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

function onPreConfirmation(){
	$.ajax({
		success: function(){
		$("#message").empty();	
		$("#message").append("Are you sure you want to confirm? <button onclick='onConfirmation()'>Y</button> <button onclick='onDenial()'>N</button>");
		}
	});
	}

function onDenial(){
	$.ajax({
		success: function(){
		$("#message").empty();
		}
	});	
	}

function onConfirmation(){
	var d=0;
	
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
	console.log(d);					
	
	/*$.ajax({
		url: "./pages/checkDuplicate.php",
		type : 'post' ,
		data : {'list' : probablePlayerList},
		success: function(data){
		  if(data)
		  	d=1;
		}
		});				
	*/
	
	if(d==0){
		//alert("Success");
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
	else{
		$("#message").empty();
		$("#message").append("<span style='color: #B20000; font-size: 12px;'>Select a minimum of 7 Batsmen, 6 Bowlers, 2 AllRounders, 2 Keepers & 1 Coach.</span>");
	}
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
							else if(balance<0){
								console.log("You don't have enough money!");
								d=2;	
							}
	/*for (q=0; q<finalPlayerList.length-1; q++){
		for (w=q; q<finalPlayerList.length; w++){
			if(finalPlayerList[q]==finalPlayerList[w]){
				d=1;
				finalPlayerList.splice(w,1);
			}
		}
	}		*/	
			
	if(d==0){
		//alert("Success");
		
				
		for (k=0; k<finalPlayerList.length; k++)
			pplFinalPlayerList += finalPlayerList[k] + ";";	
			
		$.ajax({
			url: "./pages/updateFinalPlayerList.php",
			type : 'post' ,
			data : {'list' : pplFinalPlayerList, 'balance': balance},
			success: function(data){
				if(!data)
			    	window.location = "matchday.php";
				else{
					$("#message").empty();
					$("#message").append("<span style='color: #B20000; font-size: 12px;'> Oops! You don't have enough money to continue with this selection! Try Again! </span>");	
				}
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
	else if(d==1){
	    $("#message").empty();
		$("#message").append("<span style='color: #B20000; font-size: 12px;'>Select exactly 7 Batsmen, 6 Bowlers, 2 AllRounders, 2 Keepers & 1 Coach. <br/> The number of players in your squad has to be precisely 18.</span>");
		}
		else{
		$("#message").empty();
		$("#message").append("<span style='color: #B20000; font-size: 12px;'> Oops! You don't have enough money to continue with this selection! Try Again! </span>");	
		}
	
	}

}
	
});


}


function playerInfo(playId) {
                $.ajax({
                    url: './pages/matchDayInfo.php',
                    type: 'POST',
                    data: {'playerid': playId},
                    success: function (data){
					  if(data){	
                        console.log(data);
                        $('#playInfo').empty();
                        $('#playInfo').append(data);
				  		}
                    }
                });
                       //Get the variable's value from a link 
                        var loginBox = '#login-box';

                        //Fade in the Popup
                        $(loginBox).fadeIn(300);

                        //Set the center alignment padding + border see css style
                        var popMargTop = ($(loginBox).height() + 24) / 2;
                        var popMargLeft = ($(loginBox).width() + 24) / 2;

                        $(loginBox).css({
                            'margin-top': -popMargTop,
                            'margin-left': -popMargLeft
                        });

                        $('body').append('<div id="mask"></div>');
                        $('#mask').fadeIn(400);


                    // On clicking the close button or the mask layer the popup is closed
                    $('.close,#mask').click(function () {
                        $('#mask , .login-popup').fadeOut(300, function () {
                            $('#mask').remove();

                        });
                        return false;
					});
}
			
function playerInformation(playId){
$.ajax({
url : './pages/myTeamInfo.php',
type : 'POST',
data : {'playerid' : playId},
success : function(data){
console.log(data);
$('#box1').empty();
$('#box1').append(data);}
});
}			