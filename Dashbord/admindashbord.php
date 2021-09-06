<?php
require_once "connect.php";
if (!isset($_SESSION)) {
    session_start();
}
$fid = $_SESSION['FID'];


$COUNT = 0;
$csql = "select COUNT(FID) from logins where STATUS='ACTIVE'";
$cstmt = $conn->query($csql);
$COUNT = $cstmt->fetchColumn();

$Lsql = "select COUNT(FID) from leaves where END_DATE>=CURRENT_DATE AND STATUS='GRANTED'";
$Lstmt = $conn->query($Lsql);
$Leaves = $Lstmt->fetchColumn();
$subsql = "SELECT SUBJECT,SECTION FROM subjects where FID=?";
$substmt = $conn->prepare($subsql);
$substmt->execute([$fid]);
$ccount = $substmt;
$ccount = $ccount->fetchAll();

$fid = $_SESSION['FID'];
$ccsql = "SELECT SUM(DAYS) FROM leaves WHERE FID =?";
$ccstmt = $conn->prepare($ccsql);
$ccstmt->execute([$fid]);
$cleaves = $ccstmt->fetchColumn();


?>




<body>
    <div id="home" class="page-wrapper">

        <div class="page-breadcrumb">
            <div class="row align-items-center">
                <div class="col-md-6 col-8 align-self-center">
                    <h3 class="page-title mb-0 p-0">Dashboard</h3>
                    <div class="d-flex align-items-center">
                        <nav aria-label="breadcrumb">
                            <ol class="breadcrumb">
                                <li class="breadcrumb-item"><a href="#">Home</a></li>
                                <li class="breadcrumb-item active" aria-current="page">Dashboard</li>
                            </ol>
                        </nav>
                    </div>
                </div>

            </div>
        </div>
        <style>
            body {
                background: #F5F5F5;
            }
        </style>

        <div class="container-fluid">

            <div class="row">
                <!-- Column -->
                <div class="col-sm-12" style="width: auto;">
                    <div class="card col-sm-6">
                        <div class="card-body">
                            <h4 class="card-title">Total Faculty</h4>
                            <div class="text-end">
                                <h2 class="font-light mb-0"><i class="ti-arrow-up text-success"></i><?php echo ($COUNT) ?></h2>

                                <!--<span class="text-muted">Todays Income</span>-->
                            </div>

                        </div>
                    </div>
                    <!-- Column -->
                    <!-- Column -->
                    <div class="col-sm-12" style="width: auto;">
                        <div class="card col-sm-3">
                            <div class="card-body">
                                <h4 class="card-title">Faculty on leave</h4>
                                <div class="text-end">
                                    <h2 class="font-light mb-0"><i class="ti-arrow-up text-info"></i> <?php echo ($Leaves) ?></h2>
                                    <!--<span class="text-muted">Todays Income</span>-->
                                </div>

                            </div>
                        </div>

                        <!-- Column -->
                    </div>
                    <div class="row">
                        <div class="col-sm-12">
                            <div class="card col-sm-8">
                                <div class="card-body">
                                    <div class="d-md-flex">
                                        <h4 class="card-title col-md-10 mb-md-0 mb-3 align-self-center">Handling Subjects</h4>

                                    </div>
                                    <div class="table-responsive mt-3">
                                        <table class="table stylish-table no-wrap">
                                            <thead>
                                                <tr>

                                                    <th class="border-top-0">Subject</th>
                                                    <th class="border-top-0">Year</th>
                                                    <th class="border-top-0">Branch</th>
                                                    <th class="border-top-0">Section</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <?php for ($r = 0; $r < count($ccount); $r++) : ?>
                                                    <tr class="active">
                                                        <?php
                                                        $sub = $ccount[$r]['SUBJECT'];
                                                        $ybsql = "SELECT YEAR,BRANCH FROM courses WHERE SUB1 LIKE '%$sub%' or SUB2 LIKE '%$sub%' or SUB3 LIKE '%$sub%' or SUB4 LIKE '%$sub%' or SUB5 LIKE '%$sub%' or SUB6='%$sub%' or ELE1 like '%$sub%' or ELE2 like '%$sub%'";
                                                        //echo $ybsql;
                                                        $ybstmt = $conn->query($ybsql);
                                                        $ybstmt = $ybstmt->fetch();
                                                        //print_r( $ybstmt);
                                                        //echo "hi<br><br/>";
                                                        if (empty($ybstmt)) {
                                                            echo "hioo";
                                                            continue;
                                                        }

                                                        ?>
                                                        <td class="align-middle"><?php echo $ccount[$r]['SUBJECT']; ?></td>

                                                        <td class="align-middle"><?php echo $ybstmt['YEAR'] ?></td>
                                                        <td class="align-middle"><?php echo $ybstmt['BRANCH'] ?></td>
                                                        <td class="align-middle"><?php echo $ccount[$r]['SECTION']; ?></td>
                                                    </tr>

                                                <?php endfor; ?>
                                                </tr>
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    
                </div>

            </div>


        </div>

    </div>
</body>