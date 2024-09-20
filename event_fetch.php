<?php
// Include the database connection code
include 'db_connect.php';
session_start();
// Get today's date
$today = date('Y-m-d');

// Fetch events happening today or in the future
$sql = "SELECT * FROM events WHERE event_date >= '$today' ORDER BY event_date ASC";

$result = $conn->query($sql);
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
        }

        .card {
            background-color: #af4c90;
            color: white;
            border: none;
            border-radius: 10px;
            margin-bottom: 20px;
            
            padding: 20px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        }

        .card img {
            width: 70%;
            height: 180px;
            border-radius: 8px;
           
        }

        .card-title {
            font-size: 28px;
            font-weight: bold;
            margin-bottom: 15px;
        }

        .card-text {
            font-size: 20px;
            margin-bottom: 10px;
        }

        .btn-custom {
            background-color: white;
            color: #af4c90;
            border: none;
            font-size: 16px;
            border-radius: 5px;
            padding: 10px 20px;
            margin-right: 20px;
        }

        .btn-custom:hover {
            background-color: #e894ce;
            color: black;
        }

        .btn-container {
            display: flex;
            justify-content: space-between;
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
        <div class="row mt-4">
            <?php if ($result->num_rows > 0): ?>
                <?php while($row = $result->fetch_assoc()): ?>
                    <div class="col-md-4">
                        <div class="card">
                            <h2 class="card-title"><?php echo $row['title']; ?></h2>
                            <img src="<?php echo $row['photo']; ?>" alt="Event Photo">
                            <p class="card-text">Date: <?php echo $row['event_date']; ?><br> Time: <?php echo $row['event_time']; ?></p>
                            <div class="btn-container">
                            <a href="volun_dash.php?event_id=<?php echo $row['event_id']; ?>" class="btn btn-custom">Volunteers</a>
                                <a href="partici_dash.php?event_id=<?php echo $row['event_id']; ?>" class="btn btn-custom">Participants</a>
                                
                            </div>
                        </div>
                    </div>
                <?php endwhile; ?>
            <?php else: ?>
                <p>No upcoming events.</p>
            <?php endif; ?>
        </div>
    </div>

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>

<?php
// Close database connection
$conn->close();
?>
