<!DOCTYPE HTML>
<html>
	<head>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />

	<title>登录界面</title>

	<!--- CSS --->
	<link rel="stylesheet" href="css/style.css" type="text/css" />


	<!--- Javascript libraries (jQuery and Selectivizr) used for the custom checkbox --->

	<!--[if (gte IE 6)&(lte IE 8)]>
		<script type="text/javascript" src="js/jquery.min.js"></script>
		<script type="text/javascript" src="js/selectivizr.js"></script>
		<noscript><link rel="stylesheet" href="css/fallback.css" /></noscript>
	<![endif]-->

	</head>

	<body>
		<div id="container">
			<form action="login_ok.php" method="post">
				<div class="login">LOGIN</div>
				<div class="username-text">Username:</div>
				<div class="password-text">Password:</div>
				<div class="username-field">
					<input type="text" name="username"/>
				</div>
				<div class="password-field">
					<input type="password" name="password"/>
				</div>
				<input type="checkbox" name="remember-me" id="remember-me" /><label for="remember-me">慕课系统</label>
				<div class="forgot-usr-pwd"></div>
				<input type="submit" name="submit" value="GO" />
			</form>
		</div>
		<div id="footer">
			慕课系统后台管理</div>
</body>
</html>