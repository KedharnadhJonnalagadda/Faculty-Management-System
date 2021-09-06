<?php
require_once "connect.php";

error_reporting(0);
$sql = "select FID,FIRST_NAME,ROLE,DEPARTMENT,SALARY FROM logins";
$stmt = $conn->query($sql);

$COUNT = 0;
$csql = "select COUNT(*) from logins";
$cstmt = $conn->query($csql);
$COUNT = $cstmt->fetchColumn();

$Lsql = "select COUNT(FID) from leaves where END_DATE>=CURRENT_DATE";
$Lstmt = $conn->query($Lsql);
$Leaves = $Lstmt->fetchColumn();

$Coursesql = "select SUB1,SUB2,SUB3,SUB4,SUB5,SUB6,LAB1,LAB2,LAB3,ELE1,ELE2,ELE3,ELE4,ELE5,ELE6,ELE7 from courses where BRANCH='CSE' AND YEAR>1 ORDER BY YEAR ASC,SEM ";
$CourseStmt = $conn->query($Coursesql);
$CourseStmt = $CourseStmt->fetchAll(PDO::FETCH_ASSOC);
$YSCoursesql = "select YEAR ,SEM from courses where BRANCH='CSE' AND YEAR>1 ORDER BY YEAR ASC,SEM ";
$YSCourseStmt = $conn->query($YSCoursesql);
$YSCourseStmt = $YSCourseStmt->fetchAll(PDO::FETCH_ASSOC);
$yscount = 0;

$ListSubjects = array();
foreach ($CourseStmt as $Crow) {

    foreach ($Crow as $CCrow) {
        if ($CCrow != "") {



            array_push($ListSubjects, $CCrow);
        }
    }
}
sort($ListSubjects);
//print_r($ListSubjects);
$allFids = $conn->query("SELECT FID,FIRST_NAME from logins")->fetchall();;
// print_r($allFids);
$fids = array();

foreach ($allFids as $f) {
    array_push($fids, $f['FID'] . ' (' . $f['FIRST_NAME'] . ')');
}
//print_r($fids);

//print_r($names);
$unmapstmt=$conn->query("SELECT * FROM subjects")->fetchAll();
$unmap=array();
// $unmapfids=array();
foreach ($unmapstmt as $f) {
    $ffid=$f['FID'];
    // array_push($unmapfids,$ffid);
    $unFname = $conn->query("SELECT FIRST_NAME from logins where FID = '$ffid'")->fetchColumn();
    array_push($unmap, $f['SUBJECT']."->".$f['FID'] . ' (' . $unFname. ')->'.$f['SECTION']);
}
// print_r($unmapfids);

?>


<style type="text/css">
    tbody tr:hover {
        background-color: #F5F5F5;

    }

    td input {

        background-color: #F5F5F5;
    }
</style>

<div id="profile" class="page-wrapper">
    <div class="page-breadcrumb">
        <div class="row align-items-center">
            <div class="col-md-6 col-8 align-self-center">
                <h3 class="page-title mb-0 p-0">Map Subjects</h3>
                <div class="d-flex align-items-center">
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="#">Home</a></li>
                            <li class="breadcrumb-item active" aria-current="page">Map Subjects</li>
                        </ol>
                    </nav>
                </div>
            </div>

        </div>
    </div>
    <style>
        #NewMap {
            display: none;
        }
        #UnMap {
            display: none;
        }
    </style>
    <style>
    body {
        background: #F5F5F5;
    }
</style>

    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-8 col-xlg-9 col-md-7" id="UnMap">
                <div class="card">
                    <div class="card-body">
                        <form action="subjectunmapped.php" method="post" onsubmit="return confirm('Are you sure Want to Unmap...?')" class="form-horizontal form-material mx-2">
                            <div class="form-group">

                                <div class="col-md-12">
                                    <h4 class="card-title col-md-10 mb-md-0 mb-3 align-self-center">SUBJECT UN-MAP</h4>
                                </div>
                            </div>
                           
                            <div class="form-group">
                                <label class="col-md-12 mb-0">Select Subject</label>
                                <div class="col-md-12">
                                    <select class="form-select shadow-none border-0 ps-0 " name="subfid">
                                        <option value="">Select</option>
                                        <?php  foreach ($unmap as $CCrow) { ?>
                                            <option value='<?php echo $CCrow;?>'><?php echo $CCrow; ?></option>
                                        <?php
                                        } ?>
                                    </select>
                                </div>
                            </div>
                            
                            <div class="form-group">
                                <div class="col-sm-1" align="right">
                                    <input type="submit" name="UnMap" value="UnMap" class="btn btn-outline-danger" />
                                </div>
                            </div>

                        </form>
                    </div>
                </div>
            </div>
            <div class="col-lg-8 col-xlg-9 col-md-7" id="NewMap">
                <div class="card">
                    <div class="card-body">
                        <form action="subjectmapped.php" method="post" onsubmit="return confirm('Are you sure Want to Map...?')" class="form-horizontal form-material mx-2">
                            <div class="form-group">

                                <div class="col-md-12">
                                    <h4 class="card-title col-md-10 mb-md-0 mb-3 align-self-center">SUBJECT MAP</h4>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-md-12 mb-0">SUBJECT</label>
                                <div class="col-md-12">
                                    <select class="form-select shadow-none border-0 ps-0 " name="subject">
                                        <option value="">Select</option>
                                        <?php foreach ($ListSubjects as $CCrow) { ?>
                                            <option value='<?php echo $CCrow; ?>'><?php echo $CCrow; ?></option>
                                        <?php
                                        } ?>
                                    </select>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-md-12 mb-0">FID</label>
                                <div class="col-md-12">
                                    <select class="form-select shadow-none border-0 ps-0 " name="fid">
                                        <option value="">Select</option>
                                        <?php foreach ($fids as $CCrow) { ?>
                                            <option value='<?php echo substr($CCrow, 0, strpos($CCrow, " ")); ?>'><?php echo $CCrow; ?></option>
                                        <?php
                                        } ?>
                                    </select>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-md-12 mb-0">SECTION</label>
                                <div class="col-md-12">
                                    <select class="form-select shadow-none border-0 ps-0 " name="section">
                                        <option value="">Select</option>
                                        <option value="1">1</option>
                                        <option value="2">2</option>
                                        <option value="Both">Both</option>
                                    </select>
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="col-sm-1" align="right">
                                    <input type="submit" name="Map" value="Map" class="btn btn-outline-primary" />
                                </div>
                            </div>

                        </form>
                    </div>
                </div>
            </div>
            <div class="col-sm-12">
                <div class="card">
                    <div class="card-body">
                        <div class="d-md-flex ">
                            <div class="col-sm-8" align="left">
                                <h4 class="card-title col-md-10 mb-md-0 mb-3 align-self-center">SUBJECT MAPING</h4>
                            </div>
                            <div class="col-sm-2" align="right">
                                <input type="submit" value="New Map" class="btn btn-outline-primary" id="btnnewmap" onclick="newmap();" />
                            </div>
                            <div class="col-sm-2" align="right">
                                <input type="submit" value="Un-Map" class="btn btn-outline-danger" id="btnnewmap" onclick="unmap();" />
                            </div>
                        </div>
                        <div class="table-responsive mt-3">
                            <table class="table stylish-table no-wrap">
                                <thead>
                                    <tr>
                                        <th class="border-top-0">Year</th>
                                        <th class="border-top-0">Sem</th>
                                        <th class="border-top-0">Course</th>
                                        <th class="border-top-0" colspan="4">FID & Section</th>


                                        <!-- <th class="border-top-0">FID</th>
                                        <th class="border-top-0" colspan="2">Name</th>
                                        <th class="border-top-0">Department</th>
                                        <th class="border-top-0">Salary</th>
                                    </tr> -->
                                </thead>
                                <tbody>
                                    <?php foreach ($CourseStmt as $Crow) :

                                        foreach ($Crow as $CCrow) :
                                            if ($CCrow != "") :
                                    ?>

                                                <tr>
                                                    <td class="align-middle"><?php echo $YSCourseStmt[$yscount]['YEAR']; ?></td>
                                                    <td class="align-middle"><?php echo $YSCourseStmt[$yscount]['SEM']; ?></td>
                                                    <td class="align-middle"><?php echo $CCrow; ?></td>


                                                    <?php


                                                    $fcsub = "select FID,SECTION from subjects where SUBJECT='$CCrow'";
                                                    $fcsub = $conn->query($fcsub)->fetchAll();
                                                    //print_r($fcsub);
                                                    if ($fcsub != "") :

                                                        for ($i = 0; $i < 2; $i++) :
                                                            if ($fcsub[$i]['FID'] != "") :
                                                    ?>

                                                                <td class="align-middle tdfidmap" id="tdfidmap">
                                                                    <?php echo $fcsub[$i]['FID']; ?>
                                                                </td>
                                                            <?php else : ?><td class="align-middle tdfidmap" id="tdfidmap"></td>
                                                            <?php endif;
                                                            if ($fcsub[$i]['SECTION'] != "") :
                                                            ?>

                                                                <td class="align-middle tdfidmap" id="tdfidmap">
                                                                    <?php echo $fcsub[$i]['SECTION']; ?>
                                                                </td>
                                                            <?php else : ?><td class="align-middle tdfidmap" id="tdfidmap"></td>
                                                            <?php endif; ?>
                                                        <?php endfor; ?> <?php endif; ?>

                                                </tr>
                                        <?php endif;
                                        endforeach;
                                        $yscount += 1; ?>
                                    <?php endforeach; ?>
                                    <tr ng-repeat="data in namesData" ng-include="getTemplate(data)">
                                    </tr>
                                    <!-- <?php foreach ($stmt as $row) : ?>
                                        <tr>
                                            <td class="align-middle"><?php echo $row['FID']; ?></td>
                                            <td style="width:50px;"><span class="round"><?php echo $row['FIRST_NAME'][0]; ?></span></td>
                                            <td class="align-middle">
                                                <h5><?php echo $row['FIRST_NAME']; ?></h5><small class="text-muted"><?php echo $row['ROLE']; ?></small>
                                            </td>
                                            <td class="align-middle"><?php echo $row['DEPARTMENT']; ?></td>
                                            <td class="align-middle"><?php echo $row['SALARY']; ?></td>
                                        </tr>
                                    <?php endforeach; ?> -->


                                </tbody>
                            </table>

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

</div>