<?php
session_start();
require_once('../cndataconnect.php');

// Pastikan pengguna sudah login
if (!isset($_SESSION['username'])) {
    header("Location: login.php");
    exit();
}

$current_username = $_SESSION['username'];

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Get new username and bio from form
    $new_username = $_POST['username'];
    $bio = $_POST['bio']; // Remove htmlspecialchars here!

    // Handle profile picture upload
    if (isset($_FILES['profilePic']) && $_FILES['profilePic']['error'] == UPLOAD_ERR_OK) {
        $fileTmpPath = $_FILES['profilePic']['tmp_name'];
        $fileName = $_FILES['profilePic']['name'];
        $fileSize = $_FILES['profilePic']['size'];
        $fileType = $_FILES['profilePic']['type'];

        $uploadDir = '../uploads/profile_pics/';
        if (!file_exists($uploadDir)) {
            mkdir($uploadDir, 0777, true);
        }

        $newFileName = $current_username . '_' . time() . '.' . pathinfo($fileName, PATHINFO_EXTENSION);
        $destPath = $uploadDir . $newFileName;

        list($width, $height) = getimagesize($fileTmpPath);
        $newSize = min($width, $height);
        $cropSize = 200;

        if (strpos($fileType, 'jpeg') !== false) {
            $sourceImage = imagecreatefromjpeg($fileTmpPath);
        } elseif (strpos($fileType, 'png') !== false) {
            $sourceImage = imagecreatefrompng($fileTmpPath);
        } else {
            echo "Format gambar tidak didukung!";
            exit();
        }

        $croppedImage = imagecrop($sourceImage, [
            'x' => ($width - $newSize) / 2,
            'y' => ($height - $newSize) / 2,
            'width' => $newSize,
            'height' => $newSize
        ]);

        $finalImage = imagecreatetruecolor($cropSize, $cropSize);
        imagecopyresampled($finalImage, $croppedImage, 0, 0, 0, 0, $cropSize, $cropSize, $newSize, $newSize);
        imagejpeg($finalImage, $destPath, 90);

        imagedestroy($sourceImage);
        imagedestroy($croppedImage);
        imagedestroy($finalImage);

        $query = "UPDATE accounts SET acc_pic = ? WHERE acc_usn = ?";
        $stmt = $conn->prepare($query);
        $stmt->bind_param("ss", $destPath, $current_username);
        $stmt->execute();
    }

    // Update bio
    $query = "UPDATE accounts SET acc_desc = ? WHERE acc_usn = ?";
    $stmt = $conn->prepare($query);
    $stmt->bind_param("ss", $bio, $current_username);
    $stmt->execute();

    // Update username if it has changed
    if ($new_username !== $current_username) {
        // First check if the new username is already taken
        $check_query = "SELECT acc_usn FROM accounts WHERE acc_usn = ?";
        $check_stmt = $conn->prepare($check_query);
        $check_stmt->bind_param("s", $new_username);
        $check_stmt->execute();
        $result = $check_stmt->get_result();
        
        if ($result->num_rows == 0) {
            // Update username in accounts table
            $update_query = "UPDATE accounts SET acc_usn = ? WHERE acc_usn = ?";
            $update_stmt = $conn->prepare($update_query);
            $update_stmt->bind_param("ss", $new_username, $current_username);
            $update_stmt->execute();
            
            // Update username in comnote table (and any other tables that reference the username)
            $update_notes_query = "UPDATE comnote SET nt_name = ? WHERE nt_name = ?";
            $update_notes_stmt = $conn->prepare($update_notes_query);
            $update_notes_stmt->bind_param("ss", $new_username, $current_username);
            $update_notes_stmt->execute();
            
            // Update the session variable
            $_SESSION['username'] = $new_username;
        }
    }

    header("Location: profile.php");
    exit();
}
?>