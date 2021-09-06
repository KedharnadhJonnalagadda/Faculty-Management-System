
<?php
include("connect.php");
session_start();
$mail=$_SESSION['Email'];
$fnams=$_POST["fname"];
$sname=$_POST["sname"];
$address=$_POST["address"];
$phoneno=$_POST["phoneno"];
$branch=$_POST["branch"];
$exp=$_POST["exp"];
$Gender=$_POST["gender"];
$pass=$_POST["pass"];

$sqls="INSERT INTO logins (MAIL,FIRST_NAME,SUR_NAME,PHONE_NO,STREAM,EXPERIENCE,Gender,PASSWORD) 
VALUES ('$mail','$fnams','$sname',$phoneno,'$branch',$exp,'$Gender','$pass')";
if(mysqli_query($link, $sqls)){
echo '<script>alert("successfull......!!!!!!!");</script>';
mysqli_close($link);
header("location: login.php");
}
else{
echo '<script>alert(" failed......!!!!!!!");</script>';
}
?>