
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

        .form-container {
            max-width: 800px;
            background-color: #e894ce;
            margin-top: 20px;
            padding: 20px;
            border-radius: 12px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        }

        .form-title {
            font-size: 35px;
            margin-bottom: 15px;
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

        .message {
            text-align: center;
            margin-bottom: 15px;
            font-size: 20px;
            font-weight: bold;
            color: red;
        }

        input, textarea {
            margin-top: 2px;
            padding: 10px;
            width: 100%;
            font-family: cursive;
        }

        label {
            font-size: 20px;
            font-family: cursive;
            color: white;
        }

        .form-section {
            display: flex;
            justify-content: space-between;
            gap: 20px; /* Add space between form sections */
        }

        .form-group {
            width: 48%;
            margin-bottom: 15px; /* Add margin between form fields */
        }

        .register-btn {
            background-color: #af4c90;
            border-color: #af4c90;
            font-family: cursive;
            font-size: 20px;
            color: black;
            border-radius: 5px;
            padding: 10px 16px;
            width: auto; /* Adjust the width */
            cursor: pointer; /* Change cursor on hover */
        }

        .register-btn:hover {
            background-color: #993d7c; /* Change color on hover */
            border-color: #993d7c;
        }

        .form-group .btn {
            width: 150px;
        }
    </style>
</head>
<body>
    <div class="sidebar">
        <h1>Dashboard</h1>
        <a href="stud_fetch.php">Student</a>
        <a href="post_event.php">Post Event</a>
        <a href="event_fetch.php">Current Events</a>
        <a href="pre_event_fetch.php">Previous Events</a>
    </div>

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

    <div class="content">
        <div class="form-container">
            <!-- Display any messages -->
            <?php if (!empty($message)) : ?>
                <div class="message"><?php echo $message; ?></div>
            <?php endif; ?>

            <h2 class="form-title">Post Event</h2>
            <form action="post_event.php" method="POST" enctype="multipart/form-data">
                <div class="form-section">
                    <div class="form-group">
                        <label for="event_photo" class="form-label">Event Photo</label>
                        <input type="file" class="form-control" id="event_photo" name="event_photo" required>
                    </div>
                    <div class="form-group">
                        <label for="event_date" class="form-label">Event Date</label>
                        <input type="date" class="form-control" id="event_date" name="event_date" required>
                    </div>
                </div>
                <div class="form-section">
                    <div class="form-group">
                        <label for="description" class="form-label">Description</label>
                        <textarea id="description" name="description" class="form-control" rows="3" required></textarea>
                    </div>
                    <div class="form-group">
                        <label for="event_time" class="form-label">Event Time</label>
                        <input type="time" class="form-control" id="event_time" name="event_time" required>
                    </div>
                </div>
                <div class="form-group">
                    <label for="title" class="form-label">Title</label>
                    <input type="text" id="title" name="title" class="form-control" required>
                </div>
                <div class="form-group">
                    <label for="venue" class="form-label">Venue</label>
                    <input type="text" id="venue" name="venue" class="form-control" required>
                </div>
                
                <button type="submit" class="btn btn-primary btn-custom w-100" name="post_event">Post Event</button>
            </form>
        </div>
    </div>

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
