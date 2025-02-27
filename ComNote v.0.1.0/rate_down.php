<?php
header('Content-Type: application/json');

$servername = "sql309.infinityfree.com";
$username = "if0_38160015";
$password = "winata14072006";
$dbname = "if0_38160015_test1";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die(json_encode(["status" => "error", "message" => "Connection failed: " . $conn->connect_error]));
}

$data = json_decode(file_get_contents("php://input"), true);

if($_COOKIE['GuestMode'] == 0){
if (isset($data['post_id'])) {
    $post_id = intval($data['post_id']);

    if ($post_id > 0) {
        $sql = "UPDATE comnote SET nt_rating_down = nt_rating_down + 1 WHERE nt_num = ?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("i", $post_id);

        if ($stmt->execute()) {
            $result = $conn->query("SELECT nt_rating_down FROM comnote WHERE nt_num = $post_id");
            $row = $result->fetch_assoc();
            echo json_encode(["status" => "success", "new_rating" => $row['nt_rating_down']]);
        } else {
            echo json_encode(["status" => "error", "message" => "Error updating record: " . $stmt->error]);
        }

        $stmt->close();
    } else {
        echo json_encode(["status" => "error", "message" => "Invalid post ID"]);
    }
} else {
    echo json_encode(["status" => "error", "message" => "Post ID not provided"]);
}

$conn->close();
}
?>
