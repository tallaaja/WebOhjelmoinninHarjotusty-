
<?php
if (isset($_POST['update-submit'])) {
    require 'dbh.inc.php';
    $userid = $_SESSION["userId"];

	$username = $_POST['uidUsers'];
	$email = $_POST['emailUsers'];

	if(empty($username) || empty($email)) {
		header("Location: ../signup.php?error=emptyfields&uid=".$username."&mail=".$email);
		exit();
	}
	elseif (!filter_var($email, FILTER_VALIDATE_EMAIL) && !preg_match("/^[a-zA-z0-9]*$/", $username)) {
		header("Location: ../signup.php?error=invalidmailuid");
		exit();
	}
	elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
		header("Location: ../signup.php?error=invalidmail&uid=".$username);
		exit();
	}
	elseif (!preg_match("/^[a-zA-z0-9]*$/", $username)) {
		header("Location: ../signup.php?error=invaliduid&mail=".$email);
		exit();
	}
	else {
        $sql = "SELECT idUsers, uidUsers, emailUsers FROM users WHERE idUsers=?";
		$stmt = mysqli_stmt_init($conn);
		if (!mysqli_stmt_prepare($stmt, $sql)) {
            header("Location: ../signup.php?error=sqlerror");
			exit();
		}
		else {
			mysqli_stmt_bind_param($stmt, "s", $userid);
			mysqli_stmt_execute($stmt);
			mysqli_stmt_store_result($stmt);
			$resultCheck = mysqli_stmt_num_rows($stmt);
			if ($resultCheck < 0 ){
				header("Location: ../signup.php?error=usertaken&mail=".$email);
				exit();
			}
			else {

        $sql = "UPDATE users SET uidUsers=?, emailUsers=? WHERE idUsers= '$userid'";
        if (!mysqli_stmt_prepare($stmt, $sql)) {
          echo '$sql';
        }
        else {
          mysqli_stmt_bind_param($stmt, "ss", $username, $email);
          mysqli_stmt_execute($stmt);
          header("Location: ../profile.php?success");
          exit();
        }

			}
        }
    }
    mysqli_stmt_close($stmt);
    mysqli_close($conn);
}




//salasanan vaihto
else if (isset($_POST['password-change'])) {
require 'dbh.inc.php';


$oldpwd = $_POST['oldPwd'];
$password = $_POST['newPwd'];
$passwordRepeat = $_POST['newPwd2'];


$userId = $_SESSION['userId'];



$sql = "SELECT pwdUsers FROM users WHERE idUsers=$userId";
$stmt = mysqli_stmt_init($conn);
if (!mysqli_stmt_prepare($stmt, $sql)) {
    header("Location: ../profile.php?error=wrongpassword");
    exit();
}
$result = $conn->query($sql);

while($row = $result->fetch_assoc()){
    $hash =$row['pwdUsers'];
}
if (!password_verify($oldpwd, $hash)) {
    echo 'Password is invalid!';
}
else {
    mysqli_stmt_bind_param($stmt, "s", $password);
    mysqli_stmt_execute($stmt);
    mysqli_stmt_store_result($stmt);
    $resultCheck = mysqli_stmt_num_rows($stmt);
    if ($resultCheck < 0 ){
        header("Location: ../index.php?error=usertaken&mail=".$email);
        exit();
    }
    if($password <>$passwordRepeat){
        header("Location: ../index.php?error=passwordsdidnotmatch");
        exit();
    }

    else {
        $sharedPwd = password_hash($password, PASSWORD_DEFAULT);
        $sql = "UPDATE users SET pwdUsers = '$sharedPwd' WHERE idUsers = '$userId'";
        $stmt = mysqli_stmt_init($conn);
        if (!mysqli_stmt_prepare($stmt, $sql)) {
            header("Location: ../signup.php?error=sqlerror");
            exit();
        }
        else {
           // $sharedPwd = password_hash($password, PASSWORD_DEFAULT);

            mysqli_stmt_bind_param($stmt, "s", $sharedPwd);
            mysqli_stmt_execute($stmt);
            header("Location: ../index.php?passwordupdated");
            exit();
        }
    }
}

mysqli_stmt_close($stmt);
mysqli_close($conn);
}



























else {
	header("Location: ../signup.php");
	exit();
}
