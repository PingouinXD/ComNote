<?php
session_start();
require_once('../cndataconnect.php');

if (isset($_GET['nt_name'])) {
    $nt_name = $_GET['nt_name'];
    // Fetch user details from the database using $nt_name
    $query = "SELECT * FROM accounts WHERE acc_usn = ?";
    $stmt = $conn->prepare($query);
    $stmt->bind_param("s", $nt_name);
    $stmt->execute();
    $result = $stmt->get_result();
    
    if ($result->num_rows > 0) {
        $user = $result->fetch_assoc();
        // Display the user's profile information
    } else {
        echo "User not found.";
    }
} else {
    echo "No username provided.";
}

$username = $_SESSION['username'];

$query = "SELECT * FROM comnote WHERE nt_name = ? ORDER BY nt_time DESC";
$stmt = $conn->prepare($query);
$stmt->bind_param("s", $user['acc_usn']);
$stmt->execute();
$result = $stmt->get_result();
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
        .note { 
            border: 1px solid #ccc; 
            padding: 10px; 
            margin: 10px 0; 
            height: auto;
        }
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
        .form-control:focus {
            box-shadow: none !important;
            border-color: #ccc !important;
            outline: none !important;
        }
        textarea {
            resize: none !important;
            min-height: 100px;
            overflow-y: auto;
        }
        .profile img {
            position: relative;
            top: -50px;
            width: 125px;
            box-shadow: rgba(50, 50, 93, 0.25) 0px 50px 100px -20px, rgba(0, 0, 0, 0.3) 0px 30px 60px -30px, rgba(10, 37, 64, 0.35) 0px -2px 6px 0px inset;
            margin-bottom: -40px;
        }
        .profile .d-flex.flex-column {
            display: flex;
            align-items: left;
            text-align: left;
            position: relative;
        }
        .profile .fw-bold {
            margin-top: 0;
            padding-top: 5px;
        }
        .profile small {
            margin-top: 0;
        }
        .post-image {
            aspect-ratio: 2/1;
            overflow: hidden;
            margin-left: 48px;
            margin-right: 20px;
            background: linear-gradient(135deg, #1DA1F2, #0C4A77);
            box-shadow: 0 26px 58px 0 rgba(0, 0, 0, .22), 0 5px 14px 0 rgba(0, 0, 0, .18);
            border-radius: 16px;
        }
        .post-image img {
            padding: 8px;
            width: 100%;
            height: 100%;
            object-fit: contain;
        }
        .dropdown .btn {
            background-color: transparent !important;
            border: none !important;
            color: inherit;
            box-shadow: none !important;
        }
        .right-sidebar-title {
            font-weight: bold;
            font-size: 1.1rem;
            margin: 15px;
        }
        .image-grid {
            display: grid;
            grid-template-columns: repeat(3, 1fr);
            gap: 5px; 
            padding: 15px;
        }
        .grid-item {
            aspect-ratio: 3/2;
            overflow: hidden;
            background: linear-gradient(135deg, #1DA1F2, #0C4A77);
        }
        .grid-item img {
            width: 100%;
            height: 100%;
            object-fit: cover;
        }
        .grid-item:nth-child(1) { border-top-left-radius: 20px; }
        .grid-item:nth-child(3) { border-top-right-radius: 20px; }
        .grid-item:nth-child(4) { border-bottom-left-radius: 20px; }
        .grid-item:nth-child(6) { border-bottom-right-radius: 20px; }
        .follow-card {
            padding: 10px 15px;
            margin-bottom: 8px;
            display: flex;
            align-items: center;
            justify-content: space-between;
        }
        .follow-user {
            display: flex;
            align-items: center;
        }
        .follow-user-img {
            width: 40px;
            height: 40px;
            border-radius: 50%;
            margin-right: 10px;
            background-color: #1DA1F2;
        }
        .follow-user-info {
            display: flex;
            flex-direction: column;
        }
        .follow-user-name {
            font-weight: bold;
            font-size: 0.9rem;
        }
        .follow-user-handle {
            font-size: 0.8rem;
            color: #657786;
        }
        .follow-button {
            background-color: #000;
            color: #fff;
            border-radius: 20px;
            padding: 5px 15px;
            font-size: 0.8rem;
            font-weight: bold;
            border: none;
        }
        .note p {
            margin: 0;
            padding-top: 0;
            padding-bottom: 0;
        }
        .note .d-flex {
            margin-bottom: 0;
        }
        .text-justify {
            text-align: justify;
        }
        #profilePreview {
            width: 125px;
            height: 125px;
            object-fit: cover;
        }
        @media (max-width: 768px) {
            .sidebar { display: none; }
        }
    </style>
</head>
<body>
    <div class="container-fluid">
        <div class="row">
            <div class="sidebar col-md-3 d-flex flex-column bg-white">
                <div class="sidebar list-group border-0">
                    <div class="sidebar mx-auto d-block mt-5">
                        <img src="images/logo.png" width="50px" />
                    </div>
                    <span class="sidebar mx-auto d-block mb-3 fw-bold">Community Note</span>
                    <a href="..\communitynotes" class="sidebar list-group-item list-group-item-action border-0 mb-2 rounded-pill d-flex align-items-center fw-bold">
                        <i class="fa-solid fa-house me-3 ps-3"></i> Home 
                    </a>
                    <a href="#" class="sidebar list-group-item list-group-item-action border-0 mb-2 rounded-pill d-flex align-items-center fw-bold">
                        <i class="fa-solid fa-bookmark me-3 ps-3"></i> Bookmarks 
                    </a>
                    <a href="#" class="sidebar list-group-item list-group-item-action border-0 mb-2 rounded-pill d-flex align-items-center fw-bold active">
                        <i class="fa-solid fa-user me-3 ps-3"></i> Profile 
                    </a>
                    <a href="#" class="sidebar list-group-item list-group-item-action border-0 mb-2 rounded-pill d-flex align-items-center fw-bold">
                        <i class="fa-solid fa-right-from-bracket me-2 ps-3"></i> Log Out 
                    </a>
                    <a href="post.php" class="sidebar btn btn-primary rounded-pill mx-auto px-4 mt-2" style="box-shadow: rgba(14, 30, 37, 0.12) 0px 2px 4px 0px, rgba(14, 30, 37, 0.32) 0px 2px 16px 0px;">Post</a>
                </div>
            </div>

            <div class="col-md-6 bg-white border border-secondary-subtle vh-100" style="height: 500px; overflow-y: auto; scrollbar-width: none; -ms-overflow-style: none;">
                <div class="row">
                    <div class="col-md-12 d-flex flex-row justify-content-start mt-2 mb-2" style="height: auto;">
                        <a href="..\communitynotes" class="btn btn-primary rounded-5">
                            <i class="fa-solid fa-arrow-left me-2"></i>Back To Home
                        </a>
                    </div>
                </div>

                <?php 
                $userProfilePic = "images/default.jpg";
                $accpic_query = "SELECT acc_pic FROM accounts WHERE acc_usn = ?";
                $accpic_run = $conn->prepare($accpic_query);
                $accpic_run->bind_param("s", $_SESSION['username']);
                $accpic_run->execute();
                $accpic_result = $accpic_run->get_result();

                if ($row = $accpic_result->fetch_assoc()) {
                    if ($row['acc_pic'] != NULL && $row['acc_pic'] != '') {
                        $userProfilePic = $row['acc_pic'];
                    }
                }

                $bio = "Belum ada deskripsi.";
                $accdesc_query = "SELECT acc_desc FROM accounts WHERE acc_usn = ?";
                $accdesc_run = $conn->prepare($accdesc_query);
                $accdesc_run->bind_param("s", $_SESSION['username']);
                $accdesc_run->execute();
                $accdesc_result = $accdesc_run->get_result();

                if ($row = $accdesc_result->fetch_assoc()) {
                    if ($row['acc_desc'] != NULL && $row['acc_desc'] != '') {
                        $bio = $row['acc_desc'];
                    }
                }
                ?>
                <div class="card" style="width: 100%;">
                    <img src="images/profile_banner.png" class="card-img-top" alt="...">
                    <div class="card-body profile">
                        <div class="d-flex flex-row justify-content-between">
                            <div class="d-flex flex-column">
                            <img class="img-fluid rounded-circle border" src="<?php echo !empty($user['acc_pic']) ? htmlspecialchars($user['acc_pic']) : 'images/default.jpg'; ?>" width="100px" />
                                
                                <span class="fw-bold"><?php echo $user['acc_usn']; ?></span>
                                <small>@<?php echo $user['acc_usn']; ?></small>
                            </div>
                            <div class="jusify-content-end">
                                <a href="#" class="btn btn-sm btn-primary rounded-pill"><i class="fa-regular fa-share-from-square"></i></a>
                                <button type="button" class="btn btn-sm btn-warning rounded-pill text-white" data-bs-toggle="modal" data-bs-target="#staticBackdrop">
                                    <i class="fa-regular fa-pen-to-square text-white"></i> Edit
                                </button>
                                <div class="modal fade" id="staticBackdrop" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
                                    <div class="modal-dialog modal-dialog-scrollable">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h1 class="modal-title fs-5" id="staticBackdropLabel">Edit Profile</h1>
                                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                            </div>
                                            <form id="profileForm" action="update_profile.php" method="POST" enctype="multipart/form-data">
                                                <div class="modal-body" style="max-height: 60vh; overflow-y: auto;">
                                                    <div class="container-fluid">
                                                        <div class="row">
                                                            <div class="col-md-12">
                                                                <div class="d-flex flex-row justify-content-center mt-5">
                                                                    <img class="rounded-circle" id="profilePreview" src="<?php echo $userProfilePic; ?>" alt="Profile Preview"/>
                                                                </div>
                                                                <input type="file" class="form-control mt-2" id="profilePic" name="profilePic" accept="image/*">
                                                                <hr>
                                                                <div class="mb-3">
                                                                    <label for="username" class="col-form-label">Username</label>
                                                                    <input type="text" class="form-control" id="username" name="username" value="<?php echo $_SESSION['username']; ?>">
                                                                </div>
                                                                <div class="mb-3">
                                                                    <label for="bioText" class="col-form-label">Bio</label>
                                                                    <textarea class="form-control" id="bioText" name="bio" style="height: 125px;"><?php echo $bio; ?></textarea>
                                                                    <small id="charCount">0/250</small>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="modal-footer">
                                                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                                    <button type="submit" class="btn btn-primary">Save Changes</button>
                                                </div>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <p class="card-text pt-4 pb-4 text-justify"><?php echo $user['acc_desc']; ?></p>
                        <div class="col-md-12">
                            <div class="d-flex flex-row justify-content-between">
                                <a href="#" class="link-offset-2 link-underline link-underline-opacity-0 fw-bold text-primary ps-5">My Post<p class="row border-primary border-bottom align-items-end"></p></a>
                                <a href="#" class="link-offset-2 link-underline link-underline-opacity-0 fw-bold text-primary">Likes</a>
                                <a href="#" class="link-offset-2 link-underline link-underline-opacity-0 fw-bold text-primary pe-5">Bookmarks</a>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="card" style="width: 100%;">
                    <div class="card-body">
                        <?php
                        if ($result->num_rows > 0) {
                            while ($row = $result->fetch_assoc()) { ?>
                                <div class="note rounded-4 p-4 border-0">
                                    <div class="d-flex align-items-center mb-0">
                                        <img class="rounded-circle me-2" src="<?php echo $user['acc_pic']; ?>" style="width: 6%; box-shadow: rgba(0, 0, 0, 0.24) 0px 3px 8px;">
                                        <p class="text-left ps-1 fw-bold mb-0"><?php echo htmlspecialchars($user['acc_usn']); ?></p>
                                        <p class="text-left ps-2 mb-0">@<?php echo htmlspecialchars($user['acc_usn']);?></p>
                                        <p class="text-left ps-2 mb-0">• <?php echo date('d, M Y', strtotime($row['nt_timepost'])); ?></p>
                                    </div>
                                    <p class="ps-5 me-4 mt-0 text-justify"><?php echo nl2br(htmlspecialchars($row['nt_text'])); ?></p>
                                    <?php if (!empty($row['nt_filename']) && $row['nt_filename'] != 'NULL'): ?>
                                        <div class="post-image mt-2">
                                            <img src="../uploads/<?php echo htmlspecialchars($row['nt_filename']); ?>" alt="User uploaded image" />
                                        </div>   
                                    <?php endif; ?>
                                    <div class="row">
                                        <div class="col-md-6 ms-5 mt-3">
                                            <a class="link-success link-offset-2 link-underline link-underline-opacity-0" href="#"><i class="fa-solid fa-up-long"></i> <span class="fw-bold"><?php echo $row['nt_rating_up']; ?></span></a>
                                            <a class="link-danger link-offset-2 link-underline link-underline-opacity-0 ms-3" href="#"><i class="fa-solid fa-down-long"></i> <span class="fw-bold"><?php echo $row['nt_rating_down']; ?></span></a>
                                            <a class="link-warning link-offset-2 link-underline link-underline-opacity-0 ms-3" href="#"><i class="fa-solid fa-pen-to-square"></i> <span class="fw-bold">Edit</span></a>
                                        </div>
                                    </div>
                                </div>
                            <?php }
                        } else { ?>
                            <div class="text-center my-5 py-5">
                                <i class="fa-regular fa-comment-dots fa-4x text-muted mb-3"></i>
                                <h4 class="text-muted">You haven't posted anything yet</h4>
                                <p class="text-muted">Share your thoughts by creating your first post!</p>
                            </div>
                        <?php } ?>
                    </div>
                </div>
            </div>

            <style>
                .col-md-6::-webkit-scrollbar { display: none; }
                .col-md-6 { -ms-overflow-style: none; scrollbar-width: none; }
            </style>

            <div class="col-md-3 bg-white vh-100" style="overflow-y: auto; -ms-overflow-style: none; scrollbar-width: none;">
                <div class="card bg-secondary-subtle border rounded-4 mx-2 mt-4" style="box-shadow: rgba(0, 0, 0, 0.1) 0px 4px 6px -1px, rgba(0, 0, 0, 0.06) 0px 2px 4px -1px;">
                    <div class="d-flex flex-row justify-content-between p-2">
                        <span class="ms-2 mt-1">Hallo, <?php echo $_SESSION['username']; ?>!</span>
                        <img class="rounded-circle me-2" src="<?php echo $userProfilePic; ?>" style="width: 10%; box-shadow: rgba(0, 0, 0, 0.1) 0px 4px 6px -1px, rgba(0, 0, 0, 0.06) 0px 2px 4px -1px;">
                    </div> 
                </div>

                <?php
                $rand_img = "SELECT nt_filename FROM comnote WHERE nt_filename IS NOT NULL ORDER BY RAND() LIMIT 6";
                $img_result = $conn->query($rand_img);
                $images = [];
                while ($row = $img_result->fetch_assoc()) {
                    $images[] = $row['nt_filename'];
                }
                ?>
                <div class="image-grid mt-2">
                    <?php foreach ($images as $index => $image) : ?>
                        <div class="grid-item">
                            <img src="../uploads/<?php echo $image; ?>" alt="Image <?= $index + 1 ?>" onerror="this.style.display='none'">
                        </div>
                    <?php endforeach; ?>
                </div>

                <?php 
$usr_random = "SELECT acc_usn, acc_pic FROM accounts ORDER BY RAND() LIMIT 3";
$random_result = $conn->query($usr_random);
$users_random = [];
if ($random_result->num_rows > 0) {
    while ($row = $random_result->fetch_assoc()) {
        $users_random[] = $row;
    }
}
?>
<div class="card bg-secondary-subtle border-white rounded-4 mb-3 mx-2 mt-2">
    <div class="card-body">
        <h5 class="card-title mb-3 fw-bold">Maybe you like this</h5>
        <?php foreach ($users_random as $user) : ?>
        <div class="follow-card">
            <a href="view_profile.php?nt_name=<?php echo urlencode($user['acc_usn']); ?>" class="follow-user-link">
                <div class="follow-user">
                    <img src="<?php echo $user['acc_pic'] ? htmlspecialchars($user['acc_pic']) : 'images/default.jpg'; ?>" class="follow-user-img">
                    <div class="follow-user-info">
                        <span class="follow-user-name"><?php echo htmlspecialchars($user['acc_usn']); ?></span>
                        <span class="follow-user-handle">@<?php echo htmlspecialchars($user['acc_usn']); ?></span>
                    </div>
                </div>
            </a>
            <button class="follow-button bg-primary">Follow</button>
        </div>
        <?php endforeach; ?>
    </div>
</div>

                <div class="card bg-secondary-subtle border-white rounded-4 mb-3 mx-2 mt-2">
                    <?php 
                    $trending = "SELECT nt_name, nt_text, nt_rating_up FROM comnote ORDER BY nt_rating_up DESC LIMIT 3";
                    $trending_result = $conn->query($trending);
                    ?>
                    <div class="card-body">
                        <h5 class="card-title mb-3 fw-bold">Trending <span class="text-primary"><i class="fa-solid fa-arrow-trend-up"></i></span></h5>
                        <?php while ($row = mysqli_fetch_assoc($trending_result)) { ?>
                        <div class="trending rounded-4 p-1">
                            <span>@<?php echo htmlspecialchars($row['nt_name']); ?></span>
                            <p class="fw-bold"><?php echo htmlspecialchars($row['nt_text']); ?></p>
                        </div>
                        <?php } ?>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        document.getElementById('postredirect')?.addEventListener('click', function() {
            window.location.href = "/post";
        });

        document.addEventListener("DOMContentLoaded", function () {
            const paragraphs = document.querySelectorAll(".trending p");
            paragraphs.forEach(paragraph => {
                let words = paragraph.innerText.split(" ");
                if (words.length > 7) {
                    let truncatedText = words.slice(0, 7).join(" ") + " ...";
                    paragraph.innerText = truncatedText;
                }
            });
        });

        // Preview gambar profile saat upload
        document.getElementById('profilePic')?.addEventListener('change', function(e) {
            const file = e.target.files[0];
            if (file) {
                const reader = new FileReader();
                reader.onload = function(e) {
                    const img = new Image();
                    img.onload = function() {
                        const canvas = document.createElement('canvas');
                        const ctx = canvas.getContext('2d');
                        const size = Math.min(img.width, img.height);
                        canvas.width = size;
                        canvas.height = size;
                        const offsetX = (img.width - size) / 2;
                        const offsetY = (img.height - size) / 2;
                        ctx.drawImage(img, offsetX, offsetY, size, size, 0, 0, size, size);
                        document.getElementById('profilePreview').src = canvas.toDataURL('image/jpeg');
                    };
                    img.src = e.target.result;
                };
                reader.readAsDataURL(file);
            }
        });

        // Penghitung karakter untuk bio
        const bioText = document.getElementById('bioText');
        const charCount = document.getElementById('charCount');

        bioText.addEventListener('input', function() {
            let currentLength = this.value.length;
            if (currentLength > 250) {
                this.value = this.value.substring(0, 250);
                currentLength = 250;
            }
            charCount.textContent = `${currentLength}/250`;
        });

        window.addEventListener('load', function() {
            const initialLength = bioText.value.length;
            charCount.textContent = `${initialLength}/250`;
        });
    </script>
</body>
</html>