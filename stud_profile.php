<?php
include 'db_connect.php';
session_start();

// Check if the student is logged in
if (!isset($_SESSION['stud_id'])) {
    header('Location: login.php'); // Redirect to login page if not logged in
    exit();
}

// Fetch stud details
$stud_id = $_SESSION['stud_id']; // Assuming stud ID is stored in session
$stud_sql = "SELECT name, email FROM student WHERE stud_id = ?";
$stud_stmt = $conn->prepare($stud_sql);
$stud_stmt->bind_param("i", $stud_id);
$stud_stmt->execute();
$stud_result = $stud_stmt->get_result();
$stud = $stud_result->fetch_assoc();

// Fetch stud posts
$posts_sql = "SELECT post_id, photos, caption FROM posts WHERE stud_id = ?";
$posts_stmt = $conn->prepare($posts_sql);
$posts_stmt->bind_param("i", $stud_id);
$posts_stmt->execute();
$posts_result = $posts_stmt->get_result();
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

        .container {
            margin-top: 40px;
            align: center;
        }

        .profile-container {
            background-color: white;
            
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
            margin-bottom: 10px;
        }

        .btn-edit {
            background-color: #af4c90;
            border: none;
            font-size: 18px;
            padding: 10px 20px;
            color: white;
            border-radius: 5px;
        }

        .btn-edit:hover {
            background-color: #e894ce;
            color: black;
        }

        .posts .card {
            max-width: 300px;
            background-color: white;
            border-radius: 10px;
            overflow: hidden;
            box-shadow: 0px 4px 8px rgba(0, 0, 0, 0.1);
            margin: -5px;
        }
        .posts mt-4 h2{
            color:yellow;
        }
        .posts .card-img-top {
            max-height: 450px;
            object-fit: cover;
        }

        .posts .card-body {
            padding: 10px;
            text-align: center;
        }

        .btn-delete {
            background-color: red;
            color: white;
            margin-top: 10px;
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

    <!-- Profile and Posts Section -->
    <div class="container">
    <h2>Profile Details</h2>
        <div class="profile-container">
            <div class="profile-info">
            
                <p><strong>Name:</strong> <?php echo htmlspecialchars($stud['name']); ?></p>
                <p><strong>Email:</strong> <?php echo htmlspecialchars($stud['email']); ?></p>
                <a href="edit_profile.php" class="btn btn-edit">Edit Profile</a>
            </div>
        </div>

        <div class="posts mt-4">
            
         
            <div class="row">
            <h2>Your Posts</h2>
            
                <?php while ($post = $posts_result->fetch_assoc()): ?>
                    <div class="col-md-4 mb-4">
                        <div class="card">
                            <img src="<?php echo htmlspecialchars($post['photos']); ?>" class="card-img-top" alt="Post Photo">
                            <div class="card-body">
                                <p class="card-text"><?php echo htmlspecialchars($post['caption']); ?></p>
                                <button class="btn btn-danger btn-delete" onclick="confirmDelete(<?php echo $post['post_id']; ?>)">Delete</button>
                            </div>
                        </div>
                    </div>
                <?php endwhile; ?>
            </div>
        </div>
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

        function confirmDelete(postId) {
            if (confirm('Are you sure you want to delete this post?')) {
                window.location.href = 'delete_post.php?post_id=' + postId;
            }
        }
    </script>
</body>
</html>

<?php
$stud_stmt->close();
$posts_stmt->close();
$conn->close();
?>
