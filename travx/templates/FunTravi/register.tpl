<div id="content">
 <script type="text/javascript">
 var RecaptchaOptions = {
    theme : 'blackglass'
 };
 </script>
	<div class="register">
		<h1>Free Registration to the server</h1><br/>
		<marquee>Hello, I am your guide! Please, do not register multi accounts, we have a system that will ban your both accounts! And please, dont forget to read the rules, before you play! The game is updated every day! Have a nice day and game sir! :))))</marquee>
		<form action="register.php" method="POST">
		{error}{suc}
		<br/><b><font color="red">Alphabetical characters and numbers only!! (Allowed: _ and - simbols.)</font></b><br/>
		<table>
		<tr>
			<td>Username:</td><td><input name="username" value="{username}"></td>
		</tr>
		<tr>
			<td>Password:</td><td><input type="password" name="password" value="{password}"></td>
		</tr>
		<tr>
			<td>Repeat password:</td><td><input type="password" name="repeat_password" value=""></td>
		</tr>
		<tr>
			<td>E-mail (If you forget your password):</td><td><input name="email"></td>
		</tr>
		</table><br/>
		<center>{captcha}</center>
		<br/>
		<center><input type="submit" name="register" value="Register now" style=""></center>
		</form>
		
	</div>
</div>