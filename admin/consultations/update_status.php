<?php

include '../../includes/db.php';
include '../auth.php';
if (isset($_GET['id']) && isset($_GET['status'])) {

    $id = intval($_GET['id']);
    $status = $_GET['status'];

    $allowed_status = ['Accepted', 'Rejected'];

    if (in_array($status, $allowed_status)) {

        $stmt = mysqli_prepare(
            $conn,
            "UPDATE consultations SET status=? WHERE id=?"
        );

        mysqli_stmt_bind_param(
            $stmt,
            "si",
            $status,
            $id
        );

        mysqli_stmt_execute($stmt);
    }
}

header("Location: index.php");
exit;

?>