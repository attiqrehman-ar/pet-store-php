<?php
session_start();
if (isset($_SESSION["admin"]) || isset($_SESSION["seller"])) {
    header("Location: products.php");
    exit;
} else {
    header("Location: login.php");
    exit;
}
?>
