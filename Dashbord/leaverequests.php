<?php
require_once "connect.php";
if (!isset($_SESSION)) {
    session_start();
}
$lrsql = "select * from leaves where STATUS ='PENDING'";
$lrstmt = $conn->query($lrsql);

?>

<body>
    <div id="home" class="page-wrapper">

        <div class="page-breadcrumb">
            <div class="row align-items-center">
                <div class="col-md-6 col-8 align-self-center">
                    <h3 class="page-title mb-0 p-0">Leave Requests</h3>
                    <div class="d-flex align-items-center">
                        <nav aria-label="breadcrumb">
                            <ol class="breadcrumb">
                                <li class="breadcrumb-item"><a href="#">Home</a></li>
                                <li class="breadcrumb-item active" aria-current="page">Leave Requests</li>
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
                                        <h4 class="card-title col-md-10 mb-md-0 mb-3 align-self-center">Requests</h4>

                                    </div>
                                    <div class="table-responsive mt-3">
                                        <table class="table stylish-table no-wrap">
                                            <thead>
                                                <tr>
                                                    <th class="border-top-0">FID</th>
                                                    <th class="border-top-0" colspan="2">Name</th>
                                                    <th class="border-top-0">Date</th>
                                                    <th class="border-top-0">Days</th>
                                                    <th class="border-top-0">Reason</th>
                                                    <th class="border-top-0">Permission</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <?php foreach ($lrstmt as $row) : ?>
                                                    <tr class="active">
                                                        <td class="align-middle"><?php echo $row['FID']; ?></td>
                                                        <?php
                                                        $slrsql="select PROFILE,FIRST_NAME,ROLE from logins where FID='".$row['FID']."'";
                                                        $slrstmt=$conn->query($slrsql)->fetch();
                                                        ?>
                                                        <td style="width:50px;"><img src="../assets/images/users/<?php echo $slrstmt['PROFILE']; ?>" class="dark-logo"  style="width: 57px;left: 5px;"/></td>
                                                        <td class="align-middle">
                                                            <h5><?php echo $slrstmt['FIRST_NAME']; ?></h5><small class="text-muted"><?php echo $slrstmt['ROLE']; ?></small>
                                                        </td>
                                                        <td class="align-middle"><?php echo $row['START_DATE'].' To '.$row['END_DATE']; ?></td>
                                                        <td class="align-middle"><?php echo $row['DAYS']; ?></td>
                                                        <td class="align-middle"><?php echo $row['REASON']; ?></td>
                                                        <td class="align-middle">
                                                            <form action="leavegranted.php" method="POST">
                                                                <input type="text" value="<?php echo $row['FID']?>" name='rgfid' hidden />
                                                                <input type="text" value="<?php echo $row['START_DATE']?>" name='sd' hidden />
                                                                <input type="text" value="<?php echo $row['END_DATE']?>" name='ed' hidden />
                                                                <input type="text" value="<?php echo $row['TIMESTAMP']?>" name='ts' hidden />
                                                                <input type="submit" class="btn btn-outline-success" name="leavestatusgrant" value="Grant" />
                                                                <input type="submit" class="btn btn-outline-danger" name="leavestatusdenied" value="Denied" />
                                                                 
                                                            </form>
                                                        </td>
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
</body>