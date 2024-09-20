<?php
include 'db_connect.php';
session_start();
// Check if the user is logged in
if (!isset($_SESSION['stud_id'])) {
    header("Location: std_signup.php");
    exit;
}

$stud_id = $_SESSION['stud_id'];

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $name = $_POST['name'];
    $email = $_POST['email'];

    $update_sql = "UPDATE student SET name = ?, email = ? WHERE stud_id = ?";
    $update_stmt = $conn->prepare($update_sql);
    $update_stmt->bind_param("ssi", $name, $email, $stud_id);
    if ($update_stmt->execute()) {
        header("Location: stud_profile.php"); // Redirect to the profile page
        exit();
    } else {
        echo "Error updating profile.";
    }
    $update_stmt->close();
}

// Fetch current student details
$stud_sql = "SELECT name, email FROM student WHERE stud_id = ?";
$stud_stmt = $conn->prepare($stud_sql);
$stud_stmt->bind_param("i", $stud_id);
$stud_stmt->execute();
$stud_result = $stud_stmt->get_result();
$stud = $stud_result->fetch_assoc();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Profile</title>
    <!-- Bootstrap CSS -->
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
        /* Center container styling */
        .container {
            margin-top: 80px;
            max-width: 400px;
            background-color: white;
            padding: 20px;
            border-radius: 10px;
            box-shadow: 0px 4px 8px rgba(0, 0, 0, 0.1);
        }

        h2 {
            font-size: 30px;
            color: black;
            text-align: center;
        }

        .form-label {
            font-size: 20px;
            color: #af4c90;
        }

        .form-control {
            border-radius: 5px;
            
            border: 1px solid rgba(0, 0, 0, 0.1);
        }

        .btn-primary {
            background-color: #af4c90;
            border: none;
            font-size: 18px;
            padding: 10px 20px;
            color: white;
            border-radius: 5px;
            display: block;
            width: 100%;
            margin-top: 20px;
        }

        .btn-primary:hover {
            background-color: #e894ce;
            color: black;
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

    <!-- Main Container -->
    <div class="container">
        <h2>Edit Profile</h2>
        <form method="post" action="">
            <div class="mb-3">
                <label for="name" class="form-label">Name</label>
                <input type="text" id="name" name="name" class="form-control" value="<?php echo htmlspecialchars($stud['name']); ?>" required>
            </div>
            <div class="mb-3">
                <label for="email" class="form-label">Email</label>
                <input type="email" id="email" name="email" class="form-control" value="<?php echo htmlspecialchars($stud['email']); ?>" required>
            </div>
            <button type="submit" class="btn btn-primary">Save Changes</button>
        </form>
    </div>

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        function setActiveLink(linkId) {
            document.querySelectorAll('.nav-link').forEach(function(link) {
                link.classList.remove('active');
            });
            document.getElementById(linkId).classList.add('active');
        }

        document.getElementById('home-link').addEventListener('click', function() {
            setActiveLink('home-link');
        });

        document.getElementById('add-post-link').addEventListener('click', function() {
            setActiveLink('add-post-link');
        });

        document.getElementById('messages-link').addEventListener('click', function() {
            setActiveLink('messages-link');
        });

        
    </script>
</body>
</html>

<?php
$stud_stmt->close();

$conn->close();
?>

