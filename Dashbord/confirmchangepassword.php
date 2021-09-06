<?php
require_once "connect.php";
if(!isset($_SESSION)) 
{ 
    session_start(); 
} 
function errormessage($e){
    $_SESSION["message"]="Failed To Update Password".$e;
    $_SESSION['gif'] = "error.gif";
    $_SESSION['color']="#B00020";
    $_SESSION['msgHead']="ERROR";
}
if(isset($_POST['Psubmit'])){
    $fid = $_SESSION['FID'];
    
    $opsql="SELECT PASSWORD from logins where FID=? and PASSWORD=?";
    $old_pass=$conn->prepare($opsql);
    $old_pass->execute([$fid,$_POST['current_password']]);
    $old_pass=$old_pass->fetch();
    
    if($old_pass!=""){
        $psql="update logins set PASSWORD=? where FID=? and PASSWORD=? ";
    $pstmt=$conn->prepare($psql);
    
    if($pstmt->execute([$_POST['new_password'],$fid,$_POST['current_password']])){
        $_SESSION["message"]="Password Updated Success";
        $_SESSION['gif'] = "success.gif";
        $_SESSION['color']="#4481eb";
        $_SESSION['msgHead']="SUCCESS";
    }else{
        errormessage("");
    }
}else{
    errormessage("<br />(Incorect Old PassWord)");
}

}else{
    errormessage("");
}
$_SESSION['page']="changePassword.html";
header("Location:index.php")
?>