<?php
// Start the session
session_start();

// Database connection setup
$host = "sql309.infinityfree.com";
$dbname = "if0_38160015_test1";
$dbuser = "if0_38160015";
$dbpassword = "winata14072006";

try {
    $pdo = new PDO("mysql:host=$host;dbname=$dbname", $dbuser, $dbpassword);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    die("Database connection failed: " . $e->getMessage());
}

// Initialize variables for form inputs
$username = $password = $confirmpassword = "";
$usernameErr = $passwordErr = $passwordErr2 = "";

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    // Collect and sanitize form input
    $username = trim($_POST['username']);
    $password = trim($_POST['password']);
    $confirmpassword = trim($_POST['confirmpassword']);

    
    // Validate username (at least 3 characters)
    if (empty($username) || strlen($username) < 3) {
        $usernameErr = "Username must be at least 3 characters.";
    }

    // Validate password
    if (empty($password) || strlen($password) < 8) {
        $passwordErr = "Please enter a valid password.";
    }

    // Validate password (at least 6 characters)
    // if (empty($confirmpassword) || strlen($confirmpassword) < 8) {
    //     $passwordErr = "Password must be at least 6 characters.";
    // }
    $stmts = $pdo->prepare("SELECT acc_usn FROM accounts WHERE acc_usn = ?");
    $stmts->execute([$username]);
    if ($stmts->rowCount() > 0) {
        // Username already exists
        $usernameErr = "Username is already taken.";
    }
    
    // If no errors, hash password and insert into database
    if (empty($usernameErr) && empty($passwordErr)) {
        if($password == $confirmpassword){
        // Hash the password
        $hashedPassword = password_hash($password, PASSWORD_DEFAULT);
        }
        else{
            $passwordErr2 = "Your password not matching";
            header("Location: \register");
        }
        // Insert user into database
        try {
            $stmt = $pdo->prepare("INSERT INTO accounts (acc_usn, acc_pass) VALUES (?, ?)");
            $stmt->execute([$username, $hashedPassword]);
            $_SESSION['user_id'] = $pdo->lastInsertId(); // Store user ID in session
            
                echo ("<script>
                alert('Data berhasil ditambahkan');
                </script>");
            
            header("Location: \login"); // Redirect to dashboard
            exit();
        } 
        catch (PDOException $e) {
            // Handle error if user already exists
            $usernameErr = "Username is already taken.";

            
        }
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <title>Register - Community Notes</title>
    <link rel="apple-touch-icon" sizes="180x180" href="images/apple-touch-icon.png">
    <link rel="icon" type="image/png" sizes="32x32" href="images/favicon-32x32.png">
    <link rel="icon" type="image/png" sizes="16x16" href="images/favicon-16x16.png">
    <link rel="manifest" href="images/site.webmanifest">
</head>
<style>
    body {
        background: linear-gradient(to left, #667eea,rgb(254, 253, 255));
        height: 100vh;
        display: flex;
        align-items: center;
        justify-content: center;
    }
    .card {
        border-radius: 10px;
        box-shadow: 0px 4px 10px rgba(0, 0, 0, 0.1);
    }
    .container-wrapper {
        display: flex;
        align-items: center;
        gap: 100px;
    }
    .logo-container img {
        max-width: 70px;
    }

    @media (max-width: 768px) {
            .container-wrapper {
                flex-direction: column;
                gap: 30px;
            }
        }
</style>
</head>
<body>
<div class="container-wrapper">
    <div class="logo-container text-center">
        <img src="images/android-chrome-192x192.png" alt="Community Notes Logo">
        <h3 class="text-white">Community Notes</h3>
    </div>
    <div class="card p-4" style="width: 400px;">
        <div class="card-body">
            <h3 class="card-title text-center mb-4">Register</h3>
            <form action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>" method="POST">
                <div class="mb-3">
                    <label for="username" class="form-label">Username</label>
                    <input type="text" class="form-control" id="username" name="username" value="<?php echo $username; ?>" required>
                    <small class="text-danger"><?php echo $usernameErr; ?></small>
                </div>
                <div class="mb-3">
                    <label for="email" class="form-label">Email</label>
                    <input type="email" class="form-control" id="email" name="email" value="<?php echo $email; ?>" required>
                    <small class="text-danger"><?php echo $emailErr; ?></small>
                </div>
                <div class="mb-3">
                    <label for="password" class="form-label">Password</label>
                    <input type="password" class="form-control" id="password" name="password" required>
                    <small class="text-danger"><?php echo $passwordErr; ?></small>
                </div>
                <div class="mb-3">
                    <label for="confirmpassword" class="form-label">Confirm Password</label>
                    <input type="password" class="form-control" id="confirmpassword" name="confirmpassword" required>
                </div>
                <div class="d-grid">
                    <button type="submit" class="btn btn-primary">Register</button>
                </div>
                <div class="mt-3 text-center">
                    <p>Already have an account? <a href="login.php" class="text-muted">Login here</a></p>
                </div>
            </form>
        </div>
    </div>
</div>
</body>

            <!-- End of Form -->
        </div>
    </div>
</div>

<!-- Bootstrap 5 JS -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
