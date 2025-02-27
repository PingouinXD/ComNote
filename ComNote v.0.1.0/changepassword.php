<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <title>Change Password - Community Notes</title>
    <link rel="apple-touch-icon" sizes="180x180" href="images/apple-touch-icon.png">
    <link rel="icon" type="image/png" sizes="32x32" href="images/favicon-32x32.png">
    <link rel="icon" type="image/png" sizes="16x16" href="images/favicon-16x16.png">
    <link rel="manifest" href="images/site.webmanifest">
</head>
<body class="bg-light">

<div class="container d-flex justify-content-center align-items-center" style="height: 100vh;">
    <div class="card shadow-lg" style="width: 400px;">
        <div class="card-body">
            <h3 class="card-title text-center mb-4">Change Password</h3>
            
            <!-- Start of Form -->
            <form action="login.php" method="POST">
                
                <!-- Email Input -->
                 <p>Hi, <?php session_start(); echo ($_SESSION['username'])?>!</p>
                <div class="mb-3">
                    <label for="username" class="form-label">Old Password</label>
                    <input type="password" class="form-control" id="oldpass" name="oldpass" required>
                </div>
                
                <!-- Password Input -->
                <div class="mb-3">
                    <label for="password" class="form-label">New Password</label>
                    <input type="password" class="form-control" id="newpass" name="newpass" required>
                </div>
                <div class="mb-3">
                    <label for="password" class="form-label">Confirm New Password</label>
                    <input type="password" class="form-control" id="confnewpass" name="confnewpass" required>
                </div>
                
                <!-- Error Message (if any) -->
                <?php
                if (isset($_GET['error'])) {
                    echo '<div class="alert alert-danger" role="alert">Invalid username or password.</div>';
                }
                ?>

                <!-- Login Button -->
                <div class="d-grid">
                    <button type="submit" class="btn btn-primary">Change Password</button>
                </div>
                <button type="button" id="back"class="btn btn-secondary offset-md-5" style="margin-top: 5px;">Back</button>
                
                <!-- Forgot Password Link -->
                <!-- <div class="mt-3 text-center">
                    Don't have account yet? <a href="\register" class="text-muted">Register now!</a><br>
                    <a href="\register" class="text-muted">Lupa Password?</a>
                </div> -->
            </form>
            <!-- End of Form -->
        </div>
    </div>
</div>

<!-- Bootstrap 5 JS -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
<script>document.getElementById('back').addEventListener('click', function() {
        // Redirect to the desired page
        window.location.href = "\communitynotes";
    });</script>
</body>
</html>