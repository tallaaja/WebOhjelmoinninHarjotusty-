<?php
session_start();
?>

<?php


if (isset($_POST['bookthis'])) {
    require 'dbh.inc.php';
    $bookId = $_POST['bookId'];
    $status = $_POST['status'];

    if (isset($_SESSION['userId'])) {
        $userId = $_SESSION['userId'];
    }
    else{
        $userId = "null";
    }

    $sql = "SELECT bookerIdDevices FROM devices WHERE ID =?";
    $stmt = mysqli_stmt_init($conn);
    if (!mysqli_stmt_prepare($stmt, $sql)) {
        header("Location: ../signup.php?error=sqlerror");
        exit();
    }
    else {
        mysqli_stmt_bind_param($stmt, "s", $userId);
        mysqli_stmt_execute($stmt);
        mysqli_stmt_store_result($stmt);

        $sql = "UPDATE devices SET bookerIdDevices = '$userId', STATUS = '$status' WHERE ID = '$bookId'";
        $stmt = mysqli_stmt_init($conn);
        if ($conn->query($sql) === TRUE) {
          $sql = "INSERT INTO history (DeviceId, UserId, Event) VALUES ($bookId, $userId, '$status')";
          $stmt = mysqli_stmt_init($conn);
          if (!mysqli_stmt_prepare($stmt, $sql)) {
            header("Location: ../index.php?sqlerror");
            exit();
          }
          else {
            mysqli_stmt_execute($stmt);
            header("Location: ../index.php?success");
            exit();
          }
            header("Location: ../index.php?successfullybooked");
            exit();
        } else {
            //echo "Error updating record: " . $conn->error;
            header("Location: ../index.php?sqlerror3");
        }
    }
    mysqli_close($conn);

}



?>
