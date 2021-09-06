<?php
$adminAccess = array(
    array('Admindashbord', "far fa-clock fa-fw", "Dashboard"),
    array('Profile', "fa fa-street-view", "Profile"),
    array('FacultyProfiles', "fa fa-user","Faculty Profiles"),
    array('LeaveRequests','fa fa-newspaper','Leave requests'),
    array('Leaves', "fa fa-table", "Faculty on Leave"),
    array('ApplyLeaves', "fas fa-bed", "Apply Leaves"),
    array('Feedbacks', "fa fa-font", "Feedbacks"),
    array('Register','fas fa-book','Register'),
    array('updateProf','fas fa-pen-square','Update Staff Profile'),
    array('MapSubject','fas fa-map','Map Subject')
);
$facultyAccess = array(
    array('Facultydashbord', "far fa-clock fa-fw", "Dashbord"),
    array('Profile', "fa fa-street-view", "Profile"),
    array('ApplyLeaves', "fas fa-bed", "Apply Leaves"),

);
session_start();
require_once "connect.php";
$fid = $_SESSION['FID'];

$sql = "select ROLE FROM logins WHERE FID='$fid'";

$stmt = $conn->query($sql);
$stmt = $stmt->fetchColumn();

if ($stmt == "HOD") {
    $access = $adminAccess;
} else {
    $access = $facultyAccess;
}
?>
<style>
#LogOut{text-decoration:wavy ;color:red;}
#LogOut a:hover { border-left: 4px solid Red;}
#LogOut *:hover{color:red;}
    </style>

<div class="scroll-sidebar">
    <!-- Sidebar navigation-->
    <nav class="sidebar-nav">
        <ul id="sidebarnav">
            <!-- User Profile-->


            <?php
            for ($row = 0; $row < count($access); $row++) {

            ?>
                <li class="sidebar-item">
                    <a class="sidebar-link waves-effect waves-dark sidebar-link" href="#" onClick='<?php echo $access[$row][0]; ?>();' aria-expanded="false">
                        <i class="me-3 <?php echo $access[$row][1]; ?>" aria-hidden="true"></i>
                        <span class="hide-menu"><?php echo $access[$row][2]; ?></span>
                    </a>
                </li>
            <?php }
            ?>
            <!--
            <li class="sidebar-item">
                <a class="sidebar-link waves-effect waves-dark sidebar-link" href="#" onClick="Leaves();" aria-expanded="false">
                    <i class="me-3 fa fa-table" aria-hidden="true"></i>
                    <span class="hide-menu">Leaves</span>
                </a>
            </li>
            <li class="sidebar-item">
                <a class="sidebar-link waves-effect waves-dark sidebar-link" href="#" onClick="Feedbacks();" aria-expanded="false">
                    <i class="me-3 fa fa-font" aria-hidden="true"></i>
                    <span class="hide-menu">Feedbacks</span>
                </a>
            </li>
-->
            <li class="sidebar-item">
                <a href="#"  onclick='changePassword();' class="sidebar-link waves-effect waves-dark sidebar-link" aria-expanded="false">
                    <i class="fas fa-key" aria-hidden="true"></i>
                    <span class="hide-menu"> Change Password</span></a>

            </li>
            <li id="LogOut" class="sidebar-item">
                <a href="logout.php" class="sidebar-link waves-effect waves-dark sidebar-link" aria-expanded="false">
                    <i style="color:red;" class="fas fa-sign-out-alt" aria-hidden="true"></i>
                    <span class="hide-menu">Logout</span></a>

            </li>
        </ul>

    </nav>
    <!-- End Sidebar navigation -->
</div>
<script>
    function Admindashbord() {
        $("#info").load("admindashbord.php #home");
    }

    function Profile() {
        
        $("#info").load("profile.php #profile");
    }

    function Leaves() {
        $("#info").load("leaves.php #leaves");
    }

    function ApplyLeaves() {
        $("#info").load("leaveapply.php #applyleave");
        $('.datepicker').datepicker({ 

startDate: new Date()

});
    }

    function Feedbacks() {
        $("#info").load("feedback.php #feedback")
    }

    function Facultydashbord() {
        $("#info").load("facultydashbord.php");
    }
    function changePassword() {
        $("#info").load("changePassword.php");
    }
    function Register() {
        $("#info").load("registerstaff.php");
    }
    function MapSubject() {
        $("#info").load("mapsubject.php");
    }
    function updateProf(){
        $("#info").load("updateProf.php");
    }
    function FacultyProfiles(){
        $("#info").load("FacultyProfiles.php");
    }
    function LeaveRequests(){
        $("#info").load("leaverequests.php");
    }

</script>