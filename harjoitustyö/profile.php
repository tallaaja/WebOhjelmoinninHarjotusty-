<?php
include 'header.php';
?>

<?php

require 'includes/dbh.inc.php';
if (isset($_SESSION['userId'])) {
    $userId = $_SESSION['userId'];
}
else{
    $userId = "null";
}

if (filter_var($userId, FILTER_VALIDATE_INT)) {
} else {
    header("Location: ../index.php?error=useridisnotcorrect");
}

$sql = "SELECT idUsers, uidUsers, emailUsers FROM users WHERE idUsers = $userId";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    // output data of each row

    while($row = $result->fetch_assoc()) {
        //echo '<input type="text" name="uidUsers" value="'.$row['uidUsers'].'"><br><br>';
        //echo '<input type="text" name="emailUsers" value="'.$row['emailUsers'].'"><br><br>';
        $username =$row['uidUsers'];
        $email = $row['emailUsers'];
            //echo '<button type="submit" name="update-submit">Change name and/or email</button>';

    }


} else {
    echo "0 results";
    header("Location: ../index.php?error=somethingwentwrong");
}

?>
        <form action="updateinfo.inc.php" method="post">
            <input type="text" name="uidUsers" value="<?= $username?>"><br><br>
            <input type="text" name="emailUsers" value="<?= $email?>"><br><br>
            <button type="submit" name="update-submit">Change name and/or email</button><br><br>
        </form>
        <li><a href="/harjoitustyö/changepassword.php">Change password</a></li>

<?php
    echo '<li><a href="index.php">Back to home</a></li>';
?>
