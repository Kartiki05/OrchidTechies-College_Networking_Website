<?php
session_start();
include 'db_connect.php';

// Check if the admin is logged in
// if (!isset($_SESSION['admin_id'])) {
//     header("Location: admin.php"); // Redirect to login if not logged in
//     exit();
// }
// ?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Dashboard</title>
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
     <!-- FontAwesome CSS -->
     <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" rel="stylesheet">
    
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
        
        .sidebar h1 {
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
        
        .dropdown-menu {
            background-color: white;
        }
        
        .dropdown-menu a:hover {
            background-color: #e894ce;
        }
        
        .welcome-message {
            font-size: 24px;
        }

        .content {
            flex-grow: 1;
            padding: 20px;
            overflow-y: auto;
        }

        .card {
            background-color: #af4c90;
            color: white;
            padding: 20px;
            border-radius: 10px;
            text-align: center;
        }

        .card i {
            font-size: 40px;
            margin-bottom: 10px;
        }

        .card-title {
            font-size: 24px;
            font-weight: bold;
        }

        .card-text {
            font-size: 20px;
        }

        .card-row {
            display: flex;
            justify-content: space-between;
            margin-bottom: 20px;
            margin-top: 50px;
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

        <!-- Cards Section -->
        <div class="card-row">
            <div class="card" style="width: 23%;">
                <i class="fas fa-user-graduate"></i>
                <div class="card-title">Number of Students</div>
                <div class="card-text">500</div>
            </div>
            <div class="card" style="width: 23%;">
                <i class="fas fa-calendar-check"></i>
                <div class="card-title">Events Organized</div>
                <div class="card-text">12</div>
            </div>
            <div class="card" style="width: 23%;">
                <i class="fas fa-users"></i>
                <div class="card-title">Number of Participants</div>
                <div class="card-text">70</div>
            </div>
            <div class="card" style="width: 23%;">
                <i class="fas fa-handshake"></i>
                <div class="card-title">Number of Volunteers</div>
                <div class="card-text">35</div>
            </div>
        </div>

        
    </div>

    <!-- Bootstrap JS and FontAwesome for icons -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://kit.fontawesome.com/a076d05399.js" crossorigin="anonymous"></script>
</body>
</html>
