<?php
ob_start();
session_start();
if ($_SESSION['FID']) {
} else {
    header('Location: ' . '../newloginbs.php');
}

$cookiemsg = "msg";
$cookievalue = $_SESSION["message"];
$msg = $_SESSION["message"];

setcookie($cookiemsg, $cookievalue, time() + (86400 * 30), "/");

require_once "connect.php";
$fid = $_SESSION['FID'];

$sql = "select * FROM logins WHERE FID='$fid'";
//echo $sql;
//print $_SESSION["message"]."hiuuuuuuuuuuuuuuuuuuuuuuuuuuuuuu".$_SESSION["message"];
$stmt = $conn->query($sql);

$stmt = $stmt->fetch();
//print_r($stmt);

$role =  $stmt['ROLE'];
if ($role == 'HOD') {
    $dashboard = "admindashbord.php";
} else {
    $dashboard = "facultydashbord.php";
}

?>

<!DOCTYPE html>
<html dir="ltr" lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">

    <!-- Tell the browser to be responsive to screen width -->
    <meta name="viewport" content="width=device-width, initial-scale=1">
<!-- <meta name="viewport" content="width=1024"> -->
    <title>Admin Dashboard</title>
    <link rel="canonical" href="https://www.wrappixel.com/templates/monster-admin-lite/" />
    <!-- Favicon icon -->
    <link rel="icon" type="image/png" sizes="16x16" href="../assets/images/favicon.png">
    <!-- Custom CSS -->
    <link href="../assets/plugins/chartist/dist/chartist.min.css" rel="stylesheet">
    <!-- Custom CSS -->
    <link href="css/style.min.css" rel="stylesheet">

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>

    

</head>

<body>

    <div class="preloader">
        <div class="lds-ripple">
            <div class="lds-pos"></div>
            <div class="lds-pos"></div>
        </div>
    </div>

    <div id="main-wrapper" data-layout="vertical" data-navbarbg="skin6" data-sidebartype="full" data-sidebar-position="absolute" data-header-position="absolute" data-boxed-layout="full">

        <header class="topbar" data-navbarbg="skin6">
            <nav class="navbar top-navbar navbar-expand-md navbar-dark">
                <div class="navbar-header" data-logobg="skin6">
                    <!-- ============================================================== -->
                    <!-- Logo -->
                    <!-- ============================================================== -->
                    <a class="navbar-brand" href="index.html">
                        <!-- Logo icon -->
                        <b class="logo-icon">
                            <!--You can put here icon as well // <i class="wi wi-sunset"></i> //-->
                            <!-- Replace with clg logo icon -->
                            <img src="../assets/images/logo-icon.png" alt="homepage" class="dark-logo" style="width: 57px;left: 5px;" />

                        </b>
                        <!--End Logo icon -->
                        <!-- Logo text -->
                        <span class="logo-text">
                            <!-- Replace with clg Logo text -->


                        </span>
                    </a>
                    <!-- ============================================================== -->
                    <!-- End Logo -->
                    <!-- ============================================================== -->
                    <!-- ============================================================== -->
                    <!-- toggle and nav items -->
                    <!-- ============================================================== -->
                    <a class="nav-toggler waves-effect waves-light text-dark d-block d-md-none" href="javascript:void(0)"><i class="ti-menu ti-close"></i></a>
                </div>
                <!-- ============================================================== -->
                <!-- End Logo -->
                <!-- ============================================================== -->
                <div class="navbar-collapse collapse" id="navbarSupportedContent" data-navbarbg="skin5">

                    <!-- ============================================================== -->
                    <!-- toggle and nav items -->
                    <!-- ============================================================== -->
                    <ul class="navbar-nav me-auto mt-md-0 ">
                        <!-- ============================================================== -->
                        <!-- Search -->
                        <!-- ============================================================== -->

                        <li class="nav-item hidden-sm-down">
                            <form class="app-search ps-3">
                                <input type="text" id="myQuery" class="form-control" placeholder="Search for..."> <a class="srh-btn"><i class="ti-search"></i></a>
                            </form>
                        </li>
                    </ul>

                    <!-- ============================================================== -->
                    <!-- Right side toggle and nav items -->
                    <!-- ============================================================== -->
                    <ul class="navbar-nav">
                        <!-- ============================================================== -->
                        <!-- User profile and search -->
                        <!-- ============================================================== -->
                        <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle waves-effect waves-dark" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">

                                <img src="../assets/images/users/<?php echo $stmt['PROFILE']; ?>" alt="user" class="profile-pic me-2">


                                <?php echo $stmt["FIRST_NAME"] ;?>

                            </a>

                        </li>
                    </ul>
                </div>
            </nav>
        </header>

        <aside class="left-sidebar" data-sidebarbg="skin6">
            <!-- Sidebar scroll-->
            <div id="sidenav"></div>
            <!-- End Sidebar scroll-->
        </aside>
        
        <div id="info">
            <?php include $_SESSION['page']; ?>
        </div>
        <div id="message"></div>
        <footer class="footer text-center">
           <strong> Designed by Harsha Nikkam and Kedharnadh Jonnalagadda</strong>
        </footer>

        <script src="../assets/plugins/jquery/dist/jquery.min.js"></script>
        <!-- Bootstrap tether Core JavaScript -->
        <script src="../assets/plugins/bootstrap/dist/js/bootstrap.bundle.min.js"></script>
        <script src="js/app-style-switcher.js"></script>
        <!--Wave Effects -->
        <script src="js/waves.js"></script>
        <!--Menu sidebar -->
        <script src="js/sidebarmenu.js"></script>
        <!--Custom JavaScript -->
        <script src="js/custom.js"></script>
        <!--This page JavaScript -->
        <!--flot chart-->
        <script src="../assets/plugins/flot/jquery.flot.js"></script>
        <script src="../assets/plugins/flot.tooltip/js/jquery.flot.tooltip.min.js"></script>
        <script src="js/pages/dashboards/dashboard1.js"></script>
        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
        <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
        <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js"></script>
        <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.13.0/css/all.min.css">
</body>

</html>
<script>
    $(document).ready(function() {

        
        $("#sidenav").load("sidenav.php");

    });
</script>

<script>
    function copyToClipboard() {
      var link= document.getElementById('copyfeedlink');
      //alert(link.value);
      link.select();
      document.execCommand("copy");
  
      document.getElementById("copyfeedlinkbtn").innerHTML="Link Copied to clipboard";
}
    function gethistory() {

        $("#history").toggle(1000);

    }
    function getresignedfaculty() {

$("#resignedfaculty").toggle(1000);

}
var scount=0;
function endiprofile(){
    
    document.getElementById('Fname').disabled=false;
    document.getElementById('Sname').disabled=false;
    document.getElementById('mail').disabled=false;
    document.getElementById('address').disabled=false;
    document.getElementById('Fname').style.borderColor="#87CEFA";
    document.getElementById('Sname').style.borderColor="#87CEFA";
    document.getElementById('mail').style.borderColor="#87CEFA";
    document.getElementById('address').style.borderColor="#87CEFA";
    document.getElementById('edit').value="Update";
    if(scount==1)
    document.getElementById('edit').type='submit';
    scount++;
    
}

    function newmap() {

        $("#NewMap").toggle(1000);
        $("#UnMap").hide("slow");

    }

    function unmap() {
        $("#NewMap").hide(1000);
        $("#UnMap").toggle(1000);

    }
    $(document).on("click", "#subjectdic", function() {
        var Id = $(this).data('id');
        var SubJECT = $(this).data('subject');
        var idsub = Id + "<br/>" + SubJECT;
        $(".modal-body h6").html(idsub);


        var disc = $(this).data('feedback');
        $(".modal-body #feedback_disc").html(disc);

        var disc = $(this).data('avgfeedchar');
        $(".modal-footer #avgfeedchar").html(disc);

        var avgRating = $(this).data('avgfeedback').substring(0, 3);
        if (!avgRating) {
            avgRating = "0.0";
        }
        $(".modal-footer #avgRating").html(avgRating);



        var countfeedback = $(this).data('countfeedback');
        var totalfeedback = $(this).data('totalfeedback');
        //alert(totalfeedback);
        var f1 = 0,
            f2 = 0,
            f3 = 0,
            f4 = 0,
            f5 = 0;
        if (totalfeedback.length != 0) {
            for (var i = 0; i < totalfeedback.length+1; i++) {
                if (totalfeedback[i] == 5) {
                    f5 += 1;
                } else if (totalfeedback[i] == 4) {
                    f4 += 1;
                } else if (totalfeedback[i] == 3) {
                    f3 += 1;
                } else if (totalfeedback[i] == 2) {
                    f2 += 1;
                } else if (totalfeedback[i] == 1) {
                    f1 += 1;
                }
            }
            f1 = (100 / countfeedback) * f1;
            f2 = (100 / countfeedback) * f2;
            f3 = (100 / countfeedback) * f3;
            f4 = (100 / countfeedback) * f4;
            f5 = (100 / countfeedback) * f5;
        }

        var newprogress = 3;
        $(".modal-footer #f1").css('width', f1.toString() + '%').html(f1.toString() + '%');
        $(".modal-footer #f2").css('width', f2.toString() + '%').html(f2.toString() + '%');
        $(".modal-footer #f3").css('width', f3.toString() + '%').html(f3.toString() + '%');
        $(".modal-footer #f4").css('width', f4.toString() + '%').html(f4.toString() + '%');
        $(".modal-footer #f5").css('width', f5.toString() + '%').html(f5.toString() + '%');
        f1 = 0;
        f2 = 0;
        f3 = 0;
        f4 = 0;
        f5 = 0;
    });
</script>
<script>
    $(document).ready(function() {
        $("#myQuery").on("keyup", function() {
            var that = this,
                $allListElements = $('#info tbody > tr');

            var $matchingListElements = $allListElements.filter(function(i, li) {
                var listItemText = $(li).text().toUpperCase(),
                    searchText = that.value.toUpperCase();

                return ~listItemText.indexOf(searchText);
            });

            $allListElements.hide();
            $matchingListElements.show();
            //add this
            $allListElements.parents('.brands-letter').hide();
            $matchingListElements.parents('.brands-letter').show();


        });
        $('.datepicker').datepicker({ 

startDate: new Date()

});

    });

    function msg() {
        $("#message").load("successmessage.php");
    }
</script>


<script>
    function init() {
        $(document).ready(function() {

            $("#profile-pic").load("profileupdate.php");

        });
    }
</script>

<style>
    body {
        background: #F5F5F5;
    }
</style>
<script>
    function LeaveDate() {
        var x = document.getElementById("days").value;
        var d = new Date();
        var dd = d.getDate();
        var mm = d.getMonth() + 1;
        var y = d.getFullYear();

        var someDate = new Date();

        var numberOfDaysToAdd = parseInt(x);
        someDate.setDate(someDate.getDate() + numberOfDaysToAdd);
        var sdd = someDate.getDate();
        var smm = someDate.getMonth() + 1;
        var sy = someDate.getFullYear();
        if (x > 0) {
            var startDate = dd.toString() + '/' + mm.toString() + '/' + y.toString();
            var endDate = sdd.toString() + '/' + smm.toString() + '/' + sy.toString();
            document.getElementById("selecteddate").innerHTML = startDate + " To " + endDate;
            document.getElementById("todaydate").value = startDate;
            document.getElementById("enddate").value = endDate;


        } else {
            document.getElementById("selecteddate").innerHTML = "";
            document.getElementById("todaydate").value = "";
            document.getElementById("enddate").value = "";


        }
    }
</script>
<script>
   
    const togglePassword = document.querySelector('#togglePassword');
    const password = document.querySelector('#new_password');
    togglePassword.addEventListener('click', function(e) {
        // toggle the type attribute
        const type = password.getAttribute('type') === 'password' ? 'text' : 'password';
        password.setAttribute('type', type);
        // toggle the eye slash icon
        this.classList.toggle('fa-eye-slash');
    });
</script>
<?php
if ($msg != "") {
    echo "<script>msg();</script>";
}
$pageRefreshed = isset($_SERVER['HTTP_CACHE_CONTROL']) && ($_SERVER['HTTP_CACHE_CONTROL'] === 'max-age=0' ||  $_SERVER['HTTP_CACHE_CONTROL'] == 'no-cache');
if ($pageRefreshed == 1) {
    $_SESSION['page'] = $dashboard;
} else {
    //enter code here
    echo "No";
}
?>