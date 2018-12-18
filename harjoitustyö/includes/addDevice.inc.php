<?php
if (isset($_POST['addDevice-Submit'])) {
	require 'dbh.inc.php';

	$name = $_POST['name'];
	$model = $_POST['model'];
	$brand = $_POST['brand'];
	$desc = $_POST['description'];
  $address = $_POST['address'];
  $owner = $_POST['owner'];
  $category = $_POST['category'];

	$sql = "INSERT INTO devices (nameDevices, modelDevices, brandDevices, descriptionDevices,
  addressDevices, ownerDevices, categoryDevices) VALUES (?,?,?,?,?,?,?)";
	$stmt = mysqli_stmt_init($conn);
  if (!mysqli_stmt_prepare($stmt, $sql)) {
    header("Location: ../admin.php?sqlerror");
    exit();
  }
  else {
	  mysqli_stmt_bind_param($stmt, "sssssss", $name, $model, $brand, $desc, $address, $owner, $category);
	  mysqli_stmt_execute($stmt);
	  header("Location: ../admin.php?success");
	  exit();
  }
  mysqli_stmt_close($stmt);
  mysqli_close($conn);
  }

else {
  header("Location: ../home.php?error");
  exit();
}
?>
