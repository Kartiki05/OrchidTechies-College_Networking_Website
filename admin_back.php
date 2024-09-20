<?php
// Start a session
session_start();

// Include the database connection code
include 'db_connect.php';

// Initialize an empty message variable
$message = "";

// Process form submission
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Sign-up
    if (isset($_POST["signup"])) {
        // Collect form data
        $name = $_POST["name"];
        $email = $_POST["email"];
        $password = $_POST["password"];

        // Validate email domain
        if (strpos($email, '@orchidengg.ac.in') === false) {
            $message = "Email not valid";
        } else {
            // Insert data into MySQL database
            $sql = "INSERT INTO admin (name, email, password) VALUES ('$name', '$email', '$password')";
            if ($conn->query($sql) === TRUE) {
                $message = "Signup successful!";
            } else {
                $message = "Error: " . $conn->error;
            }
        }
    }
    // Login
elseif (isset($_POST["login"])) {
    $email = $_POST["email"];
    $password = $_POST["password"];

    // Retrieve admin data from the database
    $sql = "SELECT admin_id, email FROM admin WHERE email='$email' AND password='$password'";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        // Fetch admin data
        $admin = $result->fetch_assoc();

        // Set session variables
        $_SESSION['admin_id'] = $admin['admin_id'];
        $_SESSION['email'] = $admin['email'];

        // Redirect to admin dashboard
        echo "<script>alert('Login successful!');window.location.href='admin_dashboard.php';</script>";
    } else {
        // Login failed
        $message = "Incorrect email or password";
    }
}

}

// Close the database connection
$conn->close();
?>