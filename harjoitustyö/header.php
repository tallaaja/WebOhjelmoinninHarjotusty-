<!DOCTYPE html>
<html>
	<head>
		<meta charset="utf-8">
		<meta name=viewport content="width=device-width, initial-scale=1">
		<title></title>
	</head>
	
	<body>
	<header>
		<nav class="nav-header-main">
			<ul>
				<li><a href="index.php">Home</a></li>
				<li><a href="#">Testi</a></li>
				<li><a href="#">Testi2</a></li>
				<li><a href="#">Testi3</a></li>
			</ul>
			<div class="header-login">
				<form action="includes/login.inc.php" method="post">
					<input type="text" name="mailuid" placeholder="Username">
					<input type="password" name="pwd" placeholder="Password">
					<button type="submit" name="login-submit">Login</button>
				</form>
				<a href="signup.php">Signup </a>
				
				<form action="includes/logout.inc.php" method="post">
					<button type="submit" name="logout-submit">Logout</button>
				</form>
				
			</div>
			
			
		</nav>
	</header>
</html>