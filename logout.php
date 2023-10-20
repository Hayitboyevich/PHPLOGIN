<?php
session_start();

if (!empty($_SESSION["username"])){
    unset($_SESSION["username"]);
    setcookie('user','',time()-(9000));
}
header("Location: login.php");

