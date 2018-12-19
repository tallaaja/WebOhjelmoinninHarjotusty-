<?php
session_start();

if (isset($_POST['borrow-submit'])) {
    require 'dbh.inc.php';
    $borrow = $_POST['borrowId'];

    $sql = "SELECT * FROM devices WHERE ID = ?";
    $stmt = mysqli_stmt_init($conn);
    if (!mysqli_stmt_prepare($stmt, $sql)) {
        header("Location: ../signup.php?error=sqlerror");
        exit();
    }
    else {
        mysqli_stmt_bind_param($stmt, "s", $borrow);
        mysqli_stmt_execute($stmt);
        mysqli_stmt_store_result($stmt);

        $sql = "UPDATE devices SET `STATUS`= 'LAINATTU' WHERE ID = '$borrow'";
        $stmt = mysqli_stmt_init($conn);
        if ($conn->query($sql) === TRUE) {
            //echo "Record updated successfully";
            header("Location: ../admin.php?successfullyborrowed");
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
