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
if(isset($_POST['Map'])){
    $psubject=$_POST['subject'];
    $pfid=$_POST['fid'];
    $psection=$_POST['section'];
   // echo $psection;
    $cssql="select SUBJECT,SECTION FROM subjects where SUBJECT='$psubject'";
    $csstmt=$conn->query($cssql);
    $csstmt=$csstmt->fetch();
    //print_r(($csstmt['SECTION']));
    if(count([$csstmt['SECTION']])<=2){
        if($csstmt['SECTION']=='Both' or $csstmt['SECTION']==$psection or ($psection=='Both' and $csstmt['SECTION']) ){
            errormessage("<br/>Faculty Alredy Mapped");
        }else{
            $mapsql="insert into subjects values(?,?,?)";
            $mapstmt=$conn->prepare($mapsql);
            if($mapstmt->execute([$pfid,$psubject,$psection])){

                $_SESSION['msgHead']="SUCCESS";
                $_SESSION['message'] = "Maping Subject Succesfully";
                $_SESSION['gif'] = "success.gif";
                $_SESSION['color']="#4481eb";
            }
            
        }
    }else{
        errormessage("<br/>Faculty Alredy Mapped");
    }
}
$_SESSION['page']="mapsubject.php";
header("Location:index.php")
?>