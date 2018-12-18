<?php
<<<<<<< HEAD
if (isset($_POST['editDevice-sumbit'])) {
  require "dbh.inc.php";

  $name =$_POST['nameDevices'];
  $model =$_POST['modelDevices'];
  $desc =$_POST['descriptionDevices'];
  $address =$_POST['addressDevices'];
  $owner =$_POST['ownerDevices'];
  $category =$_POST['categoryDevices'];
  $id =$_POST['idDevices'];

$sql = "UPDATE devices SET nameDevices=?, modelDevices=? descriptionDevices=?, addressDevices=?, ownerDevices=?,
 categoryDevices=? WHERE idDevices= '$id'";
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
  header("Location: ../index.php");

}
 ?>
=======
session_start();

if (isset($_POST['delete-submit'])) {
    require 'dbh.inc.php';
    $deleteId = $_POST['deleteId'];

    $sql = "DELETE FROM devices WHERE ID = ?";
    $stmt = mysqli_stmt_init($conn);
    if (!mysqli_stmt_prepare($stmt, $sql)) {
        header("Location: ../signup.php?error=sqlerror");
        exit();
    }
    else {
        mysqli_stmt_bind_param($stmt, "s", $deleteId);
        mysqli_stmt_execute($stmt);
        mysqli_stmt_store_result($stmt);

        $sql = "DELETE FROM devices WHERE ID = '$deleteId'";
        $stmt = mysqli_stmt_init($conn);
        if ($conn->query($sql) === TRUE) {
            //echo "Record updated successfully";
            header("Location: ../admin.php?successfullydeleted");
            exit();
        } else {
            //echo "Error updating record: " . $conn->error;
            header("Location: ../index.php?sqlerror");
        }
    }
    mysqli_close($conn);

}
?>
>>>>>>> 8b197f90702f18d6ebe93b28f78e8924e9cb3a77
