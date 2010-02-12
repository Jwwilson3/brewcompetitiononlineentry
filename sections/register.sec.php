<script type="text/javascript">
function AjaxFunction(email)
{
	var httpxml;
		try
		{
		// Firefox, Opera 8.0+, Safari
		httpxml=new XMLHttpRequest();
		}
	catch (e)
		{
		// Internet Explorer
		try
		{
		httpxml=new ActiveXObject("Msxml2.XMLHTTP");
		}
	catch (e)
		{
		try
		{
		httpxml=new ActiveXObject("Microsoft.XMLHTTP");
		}
		catch (e)
		{
		//alert("Your browser does not support AJAX!");
	return false;
	}
	}
}
function stateck()
{
if(httpxml.readyState==4)
{
document.getElementById("msg").innerHTML=httpxml.responseText;

}
}
var url="includes/email.inc.php";
url=url+"?email="+email;
url=url+"&sid="+Math.random();
httpxml.onreadystatechange=stateck;
httpxml.open("GET",url,true);
httpxml.send(null);
}
</script>
<?php if ($action != "add") { ?>
<div id="header">
	<div id="header-inner"><h1>Step 2: Registration</h1></div>
</div>
<?php } if ($msg == "1") { ?>
<div class="error">Sorry, there was a problem with your last login attempt.</div>
p>Have you <a href="index.php?section=register">registered your account</a> yet?</p>
<?php } ?>
<?php if ($msg == "2") { ?>
<div class="error">Sorry, the user name you entered is already in use.</div>
<p>Perhaps you have already created an account? If so, <a href="index.php?section=login">log in here</a>.</p>
<?php } 
if ($msg == "3") { ?>
<div class="error">The user name provided is not a valid email address. Please enter a valid email address.</div>
<?php } ?>
<p>Our competition entry system is completely electronic.<ul>
   	  <li>If you have already registered, <a href="index.php?section=login"> log in here</a>. </li>
    	<li>To enter your brews or indicate that you are willing to judge or steward, you will need to create an account on our system using the fields below.</li>
    	<li>Your email address will be your user name and will be used as a means of information dissemination by the competition staff. Please make sure it is correct. </li>
    	<li>Once you have registered, you'll be stepped through our entry process. </li>
  	    <li>Each brew you enter will automatically be assigned a number  by the system.</li>
	</ul>
    
<?php if ($go == "default") { ?>
<form name="judgeChoice" id="judgeChoice">
<table>
	<tr>
    	<td class="dataLabel">Are you registering as a judge or steward?</td>
    	<td class="data">
       	  <select name="judge_steward" id="judge_steward" onchange="jumpMenu('self',this,0)">
    		<option value=""></option>
    		<option value="index.php?section=register&go=judge">Yes</option>
    		<option value="index.php?section=register&go=entrant">No</option>
		  </select>
  		</td>
        <td class="data" id="inf_email"><span class="required">Required</span></td>
  	</tr>
</table>
</form>
<?php } else { ?>	  
<form action="includes/process.inc.php?action=add&dbTable=users&section=register&go=<?php echo $go; ?>" method="POST" name="form1" id="form1" onSubmit="return CheckRequiredFields()">
<table>
	<tr>
    	<td class="dataLabel">Email Address:</td>
    	<td class="data"><input name="user_name" id="user_name" type="text" class="submit" size="40" onchange="AjaxFunction(this.value);"><div id="msg">Email Format:</div></td>
        <td class="data" id="inf_email"><span class="required">Required</span></td>
  	</tr>
  	<tr>
    	<td class="dataLabel">Password:</td>
    	<td class="data"><input name="password" id="password" type="password" class="submit" size="25"></td>
        <td class="data"><span class="required">Required</span></td>
  	</tr>
<?php if ($section != "admin") { ?>
    <tr>
    	<td class="dataLabel">Security Question:</td>
    	<td class="data" nowrap="nowrap">
        <input type="radio" name="userQuestion" value="What is your favorite all-time beer to drink?" id="userQuestion_0" checked="checked" />What is your favorite all-time beer to drink?<br />
    	    <input type="radio" name="userQuestion" value="What is your mother's maiden name?" id="userQuestion_1" />What is your mother's maiden name?<br />
			<input type="radio" name="userQuestion" value="What was the name of the street you grew up on?" id="userQuestion_2" />What was the name of the street you grew up on?<br />
    	    <input type="radio" name="userQuestion" value="What was your high school's mascot?" id="userQuestion_3" />What was your high school's mascot?<br />
        </td>
      <td class="data">Choose one. This question will be used to verify your identity should you forget your password.</td>
  	</tr>
    <tr>
    	<td class="dataLabel">Security Question Answer:</td>
    	<td class="data"><input name="userQuestionAnswer" type="text" class="submit" size="30"></td>
        <td class="data"><span class="required">Required</span></td>
  	</tr>
<?php } ?>
  	<tr>
    	<td class="dataLabel">&nbsp;</td>
    	<td class="data"><input type="submit" value="Register"></td>
        <td class="data">&nbsp;</td>
  	</tr>
</table>
<input type="hidden" name="userLevel" value="2" />
</form>
<?php } ?>