
<?php 
$isLoggedIn = isset($_COOKIE['username']);
$isAnonymous = isset($_COOKIE['Anonymous']);

if (!$isLoggedIn && !$isAnonymous) {
    if($_COOKIE['guest_id']){
        setcookie('GuestMode', "", time() - 3660, "/");
    } 
    if(!$_COOKIE['guest_id']){
    session_destroy(); // Destroy session
    setcookie('username', "", time() - 3660, "/");
    setcookie('firsttime', "", time() - 3660, "/");
    header('Location: \login');
    exit();
    }
}
?>