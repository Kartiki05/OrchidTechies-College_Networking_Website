<?php
session_start();

// Check if the admin is logged in
if (!isset($_SESSION['stud_id'])) {
    // Redirect to login page
    header("Location: std_signup.php");
    exit();
}
