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
		
        //Get the variable's value from a link 
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
	
	// When clicking on the button close or the mask layer the popup is closed
	$('a.close, #mask').live('click', function() { 
	  $('#mask , .login-popup').fadeOut(300 , function() {
		$('#mask').remove();  
	}); 
	return false;
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
		else{
			$m=1;
		}
	?>
    <tr style="display:
	<?php 
	if($m==1)
		echo "block";
	else 
		echo "none"; 	
	?>"> 
    <td> <a href=""> Register </a> </td>
	<td> <a href="#login-box" class="login-window" id="opener"> Login </a> </td> </tr> 
</table>
</div>
<div align="center">
	<div id="header">
	<img src="./images/ppl13_header2c.png" width="1100px" height="120px"/>
	</div>
	<div class="menu">
	<table>
	<tr>
	<td class="current_page"> <a href=""> Home </a> </td>
	<td style="display:
		<?php 
			if($m==1)
				echo "none";
			else 
				echo "auto"; 
		?>"> <a href="./myteam.php"> my TEAM </a> </td>
	<td style="display:
		<?php 
			if($m==1)
				echo "none";
			else 
				echo "auto"; 
		?>"> <a href=""> my SCORE </a> </td>
	<td> <a href=""> The Guide </a> </td>
	<td> <a href=""> Rules & Regulations </a> </td>
	<td> <a href=""> Contact Us </a> </td>
	</tr>
	</table>
	</div>
	<div id="content">
	<table> 
    <tr> <td id="money"> Prize Money <br/> <img src="./images/prize.jpg" width="200px" /> ₹15,000 </td>
    <td> <p> Ever thought of having Sachin and Gilchrist opening the batting for your team?  Warne and Murali bowling together?  Think you have it in you to be the ultimate strategist? Do you spend your time second guessing coaches and captains? Do you possess the wits  the management skills, and the cricketing knowledge required to emerge victorious in a battle of brains?  If your answer to any of those questions is an affirmative, then Pragyan XII awaits you. 
Come February, and participate in an event bound to capture the imagination of the Cricket fan. Pragyan Premier League offers you a chance to exhibit your knowledge and skills and of course, you get rewarded amply for these!! The Pragyan Premier League(PPL) is a virtual cricket-based management game that tests the strategy skills of the contestants. Build your team and Game On!</p> </td> </tr> 
	</table> 
	<table align="center"> <tr style="display:
		<?php 
		if($m==1)
			echo "auto";
		else 
			echo "none"; 	
		?>"> <td colspan="2" style="text-align:center"> Please <a href="#login-box" class="login-window" id="opener2"> Login </a>to Enter the League!</td> </tr> <tr> <td> For all the latest updates on the PPL Fever follow us at </td> <td>  <a target="_blank" href="http://www.facebook.com/pages/Pragyan-Premier-League/314948425201871"><img id="f_icon" src="./images/f.png" width="20px" /> </a> </td> </tr> 
    </table>
	</div>
</div>

<div id="login-box" class="login-popup">
    <a href="#" class="close"> <img src="./images/close_popup.png" class="btn_close" title="Close Window" alt="Close" /> </a>
          <form method="POST" action="./pages/login.php" class="signin">
                <fieldset class="textbox">
                <label class="title"> Login @ Pragyan</label>
            	<label class="email">
                <span>Email</span>
                <input id="email" name="email" value="" type="text" autocomplete="on">
                </label>
                <label class="password">
                <span>Password</span>
                <input id="password" name="pwd" value="" type="password">
                </label>
                <input type="submit" class="button" value="Sign In"/>
                <p>
                <label class="forgot" > <a href="#">Forgot your password?</a> </label>
                </p>        
                </fieldset>
          </form>
</div>

<div align="center">
Pragyan CSG Team 2012-2013
</div>

</body>
</html>