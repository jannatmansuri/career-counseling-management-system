<?php

session_start();

if (!isset($_SESSION['admin_id'])) {
    header("Location: /CCMS-WFS/admin/login.php");
    exit;
}

?>