<?php
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
