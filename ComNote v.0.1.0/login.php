
<?php 
if (isset($_POST['action']) && $_POST['action'] === 'guest') {
    if (!isset($_COOKIE['guest_id'])) {
        $guest_id = uniqid('guest_'); // Buat ID unik
        setcookie("guest_id", $guest_id, time() + (7 * 24 * 60 * 60), "/"); // Cookie bertahan 7 hari
        setcookie("firsttime", "1", time() + (86400 * 30), "/", "");
        setcookie("Technology", "0", time() + (86400 * 30), "/", "");
        setcookie("Science", "0", time() + (86400 * 30), "/", "");
        setcookie("Politic", "0", time() + (86400 * 30), "/", "");
        setcookie("Entertainment", "0", time() + (86400 * 30), "/", "");
    } else {
        $guest_id = $_COOKIE['guest_id'];
        setcookie("firsttime", "1", time() + (86400 * 30), "/", "");

    }
}

?><!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <title>Login - Community Notes</title>
    <link rel="apple-touch-icon" sizes="180x180" href="images/apple-touch-icon.png">
    <link rel="icon" type="image/png" sizes="32x32" href="images/favicon-32x32.png">
    <link rel="icon" type="image/png" sizes="16x16" href="images/favicon-16x16.png">
    <link rel="manifest" href="images/site.webmanifest">
</head>
<body class="bg-light">
<style>
        body {
            background: linear-gradient(to left, #667eea,rgb(254, 253, 255));
            height: 100vh;
            display: flex;
            justify-content: center;
            align-items: center;
        }
        @keyframes fadeIn {
            from { opacity: 0; transform: translateY(-20px); }
            to { opacity: 1; transform: translateY(0); }
        }
        .btn-primary {
            background-color: #4c51bf;
            border: none;
            transition: 0.3s;
        }
        .btn-primary:hover {
            background-color: #6b46c1;
        }
    </style>

<div class="container d-flex justify-content-center align-items-center" style="height: 100vh;">
    <div class="card shadow-lg" style="width: 400px;">
        <div class="card-body">
            <h3 class="card-title text-center mb-4">Login</h3>
            
            <!-- Start of Form -->
            <form action="login.php" method="POST">
                
                <!-- Email Input -->
                <div class="mb-3">
                    <label for="username" class="form-label">Username</label>
                    <input type="text" class="form-control" id="username" name="username" required>
                </div>
                
                <!-- Password Input -->
                <div class="mb-3">
                    <label for="password" class="form-label">Password</label>
                    <input type="password" class="form-control" id="password" name="password" required>
                </div>
                
                <!-- Error Message (if any) -->
                <?php
                if (isset($_GET['error'])) {
                    echo '<div class="alert alert-danger" role="alert">Invalid username or password.</div>';
                }
                ?>

                <!-- Login Button -->
                <div class="d-grid">
                    <button type="submit" class="btn btn-primary">Login</button>
                </div>
                
                <!-- Forgot Password Link -->
                <div class="mt-3 text-center">
                    Don't have account yet? <a href="\register" class="text-muted">Register now!</a><br>
                </div>
                <div class="mt-3 text-center">
                    <a href="" id="guest" class="text-muted">Login as Guest</a><br>
                </div>
            </form>
            <!-- End of Form -->
        </div>
    </div>
</div>

<!-- Bootstrap 5 JS -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
<script>
document.getElementById("guest").addEventListener("click", function() {
    event.preventDefault();
    // alert("Button clicked!");
    var xhr = new XMLHttpRequest();
    xhr.open("POST", "", true);
    xhr.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");

    xhr.onreadystatechange = function() {
        if (xhr.readyState === 4 && xhr.status === 200) {
            // console.log("Response from server:", xhr.responseText);
            // document.cookie = "GuestMode=1; max-age=86400; path=/";

            window.location.href = '\communitynotes';
       } else {
           console.error("Error:", xhr.status, xhr.statusText);
       }
        
    };
    xhr.onerror = function () {
       console.error("Request failed.");
   };

    xhr.send("action=guest");
});
</script>
</body>
</html>
<?php
session_start();
$host = "sql309.infinityfree.com";
$dbname = "if0_38160015_test1";
$username = "if0_38160015";
$password = "winata14072006";

try {
    $pdo = new PDO("mysql:host=$host;dbname=$dbname", $username, $password);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    die("Database connection failed: " . $e->getMessage());
}
if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $username = $_POST['username'];
    $password = $_POST['password'];

    // Query to fetch user from database
    $stmt = $pdo->prepare("SELECT acc_usn, acc_pass FROM accounts WHERE acc_usn = ?");
    $stmt->execute([$username]);
    $user = $stmt->fetch(PDO::FETCH_ASSOC);

    if ($user && password_verify($password, $user['acc_pass'])) {
        // Set user session
        $_SESSION['username'] = $user['acc_usn'];
        setcookie("firsttime", "1", time() + (86400 * 30), "/", "");
        setcookie('username', $username, time() + 60, "/");
        header("Location: \communitynotes"); // Redirect to the user dashboard
        exit();
    } else {
        // Redirect with an error message
        header("Location: \login?error=1");
        exit();
    }
}


?>

