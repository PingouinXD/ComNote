<?php
header('Content-Type: application/json');
include 'cndataconnect.php';
// JANGAN LUPA DBNYA DIGANTI

if ($conn->connect_error) {
    die(json_encode(["error" => "Koneksi gagal: " . $conn->connect_error]));
}
   // MESSAGES UBAH DENGAN NAMA STRUKTUR DB YANG BARU INGAT MESSAGE BUKAN MESSAGES
$result = $conn->query("SELECT * FROM comnote ORDER BY RAND();");
$messages = [];

while ($row = $result->fetch_assoc()) {
    $messages[] = [
        "id" => $row["nt_num"],
        "text" => $row["nt_text"],
        "created_at" => $row["nt_timepost"]
    ];
}
// TAMBAHIN APA MAU DIMASUKAN YANG ADA DALAM DATABE CONTOHNYA ID,NAMA,TEXT,AKUN DLL

// echo json_encode($messages);
?>
