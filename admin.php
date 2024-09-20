


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Signup & Login</title>
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            background-color: #e894ce;
            font-family: cursive;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            margin: 0;
        }

        .form-container {
            width: 400px;
            font-size: 25px;
            background-color: white;
            padding: 20px;
            border-radius: 12px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        }

        .form-title {
            font-size: 35px;
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

        .nav-tabs .nav-link.active {
            background-color: #af4c90;
            color: white;
            border-radius: 15px;
        }

        .nav-tabs .nav-link {
            color: #af4c90;
            font-family: cursive;
            font-size: 20px;
        }

        .message {
            text-align: center;
            margin-bottom: 15px;
            font-size: 20px;
            font-weight: bold;
            color: red;
        }

        input {
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
    <div class="form-container">
        <!-- Display any messages -->
        <?php if (!empty($message)) : ?>
            <div class="message"><?php echo $message; ?></div>
        <?php endif; ?>

        <!-- Nav tabs -->
        <ul class="nav nav-tabs justify-content-center" id="myTab" role="tablist">
            <li class="nav-item" role="presentation">
                <button class="nav-link active" id="signup-tab" data-bs-toggle="tab" data-bs-target="#signup" type="button" role="tab" aria-controls="signup" aria-selected="true">Signup</button>
            </li>
            <li class="nav-item" role="presentation">
                <button class="nav-link" id="login-tab" data-bs-toggle="tab" data-bs-target="#login" type="button" role="tab" aria-controls="login" aria-selected="false">Login</button>
            </li>
        </ul>

        <!-- Tab content -->
        <div class="tab-content" id="myTabContent">
            <!-- Signup Form -->
            <div class="tab-pane fade show active" id="signup" role="tabpanel" aria-labelledby="signup-tab">
                <h2 class="form-title">Admin Signup</h2>
                <form action="admin_back.php" method="POST">
                    <div class="mb-3">
                        <label for="adminName" class="form-label">Admin Name</label>
                        <input type="text" class="form-control" id="adminName" name="name" placeholder="Enter your name" required minlength="3">
                    </div>
                    <div class="mb-3">
                        <label for="adminEmail" class="form-label">College Email</label>
                        <input type="email" class="form-control" id="adminEmail" name="email" placeholder="Enter your college email" required pattern=".+@orchidengg\.ac\.in">
                    </div>
                    <div class="mb-3">
                        <label for="adminPassword" class="form-label">Password</label>
                        <input type="password" class="form-control" id="adminPassword" name="password" placeholder="Enter your password" required minlength="6">
                    </div>
                    <button type="submit" class="btn btn-primary btn-custom w-100" name="signup">Sign Up</button>
                </form>
            </div>

            <!-- Login Form -->
            <div class="tab-pane fade" id="login" role="tabpanel" aria-labelledby="login-tab">
                <h2 class="form-title">Admin Login</h2>
                <form action="admin_back.php" method="POST">
                    <div class="mb-3">
                        <label for="loginEmail" class="form-label">College Email</label>
                        <input type="email" class="form-control" id="loginEmail" name="email" placeholder="Enter your college email" required>
                    </div>
                    <div class="mb-3">
                        <label for="loginPassword" class="form-label">Password</label>
                        <input type="password" class="form-control" id="loginPassword" name="password" placeholder="Enter your password" required minlength="6">
                    </div>
                    <button type="submit" class="btn btn-primary btn-custom w-100" name="login">Login</button>
                </form>
            </div>
        </div>
    </div>

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>
