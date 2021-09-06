
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
        $fid = $_SESSION['FID'];
        $adminpass = $conn->query("SELECT PASSWORD FROM logins where FID='$fid'")->fetchColumn();

        //echo $genFid;
        ?>

        <div class="page-breadcrumb">
            <div class="row align-items-center">
                <div class="col-md-6 col-8 align-self-center">
                    <h3 class="page-title mb-0 p-0">Registration</h3>
                    <div class="d-flex align-items-center">
                        <nav aria-label="breadcrumb">
                            <ol class="breadcrumb">
                                <li class="breadcrumb-item"><a href="index.html">Home</a></li>
                                <li class="breadcrumb-item active" aria-current="page">Register New Staff</li>
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
            function lessthenKey() {
                var pattern = /[<]/;
                var fname = document.getElementById("fname").value;
                if (fname.match(pattern)) {
                    document.getElementById("fname").value = '';
                    alert("😈I'm also a hacker😈");
                }
                var sname = document.getElementById("sname").value;
                if (sname.match(pattern)) {
                    document.getElementById("sname").value = '';
                    alert("😈I'm also a hacker😈");
                }
                var address = document.getElementById("address").value;
                if (address.match(pattern)) {
                    document.getElementById("address").value = '';
                    alert("😈I'm also a hacker😈");
                }




            }

            function Phonenocheck() {

            }
        </script>
        <script type="text/javascript">
            function confirmprompt() {
                var propt = prompt('Want to Add New Staff->Enter PAssword');
                // document.getElementById('adminpass').value=propt;
                if (propt !== "" && propt == <?php echo json_encode($adminpass) ?>) {
                    document.getElementById('adminpass').value = propt;
                    // document.getElementById('fid').disabled = false;
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
                            <form action="registerionform.php" method="post" onsubmit="return confirmprompt();" class="form-horizontal form-material mx-2">
                                <div class="form-group">
                                    <label class="col-md-12 mb-0">FID</label>
                                    <div class="col-md-12">
                                        <input type="text" placeholder="" id="fid" name="fid" value="<?php echo $genFid ?>" class="form-control ps-0 form-control-line" required pattern="[8]+[A]+[0]+[1-5][0-9A-B][0-9]" disabled />
                                    </div>
                                </div>
                                <div class="form-group">

                                    <div class="col-md-12">
                                        <input type="text" placeholder="" id="fid" name="fid" value="<?php echo $genFid ?>" class="form-control ps-0 form-control-line" required pattern="[8]+[A]+[0]+[1-5][0-9A-B][0-9]" hidden />
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="col-md-12 mb-0">First Name</label>
                                    <div class="col-md-12">
                                        <input type="text" onkeyup="lessthenKey();" id="fname" name="fname" title="only allows A-Z" placeholder="" class="form-control ps-0 form-control-line" required pattern="[A-Za-z]{1,20}" />
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="col-md-12 mb-0">Last Name</label>
                                    <div class="col-md-12">
                                        <input type="text" placeholder="" name="sname" id="sname" onkeyup="lessthenKey();" class="form-control ps-0 form-control-line" title="only allows A-Z" required pattern="[A-Za-z]{1,20}" />
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="col-md-12 mb-0">Email</label>
                                    <div class="col-md-12">
                                        <input type="email" name="email" class="form-control ps-0 form-control-line" required />
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="col-sm-12">Phone Number (Prefearable Whats app Number *)</label>
                                    <div class="col-sm-12">
                                        <input type="number" name="phoneno" min="999999999" max="9999999999" id="phoneno" title="must be 10 digits" placeholder="" class="form-control ps-0 form-control-line" required />
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label class="col-sm-12">Experience</label>
                                    <div class="col-sm-12 ">
                                        <input type="number" placeholder="" max="99" name="exp" title="No one can leave more then 99 years" class="form-control ps-0 form-control-line" required />
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="col-sm-12">Salary</label>
                                    <div class="col-sm-12 ">
                                        <input type="number" placeholder="" min="1000" max="200000" name="salary" title="max 999999" class="form-control ps-0 form-control-line" required />
                                    </div>
                                </div>
                                <div class="form-group">

                                    <label class="col-sm-12">Select Branch</label>
                                    <div class="col-sm-12 ">
                                        <select name="branch" id="branch" class="form-select shadow-none border-0 ps-0 form-control-line" required>
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
                                        <select name="ROLE" id="branch" class="form-select shadow-none border-0 ps-0 form-control-line" required>
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
                                        <input type="number" name="aadharno" min="99999999999" max="999999999999" id="aadharno" title="must be 12 digits" placeholder="" class="form-control ps-0 form-control-line" required />
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="col-md-12 mb-0">PAN (Permanent account number *)</label>
                                    <div class="col-md-12">
                                        <input type="panno" name="panno" title="No smaller case letters in PAN" maxlength="10" class="form-control ps-0 form-control-line" required pattern="[A-Z0-9]{10}" />
                                    </div>
                                </div>
                                <div class="form-group">

                                    <label class="col-sm-12">Blood Group</label>
                                    <div class="col-sm-12 ">
                                        <select name="bloodgroup" id="bloodgroup" class="form-select shadow-none border-0 ps-0 form-control-line" required>
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

                                    <label class="col-sm-12">Gender</label>
                                    <div class="form-radio shadow-none border-0 ps-0 form-control-line">
                                        <div class="col-sm-4 ">
                                            <input type="radio" name="gender" value="MALE" id="dot-1" required />
                                            <label for="dot-1">
                                                <span class="dot one"></span>
                                                <span class="gender">Male</span>
                                            </label>
                                        </div>
                                        <div class="col-sm-6 ">
                                            <input type="radio" name="gender" value="FEMALE" id="dot-2" required />

                                            <label for="dot-2">
                                                <span class="dot two"></span>
                                                <span class="gender">Female</span>
                                            </label>
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <div class="col-sm-12 d-flex">
                                        <input id="Register" name="NewStaff" class="btn btn-outline-primary" type="submit" value="Register">

                                    </div>
                                    <div align="center">
                                        <span style="color:red" id="passfaild"></span>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>

            </div>

        </div>

    </div>

