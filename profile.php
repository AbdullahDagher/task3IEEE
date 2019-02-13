<?php
    session_start();
    include 'connection.php';
    $stmt = $con->prepare('SELECT * FROM users WHERE id = ?');
    $stmt->execute([$_SESSION['userID']]);
    $row = $stmt->fetch(PDO::FETCH_ASSOC);
?>

<!DOCTYPE html>
<html>
<head>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Elmawakes Profile</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="css/styleprof.css" type="text/css">

</head>
<body>
<div class="ma_con">

    <header class="head">
        <h3>ELMAWAKES</h3>
        <a class="link" id="rie" href="#"> My Profile </a>
        <a class="link" id="lef" href="editpage.php"> Edit Profile</a>
        <img src="img/<?php echo $row['image'] ?>" class="avatar">
        <button class="ico" onclick="myFunction()">&#9776;</button>
    </header>
    <nav id="myLinks">
        <a class="menu" href="#"> My Profile </a><br>
        <a class="menu" id="ed2" href="editpage.php"> Edit Profile</a>
    </nav>
    <div class="cont">
        <div class="left">
            <img class="imp" src="img/<?php echo $row['image'] ?>">
            <br><br><br>
            <a class="social" href="https://www.facebook.com/profile.php?id=100007013051329" ><i class="fa fa-facebook-square"></i></a>
            <a class="social" href="https://twitter.com"><i class="fa fa-twitter-square"></i></a>
            <a class="social" href="https://gmail.com"><i class="fa fa-google-plus-square"></i></a>
        </div>
        <div class="left" id="lclass">
            <h3 id="nam"><?php echo $row['name'] ?></h3>
            <p class="nickname"><?php echo $row['jopTitle'] ?></p>
            <p><i class="fa fa-user"></i> About</p>
            <hr id="line">
            <p class="info">CONTACT INFORMATION</p>
                <div class="din">
                    <strong>Phone : </strong>
                    <p class="col"><?php if($row['phone'] != '') echo $row['phone']; else echo 'Not Available' ?></p><br>
                    <strong>Address : </strong>
                    <p><?php if($row['address'] != '') echo $row['address']; else echo 'Not Available' ?></p><br>
                    <strong>Email : </strong>
                    <p class="col"><?php echo $row['email']; ?></p><br>
                    <strong>Birthday : </strong>
                    <p><?php if($row['birthday'] != '') echo $row['birthday']; else echo 'Not Available' ?></p><br>
                    <strong>Gender : </strong>
                    <p><?php echo $row['gender'];  ?></p><br>
                </div>
        </div>
    </div>
</div>
<script src="Js/jsicon.js"></script>
</body>
</html>