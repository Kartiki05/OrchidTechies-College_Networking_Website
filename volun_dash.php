<?php

include 'db_connect.php';
session_start();
//Get the event_id from the URL or form input
if (isset($_GET['event_id'])) {
    $event_id = $_GET['event_id'];
} else {
    die("Error: event_id is not set.");
}

// Fetch volunteers for the given event
$volunteer_sql = "SELECT name, mobile, class, department FROM volunteer WHERE event_id = ?";
$volunteer_stmt = $conn->prepare($volunteer_sql);
$volunteer_stmt->bind_param("i", $event_id);
$volunteer_stmt->execute();
$volunteer_result = $volunteer_stmt->get_result();

// Fetch event list (if needed elsewhere on the page)
$event_sql = "SELECT event_id, title FROM events";
$event_result = $conn->query($event_sql);

?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Post Event</title>
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            background-color: white;
            font-family: cursive;
            display: flex;
            height: 100vh;
            margin: 0;
            flex-direction: column;
        }

        .sidebar {
            width: 250px;
            background-color: #af4c90;
            padding: 20px;
            color: white;
            display: flex;
            flex-direction: column;
            position: fixed;
            top: 0;
            bottom: 0;
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
            width: calc(100% - 280px); /* Adjust width to account for sidebar */
            display: flex;
            justify-content: space-between;
            align-items: center;
            position: fixed;
            top: 20px;
           
            left: 270px; /* Adjust to match the sidebar width */
            z-index: 1000;
            height: 65px;
        }

        .navbar .dropdown-toggle {
            color: white;
            font-size: 20px;
            border: none;
            background-color: transparent;
        }

        .dropdown-menu {
            background-color: white;
            color: black;
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
            display: flex;
            justify-content: center;
            align-items: center;
            margin-top: 65px;
            margin-left: 250px; /* Adjust to match the sidebar width */
        }
        .container {
            margin-top: 110px;
        }

        .table-container {
            background-color: #e894ce;
            padding: 20px;
            margin-left: 200px;
            border-radius: 12px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        }

        .table-container h2 {
            text-align: center;
            color: black;
            font-size: 35px;
            
            margin-bottom: 15px;
        }

        table {
            width: 100%;
            background-color: white;
        }

        th, td {
            padding: 15px;
            text-align: center;
            font-family: cursive;
        }

        th {
            background-color: #af4c90;
            color: white;
        }

        td {
            color: black;
        }
</style>
</head>
<body>
    <div class="sidebar">
        <h1>Dashboard</h1>
        <a href="#">Student</a>
        <a href="post_event.php">Post Event</a>
        <a href="event_fetch.php">Current Events</a>
        <a href="pre_event_fetch.php">Previous Events</a>
    </div>

    <div class="navbar">
        <div class="welcome-message">Welcome to Admin Dashboard</div>
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
    <div class="container">
        <div class="table-container">
            <h2>Volunteers List</h2>
            <table class="table table-striped">
                <thead>
                    <tr>
                        <th>Name</th>
                        <th>Mobile Number</th>
                        <th>Class</th>
                        <th>Department</th>
                    </tr>
                </thead>
                <tbody>
                    <?php while($row = $volunteer_result->fetch_assoc()): ?>
                        <tr>
                            <td><?php echo $row['name']; ?></td>
                            <td><?php echo $row['mobile']; ?></td>
                            <td><?php echo $row['class']; ?></td>
                            <td><?php echo $row['department']; ?></td>
                        </tr>
                    <?php endwhile; ?>
                </tbody>
            </table>
        </div>
    </div>
    <!-- Bootstrap JS and Popper.js -->
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.7/dist/umd/popper.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

</body>
</html>

<?php
$volunteer_stmt->close();
$conn->close();
?>