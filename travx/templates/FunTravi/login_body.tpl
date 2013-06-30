<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<link rel="shortcut icon" href="favicon.ico" type="image/x-icon" />
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<meta content="{keywords}" name="keywords">
<meta content="{description}" name="description">
<meta name="vs_targetSchema" content="http://schemas.microsoft.com/intellisense/ie5">
<meta name="vs_defaultClientScript" content="JavaScript">
<link rel="stylesheet" href="css/index.css" type="text/css" />
<script src="js/unx.js" type="text/javascript"></script>
<!--[if lt IE 7]>
<script defer type="text/javascript" src="js/pngfix.js"></script>
<![endif]-->
<script type="text/javascript">
function SetFocus()
{
		document.formular.username.select();
		document.formular.username.focus();
}
</script>
<title>{title}</title>
</head>
<body onLoad="start();SetFocus();">
<div id="header">
	<ul id="nav">
		<li><a href="index.php">HomePage</a></li>
		<li><a href="login.php">Login</a></li>
		<li><a href="register.php">Register</a></li>
		<li><a href="#">Forum</a></li>
	</ul>
</div>
<div id="content">
	<div class="register">
		<h1>Login to Kwantum TravX</h1><br/><br/>
		{active}{error3}<br/>
		<form name="formular" action="login.php{lang_}" method="post">
			<input type="hidden" name="check" value="{code}" />
			<label for="username">{user_name}:</label>
			<input name="username" id="username" type="text" value="{username}" class="input fm fm110 keyboardInput" tabindex="1"/>&nbsp;&nbsp;{error1}<br />
			<label for="password">{pass}:</label>
			<input name="password" type="password" id="password" value="{password}" class="input fm fm110 keyboardInput" tabindex="2"/>&nbsp;&nbsp;{error2}<input type="hidden" name="redirect" value="index.php" /><br />
			<input type="hidden" name="" id="" style="visibility:hidden;"/>
			<input type="submit" value="Login" tabindex="3"/>
        </form>
	</div>
</div>
<div id="footer">	&copy; 2013 <b>Design:</b> Travian 3.8 Unique.</div>
</body>
</html>