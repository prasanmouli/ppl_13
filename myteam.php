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
<script type="text/javascript" src="http://code.jquery.com/jquery-1.6.4.min.js"></script>
<script>
/*Login Modal*/
$(document).ready(function() {
	$('a.login-window').click(function() {
		
        //Getting the variable's value from a link 
		var loginBox = $(this).attr('href');

		//Fade in the Popup
		$(loginBox).fadeIn(300);
		
		//Set the center alignment padding + border see css style
		var popMargTop = ($(loginBox).height() + 24) / 2; 
		var popMargLeft = ($(loginBox).width() + 24) / 2; 
		
		$(loginBox).css({ 
			'margin-top' : -popMargTop,
			'margin-left' : -popMargLeft
		});
		
		// Add the mask to body
		$('body').append('<div id="mask"></div>');
		$('#mask').fadeIn(300);
		
		return false;
	});
	
	// When clicking on the button close or the mask layer the popup closed
	$('a.close, #mask').live('click', function() { 
	  $('#mask , .login-popup').fadeOut(300 , function() {
		$('#mask').remove();  
	}); 
	return false;
	});
});
</script>

<link rel="stylesheet" href="http://code.jquery.com/ui/1.9.2/themes/base/jquery-ui.css" />
<script src="http://code.jquery.com/jquery-1.8.3.js"></script>
<script src="http://code.jquery.com/ui/1.9.2/jquery-ui.js"></script>
<link rel="stylesheet" href="/resources/demos/style.css" />
<style>
	#draggable { width: 100px; height: 100px; padding: 0.5em; float: left; margin: 10px 10px 10px 0; }
    #droppable { width: 150px; height: 150px; padding: 0.5em; float: left; margin: 10px; }
</style>
<script>
   $(function() {
      $( "#draggable" ).draggable();
      $( "#droppable" ).droppable({
          drop: function( event, ui ) {
              $( this )
                  .addClass( "ui-state-highlight" )
                  .find( "p" )
                      .html( "Dropped!" );
          }
      });
  });
</script>
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

	<div id="content">
	<div id="box1"  style="width: 160px; height:350px;float: left">
		<table class="team_select" style="padding: 40px 20px 50px 10px;">
		<tr> <td> <button> Batsmen </button> </td> </tr>
		<tr> <td> <button> Bowlers </button> </td> </tr>
		<tr> <td> <button> All-Rounders </button> </td> </tr>
		<tr> <td> <button> Keepers </button> </td> </tr>
		<tr> <td> <button> Coaches </button> </td> </tr>
		</table>
	</div>
	<div id="box2" style="float:left; margin-left: 10px; width: 500px; height: 350px; border: 1px solid black">
		<div id="draggable" class="ui-widget-content"> </div>
	</div>

	<div id="droppable" class="ui-widget-header" style="float:left; overflow: scroll; margin-left: 30px; width: 200px; height: 350px; border: 1px solid black">
	</div>

</div>

<div align="center">
Pragyan CSG Team 2012-2013
</div>
</body>

</html>
