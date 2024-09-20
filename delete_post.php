<?php
include 'db_connect.php';
session_start();
// Check if the user is logged in
if (!isset($_SESSION['stud_id'])) {
    header("Location: std_signup.php");
    exit;
}

if (isset($_GET['post_id'])) {
    $post_id = $_GET['post_id'];

    // Delete post from the database
    $delete_sql = "DELETE FROM posts WHERE post_id = ?";
    $delete_stmt = $conn->prepare($delete_sql);
    $delete_stmt->bind_param("i", $post_id);
    if ($delete_stmt->execute()) {
        header("Location: stud_profile.php"); // Redirect to the profile page
        exit();
    } else {
        echo "Error deleting post.";
    }
    $delete_stmt->close();
}

$conn->close();
?>
