<?php
session_start();

if (isset($_POST['return-submit'])) {
    require 'dbh.inc.php';
    $return = $_POST['returnId'];

    $sql = "SELECT * FROM devices WHERE ID = ?";
    $stmt = mysqli_stmt_init($conn);
    if (!mysqli_stmt_prepare($stmt, $sql)) {
        header("Location: ../signup.php?error=sqlerror");
        exit();
    }
    else {
        mysqli_stmt_bind_param($stmt, "s", $return);
        mysqli_stmt_execute($stmt);
        mysqli_stmt_store_result($stmt);

        $sql = "UPDATE devices SET `STATUS`= null, `bookerIdDevices` = null WHERE ID = '$return'";
        $stmt = mysqli_stmt_init($conn);
        if ($conn->query($sql) === TRUE) {
            //echo "Record updated successfully";
            header("Location: ../admin.php?successfullyreturned");
            exit();
        } else {
            //echo "Error updating record: " . $conn->error;
            header("Location: ../index.php?sqlerror2");
        }
    }
    mysqli_close($conn);

}

else{
    header("Location: ../index.php");
}
?>
