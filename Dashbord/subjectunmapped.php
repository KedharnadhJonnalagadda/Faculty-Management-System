<?php

require_once "connect.php";
if (!isset($_SESSION)) {
    session_start();
}
function errormessage($e){
    $_SESSION["message"]="Failed To Map Subject".$e;
    $_SESSION['gif'] = "error.gif";
    $_SESSION['color']="#B00020";
    $_SESSION['msgHead']="ERROR";
}
if(isset($_POST['UnMap'])){
    
    $subfid=$_POST['subfid'];
    $unmapattr=explode("->",$subfid);
    $unmapattr[1]=substr($unmapattr[1], 0, strpos($unmapattr[1], " "));
    print_r($unmapattr);
    $unmapsql="DELETE FROM subjects where FID='$unmapattr[1]' AND SUBJECT='$unmapattr[0]' AND SECTION='$unmapattr[2]'";
    echo $unmapsql;
    $unmapStmt=$conn->query($unmapsql);
    
    if($unmapStmt->execute()){
        $_SESSION["message"]="Un-Map Subject Successfully";
        $_SESSION['gif'] = "success.gif";
        $_SESSION['color']="#4481eb";
        $_SESSION['msgHead']="SUCCESS";
    }else{
        errormessage("<br>Querry Error");
    }
}
$_SESSION['page']="mapsubject.php";
header("Location:index.php")
?>