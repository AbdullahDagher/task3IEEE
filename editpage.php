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
    <title>Elmawakes Edit</title>
    <link rel="stylesheet" href="css/styleedit.css" type="text/css">
</head>
<body>
    <header class="head">
        <h3>ELMAWAKES</h3>
        <a class="link" id="rie" href="profile.php"> My Profile </a>
        <a class="link" id="lef" href="#"> Edit Profile</a>
        <img src="img/<?php echo $row['image'] ?>" class="avatar">
        <button class="ico" onclick="myFunction()">&#9776;</button>
    </header>
    <nav id="myLinks">
        <a class="menu" href="profile.php"> My Profile </a><br>
        <a class="menu" id="ed2" href="#"> Edit Profile</a>
    </nav>
    <div class="contaner">
        <div class="container">

            <form enctype="multipart/form-data" action="updateData.php" style="border:1px solid #ccc" method="post">
                <div class="container_form">
                    <div>
                        <?php
                        if(isset($_SESSION['errors'])){
                            if(!empty($_SESSION['errors'])){
                                echo '<div class="alert alert-danger">';
                                echo '<ul>';
                                foreach ($_SESSION['errors'] as $error){
                                    echo '<li>' ;
                                    echo $error;
                                    echo '</li>' ;
                                }
                                echo '</ul>';
                                echo   '</div>';
                            }
                        }
                        ?>
                    </div>
                    <br>
                    <hr>
                    <label for="editname"><b>change your Name : </b></label>
                    <input type="text" name="name" value="<?php echo $row['name'] ?>">

                    <label for="editnickname"><b>change your jop title : </b></label>
                    <input type="text" name="jopTitle" value="<?php echo $row['jopTitle'] ?>" >

                    <label for="email"><b>E-mail : </b></label>
                    <input type="email"  name="email" value="<?php echo $row['email'] ?>" ><br>

                    <label for="photo"><b>Photo : </b></label>
                    <input type="file"  name="image" ><br><br>

                    <label for="psw"><b>Password : </b></label>
                    <input type="password"  name="password" >

                    <label for="phon"><b>Phone : </b></label><br>
                    <input type="text"  name="phone" value="<?php echo $row['phone'] ?>"><br>

                    <label for="address"><b>Address : </b></label>
                    <input type="text" name="address" value="<?php echo $row['address'] ?>">

                    <label for="Birthday"><b>Birthday : </b></label>
                    <input type="text" name="birthday" value="<?php echo $row['birthday'] ?>" >

                    <label for="Gender"><b>Gender : </b></label>
                    <input type="radio"  name="gender" value="male" <?php if($row['gender'] == 'male')  echo 'checked'?> > Male
                    <input type="radio"  name="gender" value="female"  <?php if($row['gender'] == 'female')  echo 'checked'?>> Female


                    <div class="clearfix">
                        <button type="submit" class="signupbtn" >Save</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
    <script src="Js/jsicon.js"></script>
</body>
</html>
<?php
if(isset($_SESSION['errors'])){
    unset($_SESSION['errors']);
}
?>

