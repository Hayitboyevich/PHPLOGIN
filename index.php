<?php
session_start();
require 'function.php';

if (!isset($_SESSION["username"])){
    header("Location:login.php");
}

if ($_SERVER["REQUEST_METHOD"] == "POST")
{
    generate($_POST['firstname'], $_POST['lastname'], $_POST['middlename'], $_POST['date']);
}
?>


<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
    <link rel="stylesheet" href="./assets/css/main.css">
    <link rel="stylesheet" href="https://unicons.iconscout.com/release/v4.0.0/css/line.css" />
</head>
<body>
<a href="logout.php">Logout</a>

<section class="home">

    <div class="form_container">
        <i class="uil uil-times form_close"></i>
        <!-- Login From -->
        <div class="form">
            <form  method="post">
                <div class="input_box">
                    <input type="text" placeholder="Enter your firstname" name="firstname" />
                </div>

                <div class="input_box">
                    <input type="text" placeholder="Enter your lastname" name="lastname" />
                </div>

                <div class="input_box">
                    <input type="text" placeholder="Enter your middlename" name="middlename" />
                </div>

                <div class="input_box">
                    <input type="date" placeholder="Enter your bith date" name="date" />
                </div>

                <button type="submit" class="button">Add</button>
            </form>



        </div>

        <a href="download.php" class="button">Download</a>

    </div>
</section>
<script src="assets/js/script.js" ></script>
</body>
</html>
