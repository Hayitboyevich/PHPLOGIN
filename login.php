<?php
session_start();
 require 'function.php';
    if ($_SERVER["REQUEST_METHOD"] == "POST") 
    {
        $response = login($_POST['username'], $_POST['password'], $_POST['remember']);
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
<section class="home">
    <div class="form_container">
        <i class="uil uil-times form_close"></i>
        <!-- Login From -->
        <div class="form login_form">
            <form method="post">
                <h2>Login</h2>
                <div class="text-danger"><?php if(isset($message)) { echo $message; } ?></div> 
                <div class="input_box">
                    <input type="text" name="username" placeholder="Enter your username" required  value="<?php if(isset($_COOKIE["username"])) { echo $_COOKIE["username"]; } ?>"/>
                    <i class="uil uil-envelope-alt email"></i>
                </div>
                <div class="input_box">
                    <input type="password" name="password" placeholder="Enter your password" required  value="<?php if(isset($_COOKIE["password"])) { echo $_COOKIE["password"]; }?>"/>
                    <i class="uil uil-lock password"></i>
                    <i class="uil uil-eye-slash pw_hide"></i>
                </div>

                <div class="option_field">
              <span class="checkbox">
                <input type="checkbox" name="remember" id="check"  <?php if(isset($_COOKIE["username"])) { ?> checked <?php } ?>/>
                <label for="check">Remember me</label>
              </span>
                </div>

                <button class="button">Login Now</button>

                <div class="login_signup">Don't have an account? <a href="register.php">Signup</a></div>
            </form>
        </div>

        <!-- Signup From -->

    </div>
</section>
<script src="assets/js/script.js" ></script>
</body>
</html>
