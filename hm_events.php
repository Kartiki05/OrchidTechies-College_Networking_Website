<?php
session_start();

if (!isset($_SESSION['stud_id'])) {
    header("Location: std_signup.php");
    exit;
}

// Include the database connection
include 'db_connect.php';

// Fetch events ordered by most recent first
$sql = "
SELECT event_id, title, photo, description, event_date, venue, event_time 
FROM events 
ORDER BY event_date DESC
";
$result = $conn->query($sql);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>HomePage</title>
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
       body {
            font-family: cursive;
            background-color: #e894ce;
            margin: 0;
            padding: 0;
        }
        /* Navbar styling */
        .navbar {
            background-color: #af4c90;
            color: white;
            padding: 10px;
            font-size: 20px;
        }
        .navbar-brand {
            color: white;
            font-size: 28px;
            font-weight: bold;
            font-family: Papyrus, fantasy;
        }
        .navbar-nav .nav-link {
            color: white;
            margin-left: 30px;
        }
        .navbar-nav .nav-link.active {
            background-color: #e894ce;
            color: white;
            border-radius: 5px;
        }
        .search-bar {
            width: 300px;
        }
        .search-bar input {
            width: 100%;
            padding: 5px;
            border-radius: 5px;
            border: 1px solid #af4c90;
        }
        .profile-dropdown {
            position: relative;
        }

        .profile-dropdown .btn {
            background-color: white;
            color: black;
            border: none;
        }

        .profile-dropdown .btn:hover {
            background-color: #e894ce;
        }

        .dropdown-menu {
            position: absolute;
            top: 40px;
            right: 0;
            background-color: white;
            border-radius: 5px;
        }

        .dropdown-item {
            color: black;
            padding: 10px;
            border-bottom: 1px solid #af4c90;
        }

        .dropdown-item:hover {
            background-color: #e894ce;
        }

        .dropdown-item:last-child {
            border-bottom: none;
        }
        .card {
            background-color: white;
            color: #af4c90;
            border: none;
            border-radius: 10px;
            margin-bottom: 20px;
            padding: 20px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        }

        .card img {
            width: 70%;
            height: 200px;
            border-radius: 8px;
        }

        .card-title {
            color: #af4c90;
            font-size: 28px;
            font-weight: bold;
            margin-bottom: 15px;
        }
        .card-description{
            font-size: 16px;
            margin-bottom: 8px;
            color: black;
        }
        .card-text {
            font-size: 18px;
            margin-bottom: 8px;
        }
        .register-btn{
            font-size: 23px;
            font-weight: bold;
            color: black;
        }
        .btn-custom {
            background-color: #af4c90;
            color: white;
            border: none;
            font-size: 20px;
            border-radius: 5px;
            padding: 10px 20px;
            margin-right: 1px;
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
    <!-- Navbar -->
    <nav class="navbar navbar-expand-lg">
        <div class="container-fluid">
            <a class="navbar-brand" href="fetch_posts.php">OrchidTechies</a>
            <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                <li class="nav-item">
                    <a class="nav-link" href="fetch_posts.php" id="home-link">Home</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="add_post.php" id="add-post-link">Add Post</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="hm_events.php" id="messages-link">Events</a>
                </li>
            </ul>
            <div class="search-bar me-3">
                <input type="text" placeholder="Search...">
            </div>
            <div class="profile-dropdown">
                <button class="btn dropdown-toggle" type="button" id="dropdownMenuButton" data-bs-toggle="dropdown" aria-expanded="false">
                    User Profile
                </button>
                <ul class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                    <li><a class="dropdown-item" href="stud_profile.php">My Profile</a></li>
                    <li><a class="dropdown-item" href="stud_logout.php">Logout</a></li>
                </ul>
            </div>
        </div>
    </nav>

    <!-- Homepage Content -->
    <div class="container mt-4">
        
       <br>
        <!-- Events Section -->
        <div class="row mt-4">
        <?php if ($result->num_rows > 0): ?>
                <?php while($row = $result->fetch_assoc()): ?>
                    <div class="col-md-4">
                        <div class="card">
                            <h2 class="card-title"><?php echo $row['title']; ?></h2>
                            <img src="<?php echo $row['photo']; ?>" alt="Event Photo">
                            <br>
                            <p class="card-description">
                            <?php echo $row['description']; ?>
                            </p>
                            <p class="card-text">   
                            Date: <?php echo $row['event_date']; ?>
                            <br> 
                            Time: <?php echo $row['event_time']; ?>
                            </p>
                            <p class="register-btn">
                                Register as...
                            </p>
                            <!-- Button container for Volunteer and Participant -->
                            <div class="btn-container">
                                <a href="volunteer.php?event_id=<?php echo $row['event_id']; ?>" class="btn btn-custom">Volunteer</a>
                                <a href="participant.php?event_id=<?php echo $row['event_id']; ?>" class="btn btn-custom">Participant</a>
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
// Close the database connection
$conn->close();
?>
