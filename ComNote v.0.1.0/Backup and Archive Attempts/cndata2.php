<?php
ob_start();
session_start();


require_once('cndataconnect.php');
require_once('inc/cssjava.php');

//if session variable is not found
if(!isset($_SESSION['username'])){
    //redirect user to login page
    
    header('Location: \login');
}

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['note'])) {
    $note = $conn->real_escape_string($_POST['note']);
    $sql = "INSERT INTO comnote (nt_text, nt_rating) VALUES ('$note', 0)";
    $conn->query($sql);
    header("Location: cndata2.php");
    exit();
}

 
if (isset($_GET['vote']) && isset($_GET['id'])) {
    $id = (int)$_GET['id'];
    $vote = $_GET['vote'] === 'up' ? 1 : -1;
    $sql = "UPDATE comnote SET nt_rating = nt_rating + $vote WHERE id = $id";
    $conn->query($sql);
    header("Location: cndata2.php");
    exit();
}

?>

<!DOCTYPE html>
<html>
<head>
    <title>Browse - Community Notes</title>
    <style>
        body { font-family: Arial, sans-serif; background-color: #f0f0f0; margin: 0; overflow: hidden; }
        .note { border: 1px solid #ccc; padding: 10px; margin: 10px 0; }
        .sticky-note {
            position: absolute;
            width: 200px;
            height: 100px;
            padding: 10px;
            background-color: #4caf50;
            color: white;
            display: flex;
            align-items: center;
            justify-content: center;
            border-radius: 5px;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
        }
        /* Remove blue focus outline */
        .form-control:focus {
            box-shadow: none !important;
            border-color: #ccc !important; /* Adjust to match your design */
            outline: none !important;
        }

        textarea {
        resize: none !important; /* Hides the resize handle */
        min-height: 100px; /* Allows natural expansion */
        overflow-y: auto; /* Enables scrolling when needed */
        }
    </style>
</head>
<body>
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-3 bg-white border border-black bg-dark"> 
                <?php include('inc/sidebar.php'); ?>
            </div>
            <div class="col-md-6 vh-100 overflow-auto border bg-white p-3" style="scrollbar-width: none; -ms-overflow-style: none;">
                <h4 class="text-start rounded-pill fw-bold">Home</h4><hr>
                <div class="row">
                    <div class="col-md-1">
                        <!-- Gambar akun -->
                        <h1><i class="fa-solid fa-circle-user ps-1"></i></h1>
                    </div>
                    <div class="col-md-11">
                        <form method="POST">
                            <div class="input-group">
                                <textarea class="form-control" name="note" aria-label="With textarea" placeholder="What's on your mind?"></textarea>
                            </div>
                            <br>
                            <div class="d-flex justify-content-end">
                                <button type="submit" class="btn btn-primary rounded-pill">Post Note</button>
                            </div>
                        </form>
                    </div>
                </div>
                
                <h2>Notes</h2>
                <?php
                $result = $conn->query("SELECT * FROM comnote");
                while ($row = $result->fetch_assoc()): ?>
                    <div class="note rounded-4">
                        <p><?= htmlspecialchars($row['nt_text']) ?></p>
                        <p>Rating: <?= $row['nt_rating_up'] ?></p>
                        <a><i class="fa-solid fa-heart"></i> Love</a>
                        <a><i class="fa-solid fa-heart-crack"></i> Dont Love</a>
                    </div>
                <?php endwhile; ?>
            </div>
            <div class="col-md-3 ">
                <div class="input-group mb-2 pt-2 ">
                    <span class="input-group-text rounded-start-pill" id="basic-addon1"><i class="fa-solid fa-magnifying-glass"></i></span>
                    <input type="text" class="form-control rounded-end-pill" placeholder="What's Hot?" aria-label="Username" aria-describedby="basic-addon1">
                </div>
                <div class="container bg-white rounded-5">
                    <div class="row vh-100">    
                        <?php 
                        include('inc/trending.php');
                        ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
    

</body>
</html>
