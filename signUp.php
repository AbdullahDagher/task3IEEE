<?php
session_start();
include 'connection.php';


if($_SERVER['REQUEST_METHOD'] == 'POST'){
    unset($_SESSION['signUpErrors']);
    unset($_SESSION['data']);

    $name = filter_var($_POST['name'], FILTER_SANITIZE_STRING);
    $email = filter_var($_POST['email'], FILTER_SANITIZE_STRING);
    $password = $_POST['password'];
    $hashed_pass = password_hash($password, PASSWORD_DEFAULT);
    $error_msg = [];

    if(isset($_POST['gender']))
        $gender = $_POST['gender'];
    else
        $error_msg[] = 'Please select your gender';
    if(empty($name) || strlen($name) < 5)
        $error_msg[] = 'Name must be more than 5 char';
    if(empty($password) || strlen($password) < 5)
        $error_msg[] = 'Password must be more than 5 char';
    if(!filter_var($email, FILTER_VALIDATE_EMAIL)){
        $error_msg[] = 'Enter valid email';
    }
    else{
        $stmt = $con->prepare('SELECT email FROM users WHERE email = ?');
        $stmt->execute(array($email));
        $emailCount = $stmt->rowCount();

        if($emailCount > 0 )
            $error_msg[] = 'email exist';
    }

    $data = [
        'name' => $name,
        'email' => $email,
        'gender' => $gender
    ];

    if(empty($error_msg)){
        if($gender == 'male')
            $image = 'male.jpg';
        else
            $image = 'female.jpg';
        $stmt = $con->prepare('INSERT INTO users (`name`, `email`, `password`, `gender`, `image`) VALUES (?, ?, ?, ?, ?)');
        $stmt->execute(array($name, $email, $hashed_pass, $gender, $image));
        $stmt2 = $con->prepare('SELECT id FROM users ORDER BY id DESC LIMIT 1');
        $stmt2->execute();
        $row = $stmt2->fetch(PDO::FETCH_ASSOC);
        $_SESSION['userID'] = $row['id'];
        header('Location: profile.php');
        exit();
    }else{
        $_SESSION['signUpErrors'] = $error_msg;
        $_SESSION['data'] = $data;
        header('Location: index.php');
        exit();
    }


}else{
    header('Location: index.php');
    exit();
}

