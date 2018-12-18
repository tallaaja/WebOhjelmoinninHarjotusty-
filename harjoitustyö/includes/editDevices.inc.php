<?php
if (isset($_POST['editDevice-submit'])) {
  require "dbh.inc.php";

  $name =$_POST['nameDevices'];
  $model =$_POST['modelDevices'];
  $desc =$_POST['descriptionDevices'];
  $address =$_POST['addressDevices'];
  $owner =$_POST['ownerDevices'];
  $category =$_POST['categoryDevices'];
  $id =$_POST['idDevices'];

$sql = "UPDATE devices SET nameDevices=?, modelDevices=? descriptionDevices=?, addressDevices=?, ownerDevices=?,
 categoryDevices=? WHERE idDevices=.$id.";
 $stmt = mysqli_stmt_init($conn);
 if (!mysqli_stmt_prepare($stmt, $sql)) {
     header("Location: ../editDevices.php?error=sqlerror");
     exit();
 }
 else {
     mysqli_stmt_bind_param($stmt, "ssssss", $userId,$model,$desc,$addres,$owner,$category);
     mysqli_stmt_execute($stmt);
     header("Location ..admin.php?success");
     exit();
     }
 mysqli_close($conn);
}
else {
  header("Location: ../admin.php?xd");

}

?>
