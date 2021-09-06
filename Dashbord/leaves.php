
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<?php
session_start();
require_once "connect.php";
$fid = $_SESSION['FID'];




$lsql = "select * from leaves where END_DATE>=CURRENT_DATE AND STATUS='GRANTED' ORDER by START_DATE ";
$lstmt = $conn->query($lsql);

print_r($lstmt);

?>




    <div id="leaves" class="page-wrapper">

        <div class="page-breadcrumb">
            <div class="row align-items-center">
                <div class="col-md-6 col-8 align-self-center">
                    <h3 class="page-title mb-0 p-0">Leaves</h3>
                    <div class="d-flex align-items-center">
                        <nav aria-label="breadcrumb">
                            <ol class="breadcrumb">
                                <li class="breadcrumb-item"><a href="#">Home</a></li>
                                <li class="breadcrumb-item active" aria-current="page">Leaves</li>
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
        <div class="container-fluid 0">

            <div class="row">
                <!-- column -->
                <div class="col-sm-12">
                    <div class="card">
                        <div class="card-body">
                            <h4 class="card-title">Leaves Table</h4>
                            <!--<h6 class="card-subtitle">Add class <code>.table</code></h6>-->
                            <div class="table-responsive">
                                <table class="table user-table no-wrap">
                                    <thead>
                                        <tr>
                                            <th class="border-top-0">#</th>
                                            <th class="border-top-0">FID</th>
                                            <th class="border-top-0">Name</th>
                                            <th class="border-top-0">No.of Days</th>
                                            <th class="border-top-0">Date</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php $count = 1;
                                        foreach ($lstmt as $row) : ?>
                                            <tr>
                                                <td><?php echo $count;
                                                    $count += 1; ?></td>
                                                <td><?php echo $row['FID'] ?></td>
                                                <?php
                                                $ffid = $row['FID'];
                                                $nsql = "select FIRST_NAME FROM logins where FID='$ffid' ";

                                                $nstmt = $conn->query($nsql);
                                                $nstmt = $nstmt->fetchColumn();
                                                ?>
                                                <td><?php echo $nstmt ?></td>
                                                <td><?php echo $row['DAYS']; ?></td>
                                                <td><?php echo $row['START_DATE'] . ' To ' . $row['END_DATE']; ?></td>
                                            </tr>
                                        <?php endforeach; ?>

                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <style>
            #history{
                display: none;
            }
            </style>
            
            <button class="btn btn-outline-primary" id="btnhistory" onclick="gethistory();">Show History</button>
            <br />
            <br />
            <?php
            $lsql = "select * from leaves order by start_date  desc";
            $lstmt = $conn->query($lsql);

            //print_r($lstmt);

            ?>
            
            
            <div id="history">

                <div class="row">
                    <!-- column -->
                    <div class="col-sm-12">
                        <div class="card">
                            <div class="card-body">
                                <h4 class="card-title">Leaves Table</h4>
                                <!--<h6 class="card-subtitle">Add class <code>.table</code></h6>-->
                                <div class="table-responsive">
                                    <table class="table user-table no-wrap">
                                        <thead>
                                            <tr>
                                                <th class="border-top-0">#</th>
                                                <th class="border-top-0">FID</th>
                                                <th class="border-top-0">Name</th>
                                                <th class="border-top-0">No.of Days</th>
                                                <th class="border-top-0">Date</th>
                                                <th class="border-top-0">Permission</th>

                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php $count = 1;
                                            foreach ($lstmt as $row) : ?>
                                                <tr>
                                                    <td><?php echo $count;
                                                        $count += 1; ?></td>
                                                    <td><?php echo $row['FID'] ?></td>
                                                    <?php
                                                    $ffid = $row['FID'];
                                                    $nsql = "select FIRST_NAME FROM logins where FID='$ffid' ";

                                                    $nstmt = $conn->query($nsql);
                                                    $nstmt = $nstmt->fetchColumn();
                                                    ?>
                                                    <td><?php echo $nstmt ?></td>
                                                    <td><?php echo $row['DAYS']; ?></td>
                                                    <td><?php echo $row['START_DATE'] . ' To ' . $row['END_DATE']; ?></td>
                                                    <td><?php echo $row['STATUS']; ?></td>
                                                </tr>
                                            <?php endforeach; ?>

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


