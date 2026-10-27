<?php

include '../../includes/db.php';
include '../auth.php';
if (!isset($_GET['id']) || !is_numeric($_GET['id'])) {
    die("Invalid expert ID.");
}

$id = (int) $_GET['id'];

$stmt = mysqli_prepare(
    $conn,
    "DELETE FROM experts WHERE id = ?"
);

mysqli_stmt_bind_param($stmt, "i", $id);

mysqli_stmt_execute($stmt);

header("Location: index.php");
exit;

?>