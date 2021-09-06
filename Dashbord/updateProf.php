<body>

    <div class="page-wrapper">
        <?php
        if (!isset($_SESSION)) {
            session_start();
        }
        require_once "connect.php";

        $genFid = $conn->query("SELECT FID FROM logins ORDER BY FID DESC LIMIT 1");
        $genFid = $genFid->fetchColumn();
        // print_r( explode('0',$genFid,2));
        $genFidarr = explode('0', $genFid, 2);
        $genFid = $genFidarr[0] . '0' . ($genFidarr[1] + 1);
        //echo $genFid;
        $upstmt = $conn->query("SELECT FID,FIRST_NAME FROM logins")->fetchAll();
        $upfids = array();
        // $unmapfids=array();
        $upfidsnames = array();
        foreach ($upstmt as $f) {
            $ffid = $f['FID'];
            array_push($upfids, $ffid);
            array_push($upfidsnames, $f['FID'] . ' (' . $f['FIRST_NAME'] . ')');
        }
        $fid = $_SESSION['FID'];
        $adminpass = $conn->query("SELECT PASSWORD FROM logins where FID='$fid'")->fetchColumn();

        // print_r($upfids);
        ?>

        <div class="page-breadcrumb">
            <div class="row align-items-center">
                <div class="col-md-6 col-8 align-self-center">
                    <h3 class="page-title mb-0 p-0">Update Staff Profile</h3>
                    <div class="d-flex align-items-center">
                        <nav aria-label="breadcrumb">
                            <ol class="breadcrumb">
                                <li class="breadcrumb-item"><a href="index.html">Home</a></li>
                                <li class="breadcrumb-item active" aria-current="page">Update Staff Profile</li>
                            </ol>
                        </nav>
                    </div>
                </div>

            </div>
        </div>
        <style>
            input[type=number]::-webkit-inner-spin-button,
            input[type=number]::-webkit-outer-spin-button {
                -webkit-appearance: none;
                margin: 0;
            }

            form section i {
                margin-top: -10%;
                margin-left: 90%;
                cursor: pointer;
            }
        </style>
        <style>
    body {
        background: #F5F5F5;
    }
</style>
        <script type="text/javascript">
            function confirmprompt() {
                var propt = prompt('Are you sure you want to Update Staff Profile->Enter Password');
                // document.getElementById('adminpass').value=propt;
                if (propt !== "" && propt == <?php echo json_encode($adminpass) ?>) {
                    document.getElementById('adminpass').value = propt;

                    return true;
                } else {
                    document.getElementById("passfaild").innerHTML = "Wrong Password";
                    return false;
                }

            }
        </script>
        <div class="container-fluid">

            <!-- Row -->
            <div class="row">
                <!-- Column -->
                <div class="col-lg-8 col-xlg-9 col-md-7">
                    <div class="card">
                        <div class="card-body">
                            <form action="updatestaffprofgranted.php" method="post" onsubmit="return confirmprompt();" class="form-horizontal form-material mx-2">
                                <div class="form-header">
                                    <h5 class="page-title mb-0 p-0 " style="color:#04befe">Update Profile</h5>
                                    <br/>
                                </div>
                                <div class="form-group">
                                    <label class="col-md-12 mb-0">FID</label>
                                    <div class="col-md-12">
                                        <select class="form-select shadow-none border-0 ps-0 " name="subfid" required>
                                            <option value="">Select</option>
                                            <?php $upfidcount = 0;
                                            foreach ($upfids as $CCrow) { ?>
                                                <option value='<?php echo $CCrow; ?>'><?php echo $upfidsnames[$upfidcount];
                                                                                        $upfidcount += 1; ?></option>
                                            <?php
                                            } ?>
                                        </select>
                                    </div>
                                </div>


                                <div class="form-group">
                                    <label class="col-sm-12">Experience</label>
                                    <div class="col-sm-12 ">
                                        <input type="number" placeholder="" max="99" name="exp" title="No one can leave more then 99 years" class="form-control ps-0 form-control-line" />
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="col-sm-12">Salary</label>
                                    <div class="col-sm-12 ">
                                        <input type="number" placeholder="" min="1000" max="200000" name="salary" title="max 999999" class="form-control ps-0 form-control-line" />
                                    </div>
                                </div>
                                <div class="form-group">

                                    <label class="col-sm-12">Select Branch</label>
                                    <div class="col-sm-12 ">
                                        <select name="branch" id="branch" class="form-select shadow-none border-0 ps-0 form-control-line">
                                            <option value="">Select</option>
                                            <option value="CSE">CSE</option>
                                            <option value="ECE">ECE</option>
                                            <option value="EEE">EEE</option>
                                            <option value="MECH">MECH</option>
                                            <option value="CIVIL">CIVIL</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="col-sm-12">Select Role</label>
                                    <div class="col-sm-12 ">
                                        <select name="role" id="branch" class="form-select shadow-none border-0 ps-0 form-control-line">
                                            <option value="">Select</option>
                                            <option value="Assoc. Prof.">Assoc. Prof.</option>
                                            <option value="Asst. Prof">Asst. Prof</option>
                                            <option value="Lab Asst.">Lab Asst.</option>
                                            <option value="Lab In-charge">Lab In-charge</option>
                                            <option value="Professor">Professor</option>


                                        </select>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="col-sm-12">Aadhar Number</label>
                                    <div class="col-sm-12">
                                        <input type="number" name="aadharno" min="99999999999" max="999999999999" id="aadharno" title="must be 12 digits" placeholder="" class="form-control ps-0 form-control-line"  />
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="col-md-12 mb-0">PAN (Permanent account number *)</label>
                                    <div class="col-md-12">
                                        <input type="panno" name="panno" title="No smaller case letters in PAN" maxlength="10" class="form-control ps-0 form-control-line"  pattern="[A-Z0-9]{10}" />
                                    </div>
                                </div>
                                <div class="form-group">

                                    <label class="col-sm-12">Blood Group</label>
                                    <div class="col-sm-12 ">
                                        <select name="bloodgroup" id="bloodgroup" class="form-select shadow-none border-0 ps-0 form-control-line" >
                                            <option value="">Select</option>
                                            <option value="O+">O+</option>
                                            <option value="O-">O-</option>
                                            <option value="A+">A+</option>
                                            <option value="A-">A-</option>
                                            <option value="B+">B+</option>
                                            <option value="B-">B-</option>
                                            <option value="AB+">AB+</option>
                                            <option value="AB-">AB-</option>
                                        </select>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <div class="col-sm-12 d-flex">
                                        <input id="Register" name="Upproff" class="btn btn-outline-primary" type="submit" value="Update">
                                    </div>
                                    <div align="center">
                                        <span style="color:red">Only fill the required fields</span>
                                    </div>
                                    <div align="center">
                                        <span style="color:red" id="passfaild"></span>
                                    </div>
                                </div>

                            </form>

                        </div>
                    </div>

                </div>

                <div class="col-lg-8 col-xlg-9 col-md-7">
                    <div class="card">
                        <div class="card-body">
                            <form action="updatestaffprofgranted.php" method="post" onsubmit="return confirmprompt();" class="form-horizontal form-material mx-2">
                                <div class="form-header">
                                    <h5 class="page-title mb-0 p-0 " style="color:#04befe">Delete Staff</h5>
                                    <br/>
                                </div>
                                <div class="form-group">
                                    <label class="col-md-12 mb-0">FID</label>
                                    <div class="col-md-12">
                                        <select class="form-select shadow-none border-0 ps-0 " name="subfid" required>
                                            <option value="">Select</option>
                                            <?php $upfidcount = 0;
                                            foreach ($upfids as $CCrow) { ?>
                                                <option value='<?php echo $CCrow; ?>'><?php echo $upfidsnames[$upfidcount];
                                                                                        $upfidcount += 1; ?></option>
                                            <?php
                                            } ?>
                                        </select>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <div class="col-sm-12 d-flex">
                                        <input id="Register" name="Deproff" class="btn btn-outline-danger" type="submit" value="Delete Staff">
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>

            </div>

        </div>

    </div>

</body>