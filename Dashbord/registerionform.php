
<?php
include("connect.php");
session_start();
if (isset($_POST['NewStaff'])) {
    $rfid = $_POST['fid'];
    echo $rfid;
    $fnams = $_POST["fname"];
    $sname = $_POST["sname"];
    $email = $_POST["email"];
    $phoneno = $_POST["phoneno"];
    $branch = $_POST["branch"];
    $exp = $_POST["exp"];
    $Gender = $_POST["gender"];
    $ROLE = $_POST["ROLE"];
    $SALARY = $_POST["salary"];
    $aadhar= $_POST["aadharno"];
    $pan= $_POST["panno"];
    $blood= $_POST["bloodgroup"];
    $profile=$_POST['gender'].'.png';

    $sqls = "INSERT INTO logins (FID,MAIL,FIRST_NAME,SUR_NAME,PHONE_NO,DEPARTMENT,EXPERIENCE,Gender,ROLE,SALARY,AADHAR,PAN,BLOOD_GROUP,PROFILE) 
VALUES ('$rfid','$email','$fnams','$sname',$phoneno,'$branch',$exp,'$Gender','$ROLE','$SALARY',$aadhar,'$pan','$blood','$profile')";
    if ($conn->prepare($sqls)->execute()) {
        $_SESSION['msgHead'] = "SUCCESS";
        $_SESSION['message'] = "New Staff Added Succesfully";
        $_SESSION['gif'] = "success.gif";
        $_SESSION['color'] = "#4481eb";

        //header("location: login.php");
    } else {
        $_SESSION["message"] = "Failed To Add New Staff" . $e;
        $_SESSION['gif'] = "error.gif";
        $_SESSION['color'] = "#B00020";
        $_SESSION['msgHead'] = "ERROR";
    }
}
$_SESSION['page']="registerstaff.php";
header("Location:index.php");
?>