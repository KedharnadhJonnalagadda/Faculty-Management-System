
<?php
// Initialize the session

 
// Check if the user is already logged in, if yes then redirect him to welcome page
if(isset($_SESSION["loggedin"]) && $_SESSION["loggedin"] === true){
    header("location: welcome.php");
    exit;
}
 
// Include config file
require_once "connect.php";
 
// Define variables and initialize with empty values
$fid = $password = "";
$email_err = $password_err = $login_err = "";
 
// Processing form data when form is submitted
if($_SERVER["REQUEST_METHOD"] == "POST"){
 
    // Check if email is empty
    if(empty(trim($_POST["fid"]))){
        $email_err = "Please enter email.";
    } else{
        $fid = trim($_POST["fid"]);
    }
    
    // Check if password is empty
    if(empty(trim($_POST["password"]))){
        $password_err = "Please enter your password.";
    } else{
        $password = trim($_POST["password"]);
    }
    
    // Validate credentials
    if(empty($email_err) && empty($password_err)){
        // Prepare a select statement
        $sql = "SELECT FID,PASSWORD ,ROLE FROM LOGINS WHERE FID = :fid AND STATUS='ACTIVE'";
        
        if($stmt = $conn->prepare($sql)){
            // Bind variables to the prepared statement as parameters
            $stmt->bindParam(":fid", $param_email, PDO::PARAM_STR);
            
            // Set parameters
            $param_email = trim($_POST["fid"]);
            
            // Attempt to execute the prepared statement
            if($stmt->execute()){
                // Check if email exists, if yes then verify password
                if($stmt->rowCount() == 1){
                    if($row = $stmt->fetch()){
                       
                        $fid = $row["FID"];
                        $hashed_password = $row["PASSWORD"];
                        
                        if(($password=== $hashed_password)){
                            // Password is correct, so start a new session
                            session_start();
                            
                            // Store data in session variables
                            $_SESSION["loggedin"] = true;
                            $_SESSION["message"]="";
                            $_SESSION["FID"] = $fid;  
                            if($row["ROLE"]=="HOD"){
                            $_SESSION["page"]='admindashbord.php';                       
                            }else{
                                $_SESSION["page"]='facultydashbord.php';
                            }
                            // Redirect user to welcome page
                            header("location: ./Dashbord/index.php");
                        } else{
                            // Password is not valid, display a generic error message
                            $login_err = "Invalid UserId or password.";
                        }
                    }
                } else{
                    // email doesn't exist, display a generic error message
                    $login_err = "Invalid UserId or password.";
                }
            } else{
                echo "Oops! Something went wrong. Please try again later.";
            }

            // Close statement
            unset($stmt);
        }
    }
    
    // Close connection
    unset($pdo);
}
?>

<!doctype html>
<html>

<head>
    <meta charset='utf-8'>
    <meta name='viewport' content='width=device-width, initial-scale=1'>
    <title>Faculty Login</title>
    <link rel="icon" href="user.png" type="image/x-icon">
    <link href='https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/css/bootstrap.min.css' rel='stylesheet'>
    <link href='https://use.fontawesome.com/releases/v5.7.2/css/all.css' rel='stylesheet'>
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700;800;900&display=swap');

        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            font-family: 'Poppins', sans-serif
        }

        .bubbles {
            position: absolute;
            width: 100%;
            height: 100%;
            overflow: hidden
        }

        body {
            min-height: 100vh;
            background: linear-gradient(135deg, #4481eb, #04befe)
        }

        body::-webkit-scrollbar {
            display: none
        }

        .circle {
            position: absolute;
            z-index: -100;
            border-radius: 50%;
            background-color: rgb(235, 235, 235);
            animation: flying 7s infinite ease-in;
            opacity: 0.5;
            bottom: -100px
        }

        @keyframes flying {
            0% {
                bottom: -100px;
                transform: translateX(0)
            }

            50% {
                transform: translateX(100px)
            }

            100% {
                bottom: 1080px;
                transform: translateX(-250px)
            }
        }

        .circle:nth-child(1) {
            width: 60px;
            height: 60px;
            left: 20%;
            animation-delay: 5s
        }

        .circle:nth-child(2) {
            width: 100px;
            height: 100px;
            left: 40%;
            animation-delay: 6s
        }

        .circle:nth-child(3) {
            width: 65px;
            height: 65px;
            animation-delay: 4s
        }

        .circle:nth-child(4) {
            width: 80px;
            height: 80px;
            left: 80%;
            animation-delay: 9s
        }

        .container {
            margin: 50px auto
        }

        .container .content {
            max-width: 42%;
            margin-right: 30px
        }

        .container .fs-5 {
            font-size: 1.4rem !important;
            font-weight: 200
        }

        .container .text-grey {
            color: #e8e8e8
        }

        .container .text {
            font-weight: 100;
            font-size: 0.9rem;
            line-height: 1.6rem
        }

        .container .btn {
            border: none;
            box-shadow: 0 2px 3px #505050b0;
            text-transform: uppercase;
            font-size: 0.9rem;
            font-weight: 500;
            letter-spacing: 1.3px
        }

        .container .content .btn.btn-primary {
            color: #f2f2f2;
            background-color: #14ca72
        }

        .container .content .btn.btn-primary:hover {
            background-color: #21a063
        }

        .container .btn.btn-default {
            background-color: #fff
        }

        .container .btn.btn-default:hover {
            background-color: #f2f2f2
        }

        .container .btn img {
            width: 20px;
            height: 20px;
            border-radius: 50%
        }

        .container .card {
            margin-left: 40px;
            min-width: 320px;
            max-width: 400px;
            height: 350px;
            position: relative;
            border: none;
            overflow: hidden;
            border-radius: 5px;
            box-shadow: 0 5px 15px #975ccfa1
        }

        .container .card .card-head {
            padding: 15px 20px;
            overflow-x: hidden;
            box-shadow: 0 2px 3px #1f1f1f33;
            height: 140px
        }

        .container .card .card-form {
            height: 100%;
            padding: 15px 20px;
            background-color: #eeeeee
        }

        .container .card .card-form .input-field {
            background-color: #fff;
            border-bottom: 1px solid #ddd;
            margin-bottom: 20px;
            padding: 0.1rem 0.3rem;
            border-radius: 4px;
            box-shadow: 0 2px 3px #1f1f1f33
        }

        .container .card .card-form .input-field .form-control {
            box-shadow: none;
            border: none
        }

        .container .card .card-form .input-field input:focus::placeholder {
            color: #fff
        }

        .container .card .fs-08 {
            font-size: 0.85rem;
            font-weight: 500
        }

        .container .card .card-form .btn {
            width: 100px
        }

        .container .card .card-form .btn.btn.btn-primary {
            background-color: #4481eb;
        }

        .container .card .card-form .btn.btn.btn-primary:hover {
            background-color: #04befe;
        }

        @media (max-width: 767.5px) {
            .container .content {
                max-width: 100%;
                margin-bottom: 30px;
                padding: 15px;
                margin-right: 0px
            }

            .container .card {
                margin-left: 0
            }

            .bubbles {
                display: none
            }
        }

        @media (max-width: 350px) {
            .container .content .btn {
                font-size: 0.8rem
            }

            .container .card {
                min-width: 300px
            }
        }
    </style>
    <script type='text/javascript' src=''></script>
    <script type='text/javascript' src='https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/js/bootstrap.bundle.min.js'></script>
    <script type='text/javascript'>
        document.addEventListener("DOMContentLoaded", function(event) {
            // Your code to run since DOM is loaded and ready
            VanillaTilt.init(document.querySelectorAll(".card"), {
                max: 25,
                speed: 400,
                glare: false,
                "max-glare": 0.8
            });
            VanillaTilt.init(document.querySelectorAll(".card"));
        });
        function increase(){
    var el = document.getElementById("card");
    var height = el.offsetHeight;
    var newHeight = height + 80;
    el.style.height = newHeight + 'px';
    
    }
    </script>
</head>

<body oncontextmenu='return false' class='snippet-body'>
    <div class="bubbles">
        <div class="circle"></div>
        <div class="circle"></div>
        <div class="circle"></div>
        <div class="circle"></div>
    </div>
    <div class="container">
        <div class="d-flex justify-content-center align-items-center flex-wrap">
            <div class="content">
            <div class="h4 text-white"><p class="h1"> RISE Faculty Management System</p></div>
                <div class="text my-4 text-grey"><p class="h5"> The Faculty Management System is designed to track and maintain Faculty data and activities as long as they are a part of this Educational Institution.</p>
                </div>
            </div>
            <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
                <div class="form-card">
                    <div class="card" id="card">

                    <div class="card-header bg-white" align="center">
                            <p class="m-0 text-center fs-08">Sign in with credentials</p>
                            <img src="assets/images/logo-icon.png"  alt="homepage" class="dark-logo" style="width: 57px;left: 5px;" />
                        </div>
                        <div class="card-form">
                            
                            
                            <div class="d-flex align-items-center input-field"> <span class="far fa-envelope text-muted"></span> <input type="text" name="fid" placeholder="User Id" class="form-control" required> </div>
                            <div class="d-flex align-items-center input-field"> <span class="fas fa-key text-muted"></span>
                                <input type="password" name="password" placeholder="Password" class="form-control" required>
                            </div>
                            
                            <div class="d-flex justify-content-center">
                                <button class="btn btn-primary mt-3">Sign In
                            </div>
                            
                            <?php
                            if (!empty($login_err)) {
                                echo '<script>increase();</script><br /><div class="alert alert-danger">' . $login_err . '</div>';
                            }
                            ?>
                        </div>

                    </div>

                </div>
        </div>
        </form>
    </div>
    </div>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/vanilla-tilt/1.7.0/vanilla-tilt.min.js" integrity="sha512-SttpKhJqONuBVxbRcuH0wezjuX+BoFoli0yPsnrAADcHsQMW8rkR84ItFHGIkPvhnlRnE2FaifDOUw+EltbuHg==" crossorigin="anonymous"></script>
</body>

</html>
<script>

</script>