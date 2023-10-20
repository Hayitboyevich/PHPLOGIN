
<?php
    require 'function.php';
    if ($_SERVER["REQUEST_METHOD"] == "POST") 
    {
        $response = register($_POST['email'], $_POST['name'], $_POST['password'], $_POST['confirm_password']);
        if($response == 'success'){
             header("Location: index.php");
        }
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

        <!-- Signup From -->
        <div class="form signup_form">
            <form action="#" method="post">
                <h2>Signup</h2>
               
                <div class="input_box">
                    <input type="text" placeholder="Enter your name" required  name="name" value="<?=$_POST['name']?>"/>
                    <i class="uil uil-envelope-alt email"></i>
                </div>

                <div class="input_box">
                    <input type="email" placeholder="Enter your email" required  name="email" value="<?=$_POST['email']?>"/>
                    <i class="uil uil-envelope-alt email"></i>
                </div>

                <div class="input_box">
                    <input type="password" placeholder="Create password" required name="password" value="<?=$_POST['password']?>"/>
                    <i class="uil uil-lock password"></i>
                    <i class="uil uil-eye-slash pw_hide"></i>
                </div>

                <div class="input_box">
                    <input type="password" placeholder="Confirm password" required name="confirm_password" value="<?=$_POST['confirm_password']?>"/>
                    <i class="uil uil-lock password"></i>
                    <i class="uil uil-eye-slash pw_hide"></i>
                </div>

                <button class="button">Signup Now</button>

                <div class="login_signup">Already have an account? <a href="login.php" >Login</a></div>
            </form>
        </div>
        <?php if(@$response != 'success'):?>
            <p><?=@$response?></p>
        <?php endif; ?>
    </div>
</section>
<script src="assets/js/script.js" ></script>
</body>
</html>
