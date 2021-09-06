<?php
require_once "connect.php";
if (!isset($_SESSION)) {
    session_start();
}
$fid = $_SESSION['FID'];
$sql = "select FID,FIRST_NAME,ROLE,DEPARTMENT,SALARY,PROFILE,PHONE_NO,MAIL FROM logins  where STATUS ='ACTIVE'";
$stmt = $conn->query($sql);
$rsql = "select FID,FIRST_NAME,ROLE,DEPARTMENT,SALARY,PROFILE,PHONE_NO,MAIL  FROM logins  where STATUS !='ACTIVE'";
$rstmt = $conn->query($rsql);
?>


    <div id="home" class="page-wrapper">

        <div class="page-breadcrumb">
            <div class="row align-items-center">
                <div class="col-md-6 col-8 align-self-center">
                    <h3 class="page-title mb-0 p-0">Faculty Profiles</h3>
                    <div class="d-flex align-items-center">
                        <nav aria-label="breadcrumb">
                            <ol class="breadcrumb">
                                <li class="breadcrumb-item"><a href="#">Home</a></li>
                                <li class="breadcrumb-item active" aria-current="page">Faculty Profiles</li>
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
                <div class="col-sm-12" >
                    
                    
                    
                    <div class="row">
                        <div class="col-sm-12">
                            <div class="card col-sm-12">
                                <div class="card-body">
                                    <div class="d-md-flex">
                                        <h4 class="card-title col-md-10 mb-md-0 mb-3 align-self-center">Faculty
                                            Profiles</h4>

                                    </div>
                                    <div class="table-responsive mt-3">
                                        <table class="table stylish-table no-wrap">
                                            <thead>
                                                <tr>
                                                    <th class="border-top-0">FID</th>
                                                    <th class="border-top-0" colspan="2">Name</th>
                                                    <th class="border-top-0">Phone Number</th>
                                                    <th class="border-top-0">Email</th>
                                                    <th class="border-top-0">Department</th>
                                                    <th class="border-top-0">Salary</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <?php foreach ($stmt as $row) : ?>
                                                    <tr class="active">
                                                        <td class="align-middle"><?php echo $row['FID']; ?></td>
                                                        <td style="width:50px;"><img src="../assets/images/users/<?php echo $row['PROFILE']; ?>" class="dark-logo"  style="width: 57px;left: 5px;"/></td>
                                                        <td class="align-middle">
                                                            <h5><?php echo $row['FIRST_NAME']; ?></h5><small class="text-muted"><?php echo $row['ROLE']; ?></small>
                                                        </td>
                                                        <td class="align-middle"><?php echo $row['PHONE_NO']; ?></td>
                                                        <td class="align-middle"><?php echo $row['MAIL']; ?></td>
                                                        <td class="align-middle"><?php echo $row['DEPARTMENT']; ?></td>
                                                        <td class="align-middle"><?php echo $row['SALARY']; ?></td>
                                                    </tr>
                                                <?php endforeach; ?>

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
            <style>
            #resignedfaculty{
                display: none;
            }
            </style><style>
                #resigned tr { border-left: 3px solid Red;}
            </style>
            <button class="btn btn-outline-primary" id="btnresignedfaculty" onclick="getresignedfaculty();">Resigned Faculty Profiles</button>
            <br />
            <br />
            <div class="row" id="resignedfaculty">
                <!-- Column -->
                <div class="col-sm-12" >
                    
                    
                    
                    <div class="row">
                        <div class="col-sm-12">
                            <div class="card col-sm-12">
                                <div class="card-body">
                                    <div class="d-md-flex">
                                        <h4 class="card-title col-md-10 mb-md-0 mb-3 align-self-center">Resigned Faculty
                                            Profiles</h4>

                                    </div>
                                    <div class="table-responsive mt-3">
                                        <table class="table stylish-table no-wrap" id="resigned">
                                            <thead>
                                                <tr>
                                                    <th class="border-top-0">FID</th>
                                                    <th class="border-top-0" colspan="2">Name</th>
                                                    <th class="border-top-0">Phone Number</th>
                                                    <th class="border-top-0">Email</th>
                                                    <th class="border-top-0">Department</th>
                                                    <th class="border-top-0">Salary</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <?php foreach ($rstmt as $row) : ?>
                                                    <tr class="active">
                                                        <td class="align-middle"><?php echo $row['FID']; ?></td>
                                                        <td style="width:50px;"><img src="../assets/images/users/<?php echo $row['PROFILE']; ?>" class="dark-logo"  style="width: 57px;left: 5px;"/></td>
                                                        <td class="align-middle">
                                                            <h5><?php echo $row['FIRST_NAME']; ?></h5><small class="text-muted"><?php echo $row['ROLE']; ?></small>
                                                        </td>
                                                        <td class="align-middle"><?php echo $row['PHONE_NO']; ?></td>
                                                        <td class="align-middle"><?php echo $row['MAIL']; ?></td>
                                                        <td class="align-middle"><?php echo $row['DEPARTMENT']; ?></td>
                                                        <td class="align-middle"><?php echo $row['SALARY']; ?></td>
                                                    </tr>
                                                <?php endforeach; ?>

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
