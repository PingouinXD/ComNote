<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);
session_start();
$servername = "sql309.infinityfree.com"; 
$username = "if0_38160015"; 
$password = "winata14072006"; 
$dbname = "if0_38160015_test1"; 

$conn = new mysqli($servername, $username, $password, $dbname);
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

date_default_timezone_set("Asia/Jakarta"); 

$name = $_SESSION['username'];
$text = $_POST['text'];
$time = date("d-m-Y H:i:s");

$uploadDir = "uploads/";
$filePath = NULL; 

if (!empty($_FILES["file"]["name"])) {
    $fileName = basename($_FILES["file"]["name"]);
    $filePath = $uploadDir . $fileName;
    $fileType = pathinfo($filePath, PATHINFO_EXTENSION);

    $allowedTypes = ['jpg', 'jpeg', 'png', 'gif', 'mp4', 'avi', 'mov'];
    if (in_array(strtolower($fileType), $allowedTypes)) {
        if (move_uploaded_file($_FILES["file"]["tmp_name"], $filePath)) {
            // File uploaded successfully
        } else {
            die("Error uploading file.");
        }
    } else {
        die("Invalid file type.");
    }
}

$sql = "INSERT INTO comnote (nt_name, nt_text, nt_timepost, nt_filepath, nt_filename) VALUES (?, ?, ?, ?, ?)";
$stmt = $conn->prepare($sql);
$stmt->bind_param("sssss", $name, $text, $time, $filePath, $fileName);

if ($stmt->execute()) {
    $last_id = $stmt->insert_id;
    if (!empty($_POST['tags'])) {
        $tags = $_POST['tags'];
            $sql_tag = "INSERT INTO post_type (post_id, assign_type_id, assign_type_id2, assign_type_id3) VALUES (?, ?, ?, ?)";
            $stmt_tag = $conn->prepare($sql_tag);
            $stmt_tag->bind_param("iiii", $last_id, $tags[0], $tags[1], $tags[2]);
            $stmt_tag->execute();
            $stmt_tag->close();
    }
    echo "success";
} else {
    echo "Error: " . $stmt->error;
}

$stmt->close();
$conn->close();
?>
