<?php
session_start();
// Check if the user is logged in
if (!isset($_SESSION['stud_id'])) {
    header("Location: std_signup.php");
    exit;
}

// Include the database connection
include 'db_connect.php';

// Check if post_id is set
if (isset($_POST['post_id'])) {
    $post_id = $_POST['post_id'];

    // Update the likes count in the database
    $sql = "UPDATE posts SET likes = likes + 1 WHERE post_id = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param('i', $post_id);
    $stmt->execute();

    // Fetch the updated likes count
    $sql = "SELECT likes FROM posts WHERE post_id = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param('i', $post_id);
    $stmt->execute();
    $stmt->bind_result($likes);
    $stmt->fetch();

    // Return the updated likes count
    echo $likes;
}

// Close the database connection
$conn->close();
?>
