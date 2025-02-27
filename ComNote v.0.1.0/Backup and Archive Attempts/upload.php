<?php
include 'cndataconnect.php';
session_start();

if ($_FILES['file']) {
    $file = $_FILES['file'];
    $fileName = $file['name'];
    $fileTmpName = $file['tmp_name'];
    $fileSize = $file['size'];
    $fileError = $file['error'];
    $fileusername = $_SESSION['username'];

    $allowed = ['jpg', 'jpeg', 'png', 'gif', 'mp4', 'avi', 'mov'];
    $fileExt = strtolower(pathinfo($fileName, PATHINFO_EXTENSION));

    if (in_array($fileExt, $allowed)) {
        if ($fileError === 0) {
            if ($fileSize < 50000000) { // Max 50MB
                $newFileName = uniqid('', true) . "." . $fileExt;
                $fileDestination = 'uploads/' . $newFileName;

                move_uploaded_file($fileTmpName, $fileDestination);

                $sql = "INSERT INTO uploads (file_username, file_name, file_path) VALUES (?, ?,?)";
                $stmt = $conn->prepare($sql);
                $stmt->bind_param("sss", $fileusername, $fileName, $fileDestination);
                $stmt->execute();

                echo "Upload sukses!";
            } else {
                echo "File terlalu besar!";
            }
        } else {
            echo "Terjadi error saat upload!";
        }
    } else {
        echo "Format tidak diizinkan!";
    }
}
?>
