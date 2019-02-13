<?php
session_start();
include 'connection.php';


if($_SERVER['REQUEST_METHOD'] == 'POST'){
    $email = filter_var($_POST['email'], FILTER_SANITIZE_STRING);
    $password = $_POST['password'];
    $error_msg = [];

    if(!filter_var($email, FILTER_VALIDATE_EMAIL)){
        $error_msg[] = 'Enter valid email';
        $_SESSION['loginClass'] = true;
    } else{
        $stmt = $con->prepare('SELECT * FROM users WHERE email = ?');
        $stmt->execute(array($email));
        $row = $stmt->fetch(PDO::FETCH_ASSOC);
        $userCount = $stmt->rowCount();

        if($userCount == 1 ){
            $hashedPasswordCheck = password_verify($password, $row['password']);
            if($hashedPasswordCheck){
                $_SESSION['userID'] = $row['id'];
                header('Location: profile.php');
                exit();
            }else
                $error_msg[] = 'Password not matched';
        }else{
            $error_msg[] = 'Invalid email';
            $_SESSION['loginClass'] = true;
        }
    }
    $data = [
        'email' => $email
    ];

    $_SESSION['signUpErrors'] = $error_msg;
    $_SESSION['loginData'] = $data;
    header('Location: index.php');
    exit();

}else{
    header('Location: index.php');
    exit();
}
