<?php
session_start();
// Check if the user is logged in
if (!isset($_SESSION['stud_id'])) {
    header("Location: std_signup.php");
    exit;
}

include 'db_connect.php';

if (isset($_POST['post_id'])) {
    $post_id = $_POST['post_id'];

    $sql = "UPDATE posts SET likes = likes + 1 WHERE post_id = $post_id";
    if ($conn->query($sql) === TRUE) {
        $sql = "SELECT likes FROM posts WHERE post_id = $post_id";
        $result = $conn->query($sql);
        if ($result->num_rows > 0) {
            $row = $result->fetch_assoc();
            echo $row['likes']; // Return the updated likes count
        }
    }
}
?>
