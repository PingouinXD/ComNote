<?php
include('koneksi.php'); // Pastikan Anda menghubungkan dengan database terlebih dahulu

$type = $_GET['type']; // Mendapatkan parameter 'type' yang dikirim dari frontend

// Query untuk mengambil data trending
if ($type == 'liked') {
    // Ambil data berdasarkan jumlah upvotes tertinggi
    $sql = "SELECT * FROM posts ORDER BY upvotes DESC LIMIT 10";
} elseif ($type == 'disliked') {
    // Ambil data berdasarkan jumlah downvotes tertinggi
    $sql = "SELECT * FROM posts ORDER BY downvotes DESC LIMIT 10";
} else {
    // Default jika parameter 'type' tidak sesuai
    echo "Invalid type parameter.";
    exit;
}

// Eksekusi query
$result = $conn->query($sql);

// Cek apakah ada hasil
if ($result->num_rows > 0) {
    // Menampilkan data
    while ($row = $result->fetch_assoc()) {
        echo "<div class='post'>";
        echo "<h3>" . htmlspecialchars($row['title']) . "</h3>";
        echo "<p>" . htmlspecialchars($row['content']) . "</p>";
        echo "<p><strong>Upvotes: " . $row['upvotes'] . " | Downvotes: " . $row['downvotes'] . "</strong></p>";
        echo "</div>";
    }
} else {
    echo "No posts found.";
}

$conn->close(); // Jangan lupa menutup koneksi
?>
