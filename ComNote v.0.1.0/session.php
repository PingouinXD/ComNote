<?php
session_start();
include 'login.php';
// Dummy authentication (replace with real DB check)
function setSession(){
        $_SESSION['username']; // Example username
        header("Location: \communitynotes"); // Redirect to the user dashboard
        exit();
    
}

?>
