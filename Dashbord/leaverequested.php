<?php
require_once "connect.php";
if (!isset($_SESSION)) {
    session_start();
}

// $days = $_POST['days'];
    // echo $_POST["enddate"] . "<br>";
    // $enddate = strtr($_POST['enddate'], '/', '-');
    // echo $enddate . "<br>";
    // $enddate = date('Y-m-d', strtotime($enddate));
    // echo $enddate . "<br>";
    // echo $_POST['todaydate'] . "<br>";
    // $todaydate = strtr($_POST['todaydate'], '/', '-');
    // echo $todaydate . "<br>";
    // $todaydate = date('Y-m-d', strtotime($todaydate));
    // echo $todaydate . "<br>";
    $startdate= date('Y-m-d', strtotime($_POST['startdate']));
    $startdate=date_create($startdate);
    $enddate=date('Y-m-d', strtotime($_POST['enddate']));
    $enddate=date_create($enddate);
    $datediff = date_diff($startdate,$enddate);

echo $datediff->format("%R%a");
$days=$datediff->format("%a") ;
$fid = $_SESSION['FID'];
$csql = "SELECT END_DATE FROM leaves WHERE FID =? AND STATUS!='DENIED' order by END_DATE DESC";
$cstmt = $conn->prepare($csql);
$cstmt->execute([$fid]);
$cstmt = $cstmt->fetchColumn();
echo $cstmt.'<br/>';
echo $startdate->format(DATE_ATOM).'<br/>';
echo $cstmt < $startdate->format(DATE_ATOM);
if ($cstmt < $startdate->format(DATE_ATOM)) {
 
    $alsql = "insert into leaves (FID,DAYS,START_DATE,END_DATE,REASON,STATUS) values(?,?,?,?,?,?)";
    $alstmt = $conn->prepare($alsql);
    if ($alstmt->execute([$fid, $days, $startdate->format(DATE_ATOM), $enddate->format(DATE_ATOM),$_POST['leavedescription'],'PENDING'])) {
        $_SESSION['msgHead']="SUCCESS";
        $_SESSION['message'] = "Leave Requested Succesfully";
        $_SESSION['gif'] = "success.gif";
        $_SESSION['color']="#4481eb";
        
    } else {
    }
}else{
    $_SESSION['msgHead']="WARNING";
    $_SESSION['message'] = "Invalied Leave Request";
    $_SESSION['gif'] = "confirm.gif";
    $_SESSION['color']="gold";
}
$_SESSION['page'] = "leaveapply.php";
header("Location:index.php");
?>
