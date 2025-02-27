<?php
// Koneksi ke database
include 'cndataconnect.php';
if ($conn->connect_error) {
    die("connection failed: " . $conn->connect_error);
}

// Ambil pesan dari database(BISA DIUBAH)
$result = $conn->query("SELECT * FROM comnote ORDER BY RAND();");
?>

<!DOCTYPE html>
<html lang="id">

<head>
    <title>Browse - Community Notes</title>
    <link rel="apple-touch-icon" sizes="180x180" href="images/apple-touch-icon.png"> <!--Logo-->
    <link rel="icon" type="image/png" sizes="32x32" href="images/favicon-32x32.png"> <!--Logo-->
    <link rel="icon" type="image/png" sizes="16x16" href="images/favicon-16x16.png"> <!--Logo-->
    <link rel="manifest" href="images/site.webmanifest"> <!--Logo-->
    <!-- <link rel="stylesheet" href="css/bootstrap.min.css"> -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.2/css/all.min.css"> <!--CSS-->
    <link href="https://fonts.googleapis.com/css2?family=Raleway:ital,wght@0,100..900;1,100..900&display=swap"
        rel="stylesheet"> <!--Fonts-->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <!--Bootstrap-->
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f5f5f5;
            overflow: hidden;
            margin: 0;
            padding: 0;
        }

        .sticky-container {
            position: relative;
            width: 100vw;
            height: 100vh;
        }

        .sticky-note {
            position: absolute;
            padding: 15px;
            box-shadow: 4px 4px 10px rgba(0, 0, 0, 0.3);
            font-size: 14px;
            font-family: 'Comic Sans MS', cursive, sans-serif;
            border-radius: 8px;
            word-wrap: break-word;
            white-space: pre-wrap;
            cursor: grab;
            opacity: 0;
        }

        /* Animasi masuk dari kiri */
        @keyframes fly-in-left {
            0% {
                opacity: 0;
                transform: translateX(-100vw) rotate(var(--rotation));
            }

            100% {
                opacity: 1;
                transform: translateX(0) rotate(var(--rotation));
            }
        }

        /* Animasi masuk dari kanan */
        @keyframes fly-in-right {
            0% {
                opacity: 0;
                transform: translateX(100vw) rotate(var(--rotation));
            }

            100% {
                opacity: 1;
                transform: translateX(0) rotate(var(--rotation));
            }
        }

        .form-container {
            position: fixed;
            bottom: 10px;
            left: 50%;
            transform: translateX(-50%);
            background: white;
            padding: 10px;
            box-shadow: 0px 0px 5px rgba(0, 0, 0, 0.2);
            width: 100%;
            max-width: 500px;
            border-radius: 10px;
            resize: both;
            overflow: auto;
            cursor: grab;
        }

        textarea {
            width: 100%;
            height: 100px;
            resize: none;
            padding: 10px;
            border-radius: 5px;
            border: 1px solid #ccc;
            font-size: 14px;
            font-family: 'Comic Sans MS', cursive, sans-serif;
            box-sizing: border-box;
        }

        button {
            width: 100%;
            padding: 10px;
            background-color: #ffeb3b;
            border: none;
            cursor: pointer;
            font-size: 16px;
            font-weight: bold;
            border-radius: 5px;
        }

        button:hover {
            background-color: #ffca28;
        }
    </style>
</head>

<body>
    <a class="btn btn-primary rounded-pill mx-auto px-4 mt-2" href="\communitynotes" style="z-index:100;">Back</a>
    <div class="sticky-container">
        <!-- Menampilkan Sticky Notes Secara Acak -->
        <?php while ($row = $result->fetch_assoc()): ?>
            <?php
            // Bentuk & ukuran random (horizontal atau vertikal)
            $isHorizontal = rand(0, 1); // 0 untuk horizontal, 1 untuk vertikal
            $width = $isHorizontal ? rand(280, 400) : rand(200, 280);
            $height = $isHorizontal ? rand(200, 280) : rand(280, 400);
            // Warna random
            $colors = ['#fffa90', '#ffeb3b', '#90caf9', '#ff8a65', '#c5e1a5'];
            $randomColor = $colors[array_rand($colors)];
            ?>
            <div class="sticky-note" style="
        /* POSISI DAN ROTASI ACAK */
            left: <?= rand(5, 85) ?>vw;
            top: <?= rand(0, 60) ?>vh;
            background-color: <?= $randomColor ?>;
            width: <?= $width ?>px;
            height: <?= $height ?>px;
            --rotation: <?= rand(-10, 10) ?>deg; ">
                <?= htmlspecialchars($row['nt_name']), " = " ?> <br>
                <?= htmlspecialchars($row['nt_text']) ?>
            </div>
        <?php endwhile; ?>
    </div>

    <!-- <div class="form-container" id="commentBox">
    <form action="save.php" method="post">
        <textarea name="message" placeholder="Tulis pesan..." required></textarea>
        <button type="submit">Kirim</button>
    </form>
</div> -->

    <script>
        // MEMASTIKAN BAHWA SCRIPT DIJALANKAN SETELAH HTML DIMUAT
        document.addEventListener("DOMContentLoaded", function () {
            // MENGAMBIL SEMUA ELEMENT STICKY NOTE
            const notes = Array.from(document.querySelectorAll(".sticky-note")).slice(-20);

            notes.forEach((note, index) => {
                setTimeout(() => {
                    // 50 PERSEN STICKY NOTE AKAN DARI KIRI SISANYA DARI KANAN
                    const isLeft = Math.random() < 0.5;
                    note.style.animation = isLeft ? "fly-in-left 1s forwards" : "fly-in-right 1s forwards";
                    note.style.opacity = 1;
                    makeDraggable(note);
                }, index * 3000);
            });

            function makeDraggable(element) {
                let offsetX, offsetY, isDragging = false;

                element.addEventListener("mousedown", (e) => {
                    isDragging = true;
                    offsetX = e.clientX - element.getBoundingClientRect().left;
                    offsetY = e.clientY - element.getBoundingClientRect().top;
                    element.style.zIndex = 1000;
                });

                document.addEventListener("mousemove", (e) => {
                    if (isDragging) {
                        element.style.left = `${e.clientX - offsetX}px`;
                        element.style.top = `${e.clientY - offsetY}px`;
                    }
                });

                document.addEventListener("mouseup", () => {
                    isDragging = false;
                    element.style.zIndex = "";
                });
            }

            // Dragging comment box
            // const commentBox = document.getElementById("commentBox");
            // let offsetX, offsetY, isDragging = false;
            // commentBox.addEventListener("mousedown", (e) => {
            //     if (!e.target.matches("textarea, button")) {
            //         isDragging = true;
            //         offsetX = e.clientX - commentBox.getBoundingClientRect().left;
            //         offsetY = e.clientY - commentBox.getBoundingClientRect().top;
            //         commentBox.style.zIndex = 1000;
            //     }
            // });

            // document.addEventListener("mousemove", (e) => {
            //     if (isDragging) {
            //         commentBox.style.left = `${e.clientX - offsetX}px`;
            //         commentBox.style.top = `${e.clientY - offsetY}px`;
            //     }
            // });

            // document.addEventListener("mouseup", () => {
            //     isDragging = false;
            //     commentBox.style.zIndex = "";
            // });
        });
    </script>

</body>

</html>