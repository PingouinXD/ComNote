<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <title>Browse - Community Notes</title>
    <link rel="apple-touch-icon" sizes="180x180" href="images/apple-touch-icon.png">
    <link rel="icon" type="image/png" sizes="32x32" href="images/favicon-32x32.png">
    <link rel="icon" type="image/png" sizes="16x16" href="images/favicon-16x16.png">
    <link rel="manifest" href="images/site.webmanifest">
</head>
<body>
<nav class="navbar navbar-expand-lg navbar-dark bg-dark">
    <div class="container">
        <a class="navbar-brand" href="#">Community Notes</a>

        <div class="dropdown ms-auto">
            <button class="btn btn-secondary dropdown-toggle" type="button" id="profileDropdown" data-bs-toggle="dropdown" aria-expanded="false">
                <?php echo $_SESSION['username']; ?> <!-- Show logged-in username -->
            </button>
            <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="profileDropdown">
                <li><a class="dropdown-item" href="profile.php">Profile</a></li>
                <li><hr class="dropdown-divider"></li>
                <li><a class="dropdown-item" href="\changepassword">Change Password</a></li>
                <li><hr class="dropdown-divider"></li>
                <li><a class="dropdown-item text-danger" href="logout.php">Logout</a></li>
            </ul>
        </div>
    </div>
</nav>

    <div class="container-fluid">
        <!-- <h1 style="padding:50px; text-align:center;">Community Notes <?php session_start(); echo $_SESSION['username']; ?></h1> -->
        <div class="row">
                <div class="col-md-3 bg-dark"></div>
                <div class="col-md-6">
                    <table class="table table-bordered table-hover table-striped">
                    <thead class="thead-dark">
                        <tr>
                            <th class="text-center">Username</th>
                            <th class="text-center">Content</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php include 'cndataconnect.php'; 
                            if (!empty($users)): ?>
                            <?php foreach ($users as $user): ?>
                                <tr>
                                    <td class="align-middle"> <?php echo htmlspecialchars($user['nt_name']); ?> </td>
                                    <td> <?php echo htmlspecialchars($user['nt_text']);?> 
                                        <div style="font-size:12px; margin-top: 10px;"> Posted on <?php echo htmlspecialchars($user['nt_timepost']); ?> </div> 
                                    </td> 
                                </tr>
                            <?php endforeach; ?>
                        <?php else: ?>
                            <tr>
                                <td colspan="2">No data found</td>
                            </tr>
                        <?php endif; ?>
                            </tbody>
                        </table>
                    </div>
                    <div class="col-md-2">
                        <button type="button" class="btn btn-primary" id="postredirect">Post Something</button>
                    </div>
                </div>
        
    </div>
    <script>
        document.getElementById('postredirect').addEventListener('click', function() {
            // Redirect to the desired page
            window.location.href = "\post";
        });    
    </script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

</body>
</html>