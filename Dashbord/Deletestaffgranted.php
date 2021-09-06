<?php
if(!isset($_SESSION)) 
{ 
    session_start(); 
}
require_once "connect.php";



if(isset($_POST['Deproff'])){
    echo 12;
    $ufid=$_POST['subfid'];
    if($conn->prepare("Delete FROM logins WHERE FID=?")->execute([$ufid])){
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
// header("Location:index.php");
?>