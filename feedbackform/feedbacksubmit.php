<?php
require_once "../dashbord/connect.php";
if (!isset($_SESSION)) {
    session_start();
}
if(isset($_POST['feed'])){
    if($conn->prepare("INSERT into feedback values(?,?,?)")->execute([$_POST['subject'],$_POST['feedlevel'],$_POST['feedmessage']])){
        
    }
    else{
        echo "<script>alert('Failed');</script>";
    }
}
header("Location:index.php")
?>