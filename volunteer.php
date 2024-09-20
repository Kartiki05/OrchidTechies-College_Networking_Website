<?php
// Start a session
session_start();
// Check if the user is logged in
if (!isset($_SESSION['stud_id'])) {
    header("Location: std_signup.php");
    exit;
}

// Include the database connection code
include 'db_connect.php';

// Initialize an empty message variable
$message = "";

// Fetch the event_id from the URL
if (isset($_GET['event_id'])) {
    $event_id = $_GET['event_id'];
} else {
    // Redirect if no event_id is provided
    exit();
}

// Process form submission
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Volunteer submit
    if (isset($_POST["submit"])) {
        // Collect form data
        $name = $_POST["name"];
        $mobile = $_POST["mobile"];
        $class = $_POST["class"];
        $department = $_POST["department"];
        $event_id = $_POST["event_id"]; // Get event ID from input field
    
        // Insert data into MySQL database, including event_id
        $sql = "INSERT INTO volunteer (name, mobile, class, department, event_id) 
                VALUES ('$name', '$mobile', '$class', '$department', '$event_id')";
        if ($conn->query($sql) === TRUE) {
            $message = "Volunteer registered successfully!";
        } else {
            $message = "Error: " . $conn->error;
        }
    }
}

// Close the database connection
$conn->close();
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Volunteer Form</title>
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
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

        .form-container {
            width: 400px;
            font-size: 20px;
            background-color: white;
            padding: 20px;
            border-radius: 12px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            margin: 50px auto;
        }

        .form-title {
            font-size: 30px;
            margin-bottom: 20px;
            text-align: center;
            color: black;
        }

        .btn-custom {
            background-color: #af4c90;
            border-color: #af4c90;
            font-family: cursive;
            font-size: 25px;
            color: black;
            border-radius: 5px;
            margin-top: 20px;
        }

        .btn-custom:hover {
            background-color: #af4c90;
            border-color: #af4c90;
        }

        .form-footer {
            text-align: center;
            margin-top: 25px;
        }

        .message {
            text-align: center;
            margin-bottom: 5px;
            font-size: 18px;
            font-weight: bold;
            color: red;
        }

        input, select {
            margin-top: 0px;
            padding: 10px;
            width: 95%;
            font-family: cursive;
        }

        label {
            font-size: 18px;
            font-family: cursive;
            color: #af4c90;
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
                    <a class="nav-link" href="hm_events.php" id="events-link">Events</a>
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

    <!-- Volunteer Form -->
    <div class="form-container">
        <!-- Display any messages -->
        <?php if (!empty($message)) : ?>
            <div class="message"><?php echo $message; ?></div>
        <?php endif; ?>

        <h2 class="form-title">Volunteer Form</h2>
        <form action="volunteer.php?event_id=<?php echo $event_id; ?>" method="POST">

            <!-- Display event_id in a read-only field -->
            <div class="mb-3">
                <label for="eventId" class="form-label">Event ID</label>
                <input type="text" class="form-control" id="eventId" name="event_id" value="<?php echo $event_id; ?>" readonly>
            </div>

            <div class="mb-3">
                <label for="volunteerName" class="form-label">Name</label>
                <input type="text" class="form-control" id="volunteerName" name="name" placeholder="Enter your name" required minlength="3">
            </div>
            <div class="mb-3">
                <label for="volunteerMobile" class="form-label">Mobile Number</label>
                <input type="text" class="form-control" id="volunteerMobile" name="mobile" placeholder="Enter your mobile number" required minlength="10" maxlength="10" pattern="\d{10}">
            </div>
            <div class="mb-3">
                <label for="volunteerClass" class="form-label">Class</label>
                <select class="form-control" id="volunteerClass" name="class" required>
                    <option value="" disabled selected>Select your class</option>
                    <option value="1st Year">1st Year</option>
                    <option value="2nd Year">2nd Year</option>
                    <option value="3rd Year">3rd Year</option>
                    <option value="4th Year">4th Year</option>
                </select>
            </div>

            <div class="mb-3">
                <label for="volunteerDepartment" class="form-label">Department</label>
                <select class="form-control" id="volunteerDepartment" name="department" required>
                    <option value="" disabled selected>Select your Department</option>
                    <option value="cse">Computer Science Engineering</option>
                    <option value="aids">Artificial Intelligence & Data Science</option>
                    <option value="entc">Electronics and Telecommunication Engineering</option>
                    <option value="electrical">Electrical Engineering</option>
                    <option value="mech">Mechanical Engineering</option>
                    <option value="civil">Civil Engineering</option>
                </select>
            </div>

            <button type="submit" class="btn btn-primary btn-custom w-100" name="submit">Submit</button>
        </form>
    </div>

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>
