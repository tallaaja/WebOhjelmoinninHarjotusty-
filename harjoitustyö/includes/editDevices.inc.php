<?php
if (isset($_POST['editDevice-sumbit'])) {
  require "dbh.inc.php";

  $name =$_POST['nameDevices'];
  $model =$_POST['modelDevices'];
  $desc =$_POST['descriptionDevices'];
  $address =$_POST['addressDevices'];
  $owner =$_POST['ownerDevices'];
  $category =$_POST['categoryDevices'];
  $id =$_POST['idDevices'];
  
  $sql = "SELECT nameDevices, modelDevices, descriptionDevices,addressDevices,ownerDevices, categoryDevices FROM devices WHERE ID =?";
  $stmt = mysqli_stmt_init($conn);
  if (!mysqli_stmt_prepare($stmt, $sql)) {
      header("Location: ../index.php?error=sqlerror");
      echo $id;
      exit();
  }
  else {
      mysqli_stmt_bind_param($stmt, "s", $id);
      mysqli_stmt_execute($stmt);
      mysqli_stmt_store_result($stmt);
      $resultCheck = mysqli_stmt_num_rows($stmt);
      if ($resultCheck < 0 ){
          header("Location: ../signup.php?error=usertaken&mail=".$email);
          exit();		
      }
      else {
            $sql = "UPDATE devices SET nameDevices=?, modelDevices=?, descriptionDevices=?, addressDevices=?, ownerDevices=?,
            categoryDevices=? WHERE ID= '$id'";
            $stmt = mysqli_stmt_init($conn);
            if (!mysqli_stmt_prepare($stmt, $sql)) {
                header("Location: editDevices.inc.php?error=sqlerror");
                echo $id;
                exit();
            }
            else {
                mysqli_stmt_bind_param($stmt, "ssssss", $name,$model,$desc,$address,$owner,$category);
                mysqli_stmt_execute($stmt);
                header("Location: ../admin.php?success");
                exit();
                }
            }
 mysqli_close($conn);
}
}
else {
  header("Location: ../index.php");
    exit();
}

?>
