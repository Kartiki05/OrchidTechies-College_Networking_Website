<?php
session_start();

// Check if the user is logged in
if (!isset($_SESSION['stud_id'])) {
    header("Location: std_signup.php");
    exit;
}

// Include the database connection
include 'db_connect.php';

// Fetch posts along with student information, ordered by most recent first
// Fetch posts along with student information and number of likes
$sql = "
SELECT student.name, posts.photos, posts.caption, posts.likes, posts.post_id 
FROM posts 
INNER JOIN student ON posts.stud_id = student.stud_id
ORDER BY posts.created_at DESC
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
        .post-container {
            background-color: white;
            border-radius: 15px;
            padding: 20px;
            margin-bottom: 20px;
            margin-right: 120px;
            margin-left: 100px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        }
        .post-header {
            display: flex;
            align-items: center;
            margin-bottom: 15px;
        }
        .post-caption {
            margin: 15px 0;
            font-size: 25px;
        }
        .like-button {
            background-color: #af4c90;
            color: white;
            border: none;
            padding: 10px 20px;
            border-radius: 5px;
        }
        .like-button:hover {
            background-color: #e894ce;
        }
        .post-image {
            height: 400;
            width: 50%;
            object-fit: cover;
            border-radius: 2px;
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
        <h1>Welcome to OrchidTechies</h1>
       <br>
        <!-- Posts Section -->
        <?php if ($result->num_rows > 0): ?>
    <?php while($row = $result->fetch_assoc()): ?>
        <div class="post-container">
            <div class="post-header">
                <h3><?php echo $row['name']; ?></h3>
            </div>

            <!-- Display the single image -->
            <img src="<?php echo $row['photos']; ?>" alt="Event Photo" class="post-image">
            <p class="post-caption"><?php echo $row['caption']; ?></p>
            
            <!-- Display likes count -->
            <p id="like-count-<?php echo $row['post_id']; ?>">
                <i class="fas fa-heart" style="color: #af4c90; font-size: 22px"></i> 
                <span id="likes-<?php echo $row['post_id']; ?>"><?php echo $row['likes']; ?> </span>
            </p>
            <!-- Like button -->
            <button class="like-button" onclick="likePost(<?php echo $row['post_id']; ?>)">Like </button>
           
        </div>
    <?php endwhile; ?>
<?php else: ?>
    <p>No posts available.</p>
<?php endif; ?>

    </div>

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script>
function likePost(postId) {
    // Send an AJAX request to the server to update the like count
    var xhr = new XMLHttpRequest();
    xhr.open("POST", "like_post.php", true);
    xhr.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
    xhr.onreadystatechange = function() {
        if (xhr.readyState == 4 && xhr.status == 200) {
            // Update the likes count on the page without reloading
            document.getElementById('like-count-' + postId).innerHTML = "Likes: " + xhr.responseText;
        }
    };
    xhr.send("post_id=" + postId);
}
</script>
<script>
function likePost(postId) {
    var xhttp = new XMLHttpRequest();
    xhttp.onreadystatechange = function() {
        if (this.readyState == 4 && this.status == 200) {
            document.getElementById('likes-' + postId).innerHTML = this.responseText;
        }
    };
    xhttp.open("POST", "likes_icon.php", true);
    xhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
    xhttp.send("post_id=" + postId);
}
</script>



</body>
</html>

<?php
// Close the database connection
$conn->close();
?>
