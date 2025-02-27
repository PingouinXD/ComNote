<?php
session_start();
require 'auth.php';
require_once('cndataconnect.php'); // Pastikan path ini sesuai

// Ambil username dari sesi
$username = $_SESSION['username'];

// Query untuk mengambil acc_pic dari tabel accounts
$userProfilePic = "images/default.jpg"; // Default image jika tidak ada acc_pic
$query = "SELECT acc_pic FROM accounts WHERE acc_usn = ?";
$stmt = $conn->prepare($query);
$stmt->bind_param("s", $username);
$stmt->execute();
$result = $stmt->get_result();

if ($result->num_rows > 0) {
    $row = $result->fetch_assoc();
    if ($row['acc_pic'] != NULL && !empty($row['acc_pic'])) {
        $userProfilePic = $row['acc_pic']; // Gunakan path dari database jika ada
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    
    <title>Browse - Community Notes</title>
    <link rel="apple-touch-icon" sizes="180x180" href="images/apple-touch-icon.png">    <!--Logo-->
    <link rel="icon" type="image/png" sizes="32x32" href="images/favicon-32x32.png">    <!--Logo-->
    <link rel="icon" type="image/png" sizes="16x16" href="images/favicon-16x16.png">    <!--Logo-->
    <link rel="manifest" href="images/site.webmanifest">                                <!--Logo-->
    <!-- <link rel="stylesheet" href="css/bootstrap.min.css"> -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.2/css/all.min.css">    <!--CSS-->
    <link href="https://fonts.googleapis.com/css2?family=Raleway:ital,wght@0,100..900;1,100..900&display=swap" rel="stylesheet"> <!--Fonts-->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">  <!--Bootstrap-->

    <style>
        body { font-family: Arial, sans-serif; background-color: #f0f0f0; margin: 0; overflow: hidden; }
        .note { border: 1px solid #ccc; padding: 10px; margin: 10px 0; }
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

                    <a href="#" id="booktest" class="list-group-item list-group-item-action border-0 mb-2 rounded-pill d-flex align-items-center fw-bold">
                        <i class="fa-solid fa-bookmark me-3 ps-3"></i> Bookmarks 
                    </a>
                    <a href="index.php" class="list-group-item list-group-item-action border-0 mb-2 rounded-pill d-flex align-items-center fw-bold">
                        <i class="fa-solid fa-bookmark me-3 ps-3"></i> Another way to view posts! 
                    </a>
                        
                    <a href="profile/profile.php" class="list-group-item list-group-item-action border-0 mb-2 rounded-pill d-flex align-items-center fw-bold">
                        <i class="fa-solid fa-user me-3 ps-3"></i> Profile 
                    </a>
                        
                    <a href="logout.php" class="list-group-item list-group-item-action border-0 mb-2 rounded-pill d-flex align-items-center fw-bold">
                        <i class="fa-solid fa-right-from-bracket me-2 ps-3"></i> Log Out 
                    </a>
                    <a class="btn btn-primary rounded-pill mx-auto px-4 mt-2">Post</a>
                </div>

                    <!-- Bootstrap JS Bundle (includes Popper.js) -->
                    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
            </div>

                <!-- Main Home -->
            <div class="col-md-6 border bg-white p-3 d-flex flex-column" style="overflow-y: auto; max-height: 100vh; scrollbar-width: none; -ms-overflow-style: none;">
                    <h4 class="text-start rounded-pill fw-bold">Home</h4><hr>
                    <p id="guesttext" style="display:none;">You are in Guest Mode</p>
                    <div class="row" id="postbar">
                        <div class="col-md-1" >
                            <!-- Gambar akun -->
                            <img class="rounded-circle me-3" src="<?php echo $userProfilePic; ?>" style="width: 50px; box-shadow: rgba(0, 0, 0, 0.24) 0px 3px 8px;">
                        </div>
                        <div class="col-md-11" >
                            <form method="POST" id="dataForm" enctype="multipart/form-data">
                                <div class="input-group">
                                    <textarea class="form-control" name="text" id="text" aria-label="With textarea" placeholder="What's on your mind?" required></textarea>
                                </div>
                                <br>
                            <input type="file" name="file" id="fileInput" accept="image/*,video/*">
                            <!-- <button onclick="uploadFile()">Upload</button> -->
                            <br>
                            <img id="previewImage" style="max-width: 200px; display: none;"> 
                            <video id="previewVideo" controls style="max-width: 200px; display: none;"></video>
                            <!-- <button id="cancel-btn" style="display: none;">✖</button> -->
                            <!-- <select class="custom-select tag">
                                <option selected>Select the tag</option>
                                <option value="1">One</option>
                                <option value="2">Two</option>
                                <option value="3">Three</option>
                            </select> -->
                            <span>Tags:<span>
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" name="tags[]" value="1" id="flexCheckDefault" onclick="limitCheckbox(this)">
                                <label class="form-check-label" for="flexCheckDefault">
                                    Technology
                                </label>
                            </div>
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" name="tags[]" value="2" id="flexCheckDefault" onclick="limitCheckbox(this)">
                                <label class="form-check-label" for="flexCheckDefault">
                                    Science
                                </label>
                            </div>
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" name="tags[]" value="3" id="flexCheckDefault" onclick="limitCheckbox(this)">
                                <label class="form-check-label" for="flexCheckDefault">
                                    Politics
                                </label>
                            </div>
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" name="tags[]" value="4" id="flexCheckDefault" onclick="limitCheckbox(this)">
                                <label class="form-check-label" for="flexCheckDefault">
                                Entertainment
                                </label>
                            </div>
                            <div class="d-flex justify-content-end">
                                <button type="submit" class="btn btn-primary rounded-pill mb-3 submit" name="submit" id="submit">Post Note</button>
                                </div>
                            </form>
                            <p id="status"></p>
                            
                        </div>
                    </div>
                    <h4 class="fw-bold">Notes</h4>
                        <?php include 'cndataconnect.php'; 
                            if (!empty($users)): ?>
                                <?php foreach ($users as $user): ?>
                                    <div class="card" style="margin-top: 10px;">
                                    <div class="card-body d-flex flex-column">
                                        <h5 class="card-title"><?php echo htmlspecialchars($user['nt_name']); ?> </h5>
                                        <span class="card-text"><?php echo htmlspecialchars($user['nt_text']);?> </span> 
                                        <div class="col-md-1">
                                        <?php if($user['post_id'] == $user['nt_num']):?>
                                        <?php 

                                        // Store all assign type IDs in an array
                                        $assignTypes = [
                                            $user['assign_type_id'],
                                            $user['assign_type_id2'],
                                            $user['assign_type_id3']
                                        ];

                                        // Assign type labels
                                        $typeLabels = [
                                            1 => "Technology",
                                            2 => "Science",
                                            3 => "Politics",
                                            4 => "Entertainment"
                                        ];

                                        // Loop through the assign types and display badges
                                        foreach ($assignTypes as $typeId) {
                                            if (!empty($typeId) && isset($typeLabels[$typeId])) {
                                                echo '<span class="badge bg-primary" style="z-index: 100; margin-right: 5px;">' . $typeLabels[$typeId] . '</span>';
                                            }
                                        }
                                        
                                        // switch(true) {
                                        //     case ($user['assign_type_id']) === 1: echo('<span class="badge bg-primary" style="z-index: 100">Technology</span>'); break;
                                        //     case ($user['assign_type_id']) === 2: echo('<span class="badge bg-primary" style="z-index: 100">Politics</span>'); break;
                                        //     case ($user['assign_type_id']) === 3: echo('<span class="badge bg-primary" style="z-index: 100">Entertainment</span>'); break;
                                        //     case ($user['assign_type_id']) === 4: echo('<span class="badge bg-primary" style="z-index: 100">Science</span>'); break;
                                        //     default: break;
                                        // } 
                                        ?>
                                        <?php endif ?>

                                        </div>
                                        <div style="font-size:12px; margin-top: 0px;"> Posted on <?php echo htmlspecialchars($user['nt_timepost']); ?> </div>                              
                                        <!-- <button type="button" id="rateup" class="btn btn-success vote-btn" onclick="rateUp(1)"> ▲ </button> -->

                                        <?php if (!empty($user['nt_filepath'])): ?>
                                        <?php 
                                        $filePath = htmlspecialchars($user['nt_filepath']);
                                        $fileExt = pathinfo($filePath, PATHINFO_EXTENSION);
                                        ?>
                                        <?php if (in_array($fileExt, ['jpg', 'jpeg', 'png', 'gif'])): ?>
                                            <img src="<?php echo $filePath; ?>" style="max-width: 300px; height:auto; margin-top: 10px; object-fit: contain;">
                                        <?php elseif (in_array($fileExt, ['mp4', 'avi', 'mov'])): ?>
                                            <video controls style="max-width: 100%; margin-top: 10px;">
                                                <source src="<?php echo $filePath; ?>" type="video/<?php echo $fileExt; ?>">
                                                Your browser does not support the video tag.
                                            </video>
                                        <?php endif; ?>
                                    <?php endif; ?>

                            <div class ="align-center d-flex justify-content-between" style="margin-top:10px;">
                                <div class="btn-group" role="group" aria-label="Basic mixed styles example">
                                    <button type="button" class="btn btn-success vote-btn upvote" data-post-id="<?php echo htmlspecialchars($user['nt_num']); ?>" data-vote-type="up">
                                        ▲ <span id="upvote-count-<?php echo htmlspecialchars($user['nt_num']); ?>">
                                            <?php echo htmlspecialchars($user['nt_rating_up']); ?>
                                        </span>
                                    </button>

                                    <button type="button" class="btn btn-danger vote-btn downvote" data-post-id="<?php echo htmlspecialchars($user['nt_num']); ?>" data-vote-type="down">
                                        ▼ <span id="downvote-count-<?php echo htmlspecialchars($user['nt_num']); ?>">
                                            <?php echo htmlspecialchars($user['nt_rating_down']); ?>
                                        </span>
                                    </button>
                                </div>
                                <div class="d-flex flex-row justify-content-end">
                                    <button type="button" class="btn btn-warning me-1 bookmark-btn" data-post-id="<?php echo htmlspecialchars($user['nt_num']); ?>">
                                        <i class="fa-regular fa-bookmark"></i>
                                    </button>

                                    <button type="button" data-item-id="<?php echo htmlspecialchars($user['nt_num']) ?>" class="btn btn-danger not-interested"> Not Interesed</button>   
                                </div>  
                            </div>
                        </div>
                    </div>
                    <?php endforeach; ?>
                <?php else: ?>                           
                    No data found
                <?php endif; ?>                        
            </div>

                <!-- trending -->
            <div class="col-md-3 bg-white vh-100 d-flex flex-column" style="overflow-y: auto; max-height: 100vh; scrollbar-width: none; -ms-overflow-style: none;">
                <h5 class="mt-4 text-center fw-bold"><i class="fa-solid fa-arrow-trend-up"></i> Trending</h5>
                <form>
                <div class="form-group">
                <div class="dropdown">
                    <!-- <button class="btn btn-primary dropdown-toggle" type="button" id="dropdownMenuButton" data-bs-toggle="dropdown" aria-expanded="false">
                        Most Rated Up
                    </button>
                    <ul class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                        <li><a class="dropdown-item" href="#" data-value="Option 1">Most Rated Up</a></li>
                        <li><a class="dropdown-item" href="#" data-value="Option 2">Most Rated Down</a></li>
                    </ul> -->
                </div>
                </form>
                <div class="text-center mb-3">
        <!-- Dropdown Sorting -->
        <div class="dropdown">
            <button class="btn btn-primary dropdown-toggle" type="button" id="dropdownMenuButton" data-bs-toggle="dropdown" aria-expanded="false">
                Sort by
            </button>
            <ul class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                <li><a class="dropdown-item sort-option" href="#" data-sort="nt_rating_up">Most Rated Up ▲</a></li>
                <li><a class="dropdown-item sort-option" href="#" data-sort="nt_rating_down">Most Rated Down ▼</a></li>
            </ul>
        </div>
    </div>

    <!-- Area untuk menampilkan data -->
    <div id="noteContainer" class="mt-4">
        <!-- Data dari database akan muncul di sini -->
    </div>
</div>
                <!-- <button type="submit" class="btn btn-primary btn-sm">Submit</button>
                <div class="p-3 mt-3">
                   
                </div>
                        </div> -->
                      
            </div>
        </div>
    </div>

    <?php
include 'cndataconnect';
if (isset($_GET['nt_rating_up']) && isset($_GET['nt_num'])) {
    $id = (int)$_GET['nt_num'];
    $vote = $_GET['nt_rating_up'] === 'up' ? 1 : -1;
    $sql = "UPDATE comnote SET nt_rating_up = nt_rating_up + $vote WHERE id = $id";
    $conn->query($sql);
    header("Location: \communitynotes");
}
?>
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>

//              ========= GUEST MODE GABISA TEKAN TOMBOL =========

        function isGuestMode() {
    return document.cookie.includes("guest_id=");
}
    if (isGuestMode()) {
    document.addEventListener("DOMContentLoaded", function() {
        // Pilih semua elemen interaktif yang bisa diklik atau diisi
        const interactiveElements = document.querySelectorAll(".upvote, .downvote, .not-interested");
        let postbar = document.getElementById('postbar');
        postbar.style.display = 'none';

        document.getElementById("guesttext").style.display = 'block';

        interactiveElements.forEach(element => {
            element.addEventListener("click", function(event) {
                // Cegah aksi default (misalnya mencegah link berpindah halaman)
                event.preventDefault();
                alert("Tidak bisa melakukan ini karena Anda sedang dalam mode tamu. Tetapi record untuk preference anda akan dtetap dicatat di Cookies anda");
            });
        });
    });
}
//            ========================================================
//                          FIRST SUBMIT ATTEMPT

    // document.getElementById('dataForm').addEventListener('submit', function(event) {
    //     event.preventDefault(); // Prevent the form from submitting traditionally

    //     var submitButton = document.getElementById('submit');
    //     submitButton.disabled = true; // Disable the button

    //     var formData = new FormData(this); // Use 'this' to refer to the form
    //     var xhr = new XMLHttpRequest();
    //     xhr.open('POST', 'submission.php', true);
    //     xhr.onload = function() {
    //         if (xhr.status === 200) {
    //             alert('Content posted successfully!');
    //             window.location.href = "\communitynotes"; // Redirect to a success page
    //         } else {
    //             alert('An error occurred while adding the row.');
    //             console.error(xhr.responseText);
    //             submitButton.disabled = false; // Re-enable the button if there's an error
    //         }
    //     };
    //     xhr.send(formData);
    // });

    //                                  LIMIT CHECKBOX
    function limitCheckbox(checkbox) {
        const checkboxes = document.querySelectorAll('input[name="tags[]"]:checked');
        if (checkboxes.length > 3) {
            checkbox.checked = false;
            alert("You can only select up to 3 options.");
        }
    }


    //                                  SUBMIT POSTINGAN
    document.querySelector('#dataForm .submit').addEventListener('click', function(event) {
    event.preventDefault();
    var form = document.getElementById('dataForm');
    var formData = new FormData(form);
    var submitButton = document.querySelector('#dataForm .submit');
    submitButton.disabled = true;

    fetch('submission.php', {
        method: 'POST',
        body: formData
    })
    .then(response => response.text())
    .then(data => {
        if (data.trim() === "success") {
            alert('Content posted successfully!');
            location.reload();
        } else {
            alert('Error: ' + data);
            submitButton.disabled = false;
        }
    })
    .catch(error => console.error('Error:', error));
});

    //                     PREVIEW GAMBAR/VIDEO SEBELUM UPLOAD
document.getElementById('fileInput').addEventListener('change', function(event) {
    let file = event.target.files[0];
    let previewImage = document.getElementById('previewImage');
    let previewVideo = document.getElementById('previewVideo');
    let fileInput = document.getElementById('fileInput');
    cancelBtn = document.getElementById('cancel-btn');

    if (!file) return;

    let fileType = file.type;
    let fileURL = URL.createObjectURL(file);


    if (fileType.startsWith('image/')) {
        previewImage.src = fileURL;
        previewImage.style.display = 'block';
        previewVideo.style.display = 'none';
        cancelBtn.style.display = 'block';
    } else if (fileType.startsWith('video/')) {
        previewVideo.src = fileURL;
        previewVideo.style.display = 'block';
        previewImage.style.display = 'none';
        cancelBtn.style.display = 'block';
    }
    //                               CANCEL BUTTON GAJADI
//     cancelBtn.addEventListener('click', function() {
//         event.preventDefault();
//         previewImage.style.display = 'none'; // Sembunyikan preview
//         previewVideo.style.display = 'none'; // Sembunyikan preview
//         var fileInput = document.getElementById("fileInput");
// var newInput = fileInput.cloneNode(true);
// fileInput.parentNode.replaceChild(newInput, fileInput)
//         cancelBtn.style.display = 'none';
//         });
});
    //                                  BOOKMARK UNTUK RESET FIRSTIME COOKIES
document.querySelector('#booktest').addEventListener('click', function(event) {
    document.cookie = "firsttime=0; max-age=86400; path=/";
    console.log(document.cookie);
});
    //                                 VOTE BUTTON
document.addEventListener("DOMContentLoaded", function () {
    document.querySelectorAll(".vote-btn").forEach(button => {
        button.addEventListener("click", function () {
            let postId = this.dataset.postId;
            let voteType = this.dataset.voteType; // 'up' atau 'down'
            let url = voteType === "up" ? "rate_up.php" : "rate_down.php";

            fetch(url, {
                method: "POST",
                headers: { "Content-Type": "application/json" },
                body: JSON.stringify({ post_id: postId })
            })
            .then(response => response.json())
            .then(data => {
                if (data.status === "success") {
                    updateVoteDisplay(postId, data.new_rating, voteType);
                } else {
                    alert("Error processing vote.");
                }
            })
            .catch(error => console.error("Error:", error));
        });
    });
});

// BOOKMARK JAHID BELUM JADI

// document.addEventListener("DOMContentLoaded", function () {
//     document.querySelectorAll(".bookmark-btn").forEach(button => {
//         button.addEventListener("click", function () {
//             let postId = this.dataset.postId;
//             console.log(postId);
//             let isBookmarked = this.classList.contains("bookmarked");

//             fetch("handle_bookmark.php", {
//                 method: "POST",
//                 headers: { "Content-Type": "application/json" },
//                 body: JSON.stringify({ post_id: postId, is_bookmarked: !isBookmarked })
//             })
//             .then(response => response.json())
//             .then(data => {
//                 if (data.status === "success") {
//                     this.classList.toggle("bookmarked", !isBookmarked);
//                     this.querySelector("i").classList.toggle("fa-solid", !isBookmarked);
//                     this.querySelector("i").classList.toggle("fa-regular", isBookmarked);
//                 } else {
//                     alert("Error processing bookmark.");
//                 }
//             })
//             .catch(error => console.error("Error:", error));
//         });
//     });
// });

    //                                  UPDATE VOTE REALTIME
function updateVoteDisplay(postId, newRating, voteType) {
    if (voteType === "up") {
        document.querySelector(`#upvote-count-${postId}`).innerText = newRating;
    } else {
        document.querySelector(`#downvote-count-${postId}`).innerText = newRating;
    }
}
    //                                  DROPDOWN BUTTON DI TRENDING
document.querySelectorAll('.dropdown-item').forEach(item => {
        item.addEventListener('click', function () {
            document.getElementById('dropdownMenuButton').textContent = this.textContent;
        });
    });



    //                                  NOT INTERESTED
    $(document).on("click", ".not-interested", function() {
    var itemId = $(this).data("item-id");
    var card = $(this).closest(".card"); // Ambil elemen card
    // console.log("Button clicked, Item ID:", itemId);
    // console.log("Card found:", card.length > 0 ? "Yes" : "No");
    
    $.ajax({
        url: "remove_content_preference.php",
        type: "POST",
        data: { item_id: itemId },
        success: function(response) {
            if (response == "success") {
                card.fadeOut(300, function() {
                $(this).remove(); // Hapus elemen setelah animasi selesai
                });
            } else {
                alert("Failed to remove content. Server response: " + response);
            }
        }
    });
}); 



    //                                  SORTING DATA TRENDING
$(document).ready(function() {
    // Fungsi untuk mengambil data berdasarkan sorting
    function loadData(sortBy = "nt_rating_up") {
        $.ajax({
            url: "sort_data.php", 
            type: "POST",
            data: { sort: sortBy },
            success: function(response) {
                $("#noteContainer").html(response);
            },
            error: function(xhr, status, error) {
                console.error(xhr.responseText);
            }
        });
    }

    // Load data pertama kali dengan sorting default (Rate Up)
    loadData();

    // Saat salah satu opsi di dropdown diklik
    $(".sort-option").click(function() {
        let sortBy = $(this).data("sort");
        loadData(sortBy);
    });
});


// document.getElementById('fileInput').addEventListener('change', function(event) {
//             let file = event.target.files[0];
//             let previewImage = document.getElementById('previewImage');
//             let previewVideo = document.getElementById('previewVideo');

//             if (!file) return;

//             let fileType = file.type;
//             let fileURL = URL.createObjectURL(file);

//             if (fileType.startsWith('image/')) {
//                 previewImage.src = fileURL;
//                 previewImage.style.display = 'block';
//                 previewVideo.style.display = 'none';
//             } else if (fileType.startsWith('video/')) {
//                 previewVideo.src = fileURL;
//                 previewVideo.style.display = 'block';
//                 previewImage.style.display = 'none';
//             }
//         });

//         function uploadFile() {
//             let fileInput = document.getElementById('fileInput');
//             let file = fileInput.files[0];
//             if (!file) {
//                 alert('Pilih file terlebih dahulu!');
//                 return;
//             }

//             let formData = new FormData();
//             formData.append("file", file);

//             let xhr = new XMLHttpRequest();
//             xhr.open("POST", "upload.php", true);

//             xhr.onload = function() {
//                 document.getElementById('status').innerText = xhr.responseText;
//             };

//             xhr.send(formData);
//         }
    </script>
    

    <script>
            //                                  IDLE 10 MENIT
        // Idle timeout in milliseconds (5 minutes)
        const IDLE_TIMEOUT = 600 * 1000;
        let idleTimer = null;

        // Function to redirect to screensaver
        function redirectToScreensaver() {
            window.location.href = 'index.php';
        }

        // Reset the idle timer
        function resetIdleTimer() {
            if (idleTimer) {
                clearTimeout(idleTimer);
            }
            idleTimer = setTimeout(redirectToScreensaver, IDLE_TIMEOUT);
        }

        // Add event listeners for user activity
        const events = ['mousedown', 'mousemove', 'keypress', 'scroll', 'touchstart'];
        events.forEach(event => {
            document.addEventListener(event, resetIdleTimer, true);
        });

        // Start the idle timer when page loads
        resetIdleTimer();   
    </script>
</body>
</html>