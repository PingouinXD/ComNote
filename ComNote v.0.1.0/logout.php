<?php
session_start();
if($_COOKIE['GuestMode'] == 1){
    setcookie("GuestMode", "", time() - 3600, "/"); 
}
session_unset();
session_destroy(); // Destroy session

setcookie("firsttime", "1", time() + (86400 * 30), "/", "");
setcookie("guest_id", "", time() - 3600, "/"); // Expire 1 hour ago
setcookie("username", "", time() - 3600, "/"); 
header("Location: \login"); // Redirect to login page

exit();
?>
