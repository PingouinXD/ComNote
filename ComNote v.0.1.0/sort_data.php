<?php
 /*include 'cndataconnect.php'; // Pastikan koneksi database benar

$sort = isset($_POST['sort']) ? $_POST['sort'] : 'nt_rating_up';

// Query sorting berdasarkan pilihan user
$query = "SELECT * FROM comnote ORDER BY $sort DESC";
$result = $conn->query($query);

if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        echo '<div class="card mb-3 shadow">';
        echo '<div class="card-body">';
        echo '<h5 class="card-title">' . htmlspecialchars($row['nt_name']) . '</h5>';
        echo '<p class="card-text">' . htmlspecialchars($row['nt_text']) . '</p>';
        echo '<small class="text-muted">Posted on ' . htmlspecialchars($row['nt_timepost']) . '</small>';
        echo '<div class="mt-2">';
        echo '<span class="badge bg-success">▲ ' . $row['nt_rating_up'] . '</span> ';
        echo '<span class="badge bg-danger">▼ ' . $row['nt_rating_down'] . '</span>';
        echo '</div>';
        echo '</div>';
        echo '</div>';
    }
} else {
    echo "<p class='text-center text-muted'>No data found</p>";
}

$conn->close(); */

include 'cndataconnect.php'; // Pastikan koneksi database benar
session_start();

$current_user_id = $_SESSION['username']; 
$sort = isset($_POST['sort']) ? $_POST['sort'] : 'nt_rating_up';

// Pastikan input sorting hanya sesuai kolom yang valid
$allowed_sort_columns = ['nt_rating_up', 'nt_rating_down', 'nt_timepost'];
if (!in_array($sort, $allowed_sort_columns)) {
    $sort = 'nt_rating_up'; // Default jika input tidak valid
}

// Query untuk menampilkan postingan yang tidak diblacklist oleh user tertentu dan diurutkan
$sql = "SELECT * FROM comnote 
        WHERE nt_num NOT IN (
            SELECT pref_text_id FROM user_preferences WHERE pref_name = :current_user_id
        )
        ORDER BY $sort DESC"; 

$stmt = $pdo->prepare($sql);
$stmt->bindParam(':current_user_id', $current_user_id, PDO::PARAM_STR);
$stmt->execute();
$posts = $stmt->fetchAll();

if (count($posts) > 0) {
    foreach ($posts as $row) {
        echo '<div class="card mb-3 shadow">';
        echo '<div class="card-body">';
        echo '<h5 class="card-title">' . htmlspecialchars($row['nt_name']) . '</h5>';
        echo '<p class="card-text">' . htmlspecialchars($row['nt_text']) . '</p>';
        echo '<small class="text-muted">Posted on ' . htmlspecialchars($row['nt_timepost']) . '</small>';
        echo '<div class="mt-2">';
        echo '<span class="badge bg-success">▲ ' . $row['nt_rating_up'] . '</span> ';
        echo '<span class="badge bg-danger">▼ ' . $row['nt_rating_down'] . '</span>';
        echo '</div>';
        echo '</div>';
        echo '</div>';
    }
} else {
    echo "<p class='text-center text-muted'>No data found</p>";
}
?>

?>
