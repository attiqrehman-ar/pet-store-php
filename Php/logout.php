<?php
session_start(); // Start the session

// Destroy the session
session_destroy();

require './loader.html';
// Redirect to the login page
header("Location: index.php");
exit;
?>
