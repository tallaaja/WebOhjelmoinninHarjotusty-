<?php

if (isset($_POST['login-submit'])) {
	require 'dbh.inc.php';

	$userid = $_POST['mailuid'];
	$password = $_POST['pwd'];

	if(empty($userid) || empty($password)) {
		header("Location: ../index.php?error=emptyfields");
		exit();
	}
	else {
	$sql = "SELECT * FROM users WHERE uidUsers=?";
	$stmt = mysqli_stmt_init($conn);

	if (!mysqli_stmt_prepare($stmt, $sql)) {
		header("Location: ../index.php?error=sqlerror");
		exit();
	}
	else {
		mysqli_stmt_bind_param($stmt, "s", $userid);
		mysqli_stmt_execute($stmt);
		$result = mysqli_stmt_get_result($stmt);
		if ($row = mysqli_fetch_assoc($result)){
			$passwordCheck = password_verify($password, $row['pwdUsers']);
			if ($passwordCheck == false) {
				header("Location: ../index.php?login=false");
				exit();
			}
			elseif ($passwordCheck == true) {
				session_start();
				$_SESSION["userId"] = $row['idUsers'];
				$_SESSION["userID"] = $row['uidUsers'];
				header("Location: ../index.php?login=success");
				exit();

			}
			else {
				header("Location: ../index.php?error=wrongpassword");
				exit();
			}
		}
		else {
			header("Location ../index.php?error=usernotfound");
			exit();
		}
	}

	}
}
else{
	header("Location: ../index.php");
	exit();
}

?>
