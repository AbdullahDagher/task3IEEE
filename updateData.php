<?php

session_start();
include 'connection.php';


if($_SERVER['REQUEST_METHOD'] == 'POST'){
    unset($_SESSION['data']);

    $name = filter_var($_POST['name'], FILTER_SANITIZE_STRING);
    $jopTitle = filter_var($_POST['jopTitle'], FILTER_SANITIZE_STRING);
    $phone = filter_var($_POST['phone'], FILTER_SANITIZE_STRING);
    $address = filter_var($_POST['address'], FILTER_SANITIZE_STRING);
    $birthday = filter_var($_POST['birthday'], FILTER_SANITIZE_STRING);
    $gender = $_POST['gender'];
    $email = filter_var($_POST['email'], FILTER_SANITIZE_STRING);
    $password = $_POST['password'];
    $hashed_pass = password_hash($password, PASSWORD_DEFAULT);
    $error_msg = [];

    $image = '';
    if(isset($_FILES['image']) && $_FILES['image']['name'] !=''){
        $filename = $_FILES['image']['name'];
        $fileTempName = $_FILES['image']['tmp_name'];
        $fileSize = $_FILES['image']['size'];

        $fileExtension = explode('.', $filename);
        $fileExt = strtolower(end($fileExtension));
        $allowed = ['jpg', 'jpeg', 'png'];

        if(in_array($fileExt, $allowed)){
            if($fileSize < 2000000){
                $image = uniqid('', true) . '.' . $fileExt;
                $fileDestination = 'img/'. $image;
                move_uploaded_file($fileTempName, $fileDestination);
            }else
                $error_msg[] ='Your file is too big';
        }else
            $error_msg[] ='You can\'t upload file of this type';

    }

    if($phone!=''){
        if(strlen($phone) != 11 && !preg_match('/01[0125]{1}[0-9]{8}/', $phone ))
            $error_msg[] = 'Enter valid phone number';
    }

    if($birthday !=''){
        if(!preg_match('/[0-9]{1,2}[\/-]{1}[0-9]{1,2}[\/-]{1}[0-9]{4}/', $birthday))
            $error_msg[] = 'Enter valid birthday';
    }

    if(empty($name) || strlen($name) < 5)
        $error_msg[] = 'Name must be more than 5 char';
    if(!empty($password)){
        if(strlen($password) < 5)
            $error_msg[] = 'Password must be more than 5 char';
    }
    if(!filter_var($email, FILTER_VALIDATE_EMAIL)){
        $error_msg[] = 'Enter valid email';
    }
    else{
        $stmt = $con->prepare('SELECT email FROM users WHERE email = ? AND id != ?');
        $stmt->execute([
            $email,
            $_SESSION['userID']
        ]);
        $emailCount = $stmt->rowCount();

        if($emailCount > 0 )
            $error_msg[] = 'email exist';
    }

    if(empty($error_msg)){
        $stmt2 = $con->prepare('UPDATE users SET `name` = ?, email = ?, jopTitle = ?, phone = ?, address = ?, gender = ?, birthday = ? WHERE id = ?;');
        $stmt2->execute([
            $name,
            $email,
            $jopTitle,
            $phone,
            $address,
            $gender,
            $birthday,
            $_SESSION['userID']
        ]);
        if($image!=''){
            $stmt2 = $con->prepare('UPDATE users SET image = ? WHERE id = ?;');
            $stmt2->execute([
                $image
            ]);
        }
        if($password!=''){
            $stmt2 = $con->prepare('UPDATE users SET password = ? WHERE id = ?;');
            $stmt2->execute([
                $hashed_pass
            ]);
        }
        header('Location: profile.php');
        exit();
    }else{
        $_SESSION['errors'] = $error_msg;
        header('Location: editpage.php');
        exit();
    }


}else{
    header('Location: editpage.php');
    exit();
}

