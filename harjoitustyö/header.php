<?php
	session_start();
?>
<!DOCTYPE html>
<html>
	<head>
		<meta charset="utf-8">
		<meta name=viewport content="width=device-width, initial-scale=1">
		<link href="stylesheet.css" rel="stylesheet" type="text/css">
		<title></title>
	</head>

	<body>
	<header>
		<nav class="nav-header-main">
			<ul class="header-links">
				<li><a href="index.php">Home</a></li>
				<?php
					if (isset($_SESSION["userID"])) {
						echo '<li><a href="profile.php">Profile</a></li>';
					}
				 ?>
				<li><a href="admin.php">Admin</a></li>
				<li><a href="#">Link4</a></li>
			</ul>
			<div class="login-div">
				<?php
					if (isset($_SESSION["userId"])) {
						echo '<form class="logout-form" action="includes/logout.inc.php" method="post">
							<button type="submit" name="logout-submit">Logout</button>
						</form>';
					}
					else {
						echo '<form action="includes/login.inc.php" method="post">
							<input type="text" name="mailuid" placeholder="Username">
							<input type="password" name="pwd" placeholder="Password">
							<button type="submit" name="login-submit">Login</button>
						</form>
						<a class="login-a" href="signup.php">Signup </a>';
					}
				 ?>
			</div>
		</nav>
	</header>
</html>
