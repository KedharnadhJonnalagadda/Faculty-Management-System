
<?php
if (!isset($_SESSION)) {
    session_start();
}
require_once "connect.php";
$fid = $_SESSION['FID'];
$sql = "SELECT First_name FROM logins WHERE FID =?";
$stmt = $conn->prepare($sql);
$stmt->execute([$fid]);
$stmt = $stmt->fetchColumn();

$lrsql = "select * from leaves where END_DATE >CURRENT_DATE AND FID='$fid'";

$lrstmt = $conn->query($lrsql);
?>

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

    <div id="applyleave">

        <div class="page-wrapper">


            <div class="page-breadcrumb">
                <div class="row align-items-center">
                    <div class="col-md-6 col-8 align-self-center">
                        <h3 class="page-title mb-0 p-0">Apply Leaves</h3>
                        <div class="d-flex align-items-center">
                            <nav aria-label="breadcrumb">
                                <ol class="breadcrumb">
                                    <li class="breadcrumb-item"><a href="#">Home</a></li>
                                    <li class="breadcrumb-item active" aria-current="page">Apply Leave</li>
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
                    <!-- column -->
                    <div class="col-sm-12">
                        <div class="card">
                            <div class="card-body">
                                <form class="form-horizontal form-material mx-2" action="leaverequested.php" method="post">
                                    <div class="form-group">
                                        <label class="col-md-12 my-2">FID</label>
                                        <div class="col-md-12">
                                            <input type="text" value="<?php echo $fid; ?>" name="fid" placeholder="" class="form-control ps-0 form-control-line" style="cursor: not-allowed;" disabled>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label class="col-md-12 my-2">Name</label>
                                        <div class="col-md-12">
                                            <input type="text" value="<?php echo $stmt; ?>" placeholder="" class="form-control ps-0 form-control-line" style="cursor: not-allowed;" disabled>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <div class="row col-md-12 my-2">
                                            <label class="col-md-6 my-2">Start Date</label>
                                            <label class="col-md-6 my-2">End Date</label>
                                        </div>
                                        <div class="row col-md-12 my-2">
                                            <div class="col-md-6">
                                                
                                                <input type="date" id="datepicker" name="startdate" placeholder="" data-provide="datepicker" class="form-control datepicker">
                                            </div>
                                            <div class="col-md-6">
                                                
                                                <input type="date" id="datepicker" name="enddate" placeholder="" class="form-control datepicker">
                                            </div>
                                        </div>
                                    </div>
                                    
                                    <!-- <div class="form-group">
                                        <label class="col-md-12 my-2">Number of days</label>
                                        <div class="col-md-12">
                                            <input id="days" type="number" onkeyup="LeaveDate();" name="days" placeholder="Enter number of days you are leaving" class="form-control ps-0 form-control-line" required />
                                        </div>
                                        <br />
                                        <div class="col-md-4">
                                            <i id="datelogo" class="me-3 fa fa-table"> Date:</i><span id="selecteddate"></span>
                                            <input type="text" id="todaydate" name="todaydate" hidden />
                                            <input type="text" id="enddate" name="enddate" hidden />
                                        </div>
                                    </div> -->

                                    <div class="form-group">
                                        <label class="col-md-12 my-2">Description about leave</label>
                                        <div class="col-md-12">
                                            <textarea rows="5" name="leavedescription" class="form-control ps-0 form-control-line" required></textarea>
                                        </div>
                                    </div>
                                    <div class="form-group">

                                        <div class="col-md-12">
                                            <button type="submit" id="ApplyLeaveBtn" class="btn btn-outline-primary" value="Submit">Request</button>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>

            </div>
            
            <div class="container-fluid">

<div class="row">
    <!-- Column -->
    <div class="col-sm-12" >
        
        
        
        <div class="row">
            <div class="col-sm-12">
                <div class="card col-sm-12">
                    <div class="card-body">
                        <div class="d-md-flex">
                            <h4 class="card-title col-md-10 mb-md-0 mb-3 align-self-center">Leave Status & History</h4>
                                

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
                                        <tr class="active" id="Resigned">
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
                                            <td class="align-middle STATUS"><?php echo $row['STATUS'];?></td>
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

    </div>

