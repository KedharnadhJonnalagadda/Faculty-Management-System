<?php
require_once "connect.php";
if (!isset($_SESSION)) {
    session_start();
}
if(isset($_POST['leavestatusgrant'])){
    if($conn->prepare('UPDATE leaves set STATUS="GRANTED" where START_DATE=? AND END_DATE=? AND FID=? AND TIMESTAMP=?')
    ->execute([$_POST['sd'],$_POST['ed'],$_POST['rgfid'],$_POST['ts']])){
        $_SESSION['msgHead']="SUCCESS";
        $_SESSION['message'] = "Leave Granted Succesfully";
        $_SESSION['gif'] = "success.gif";
        $_SESSION['color']="#4481eb";
        echo "Leave Granted Succesfully";
    }else{
        $_SESSION["message"] = "Failed To Grant Leave" ;
        $_SESSION['gif'] = "error.gif";
        $_SESSION['color'] = "#B00020";
        $_SESSION['msgHead'] = "ERROR";
        echo "Failed To Grant Leave" ;
    }
}
if(isset($_POST['leavestatusdenied'])){
    if($conn->prepare('UPDATE leaves set STATUS="DENIED" where START_DATE=? AND END_DATE=? AND FID=?')
    ->execute([$_POST['sd'],$_POST['ed'],$_POST['rgfid']])){
        $_SESSION['msgHead']="SUCCESS";
        $_SESSION['message'] = "Leave Denied Succesfully";
        $_SESSION['gif'] = "success.gif";
        $_SESSION['color']="red";
    }else{
        $_SESSION["message"] = "Failed To Denied Leave" ;
        $_SESSION['gif'] = "error.gif";
        $_SESSION['color'] = "#B00020";
        $_SESSION['msgHead'] = "ERROR";
    }
}
$_SESSION['page'] = "leaverequests.php";
header("Location:index.php");
?>