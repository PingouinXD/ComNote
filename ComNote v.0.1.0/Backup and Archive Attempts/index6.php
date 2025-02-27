<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <title>Post - Community Notes</title>
    <link rel="apple-touch-icon" sizes="180x180" href="images/apple-touch-icon.png">
    <link rel="icon" type="image/png" sizes="32x32" href="images/favicon-32x32.png">
    <link rel="icon" type="image/png" sizes="16x16" href="images/favicon-16x16.png">
    <link rel="manifest" href="images/site.webmanifest">
    <style>
        h1 {
            text-align: center;
            padding: 50px;
        }
        th {
            background-color: rgba(74, 74, 74, 50%);
        }
        button#up {
            color: green;
            padding-right: 10px;
        }
        button#down {
            color: red;
            padding-left: 10px;
        }
        table {
            table-layout: fixed; /* Ensures fixed-width columns */
        }
        td#users {
            width: 100px;
            word-wrap: break-word;
        }
        td#contents {
            width: 500px;
            word-break: break-word;
            overflow-wrap: break-word;
            white-space: normal;
        }
        td#ratings {
            width: 200px;
            word-wrap: break-word;
            text-align: center;
            padding: 20px;
        }
        table {
            margin-left: auto;
            margin-right: auto;
        }
        .form-floating {
            max-width: 200px;
        }
    </style>
    
</head>
<body>
    <h1>Community Notes</h1>
    <div class="card mx-auto" style="width: 750px; border: 2px black solid;">
        <p class="mx-auto" style="margin:20px;">What do you want to post? <?php session_start(); echo $_SESSION['username']; ?></p>
        
        <form method="post" id="dataForm">
            <div class="input-group mb-3 w-50" style="margin-left: 2rem;">
                <span class="input-group-text" id="basic-addon1" style="width: 7rem;">Username</span>
                <input type="text" class="form-control" placeholder="Username" aria-label="Username" aria-describedby="basic-addon1" id="username" name="username" required>
            </div>
            <div class="input-group w-75" style="margin-left: 2rem;">
                <span class="input-group-text" style="width: 7rem;">Contents</span>
                <textarea rows="4" class="form-control" aria-label="With textarea" name="text" id="text" placeholder="Write something here!" style="width: 75%; resize: none;" required></textarea>
            </div><br>
            <div class="col text-center">
                <button type="submit" class="btn btn-primary" name="submit" id="submit">Post!</button>   
            </div> <br>
        </form>
        <button type="button" id="cndata"class="btn btn-secondary">Click here to check what you and the other posts here!</button>
    </div>
    <br>
    <script>
    document.getElementById('dataForm').addEventListener('submit', function(event) {
        event.preventDefault(); // Prevent the form from submitting traditionally

        var submitButton = document.getElementById('submit');
        submitButton.disabled = true; // Disable the button

        var formData = new FormData(this); // Use 'this' to refer to the form
        var xhr = new XMLHttpRequest();
        xhr.open('POST', 'submission.php', true);
        xhr.onload = function() {
            if (xhr.status === 200) {
                alert('Content posted successfully!');
                window.location.href = "post"; // Redirect to a success page
            } else {
                alert('An error occurred while adding the row.');
                console.error(xhr.responseText);
                submitButton.disabled = false; // Re-enable the button if there's an error
            }
        };
        xhr.send(formData);
    });

    document.getElementById('cndata').addEventListener('click', function() {
        // Redirect to the desired page
        window.location.href = "\communitynotes";
    });
    </script>

</body>
</html>