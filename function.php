<?php
session_start();
require 'config.php';

function dd($data){
    print_r($data);die;
}

function connect()
{
        $mysqli = new mysqli(SERVER, USERNAME, PASSWORD, DATABASE);
        if($mysqli->connect_errno != 0){
           $error = $mysqli->connect_error;
           $error_date = date("F j, Y, g:i a");
           $message = "{$error} | {$error_date} \r\n";
           file_put_contents("upload/log.txt", $message, FILE_APPEND);
           return false;
        }else{
            return $mysqli;
        }
}

function register($email, $username, $password, $confirm_password)
{
    $mysqli = connect();

    $args = func_get_args();
    
    $args = array_map(function($value){
        return trim($value);
    }, $args);


    foreach($args as $value){
        if(empty($value)){
            return 'All fields are required';
        }
    }

     foreach($args as $value){
        if(preg_match("/([<|>])/", $value)){
            return '<> characters not allowed';
        }
    }

    if(!filter_var($email, FILTER_VALIDATE_EMAIL)){
        return "Email is not valid";
    }

    $stmt = $mysqli->prepare("SELECT username FROM users WHERE username = ?");
    $stmt->bind_param("s", $username);

    $stmt->execute();

    $result = $stmt->get_result();
    $data = $result->fetch_assoc();


    if($data != NULL){
        return "Username allready exists!";
    }

    $stmt = $mysqli->prepare("SELECT email FROM users WHERE email = ?");
    $stmt->bind_param("s", $email);

    $stmt->execute();

    $result = $stmt->get_result();
    $data = $result->fetch_assoc();


    if($data != NULL){
        return "Email allready exists!";
    }

    if(strlen($password) < 8)
    {
        return "Password is min 8 characters";
    }

    if( !preg_match("#[0-9]+#", $password) ) {
       return  "Password must include at least one number!";
    }

    if( !preg_match("#[A-Z]+#", $password) ) {
        return  "Password must include at least one CAPS!";
    }

    if($password !=$confirm_password)
    {
        return "Password don't match";
    }

    $password_hash = password_hash($password, PASSWORD_DEFAULT);

    $stmt = $mysqli->prepare("INSERT INTO users(username,password, email) VALUES(?,?,?)");
    $stmt->bind_param("sss", $username, $password_hash, $email);
    $stmt->execute();

    if($stmt->affected_rows != 1){
        return "An error occured, Please try again";
    }else{
        $_SESSION["username"] = $username;
        setcookie ("username",$username,time()+ (10 * 365 * 24 * 60 * 60));
        setcookie ("password",$password,time()+ (10 * 365 * 24 * 60 * 60));
        header('Location:login.php');
    }
}

function login($username, $password, $remember)
{
    $mysqli = connect();

    if($username == '' || $password == ''){
        return " Both fields are required";
    }

    $username = filter_var($username, FILTER_SANITIZE_STRING);
    $password = filter_var($password, FILTER_SANITIZE_STRING);

    $sql = "SELECT username, password FROM users WHERE username= ?";
    $stmt = $mysqli->prepare($sql);
    $stmt->bind_param("s", $username);
    $stmt->execute();

   $result = $stmt->get_result();
    $data = $result->fetch_assoc();
    
    if($data == NULL){
        return "Wrong Name or Password";
    }

    if(password_verify($password, $data['password']) == FALSE)
    {
         return "Wrong Name or Password";
    }

    else{
        $_SESSION["username"] = $username;

        if($remember)
        {
            setcookie ("username",$username,time()+ (10 * 365 * 24 * 60 * 60));
            setcookie ("password",$password,time()+ (10 * 365 * 24 * 60 * 60));
        }else{
            setcookie("username","");
            setcookie ("password","");  
        }

        header("Location: index.php");
        exit();
    }

}

function generate($firstname, $lastname, $middlename, $date)
{
    $file = 'assets/upload/fromFile.doc';
    if (file_exists($file))
    {
        unlink($file);
    }
    $file = fopen('assets/upload/fromFile.doc', 'w+');
    fwrite($file,"Firstname :");
    fwrite($file, $firstname ."\n");
    fwrite($file,"Lastname :");
    fwrite($file, $lastname ."\n");
    fwrite($file,"Middlename :");
    fwrite($file, $middlename ."\n");
    fwrite($file, "Date :");
    fwrite($file, $date ."\n");
    fclose($file);
    header("location: index.php");

}

function download()
{
    $file = 'assets/upload/fromFile.doc';
    if(file_exists($file)){
        // Define headers
        header("Cache-Control: public");
        header("Content-Description: File Transfer");
        header("Content-Disposition: attachment; filename=word.doc");
        header("Content-Type: application/zip");
        header("Content-Transfer-Encoding: binary");

        // Read the file
        readfile($file);
        exit;
    }else{
        echo 'The file does not exist.';
    }
}
