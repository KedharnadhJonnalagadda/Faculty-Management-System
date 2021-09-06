<?php
if(!isset($_SESSION)) 
{ 
    session_start(); 
}
require_once "connect.php";

$e="";
function successmsg(){
    $_SESSION['msgHead'] = "SUCCESS";
    $_SESSION['message'] = "Updated Succesfully";
    $_SESSION['gif'] = "success.gif";
    $_SESSION['color'] = "#4481eb";
}
function errormsg($e){
    $GLOBALS['e'].=$e;
}
function errormsgnotify(){
    $_SESSION["message"] = "Failed To Add New Staff" . $GLOBALS['e'];
    $_SESSION['gif'] = "error.gif";
    $_SESSION['color'] = "#B00020";
    $_SESSION['msgHead'] = "ERROR";
}


if(isset($_POST['Upproff'])){
    $ufid=$_POST['subfid'];
$exp=$_POST['exp'];
$salary=$_POST['salary'];
$branch=$_POST['branch'];
$role=$_POST['role'];
$aadhar=$_POST['aadharno'];
$pan=$_POST['panno'];
$blood=$_POST['bloodgroup'];
$flag=0;
    if($exp!=""){
        $upstst=$conn->prepare("UPDATE logins set EXPERIENCE=? where FID=?");
    if($upstst->execute([$exp,$ufid])){
        echo $exp;
        echo $ufid;
        successmsg();
    }
    else{
        errormsg("Experience Updation Failed");
        $flag=1;
    }
}
if($salary!=""){
    if($conn->prepare("UPDATE logins set SALARY=? where FID=?")->execute([$salary,$ufid])){
        echo $salary;
        
    }
    else{
        errormsg("Salary Updation Failed");
        $flag=1;
    }
}
if($branch!=""){
    if($conn->prepare("UPDATE logins set DEPARTMENT=? where FID=?")->execute([$branch,$ufid])){
        echo $branch;
       
    }
    else{
        errormsg("Department Updation Failed");
        $flag=1;
    }
}
if($role!=""){
    if($conn->prepare("UPDATE logins set ROLE=? where FID=?")->execute([$role,$ufid])){
        echo $role;
        
    }
    else{
        errormsg("Role Updation Failed");
        $flag=1;
    }
}
if($aadhar!=""){
    if($conn->prepare("UPDATE logins set AADHAR=? where FID=?")->execute([$aadhar,$ufid])){
        echo $role;
        
    }
    else{
        errormsg("Aadhar Updation Failed");
        $flag=1;
    }
}
if($pan!=""){
    if($conn->prepare("UPDATE logins set PAN=? where FID=?")->execute([$pan,$ufid])){
        echo $role;
        
    }
    else{
        errormsg("PAN Updation Failed");
        $flag=1;
    }
}
if($blood!=""){
    if($conn->prepare("UPDATE logins set BLOOD_GROUP=? where FID=?")->execute([$blood,$ufid])){
        echo $role;
        
    }
    else{
        errormsg("Blood Group Updation Failed");
        $flag=1;
    }
}
if($f){
    errormsgnotify();
}
else{
    successmsg();
}
}
if(isset($_POST['Deproff'])){
    echo 12;
    $ufid=$_POST['subfid'];
    if($conn->prepare("UPDATE  logins SET STATUS='RESIGN' WHERE FID=?")->execute([$ufid])){
        $conn->prepare("DELETE FROM subjects WHERE FID=?")->execute([$ufid]);
        $_SESSION['msgHead'] = "SUCCESS";
    $_SESSION['message'] = "Deletion Succesfully";
    $_SESSION['gif'] = "success.gif";
    $_SESSION['color'] = "red";
    echo 0;
    }else{
        $_SESSION["message"] = "Failed To Delete Staff" ;
        $_SESSION['gif'] = "error.gif";
        $_SESSION['color'] = "#B00020";
        $_SESSION['msgHead'] = "ERROR";
        echo 1;
    }
}
$_SESSION['page']="updateProf.php";
header("Location:index.php");
?>
