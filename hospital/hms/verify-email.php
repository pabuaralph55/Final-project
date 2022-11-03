<?php

session_start();
if (isset($_GET["token"])) {
    include 'include/config.php';
    $sql= "UPDATE users SET status='1' WHERE token='{$_GET["token"]}'";
    mysqli_query($con, $sql);
    
    $showUserId = mysqli_fetch_assoc(mysqli_query($con, "SELECT id FROM users WHERE token='{$_GET["token"]}'"));
    $_SESSION["user_id"] = $showUserId['id'];
    header("Location: user-login.php");
} else {
    header("Location: registration.php");
}

?>