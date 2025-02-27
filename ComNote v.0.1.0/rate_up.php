<?php
header('Content-Type: application/json');
error_reporting(0);
ini_set('display_errors', 0);

session_start();

$servername = "sql309.infinityfree.com";
$username = "if0_38160015";
$password = "winata14072006";
$dbname = "if0_38160015_test1";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die(json_encode(["status" => "error", "message" => "Connection failed: " . $conn->connect_error]));
}

// Ambil data JSON dari request
$data = json_decode(file_get_contents("php://input"), true);

if(!$_COOKIE['guest_id']){



if (isset($data['post_id'])) {
    $post_id = intval($data['post_id']);
    $user_name = $_SESSION['username'] ?? null;

    if (!$user_name) {
        echo json_encode(["status" => "error", "message" => "User not logged in"]);
        exit();
    }
    
    // Ambil assign type dari database atau sesuaikan dengan logika yang sesuai
    $query = "SELECT assign_type_id, assign_type_id2, assign_type_id3 FROM post_type WHERE post_id = ?";
    $stmt = $conn->prepare($query);
    $stmt->bind_param("i", $post_id);
    $stmt->execute();
    $result = $stmt->get_result();
    $users = $result->fetch_assoc();
    $stmt->close();

    if (!$users) {
        echo json_encode(["status" => "error", "message" => "Post not found"]);
        exit();
    }

    $tags = [$users['assign_type_id'], $users['assign_type_id2'], $users['assign_type_id3']];

    // **STEP 1: Update `nt_rating_up`**
    $sql = "UPDATE comnote SET nt_rating_up = nt_rating_up + 1 WHERE nt_num = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $post_id);

    if (!$stmt->execute()) {
        echo json_encode(["status" => "error", "message" => "Error updating post rating: " . $stmt->error]);
        exit();
    }
    $stmt->close();

    // Ambil nilai `nt_rating_up` terbaru
    $result = $conn->query("SELECT nt_rating_up FROM comnote WHERE nt_num = $post_id");
    $row = $result->fetch_assoc();
    $new_rating = $row['nt_rating_up'];

    // **STEP 2: Update `user_interactions` berdasarkan tags**
    foreach ($tags as $tag) {
        if ($tag !== null) {
            // Cek apakah interaksi sudah ada
            $check_sql = "SELECT interact_id FROM user_interactions WHERE interact_usn = ? AND interact_type = ?";
            $stmt = $conn->prepare($check_sql);
            $stmt->bind_param("si", $user_name, $tag);
            $stmt->execute();
            $result = $stmt->get_result();
            $interaction = $result->fetch_assoc();
            $stmt->close();

            if ($interaction) {
                // Jika sudah ada, lakukan UPDATE
                $update_sql = "UPDATE user_interactions SET interactions = interactions + 1 WHERE interact_usn = ? AND interact_type = ?";
                $stmt = $conn->prepare($update_sql);
                $stmt->bind_param("si", $user_name, $tag);
                $stmt->execute();
                $stmt->close();
            } else {
                // Jika belum ada, lakukan INSERT
                $insert_sql = "INSERT INTO user_interactions (interact_usn, interact_type, interactions) VALUES (?, ?, 1)";
                $stmt = $conn->prepare($insert_sql);
                $stmt->bind_param("si", $user_name, $tag);
                $stmt->execute();
                $stmt->close();
            }
        }
    }

    // **STEP 3: Kirim response**
    echo json_encode(["status" => "success", "new_rating" => $new_rating, "message" => "Interactions updated"]);

} else {
    echo json_encode(["status" => "error", "message" => "Post ID not provided"]);
}
}
if($_COOKIE['guest_id']){
    $post_id = intval($data['post_id']);
    $query = "SELECT assign_type_id, assign_type_id2, assign_type_id3 FROM post_type WHERE post_id = ?";
    $stmt = $conn->prepare($query);
    $stmt->bind_param("i", $post_id);
    $stmt->execute();
    $result = $stmt->get_result();
    $users = $result->fetch_assoc();
    $stmt->close();
    $categories = [
        "Technology" => isset($_COOKIE['Technology']) ? (int) $_COOKIE['Technology'] : 0,
        "Science" => isset($_COOKIE['Science']) ? (int) $_COOKIE['Science'] : 0,
        "Politic" => isset($_COOKIE['Politic']) ? (int) $_COOKIE['Politic'] : 0,
        "Entertainment" => isset($_COOKIE['Entertainment']) ? (int) $_COOKIE['Entertainment'] : 0,
    ];
    // foreach($users as $user){
        if ($users['assign_type_id'] == 1 || $users['assign_type_id2'] == 1 || $users['assign_type_id3'] == 1 ){
            // $counter = $_COOKIE['Technology'];
            setcookie("Technology", $categories['Technology'] + 1, time() + (60 * 60 * 24 * 30), "/");
        } 
        if ($users['assign_type_id'] == 2 || $users['assign_type_id2'] == 2 || $users['assign_type_id3'] == 2 ){
            // $counter = $_COOKIE['Science'];
            setcookie("Science", $categories['Science'] + 1, time() + (60 * 60 * 24 * 30), "/");
        } 
        if ($users['assign_type_id'] == 3 || $users['assign_type_id2'] == 3 || $users['assign_type_id3'] == 3 ){
            // $counter = $_COOKIE['Politic'];
            setcookie("Politic", $categories['Politic'] + 1, time() + (60 * 60 * 24 * 30), "/");
        } 
        if ($users['assign_type_id'] == 4 || $users['assign_type_id2'] == 4 || $users['assign_type_id3'] == 4 ){
            // $counter = $_COOKIE['Entertainment'];
            setcookie("Entertainment",$categories['Entertainment'] + 1, time() + (60 * 60 * 24 * 30), "/");
        }
    // }
}
$conn->close();

?>
