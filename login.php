<?php
session_start();
include("connect.php");
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
	
    <script
        src="https:kit.fontawesome.com/64d58efce2.js"
        crossorigin="anonymous"
    ></script>
    <title>Sign In & Sign Up</title>
    <link rel="stylesheet" href="loginStyles.css">
</head>
<body>
    <div class="container">
        <div class="forms-container">
            <div class="signin-signup">
                <form action="" class="sign-in-form">
                    <h2 class="title">Sign in</h2>
                    <div class="input-field">
                        <i class="fas fa-user"></i>
                        <input type="text" placeholder="Username">
                    </div>
                    <div class="input-field">
                        <i class="fas fa-lock"></i>
                        <input type="password" placeholder="Password">
                    </div>
                    <input type="submit" value="Login" class="btn solid">
<!--
                    <p class="social-text">Or sign in with social platforms</p>
                    <div class="social-media">
                        <a href="#" class="social-icon">
                            <i class="fab fa-google"></i>
                        </a>
                        <a href="#" class="social-icon">
                            <i class="fab fa-linkedin-in"></i>
                        </a>
                    </div>
-->
                </form>
                <form  method="post" class="sign-up-form">
                    <h2 class="title">Sign up</h2>
                    <!--<div class="input-field">
                        <i class="fas fa-user"></i>
                        <input type="text" placeholder="Username" required>
                    </div>-->
                    <div class="input-field">
                        <i class="fas fa-envelope"></i>
                        <input name="Email" type="text" placeholder="Email" required />
                    </div>
                    <!--<div class="input-field">
                        <i class="fas fa-lock"></i>
                        <input type="password" placeholder="Password">
                    </div>-->
                    <input type="submit" name="Register" value="register" class="btn solid" >
<!--
                    <p class="social-text">Or sign up with social platforms</p>
                    <div class="social-media">
                        <a href="#" class="social-icon">
                            <i class="fab fa-google"></i>
                        </a>
                        <a href="#" class="social-icon">
                            <i class="fab fa-linkedin-in"></i>
                        </a>
                    </div>
-->
                </form>
            </div>
        </div>

        <div class="panels-container">
            <div class="panel left-panel">
                <div class="content">
                    <h3>New here?<br><br></h3>
                    <button class="btn transparent" id="sign-up-btn">Sign Up</button>
                </div>
                
                <img src="loginImg.svg" class="image">
            </div>

            <div class="panel right-panel">
                <div class="content">
                    <h2>Already one of us?</h2>
                    <h3><br>Reload to get back to login page.</h3>
                </div>
                
                <img src="registerImg.svg" class="image">
            </div>
        </div>
    </div>

    <script src="app.js"></script>
</body>
</html>

<?php

if(isset($_POST['Register'])){
	$_SESSION['Email']=$_POST['Email'];
	$mail=$_SESSION['Email'];
	$sql="SELECT MAIL from logins where MAIL='$mail'" ;
	//$sql="SELECT * from logins";
	#echo $sql;
	$newline=" \n ";
	#echo nl2br ($newline);
	$mails=mysqli_query($link,$sql);
	$m=mysqli_fetch_array($mails,MYSQLI_ASSOC);
	#echo $m['MAIL']."hi";
	
	if($m==""){
		
		header("Location: /fms/registerForm.php");
	}
	else{
		echo "<script>alert('Mail account exist')</script>";
	}
	
}
?>