<?php
session_start();
include 'db_connect.php';

// Check if the admin is logged in
if (!isset($_SESSION['admin_id'])) {
    header("Location: admin.php"); // Redirect to login if not logged in
    exit();
}

$admin_id = $_SESSION['admin_id'];

// Fetch admin details
$sql = "SELECT name, email FROM admin WHERE admin_id = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("i", $admin_id);
$stmt->execute();
$admin_result = $stmt->get_result();
$admin = $admin_result->fetch_assoc();


?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Dashboard</title>
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            background-color: white;
            font-family: cursive;
            display: flex;
            height: 100vh;
            margin: 0;
        }

        .sidebar {
            width: 250px;
            background-color: #af4c90;
            padding: 20px;
            color: white;
            display: flex;
            flex-direction: column;
        }
        .sidebar h1{
            color: white;
            font-weight: bold;
            font-family: Papyrus, fantasy;
        }

        .sidebar a {
            color: white;
            text-decoration: none;
            font-size: 20px;
            margin-bottom: 15px;
            padding: 10px;
            border-radius: 5px;
            display: block;
        }

        .sidebar a:hover {
            background-color: #e894ce;
            color: black;
        }

        .navbar {
            background-color: #af4c90;
            color: white;
            padding: 15px;
            font-size: 20px;
            width: 100%;
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        .navbar .dropdown-toggle {
            color: white;
            font-size: 20px;
            border: none;
            background-color: transparent;
        }
        .dropdown-menu{
            background-color: white;
        }
        .dropdown-menu a:hover{
            background-color: #e894ce;
        }
        .welcome-message {
            font-size: 24px;
        }

        .content {
            flex-grow: 1;
            padding: 20px;
        }
        .container {
            margin-top: 40px;
            align: center;
        }

        .profile-container {
            background-color: #af4c90;
            
            padding: 20px;
            border-radius: 10px;
            margin-right: 800px;
            box-shadow: 0px 4px 8px rgba(0, 0, 0, 0.1);
        }

        .container h2 {
            font-size: 30px;
            color: black;
            margin-bottom: 20px;
            font-weight: bold;
        }

        .profile-info p {
            font-size: 20px;
            color: white;
            margin-bottom: 10px;
        }

        .btn-edit {
            background-color: white;
            border: none;
            font-size: 18px;
            padding: 10px 20px;
            color: #af4c90;
            border-radius: 5px;
        }

        .btn-edit:hover {
            background-color: #e894ce;
            color: black;
        }

    </style>
</head>
<body>
    <!-- Sidebar -->
    <div class="sidebar">
        <h1>Dashboard</h1>
        <a href="stud_fetch.php">Student</a>
        <a href="post_event.php">Post Event</a>
        <a href="event_fetch.php">Current Events</a>
        <a href="pre_event_fetch.php">Previous Events</a>
    </div>

    <!-- Main Content -->
    <div class="content">
        <!-- Navbar -->
        <div class="navbar">
            <div class="welcome-message">Welcome, Admin!</div>
            <div class="dropdown">
                <button class="dropdown-toggle" type="button" id="dropdownMenuButton" data-bs-toggle="dropdown" aria-expanded="false">
                   Admin Profile
                </button>
                <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="dropdownMenuButton">
                    <li><a class="dropdown-item" href="admin_profile.php">Profile</a></li>
                    <li><a class="dropdown-item" href="admin_logout.php">Logout</a></li>
                </ul>
            </div>
        </div>

        <!-- Content Area -->
        <div class="mt-4">
        <div class="container">
            <h2>Profile Details</h2>
            <div class="profile-container">
            <div class="profile-info">
            
                <p><strong>Name:</strong> <?php echo htmlspecialchars($admin['name']); ?></p>
                <p><strong>Email:</strong> <?php echo htmlspecialchars($admin['email']); ?></p>
                <a href="edit_admin_profile.php" class="btn btn-edit">Edit Profile</a>
            </div>
        </div>
        </div>
    </div>

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>


