<?php
include 'header.php';
?>
<main>
  <div class="wrapper-main">
    <section class="section-default">
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
    while($row = $result->fetch_assoc()) {
        $username =$row['uidUsers'];
        $email = $row['emailUsers'];
    }
} else {
    echo "0 results";
    header("Location: ../index.php?error=somethingwentwrong");
}

?>
  <h2>Edit user info</h2>
    <form action="includes/updateinfo.inc.php" method="post">
        <input type="text" name="uidUsers" value="<?= $username?>"><br><br>
        <input type="text" name="emailUsers" value="<?= $email?>"><br><br>
        <button type="submit" name="update-submit">Change name and/or email</button><br><br>
    </form>
    <form action="includes/updateinfo.inc.php" method="post">
      <input type="password" name="oldPwd" placeholder="Your old password"><br><br>
      <input type="password" name="newPwd" placeholder="New password"><br><br>
      <input type="password" name="newPwd2" placeholder="New password again"><br><br>
      <button type="submit" name="password-change">Change password</button><br><br>
    </form>

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
    </section>
    <div>
</main>
