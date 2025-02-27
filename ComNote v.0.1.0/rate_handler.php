<?php
session_start();
require_once('cndataconnect.php');

if (!isset($_SESSION['username'])) {
    echo json_encode(["status" => "error", "message" => "User not logged in."]);
    exit();
}

$user_id = $_SESSION['username'];
$note_id = (int)$_POST['nt_num'];
$vote_types = $_POST['vote_type']; // 'up' or 'down'
echo $vote_types;

if ($vote_types !== 'up' && $vote_types !== 'down') {
    echo json_encode(["status" => "error", "message" => "Invalid vote type."]);
    exit();
}

// Determine the column to update
$vote_column = ($vote_types === 'up') ? 'nt_rating_up' : 'nt_rating_down';
$opposite_column = ($vote_types === 'up') ? 'nt_rating_down' : 'nt_rating_up';

// Check if user has already voted on this note
$sql = "SELECT nt_rating_up, nt_rating_down FROM comnote WHERE nt_num = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("i", $note_id);
$stmt->execute();
$result = $stmt->get_result();
$existing_vote = $result->fetch_assoc();

if ($existing_vote) {
    // If the user is changing their vote, update it
    if ($existing_vote[$vote_column] == 0) {
        // Increase the selected vote type
        $sql = "UPDATE comnote SET $vote_column = $vote_column + 1 WHERE nt_num = ?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("i", $note_id);
        $stmt->execute();
    } elseif ($existing_vote[$vote_column] == 1) {
        // User is removing their vote
        $sql = "UPDATE comnote SET $vote_column = $vote_column - 1 WHERE nt_num = ?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("i", $note_id);
        $stmt->execute();
    }
    
    // Ensure opposite vote type is reset to prevent double votes
    if ($existing_vote[$opposite_column] == 1) {
        $sql = "UPDATE comnote SET $opposite_column = $opposite_column - 1 WHERE nt_num = ?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("i", $note_id);
        $stmt->execute();
    }
} else {
    // Insert new vote
    $sql = "UPDATE comnote SET $vote_column = $vote_column + 1 WHERE nt_num = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $note_id);
    $stmt->execute();
}

echo json_encode(["status" => "success", "message" => "Vote updated!"]);
?>
