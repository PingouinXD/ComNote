<!DOCTYPE html>
<html><head>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
</head><body>
<h5 class="mt-4 mx-auto text-center fw-bold"><i class="fa-solid fa-arrow-trend-up"></i> Trending</h5>
<div class="overflow-auto" style="max-height: 1000px; -ms-overflow-style: none; scrollbar-width: none;">
    <?php
    $servername = "sql309.infinityfree.com"; // Your server name
    $username = "if0_38160015"; // Your database username
    $password = "winata14072006"; // Your database password
    $dbname = "if0_38160015_test1"; // Your database name

    $conn = new mysqli($servername, $username, $password, $dbname);
    // require_once 'inc/cssjava.php';
    // require_once 'cndataconnect.php';
    $sql2 = "SELECT * FROM comnote";
    $result2 = $conn->query($sql2);

if (!$result2) {
    die("Query failed: " . $conn->error); // Show error if query fails
}
else{
    echo("connected");
}

    
     $row = [];
    while ($row = $result2->fetch_assoc()): ?>
        <div class="note card mx-auto mb-3 rounded-4" style="width: 80%; padding: 10px;">
            <div class="card-body">
                <p><?= htmlspecialchars($row['nt_text']) ?></p>
                <p>Rating: <?= $row['nt_rating_up'] ?></p>
                <!-- <a href="cndata2.php?vote=up&id=<?= $row['nt_num'] ?>" class="btn btn-sm btn-outline-primary"><i class="fa-solid fa-heart"></i> Love</a> -->
                <a href="cndata2.php?vote=up&id=<?= $row['nt_num'] ?>" class="btn btn-sm btn-outline-primary"><i class="fa-solid fa-heart"></i> Love</a>
                <a href="cndata2.php?vote=down&id=<?= $row['nt_num'] ?>" class="btn btn-sm btn-outline-danger"><i class="fa-solid fa-heart-crack"></i> Dont Love</a>
            </div>
        </div>
    <?php endwhile; ?>
</div>
    </body>
    </html>