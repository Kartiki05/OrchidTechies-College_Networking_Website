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

// Process form submission
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (isset($_POST["submit"])) {
        // Collect form data
        $caption = $_POST["caption"];
        $stud_id = $_SESSION['stud_id'];

        // Handle multiple file uploads
        $total_files = count($_FILES['photos']['name']);
        $uploadOk = 1;

        // Loop through each file and insert separately
        for ($i = 0; $i < $total_files; $i++) {
            $target_dir = "uploads_post/";
            $target_file = $target_dir . basename($_FILES["photos"]["name"][$i]);
            $imageFileType = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));

            // Check if file is an actual image
            $check = getimagesize($_FILES["photos"]["tmp_name"][$i]);
            if ($check !== false) {
                // Check file size
                if ($_FILES["photos"]["size"][$i] > 5000000) {
                    $message = "Sorry, one of your files is too large.";
                    $uploadOk = 0;
                    break;
                }

                // Allow certain file formats
                if ($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg" && $imageFileType != "gif") {
                    $message = "Sorry, only JPG, JPEG, PNG & GIF files are allowed.";
                    $uploadOk = 0;
                    break;
                }

                // Try to upload file
                if (move_uploaded_file($_FILES["photos"]["tmp_name"][$i], $target_file)) {
                    // Insert data into MySQL database for each file
                    $sql = "INSERT INTO posts (photos, caption, stud_id) 
                            VALUES ('$target_file', '$caption', '$stud_id')";
                    
                    if ($conn->query($sql) !== TRUE) {
                        $message = "Error: " . $conn->error;
                        $uploadOk = 0;
                        break;
                    }
                } else {
                    $message = "Sorry, there was an error uploading your file.";
                    $uploadOk = 0;
                    break;
                }
            } else {
                $message = "One of the files is not an image.";
                $uploadOk = 0;
                break;
            }
        }

        // If all files were uploaded and inserted successfully
        if ($uploadOk == 1) {
            $message = "Post added successfully!";
        }
    }
}

// Close database connection
$conn->close();


?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add Post</title>
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

        /* Add Post Form Styling */
        .form-container {
            background-color: white;
            padding: 20px;
            border-radius: 12px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            width: 400px;
            margin: 80px auto;
        }

        .form-title {
            font-size: 30px;
            text-align: center;
            margin-bottom: 20px;
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

        .message {
            text-align: center;
            margin-bottom: 5px;
            font-size: 18px;
            font-weight: bold;
            color: red;
        }

        label {
            font-size: 18px;
            font-family: cursive;
            color: #af4c90;
        }

        input[type="text"], textarea {
            width: 100%;
            padding: 10px;
            margin-bottom: 10px;
            font-family: cursive;
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
                    <a class="nav-link active" href="add_post.php" id="add-post-link">Add Post</a>
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

    <!-- Add Post Form -->
    <div class="form-container">
        <!-- Display any messages -->
        <?php if (!empty($message)) : ?>
            <div class="message"><?php echo $message; ?></div>
        <?php endif; ?>

        <h2 class="form-title">Add Post</h2>
        <form action="add_post.php" method="POST" enctype="multipart/form-data">
            <div class="mb-3">
                <label for="photos" class="form-label">Upload Photos</label>
                <input type="file" class="form-control" id="photos" name="photos[]" multiple required>
            </div>
            <div class="mb-3">
                <label for="caption" class="form-label">Write a Caption</label>
                <textarea class="form-control" id="caption" name="caption" rows="3" placeholder="Enter your caption" required></textarea>
            </div>
            <button type="submit" class="btn btn-primary btn-custom w-100" name="submit">Post</button>
        </form>
    </div>

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
