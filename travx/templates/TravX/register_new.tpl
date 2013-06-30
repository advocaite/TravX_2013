<div id="box1">
<div id="box2">
 <script type="text/javascript">
 var RecaptchaOptions = {
    theme : 'blackglass'
 };
 </script>
 <script>
var timeout;
var i = 0;
var str = 'Hello, I am your guide! This game is running in 100x speed. Please, do not register multi accounts, we have a system that will ban your both accounts! And please, dont forget to read the rules, before you play! Have a nice day and game!';
function add() {
document.getElementById('texty').innerHTML += str.charAt(i);
i = i+1;
if(i == str.length){
clearTimeout(timeout)
}
}
timeout = setInterval('add()', 50);
</script>
		<h1 align="center">Register</h1><br/>
		<div id="texty"></div>
		<noscript><marquee behavior="scroll" direction="left" scrollamount="2">Hello, I am your guide! This game is running in 100x speed. Please, do not register multi accounts, we have a system that will ban your both accounts! And please, dont forget to read the rules, before you play! Have a nice day and game!</marquee></noscript>

		<form action="register.php" method="POST">
		{error}
		<br/>
		<b>NOTE:</b> You can only register with <b>alphabetical</b>(a-z and A-Z) and <b>numbers</b> (0-9) only!!<br/>Ex.: someone<br/><br/>
		<table id="sign_input" cellpadding="1" cellspacing="1" width="50%">
		<tbody>
		<tr class="top">
			<td>Nickname :</td>
			<td><input name="username" value="{username}"></td>
		</tr>
		<tr>
			<td>Password:</td>
			<td><input type="password" name="password" value="{password}"></td>
		</tr>
		<tr>
			<td>Repeat password:</td><td><input type="password" name="repeat_password" value=""></td>
		</tr>
		<tr class="btm">
			<td>E-mail :</td>
			<td><input name="email"></td>
		</tr>
		</table><br/>
		<center>{captcha}</center>
		<br/>
		<center><input type="submit" name="register" value="Register now" style=""></center>
		</form>
</div></div>
		<!-- side nav-->
		
				<div id="boxright1">
		<div class="boxright11">
		<div id="side_info">
		<div class="news">
			<p align="center"><b>In-Game News:</b></p>
			</div>
		</div>
		</div>
		</div>
		</div>
		<!-- footer-->
	</div>
	<script type="text/javascript" src="js/tipbox.js"></script>
	<!-- Footer --></div>
	<div id="footer">
		<div id="mfoot">
			<div class="footer-menu">
<div class="copyright">
					&copy; 2013 
				</div>
			</div>
		</div>
	</div>
</body>
</html>