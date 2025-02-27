<?php
session_start();
?>
<!DOCTYPE html>
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
                    <a class="btn btn-primary rounded-pill mx-auto px-4 mt-2">Post</a>
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
                        <?php include 'cndataconnect.php'; 
                            if (!empty($users)): ?>
                                <?php foreach ($users as $user): ?>
                                    <div class="card" style="margin-top: 10px;">
                                    <div class="card-body d-flex flex-column">
                                        <h5 class="card-title"><?php echo htmlspecialchars($user['nt_name']); ?> </h5>
                                        <p class="card-text"><?php echo htmlspecialchars($user['nt_text']);?> </p> 
                                        <div style="font-size:12px; margin-top: -15px;"> Posted on <?php echo htmlspecialchars($user['nt_timepost']); ?> </div>                              
                                        <!-- <button type="button" id="rateup" class="btn btn-success vote-btn" onclick="rateUp(1)"> ▲ </button> -->
                                        <div class ="align-center d-flex justify-content-between" style="margin-top:10px;">
                                            <div class="btn-group" role="group" aria-label="Basic mixed styles example">
    <button type="button" 
            class="btn btn-success vote-btn upvote" 
            data-post-id="<?php echo htmlspecialchars($user['nt_num']); ?>" 
            data-vote-type="up">
        ▲ <span id="upvote-count-<?php echo htmlspecialchars($user['nt_num']); ?>">
            <?php echo htmlspecialchars($user['nt_rating_up']); ?>
        </span>
    </button>

    <button type="button" 
            class="btn btn-danger vote-btn downvote" 
            data-post-id="<?php echo htmlspecialchars($user['nt_num']); ?>" 
            data-vote-type="down">
        ▼ <span id="downvote-count-<?php echo htmlspecialchars($user['nt_num']); ?>">
            <?php echo htmlspecialchars($user['nt_rating_down']); ?>
        </span>
    </button>
                                            </div>
                                            <button type="button" data-item-id="<?php echo htmlspecialchars($user['nt_num']) ?>" class="btn btn-danger vote-btn not-interested"> Not Interesed</button>     
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
    <h5 class="mt-4 text-center fw-bold"> THE
    </h5>

    <!-- Tombol Pilihan -->
    <?php
include('cndataconnect.php'); // Pastikan koneksi berhasil

$type = $_GET['type']; // Mendapatkan parameter type dari URL

// Mengecek apakah type ada di URL
if (!in_array($type, ['like', 'dislike'])) {
    echo "Invalid type!";
    exit;
}

// Menentukan query berdasarkan tipe (like atau dislike)
if ($type == 'like') {
    $sql = "SELECT * FROM posts ORDER BY nt_rating_up DESC LIMIT 10"; // Mengambil 10 post dengan like terbanyak
} elseif ($type == 'dislike') {
    $sql = "SELECT * FROM posts ORDER BY nt_rating_down DESC LIMIT 10"; // Mengambil 10 post dengan dislike terbanyak
}

// Mengeksekusi query
$result = $conn->query($sql);

// Mengecek apakah ada hasil dari query
if ($result->num_rows > 0) {
    // Menampilkan hasilnya
    while ($row = $result->fetch_assoc()) {
        echo "<div class='post'>";
        echo "<h3>" . htmlspecialchars($row['title']) . "</h3>";
        echo "<p>" . htmlspecialchars($row['content']) . "</p>";
        echo "<p><strong>Likes: " . $row['nt_rating_up'] . "</strong> | <strong>Dislikes: " . $row['nt_rating_down'] . "</strong></p>";
        echo "</div>";
    }
} else {
    echo "No posts found.";
}

$conn->close(); // Jangan lupa menutup koneksi
?>

        </div>
    </div>
</div>

<script>
function showTrending(type) {
    console.log("Tombol diklik:", type); // Debugging
    if (type === 'up') {
        document.getElementById('trending-up').style.display = 'block';
        document.getElementById('trending-down').style.display = 'none';
    } else {
        document.getElementById('trending-up').style.display = 'none';
        document.getElementById('trending-down').style.display = 'block';
    }
}
</script>
                <!--  -->
        </div>
    </div>
    <?php
include 'cndataconnect.php';
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

    // RATING FUNCTION
//     function rateUp(postId) {
//     fetch("rate_up.php", {
//         method: "POST",
//         headers: {
//             "Content-Type": "application/json"
//         },
//         body: JSON.stringify({ post_id: postId }) 
//     })
//     .then(response => response.json())
//     .then(data => {
//         let button = document.querySelector(`[data-post-id='${postId}'].upvote`);
//         let downvoteButton = document.querySelector(`[data-post-id='${postId}'].downvote`);
//         let count = button.querySelector(".count");

//         if (data.status === "success") {
//             count.textContent = parseInt(count.textContent) + 1;
//         } else if (data.status === "undone") {
//             count.textContent = parseInt(count.textContent) - 1;
//         } else {
//             alert(data.message);
//         }
//     })
//     .catch(error => console.error("Error:", error));
// }

// function rateDown(postId) {
//     fetch("rate_down.php", {
//         method: "POST",
//         headers: {
//             "Content-Type": "application/json"
//         },
//         body: JSON.stringify({ post_id: postId }) 
//     })
//     .then(response => response.json())
//     .then(data => {
//         let button = document.querySelector(`[data-post-id='${postId}'].downvote`);
//         let upvoteButton = document.querySelector(`[data-post-id='${postId}'].upvote`);
//         let count = button.querySelector(".count");

//         if (data.status === "success") {
//             count.textContent = parseInt(count.textContent) + 1;
//             button.classList.add("active");
//             upvoteButton.classList.remove("active"); // Hapus upvote jika ada
//         } else if (data.status === "undone") {
//             count.textContent = parseInt(count.textContent) - 1;
//             button.classList.remove("active");
//         } else {
//             alert(data.message);
//         }
//     })
//     .catch(error => console.error("Error:", error));
// }
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

// Fungsi untuk memperbarui tampilan jumlah vote
function updateVoteDisplay(postId, newRating, voteType) {
    if (voteType === "up") {
        document.querySelector(`#upvote-count-${postId}`).innerText = newRating;
    } else {
        document.querySelector(`#downvote-count-${postId}`).innerText = newRating;
    }
}

</script>


    // fetchRateUpCount(1);   
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
    </script>
    
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

</body>
</html>