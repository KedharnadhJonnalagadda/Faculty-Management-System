<?php
session_start();
//include("connect.php");
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register Form</title>
    <link rel="stylesheet" href="registerForm.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.13.0/css/all.min.css">
</head>

<body>
    <div class="container">
        <div class="title">
            <h2>Sign Up</h2>
            <small>It's quick and easy !</small>
        </div>
        <div class="contents">
            <form id="form" action="registerionform.php" method="post">
                <section class="inp">
                    <input id="fname" type="text" onkeyup="lessthenKey();" name="fname" title="only allows A-Z"
                        placeholder="First name" required pattern="[A-Za-z]{1,20}" />
                </section>
                <section class="inp">
                    <input type="text" name="sname" onkeyup="lessthenKey();" placeholder="Surname"
                        title="only allows A-Z" required pattern="[A-Za-z]{1,20}" />
                </section>
                <section class="inp">
                    <input type="email" name="mail" placeholder="Email" required />
                </section>
                <section class="inp">

                    <input type="number" step="0.01" name="phoneno" maxlength="10" title="must be 10digits"
                        placeholder="Phone Number" required />
                </section>
                <section class="inp">
                    <select name="branch" id="branch">
                        <option value="default" selected="selected">Choose your stream ...</option>
                        <option value="cse">CSE</option>
                        <option value="ece">ECE</option>
                        <option value="civil">CIVIL</option>
                        <option value="mech">MECH</option>
                        <option value="eee">EEE</option>
                    </select>
                </section>
                <section class="inp">
                    <input type="number" name="exp" placeholder="Experience" required />
                </section>
                
                    <section class="inp">
                        <input type="password" class="input-group" name="pass" onkeyup='get_result()' id="SPassword" placeholder="New Password" title="At least 1 Uppercase , lowercase ,1 number,1 symbol allows->!@#$%^&* _+-" required >
						<div class="input-group-addon">
                                          <a href=""><i class="fa fa-eye-slash" aria-hidden="true"></i></a>
                                        </div>
                    </section>
					
                    <section class="inp">
                        <input type="password" name="cpass" onkeyup='check();'  id="SPasswordConfirm" placeholder="Confirm Password" title="must be 10digits" disabled required />
						<span id="Smessage"></span>
                    </section>
					<section>
						<h5 class="gender-title" class="PasswordStringth">Password Stringth</h5>
					</section>
					<section>
						<progress value="0" max="5" id="strength"></progress>
					</section>

                <div class="gen">
                    <input type="radio" name="gender" id="dot-1" required />
                    <input type="radio" name="gender" id="dot-2" required />
                    <input type="radio" name="gender" id="dot-3" required />
                    <h5 class="gender-title">Gender</h5>
                    <div class="category">
                        <label for="dot-1">
                            <span class="dot one"></span>
                            <span class="gender">Male</span>
                        </label>
                        <label for="dot-2">
                            <span class="dot two"></span>
                            <span class="gender">Female</span>
                        </label>
                        <label for="dot-3">
                            <span class="dot three"></span>
                            <span class="gender">Prefer not to say</span>
                        </label>
                    </div>
                </div>
                <div class="button">
                    <input id="Register" type="submit" value="Register">
                </div>
            </form>
        </div>
    </div>
</body>

</html>

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

<script>

    var check = function () {
        if (document.getElementById('SPassword').value ==
            document.getElementById('SPasswordConfirm').value) {
            document.getElementById('Smessage').style.color = 'green';
            document.getElementById('Smessage').innerHTML = 'matching';
            document.getElementById("Register").disabled = false;
            get_result();

        } else {
            document.getElementById('Smessage').style.color = 'red';
            document.getElementById('Smessage').innerHTML = 'not matching';
            document.getElementById("Register").disabled = true;

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
            document.getElementById("SPassword").value = '';
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
            document.getElementById("SPasswordConfirm").disabled = false;
        }
        else {
            document.getElementById("SPasswordConfirm").disabled = true;
            document.getElementById("SPasswordConfirm").value = '';
        }
    }
    function get_result() {
        var password = document.getElementById("SPassword").value;
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

<script>
    const togglePassword = document.querySelector('#togglePassword');
    const password = document.querySelector('#SPassword');
    togglePassword.addEventListener('click', function (e) {
        // toggle the type attribute
        const type = password.getAttribute('type') === 'password' ? 'text' : 'password';
        password.setAttribute('type', type);
        // toggle the eye slash icon
        this.classList.toggle('fa-eye-slash');
    });
</script>