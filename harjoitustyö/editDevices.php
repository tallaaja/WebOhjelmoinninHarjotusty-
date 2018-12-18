<?php
if (isset($_POST['edit-submit'])) {

require "header.php";
require "includes/dbh.inc.php";
$editId = $_POST['editId'];
$sql = "SELECT * FROM devices WHERE ID = $editId";
$result = $conn->query($sql);
  if ($result->num_rows > 0) {



    while ($row = $result->fetch_assoc()){
      $name =$row['nameDevices'];
      $model =$row['modelDevices'];
      $desc =$row['descriptionDevices'];
      $address =$row['addressDevices'];
      $owner =$row['ownerDevices'];
      $category =$row['categoryDevices'];

      echo '<form class="" action="includes/editDevices.inc.php" method="post">
        Name: <br>
        <input name="nameDevices" type="text" value="'.$name.'"><br>
        Model:<br>
        <input name="modelDevices" type="text" value="'.$model.'"><br>
        Description:<br>
        <input name="descriptionDevices" type="text" value="'.$desc.'"><br>
        address:<br>
        <input name="addressDevices" type="text" value="'.$address.'"><br>
        ownder:<br>
        <input name="ownerDevices" type="text" value="'.$owner.'"><br>
        category:<br>
        <input name="categoryDevices" type="text" value="'.$category.'"><br>
        <input name="idDevices" type="hidden" value="'.$editId.'">
        <button type="button" name="editDevice-sumbit">Edit</button>';



    }
  }
}
else {
header("Location: index.php");
exit();
}


?>
