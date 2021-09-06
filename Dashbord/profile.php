<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<?php
if (!isset($_SESSION)) {
    session_start();
}

require_once "connect.php";
$fid = $_SESSION['FID'];

$sql = "select * FROM logins WHERE FID='$fid'";

$stmt = $conn->query($sql);
$stmt = $stmt->fetch();
?>



<div id="profile" class="page-wrapper">
    <div class="page-breadcrumb">
        <div class="row align-items-center">
            <div class="col-md-6 col-8 align-self-center">
                <h3 class="page-title mb-0 p-0">Profile</h3>
                <div class="d-flex align-items-center">
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="#">Home</a></li>
                            <li class="breadcrumb-item active" aria-current="page">Profile</li>
                        </ol>
                    </nav>
                </div>
            </div>

        </div>
    </div>


    <div class="container-fluid">

        <div class="row">
            <form action="updatedprofile.php" method="post" enctype="multipart/form-data" onsubmit="return confirm('Sure Want To Updated Profile....!');">
                <!-- Column -->
                <div class="form-group">
                    <div class="col-lg-4 col-xlg-3 col-md-5">
                        <div class="card">
                            <div class="card-body profile-card">
                                <center class="mt-4">
                                    <div id="profile-pic">
                                        <img class="rounded-circle" src="../assets/images/users/<?php echo $stmt["PROFILE"]; ?>" id="uploadimage" alt="user" onclick="init();">
                                    </div>
                                    <h4 class="card-title mt-2"><?php echo $stmt["FIRST_NAME"] ?></h4>
                                    <h6 class="card-subtitle"><?php echo $stmt["ROLE"] ?></h6>

                                </center>
                            </div>
                        </div>
                    </div>

                    <!-- Column -->
                    <!-- Column -->
                    <style>
                        .form-control input {
                            background-color: white;
                        }
                    </style>
                    <div class="col-lg-8 col-xlg-9 col-md-7">
                        <div class="card">
                            <div class="card-body">

                                <div class="form-group">
                                    <label class="col-md-12" for="Fname">FID</label>
                                    <div class="col-md-12">
                                        <input type="text" style="background-color:white;" placeholder="" value="<?php echo $stmt['FID'] ?>" class="form-control ps-10 form-control-line" disabled />
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="col-md-12" for="Fname">First Name</label>
                                    <div class="col-md-12">
                                        <input type="text" style="background-color:white;" id="Fname" name="Fname" placeholder="" value="<?php echo $stmt['FIRST_NAME'] ?>" class="form-control ps-10 form-control-line" disabled />
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label class="col-md-12" for="Fname">Last Name</label>
                                    <div class="col-md-12">
                                        <input type="text" style="background-color:white;" id="Sname" name="Sname" placeholder="" value="<?php echo $stmt['SUR_NAME'] ?>" class="form-control ps-10 form-control-line" disabled />
                                    </div>
                                </div>



                                <div class="form-group">
                                    <label for="email" class="col-md-12">Email</label>
                                    <div class="col-md-12">
                                        <input type="email" style="background-color:white;" id="mail" placeholder="" value="<?php echo $stmt['MAIL'] ?>" class="form-control ps-10 form-control-line" name="email" id="example-email" disabled />
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="col-md-12" for="address">Address</label>
                                    <div class="col-md-12">
                                        <input type="text" style="background-color:white;" id="address" name="address" value="<?php echo $stmt['ADDRESS'] ?>" class="form-control ps-10 form-control-line" disabled />
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="col-md-12 " for="phoneno">Phone No</label>
                                    <div class="col-md-12">
                                        <input type="text" style="background-color:white;" id="phoneno" name="phoneno" placeholder="" value="<?php echo $stmt['PHONE_NO'] ?>" class="form-control ps-10 form-control-line" disabled />
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="col-md-12 " for="phoneno">Experience</label>
                                    <div class="col-md-12">
                                        <input type="text" style="background-color:white;" id="phoneno" name="phoneno" placeholder="" value="<?php echo $stmt['EXPERIENCE'] ?>" class="form-control ps-10 form-control-line" disabled />
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="col-md-12" for="address">Aadhar</label>
                                    <div class="col-md-12">
                                        <input type="text" style="background-color:white;" value="<?php echo $stmt['AADHAR'] ?>" class="form-control ps-10 form-control-line" disabled />
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="col-md-12" for="address">PAN (Permanent account number *)</label>
                                    <div class="col-md-12">
                                        <input type="text" style="background-color:white;" value="<?php echo $stmt['PAN'] ?>" class="form-control ps-10 form-control-line" disabled />
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="col-md-12" for="address">Blood Group</label>
                                    <div class="col-md-12">
                                        <input type="text" style="background-color:white;" value="<?php echo $stmt['BLOOD_GROUP'] ?>" class="form-control ps-10 form-control-line" disabled />
                                    </div>
                                </div>

                                <div class="form-group">
                                    <div class="col-sm-12 d-flex">
                                        <div id="confirmmessage"></div>
                                        <input type="button" class="btn btn-outline-primary" onclick="endiprofile();" id="edit" value="Edit" name="submit" />

                                    </div>
                                </div>

                            </div>
                        </div>
                    </div>

                    </from>

                    <!-- Column -->


                </div>
                <style type="text/css">
                    #uploadimage {
                        cursor: pointer;
                        display: block;
                        position: relative;
                        margin: 50px auto 10px auto;
                        width: 250px;
                        height: auto;
                    }

                    #uploadimage:hover {
                        cursor: pointer;
                        opacity: 1;
                    }

                    body {
                        background: #F5F5F5;
                    }
                </style>


                <script>
                    function init() {
                        $(document).ready(function() {


                            $("#profile-pic").load("profileupdate.php");

                        });
                    }
                </script>

        </div>
    </div>
</div>
