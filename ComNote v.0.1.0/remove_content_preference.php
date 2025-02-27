<?php
session_start();
require 'cndataconnect.php'; // Koneksi ke database

if (isset($_POST['item_id']) && isset($_SESSION['username'])) {
    $user_id = $_SESSION['username'];
    $item_id = $_POST['item_id'];
    // echo "User: " . htmlspecialchars($user_id) . " - Item: " . htmlspecialchars($item_id); // Debugging output
    $sql = "INSERT INTO user_preferences (pref_name, pref_text_id)
            SELECT a.acc_usn, c.nt_num
            FROM accounts a, comnote c
            WHERE a.acc_usn = ?
            AND c.nt_num = ?;";
    $stmt = $pdo->prepare($sql);
    
    if ($stmt->execute([$user_id, $item_id])) {
        echo "success";
    } else {
        echo "error";
    }
}
 else {
    echo "Invalid request";
}
?>
