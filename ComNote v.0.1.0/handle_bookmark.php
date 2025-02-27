<?php
session_start();
include 'cndataconnect.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $data = json_decode(file_get_contents('php://input'), true);
    $postId = $data['post_id'];
    $isBookmarked = $data['is_bookmarked'];

    $userId = $_SESSION['username']; // Asumsikan Anda menyimpan ID user di session

    if ($isBookmarked) {
        $sql = "INSERT INTO bookmarks (username, post_id) VALUES (?, ?)";
    } else {
        $sql = "DELETE FROM bookmarks WHERE username = ? AND post_id = ?";
    }

    $stmt = $conn->prepare($sql);
    $stmt->bind_param("si", $userId, $postId);
    $stmt->execute();

    if ($stmt->affected_rows > 0) {
        echo json_encode(["status" => "success"]);
    } else {
        echo json_encode(["status" => "error", "message" => "Failed to update bookmark"]);
    }

    $stmt->close();
    $conn->close();
}
?>