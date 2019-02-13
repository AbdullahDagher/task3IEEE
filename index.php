<?php
    session_start();
    if(isset($_SESSION['userID'])){
        header('Location:profile.php');
        exit();
    }
?>

<!DOCTYPE html>
<html>
    <head>
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta charset="UTF-8">
        <meta name="viewport"
              content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
        <meta http-equiv="X-UA-Compatible" content="ie=edge">
        <title>Elmawakes</title>
        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
        <link rel="stylesheet" href="css/style.css" type="text/css">
    </head>

    <body>
    <div class="main">
    <div class="main-nav">


        <div class="tabs">
            <h3>ELMAWAKES</h3>
            <div class="butt">
                <button onclick="showcont(0,'#FFFFFF')">Sign Up</button>
                <button onclick="showcont(1,'#FFFFFF')">Sign In</button>
            </div>

            <div id="errors">
                <?php
                if(isset($_SESSION['signUpErrors'])){
                    if(!empty($_SESSION['signUpErrors'])){
                        echo '<div class="alert alert-danger">';
                            echo '<ul>';
                            foreach ($_SESSION['signUpErrors'] as $error){
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
            <div id="signup" class="container <?php if(isset($_SESSION['loginClass'])) echo 'loginClass' ?>">
                <form action='signUp.php' style="border:1px solid #ccc" method="post">
                <div class="container_form">
                    <br>
                    <p>Please fill in this form to create an account.</p>
                    <hr>

                    <label for="name"><b>Name</b></label>
                    <input id="name" type="text" placeholder="Enter your name" name="name"  value="<?php if(isset($_SESSION['data'])) echo $_SESSION['data']['name'] ?>">

                    <label for="email"><b>E-mail</b></label>
                      <input id="email" type="email" placeholder="Enter Email" name="email"  value="<?php if(isset($_SESSION['data'])) echo $_SESSION['data']['email'] ?>">

                    <label for="psw"><b>Password</b></label>
                    <div class="password">
                        <input id="psw" type="password" placeholder="Enter Password" name="password" >
                        <i class="fa fa-eye"></i>
                    </div>

                    <input type="radio"  name="gender" value="male" style="margin-bottom:15px" checked <?php if(isset($_SESSION['data']) && $_SESSION['data']['gender'] == 'male') echo 'checked'?> > Male
                    <input type="radio"  name="gender" value="female" style="margin-bottom:15px"  <?php if(isset($_SESSION['data']) && $_SESSION['data']['gender'] == 'female') echo 'checked'?> > Female

                    <div class="clearfix">
                        <button type="submit" class="signupbtn" name="signUp">Sign Up</button>
                    </div>
                </div>
            </form>
            </div>
            <div id="login" class="container <?php if(isset($_SESSION['loginClass'])) echo 'loginClass' ?>"">
                <form action="login.php" style="border:1px solid #ccc" method="post">
                    <div class="container_form">
                        <br>
                        <label for="login-email"><b>Email</b></label>
                        <input id="login-email" type="email" placeholder="Enter Email" name="email" value="<?php if(isset($_SESSION['loginData'])) echo $_SESSION['loginData']['email'] ?>">

                        <label for="login-psw"><b>Password</b></label>
                        <div class="password">
                            <input id="login-psw" type="password" placeholder="Enter Password" name="password" >
                            <i class="fa fa-eye"></i>
                        </div>

                        <div class="clearfix">
                            <button type="submit" class="signupbtn" name="signIn">Sign In</button>
                        </div>
                    </div>
                </form>
            </div>

        </div>
    </div>
    </div>
    <script src="https://code.jquery.com/jquery-3.3.1.min.js"></script>
    <script src="js/custom.js"></script>
    <script src="Js/jstask.js"></script>
    </body>
</html>
<?php
    if(isset($_SESSION['signUpErrors'])){
        unset($_SESSION['signUpErrors']);
    }
    if(isset($_SESSION['data'])){
        unset($_SESSION['data']);
    }
    if(isset($_SESSION['loginData'])){
        unset($_SESSION['loginData']);
    }
if(isset($_SESSION['loginClass'])){
    unset($_SESSION['loginClass']);
}
?>