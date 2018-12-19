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
        <li><a href="changepassword.php">Change password</a></li>

<h2>Your devices</h2>
<?php
if (isset($_SESSION["userId"]))
{
  $sql = "SELECT `ID`, `nameDevices`, `modelDevices`, `brandDevices`, `descriptionDevices`,
   `addressDevices`, `ownerDevices`, `categoryDevices`, `bookerIdDevices`, `STATUS` FROM devices WHERE bookerIdDevices = $userId";
  $result = $conn->query($sql);
  echo '<table>';
  echo '<tr>';
  echo '<th>Name</th>';
  echo '<th>Model</th>';
  echo '<th>Brand</th>';
  echo '<th>Description</th>';
  echo '<th>Address</th>';
  echo '<th>Owner</th>';
  echo '<th>Category</th>';
  echo '<th>Status</th>';
  while ($row = $result ->fetch_assoc()) {
    echo '<tr>';
    echo '<td>'.$row['nameDevices'].'</td>';
    echo '<td>'.$row['modelDevices'].'</td>';
    echo '<td>'.$row['brandDevices'].'</td>';
    echo '<td>'.$row['descriptionDevices'].'</td>';
    echo '<td>'.$row['addressDevices'].'</td>';
    echo '<td>'.$row['ownerDevices'].'</td>';
    echo '<td>'.$row['categoryDevices'].'</td>';
    echo '<td>'.$row['STATUS'].'</td>';

    if($row['STATUS'] == "VARATTU" ){
    echo '<td><form action="includes/deleteBOOK.inc.php" method="post">
        <input type="hidden" name="deleteId" value='.$row['ID'].'>
        <input type="submit" name="deletebook-submit" value="Delete book" />
    </form></td>';
    }
    echo '</tr>';


  }
}
else {
  echo '<p> You dont have any booked devices </p>';
}

?>
