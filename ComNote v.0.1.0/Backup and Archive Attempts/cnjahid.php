<?php
include 'cndataconnect';
if (isset($_GET['nt_rating_up']) && isset($_GET['nt_num'])) {
    $id = (int)$_GET['nt_num'];
    $vote = $_GET['nt_rating_up'] === 'up' ? 1 : -1;
    $sql = "UPDATE comnote SET nt_rating_up = nt_rating_up + $vote WHERE id = $id";
    $conn->query($sql);
    header("Location: \communitynotes");
}
?><!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    
    <title>Browse - Community Notes</title>
    <link rel="apple-touch-icon" sizes="180x180" href="images/apple-touch-icon.png">
    <link rel="icon" type="image/png" sizes="32x32" href="images/favicon-32x32.png">
    <link rel="icon" type="image/png" sizes="16x16" href="images/favicon-16x16.png">
    <link rel="manifest" href="images/site.webmanifest">
    <link rel="stylesheet" href="css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.2/css/all.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Raleway:ital,wght@0,100..900;1,100..900&display=swap" rel="stylesheet">

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

        .dropdown .btn {
        background-color: transparent !important;
        border: none !important;
        color: inherit;
        box-shadow: none !important;
}
    </style>
</head>
<body>
    <div class="container-fluid">
        <div class="row">
            <!-- sidebar -->
                <div class="col-md-3 vh-100 d-flex flex-column bg-white">
                    <div class="list-group border-0 ">
                        <div class="mx-auto d-block mt-5">
                            <img src="images/android-chrome-512x512.png" width="50px" />
                        </div>
                        <span class="mx-auto d-block mb-3 fw-bold">Community Note</span>
                        <a href="#" class="list-group-item list-group-item-action border-0 mb-2 rounded-pill d-flex align-items-center fw-bold active">
                            <i class="fa-solid fa-house me-3 ps-3"></i> Home 
                        </a>
    
                        <a href="#" class="list-group-item list-group-item-action border-0 mb-2 rounded-pill d-flex align-items-center fw-bold">
                            <i class="fa-solid fa-bookmark me-3 ps-3"></i> Bookmarks 
                        </a>
                        
                        <a href="#" class="list-group-item list-group-item-action border-0 mb-2 rounded-pill d-flex align-items-center fw-bold">
                            <i class="fa-solid fa-user me-3 ps-3"></i> Profile 
                        </a>
                        
                        <a href="logout.php" class="list-group-item list-group-item-action border-0 mb-2 rounded-pill d-flex align-items-center fw-bold">
                            <i class="fa-solid fa-right-from-bracket me-2 ps-3"></i> Log Out 
                        </a>
                         <a href="#"class="btn btn-primary rounded-pill mx-auto px-4 mt-2">Post</a>
                    </div>

                    <!-- Bootstrap JS Bundle (includes Popper.js) -->
                    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>

                </div>

                <!-- Main Home -->
                <div class="col-md-6 border bg-white p-3 d-flex flex-column" style="overflow-y: auto; max-height: 100vh; scrollbar-width: none; -ms-overflow-style: none;">
                <h4 class="text-start rounded-pill fw-bold">Home</h4><hr>
                <div class="row">
                    <div class="col-md-1">
                        <!-- Gambar akun -->
                        <h1><i class="fa-solid fa-circle-user ps-1"></i></h1>
                    </div>
                    <div class="col-md-11">
                    <form method="POST" id="dataForm">
                        <div class="input-group">
                            <textarea class="form-control" name="text" id="text" aria-label="With textarea" placeholder="What's on your mind?" required></textarea>
                        </div>
                    <br>
                        <div class="d-flex justify-content-end">
                            <button type="submit" class="btn btn-primary rounded-pill mb-3" name="submit" id="submit">Post Note</button>
                        </div>
                    </form>
                    </div>
                </div>
                
                <h4 class="fw-bold">Notes</h4>
                <table class="table table-bordered table-hover table-striped ">
                        <thead class="thead-dark">
                            <tr>
                                <th class="text-center">Username</th>
                                <th class="text-center">Content</th>
                                <th class="text-center">Rating</th>
                            </tr>
                        </thead>
                        <?php include 'cndataconnect.php'; 
                            if (!empty($users)): ?>
                            <?php foreach ($users as $user): ?>
                                <tr>
                                    <td class="align-middle"> <?php echo htmlspecialchars($user['nt_name']); ?> </td>
                                    <td> <?php echo htmlspecialchars($user['nt_text']);?> 
                                        <div style="font-size:12px; margin-top: 10px;"> Posted on <?php echo htmlspecialchars($user['nt_timepost']); ?> </div> 
                                    </td> 
                                    <td class="align-middle"> 
                                    <!-- <button type="button" id="rateup" class="btn btn-success vote-btn" onclick="rateUp(1)"> ▲ </button> -->
                                    <button type="button" class="btn btn-success vote-btn" onclick="rateUp(<?php echo $user['nt_num']; ?>)">
                                    ▲ <?php echo htmlspecialchars($user['nt_rating_up']); ?>
                                    </button>

                                    <button type="button" class="btn btn-danger vote-btn" > ▼ <?php echo htmlspecialchars($user['nt_rating_down']); ?></button>
                                    </td>
                                </tr>
                            <?php endforeach; ?>
                        <?php else: ?>
                            <tr>
                                <td colspan="2">No data found</td>
                            </tr>
                        <?php endif; ?>
                        </table>
                </div>

                <!-- trending -->
                <div class="col-md-3 bg-white vh-100 d-flex flex-column" style="overflow-y: auto; max-height: 100vh; scrollbar-width: none; -ms-overflow-style: none;">
                    <h5 class="mt-4 text-center fw-bold"><i class="fa-solid fa-arrow-trend-up"></i> Trending</h5>
                    <div class="p-3 mt-3">
                    <table class="table table-bordered table-hover table-striped ">
                        <thead class="thead-dark">
                            <tr>
                                <th class="text-center">Username</th>
                                <th class="text-center">Content</th>
                                <th class="text-center">Rating</th>
                            </tr>
                        </thead>
                        <tbody>
                        <?php include 'cndataconnect.php'; 
                            if (!empty($trending)): ?>
                            <?php foreach ($trending as $row): ?>
                                <tr>
                                    <td class="align-middle"> <?php echo htmlspecialchars($row['nt_name']); ?> </td>
                                    <td> <?php echo htmlspecialchars($row['nt_text']);?> 
                                        <div style="font-size:12px; margin-top: 10px;"> Posted on <?php echo htmlspecialchars($row['nt_timepost']); ?> </div> 
                                    </td> 
                                    <td class="align-middle"> <?php echo htmlspecialchars($row['nt_rating_up']); ?> </td>
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
                </div>
            </div>
    </div>
    <script>

    document.getElementById('dataForm').addEventListener('submit', function(event) {
        event.preventDefault(); // Prevent the form from submitting traditionally

        var submitButton = document.getElementById('submit');
        submitButton.disabled = true; // Disable the button

        var formData = new FormData(this); // Use 'this' to refer to the form
        var xhr = new XMLHttpRequest();
        xhr.open('POST', 'submission.php', true);
        xhr.onload = function() {
            if (xhr.status === 200) {
                alert('Content posted successfully!');
                window.location.href = "\communitynotes"; // Redirect to a success page
            } else {
                alert('An error occurred while adding the row.');
                console.error(xhr.responseText);
                submitButton.disabled = false; // Re-enable the button if there's an error
            }
        };
        xhr.send(formData);
    });

    document.getElementById('cndata').addEventListener('click', function() {
        // Redirect to the desired page
        window.location.href = "\communitynotes";
    });


    function rateUp(postId) {
    console.log("Mengirim post_id:", postId); // Debugging

    fetch("rate_up.php", {
        method: "POST",
        headers: {
            "Content-Type": "application/json"
        },
        body: JSON.stringify({ post_id: postId }) // Kirim sebagai JSON
    })
    .then(response => response.json())
    .then(data => {
        console.log("Response dari server:", data); // Debugging
        if (data.status === "success") {
            location.reload(); // Update tampilan rating
        } else {
            alert("Error: " + data.message);
        }
    })
    .catch(error => console.error("Error:", error));
}

    fetchRateUpCount(1);    
    </script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

</body>
</html>