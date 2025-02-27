<?php
 session_start();
    $servername = "sql309.infinityfree.com"; // Your server name
    $username = "if0_38160015"; // Your database username
    $password = "winata14072006"; // Your database password
    $dbname = "if0_38160015_test1"; // Your database name

    try {
        // Membuat koneksi ke database menggunakan PDO
        $pdo = new PDO("mysql:host=$servername;dbname=$dbname;charset=utf8", $username, $password);
        
        // Set mode error agar bisa menangkap error jika terjadi
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    
        // Set agar hasil query berupa array asosiatif
        $pdo->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);
    
        // echo "Koneksi berhasil!";
    } catch (PDOException $e) {
        // Menampilkan error jika koneksi gagal
        die("Koneksi gagal: " . $e->getMessage());
    }

    $conn = new mysqli($servername, $username, $password, $dbname);

    // if ($conn->connect_error) {
    //     die("Connection failed: " . $conn->connect_error);
    // }
    
    // Fetch data from the database
    // $sql = "SELECT nt_num, nt_name, nt_text, nt_timepost, nt_rating_up, nt_rating_down FROM comnote";
    // $result = $conn->query($sql);
    $current_user_id = $_SESSION['username']; 
    // echo($_SESSION['username']);
    if($_COOKIE['firsttime'] == 1){
        $sql = "SELECT DISTINCT c.*, p.*
                FROM comnote c
                LEFT JOIN post_type p 
                    ON p.post_id = c.nt_num
                LEFT JOIN user_interactions ui 
                    ON p.assign_type_id = ui.interact_type AND ui.interact_usn = :current_user_id
                WHERE (ui.interactions IS NULL OR ui.interactions > 0)
                AND c.nt_num NOT IN (
                SELECT pref_text_id FROM user_preferences WHERE pref_name = :current_user_id )
                ORDER BY ui.interactions DESC, RAND();";
        $stmt = $pdo->prepare($sql);
        $stmt->bindParam(':current_user_id', $current_user_id, PDO::PARAM_STR);
        $stmt->execute();
        $users = $stmt->fetchAll();
    }
    else{
        $sql = "SELECT c.*, p.*
FROM comnote c
LEFT JOIN post_type p 
    ON p.post_id = c.nt_num
LEFT JOIN user_interactions ui 
    ON p.assign_type_id = ui.interact_type 
    AND ui.interact_usn = :current_user_id
WHERE c.nt_num NOT IN (
    SELECT pref_text_id FROM user_preferences WHERE pref_name = :current_user_id
)
AND ui.interact_type = (
    SELECT interact_type 
    FROM user_interactions 
    WHERE interact_usn = :current_user_id
    ORDER BY interactions DESC
    LIMIT 1
)
ORDER BY ui.interactions DESC;";
    // $sql = "SELECT c.* FROM comnote c
    //     LEFT JOIN user_preferences u
    //     ON c.nt_num = u.pref_text_id AND u.pref_name = :current_user_id
    //     WHERE u.pref_text_id IS NULL";
    // Siapkan query
    $stmt = $pdo->prepare($sql);
$stmt->bindParam(':current_user_id', $current_user_id, PDO::PARAM_STR);
$stmt->execute();
$users = $stmt->fetchAll();
    }

    if($_COOKIE['guest_id'] && $_COOKIE['firsttime'] == 0){

        $cookie_names = ['Technology', 'Science', 'Politic', 'Entertainment'];

        $max_value = 0;
        $max_cookie_name = '';

        foreach ($cookie_names as $name) {
            if (isset($_COOKIE[$name])) { // Pastikan cookie ada
                $value = (int) $_COOKIE[$name]; // Konversi ke integer
                // echo($value);
                if ($value > $max_value) { // Cek apakah lebih besar dari max sebelumnya
                $max_value = $value;
                $max_cookie_name = $name;
            }
        // echo($max_cookie_name);
    }
}
switch($max_cookie_name){
    case "Technology": $maxnamevalue = 1; break;
    case "Science" : $maxnamevalue = 2;break;
    case "Politic": $maxnamevalue = 3;break;
    case "Entertainment": $maxnamevalue = 4;break;
    default: $maxnamevalue = 0;
}
// echo($maxnamevalue  ." ".$max_value);
        $sql = "SELECT c.*, p.*
FROM comnote c
JOIN post_type p 
    ON p.post_id = c.nt_num
WHERE (p.assign_type_id = :maxvalue OR p.assign_type_id2 = :maxvalue OR p.assign_type_id3 = :maxvalue);";
    $stmt = $pdo->prepare($sql);
$stmt->bindParam(':maxvalue', $maxnamevalue, PDO::PARAM_STR);
$stmt->execute();
$users = $stmt->fetchAll();
    }

//  var_dump($users);
 // Hentikan eksekusi untuk memeriksa data

    // if ($result->num_rows > 0) {
    //     while ($row = $result->fetch_assoc()) {
    //         $users[] = $row;
    //     }
    // }
    // $sqll = "SELECT nt_name, nt_text, nt_timepost, nt_rating_up FROM comnote ORDER BY nt_rating_up DESC LIMIT 3";
    // $resultt = $conn->query($sqll);
    // $trending = [];

    // if ($resultt->num_rows > 0) {
    //     while ($roww = $resultt->fetch_assoc()) {
    //         $trending[] = $roww;
    //     }
    // } else {
    //     die("Query failed: " . $conn->error); // Debugging error message
    // }

    // $conn->close();
?>