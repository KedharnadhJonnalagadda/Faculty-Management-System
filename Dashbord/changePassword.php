
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.13.0/css/all.min.css">
    
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.13.0/css/all.min.css">
    <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    <div class="page-wrapper">
        <!-- ============================================================== -->
        <!-- Bread crumb and right sidebar toggle -->
        <!-- ============================================================== -->
        <div class="page-breadcrumb">
            <div class="row align-items-center">
                <div class="col-md-6 col-8 align-self-center">
                    <h3 class="page-title mb-0 p-0">Password</h3>
                    <div class="d-flex align-items-center">
                        <nav aria-label="breadcrumb">
                            <ol class="breadcrumb">
                                <li class="breadcrumb-item"><a href="index.html">Home</a></li>
                                <li class="breadcrumb-item active" aria-current="page">Change Password</li>
                            </ol>
                        </nav>
                    </div>
                </div>
                <!--<div class="col-md-6 col-4 align-self-center">
                        <div class="text-end upgrade-btn">
                            <a href="https://www.wrappixel.com/templates/monsteradmin/"
                                class="btn btn-success d-none d-md-inline-block text-white" target="_blank">Upgrade to
                                Pro</a>
                        </div>
                    </div>-->
            </div>
        </div>
        
        <!-- ============================================================== -->
        <!-- End Bread crumb and right sidebar toggle -->
        <!-- ============================================================== -->
        <!-- ============================================================== -->
        <!-- Container fluid  -->
        <!-- ============================================================== -->
        <div class="container-fluid">
            <!-- ============================================================== -->
            <!-- Start Page Content -->
            <!-- ============================================================== -->
            <style>
                body {
                    background:#F5F5F5;
                }
            </style>
            <!-- Row -->
            <div class="row">
                <!-- Column -->
                <div class="col-lg-8 col-xlg-9 col-md-7">
                    <div class="card">
                        <div class="card-body">
                            <form class="form-horizontal form-material mx-2" action="confirmchangepassword.php" method="POST"
                                onsubmit="return confirm('Are you sure you want to Change Password');">
                                <div class="form-group">
                                    <label class="col-md-12 mb-0">Current Password</label>
                                    <div class="col-md-12">
                                        <input type="password" name="current_password" placeholder=""
                                            name="old_password" class="form-control ps-0 form-control-line" required />
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="col-md-12 input-group-append mb-0">New Password</label>
                                    <div class="col-md-12">
                                        <input class="form-control pwd ps-0 form-control-line" onkeyup='get_result();check();' id="new_password" name="new_password" type="Password" required />
                                        
                                    </div>
                                    
                                    <!-- <div class="input-group-addon">
                                        <a href="#"><i class="fa fa-eye-slash" id="#togglePassword" aria-hidden="true"></i></a>
                                      </div> -->
                                    <div class="col-md-12">
                                        <progress value="0" max="5" id="strength"></progress>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="retype_password" class="col-md-12">Re-type password</label>
                                    <div class="col-md-12">
                                        <input type="password" onkeyup='check();' name="retype_password" placeholder="" id="retype_password"
                                            class="form-control ps-0 form-control-line" required/>
                                    </div>
                                    <div class="col-md-12">
                                        <span id="Smessage"></span><span class="text-muted">Password must contain at least one A-Z,a-z,0-9,Special Char and Length 8</span>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <div class="col-sm-12 d-flex">
                                        <input id="UpPbtn" type="submit" name="Psubmit" value="Update Password" class="btn btn-outline-primary mx-auto mx-md-0 text-blue">
                                    </div>
                                </div>
                                <span id="Smessage"></span>
                                
                            </form>
                        </div>
                    </div>
                </div>
                <!-- Column -->
            </div>

        </div>

    </div>
    <!-- ============================================================== -->
    <!-- End Page wrapper  -->
    <!-- ============================================================== -->
    </div>

    <style type="text/css">
    .container i {
    margin-left: -30px;
    cursor: pointer;
}
    </style>
    <script>
 
        const togglePassword = document.querySelector('#togglePassword');
        const password = document.querySelector('#new_password');
        togglePassword.addEventListener('click', function (e) {
            // toggle the type attribute
            const type = password.getAttribute('type') === 'password' ? 'text' : 'password';
            password.setAttribute('type', type);
            // toggle the eye slash icon
            this.classList.toggle('fa-eye-slash');
        });
    </script>
    <script>
   

        var check = function () {
            if(document.getElementById('retype_password').value==''){

                document.getElementById('Smessage').style.color = 'red';
                document.getElementById('Smessage').innerHTML = 'Empty';
                document.getElementById("UpPbtn").disabled = true;

            }else if (document.getElementById('new_password').value ==
                document.getElementById('retype_password').value) {

                document.getElementById('Smessage').style.color = 'green';
                document.getElementById('Smessage').innerHTML = 'matching';
                document.getElementById("UpPbtn").disabled = false;
                
                get_result();
    
            } else {

                document.getElementById('Smessage').style.color = 'red';
                document.getElementById('Smessage').innerHTML = 'not matching';
                document.getElementById("UpPbtn").disabled = true;
    
            }
    
        }
        function length(password) {
            if (password.length > 8) {
                return 1;
            }
            return 0;
        }
        function has_digit(password) {
            var pattern = /\d/;
            if (password.match(pattern)) {
                return 1;
            }
            return 0;
        }
        function has_lower(password) {
            var pattern = /[a-z]/;
            if (password.match(pattern)) {
                return 1;
            }
            return 0;
        }
        function has_upper(password) {
            var pattern = /[A-Z]/;
            if (password.match(pattern)) {
                return 1;
            }
            return 0;
        }
        function has_not_grater(password, num) {
            var pattern = /["<]/;
            if (password.match(pattern)) {
                document.getElementById("new_password").value = '';
                alert("😈I'm also a hacker😈");
                return -10;
            }
            return 0;
        }
        function has_symbol(password) {
            var pattern = /[$-/:-?{-~!@#%&*()"^_`\[\]]/;
            if (password.match(pattern)) {
                return 1;
            }
            return 0;
        }
        function progress_full(num) {
            if (num == 5) {
                document.getElementById("retype_password").disabled = false;
            }
            else {
                document.getElementById("retype_password").disabled = true;
                document.getElementById("retype_password").value = '';
            }
        }
        function get_result() {
            var password = document.getElementById("new_password").value;
            var num = length(password) +
                has_digit(password) +
                has_lower(password) +
                has_upper(password) +
                has_symbol(password) +
                has_not_grater(password, num);
            progress_full(num);
            document.getElementById("strength").value = num;
        }
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
    
    </script>
    
