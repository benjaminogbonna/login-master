<?php
session_start();
if (isset($_SESSION['username'])) {
    header("location:profile.php");
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="author" content="Benjamin">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width,initial-scale=1">
    <title>Login</title>
    <link href="css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" type="text/css" href="css/mycustom.css">
    <style type="text/css">
        .bg-dar {
            -webkit-background-size: cover !important;
            -moz-background-size: cover !important;
            -o-background-size: cover !important;
            background-size: cover !important;
            background: url(image/uniabj.jpg) no-repeat fixed center;
            color: white;
        }

        .div-trans {
            padding-top: 5px;
            background-color: rgba(0, 0, 0, 0.5);
            margin-bottom: 10px;
            max-width: 500px;
            min-width: 200px;
            margin-left: auto;
            margin-right: auto;
            padding-left: auto;
            padding-right: auto;
            color: #fff;
            -webkit-border-radius: 5px;
            -moz-border-radius: 5px;
            border-radius: 5px;
        }

        .div-trans i {
            margin-left: 10px;
            margin-right: 10px;
            color: #159238;
        }

        .input-trans {
            background-color: transparent;
            color: white;
        }

        .mt-2 {
            color: white
        }

        form a:hover {
            color: white;
        }

        .overlay {
            margin-top: -25px;
            background: rgba(0, 0, 0, 0.7);
            min-height: 635px;
        }
    </style>
</head>
<body class="bg-dar">
<div id="home">
    <div class="overlay">
        <div class="container mt-4">
            <!--time and date-->
            <div style="text-align: center;">
                <br/><br/>
                <div class="row">
                    <div class="col-lg-4 offset-lg-4">
                        <h4><span id=tick2></span>&nbsp;|
                            <?php
                            $date = new DateTime();
                            echo $date->format('l,<br/> F jS, Y');
                            ?>
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-lg-4 offset-lg-4" id="alert">
                    <div class="alert alert-success">
                        <strong id="result"></strong>
                    </div>
                </div>
            </div>
            <div class="text-center">
                <img src="image/preloader.gif" width="50px" height="50px" class="m-2" id="loader">
            </div>
            <!-- login form -->
            <div class="row">
                <div class="col-lg-4 offset-lg-4 div-trans rounded" id="login-box">
                    <h2 class="text-center mt-2">Login</h2>
                    <form action="" method="post" role="form" class="p-2" id="login-frm">
                        <div class="form-group">
                            <input type="text" name="username" class="form-control input-trans" placeholder="Username"
                                   required minlength="2" value="<?php if (isset($_COOKIE['username'])) {
                                echo $_COOKIE['username'];
                            } ?>">
                        </div>
                        <div class="form-group">
                            <input type="password" name="password" class="form-control input-trans"
                                   placeholder="Password" id="typepass" required minlength="6"
                                   value="<?php if (isset($_COOKIE['password'])) {
                                       echo $_COOKIE['password'];
                                   } ?>">
                            <input type="checkbox" onclick="Toggle()">
                            Show Password
                            <script type="text/javascript">
                                // Change the type of input to password or text
                                function Toggle() {
                                    var temp = document.getElementById("typepass");
                                    if (temp.type === "password") {
                                        temp.type = "text";
                                    } else {
                                        temp.type = "password";
                                    }
                                }
                            </script>
                        </div>
                        <div class="form-group">
                            <div class="custom-control custom-checkbox">
                                <input type="checkbox" name="rem" class="custom-control-input"
                                       id="customCheck" <?php if (isset($_COOKIE['username'])) { ?><?php } ?>>
                                <label for="customCheck" class="custom-control-label input-trans">
                                    Remember Me</label>
                                <a href="#" id="forgot-btn" class="float-right">Forgot Password?</a>
                            </div>
                        </div>
                        <div class="form-group">
                            <input type="submit" name="login" id="login" value="Login"
                                   class="btn btn-primary btn-block">
                        </div>
                        <div class="form-group">
                            <p class="text-center">New User? <a href="#" id="register-btn">Register Here</a></p>
                        </div>
                    </form>
                </div>
            </div>
            <!-- registration form -->
            <div class="row">
                <div class="col-lg-4 offset-lg-4 div-trans rounded" id="register-box">
                    <h2 class="text-center mt-2">Register</h2>
                    <form action="" method="post" role="form" class="p-2" id="register-frm">
                        <div class="form-group">
                            <input type="text" name="name" class="form-control input-trans"
                                   placeholder="Full Name" required minlength="3">
                        </div>
                        <div class="form-group">
                            <input type="text" name="uname" class="form-control input-trans"
                                   placeholder="Username" required minlength="4">
                        </div>
                        <div class="form-group">
                            <input type="email" name="email" class="form-control input-trans"
                                   placeholder="E-Mail" required>
                        </div>
                        <div class="form-group">
                            <input type="password" name="pass" id="pass" class="form-control input-trans"
                                   placeholder="Password" required minlength="6">
                        </div>
                        <div class="form-group">
                            <input type="password" name="cpass" id="cpass" class="form-control input-trans"
                                   placeholder="Confirm Password" required minlength="6">
                        </div>
                        <div class="form-group">
                            <div class="custom-control custom-checkbox">
                                <input type="checkbox" name="rem" class="custom-control-input" id="customCheck2">
                                <label for="customCheck2" class="custom-control-label">I agree to the <a href="#">terms
                                        & conditions.</a></label>
                            </div>
                        </div>
                        <div class="form-group">
                            <input type="submit" name="register" id="register" value="Register"
                                   class="btn btn-primary btn-block">
                        </div>
                        <div class="form-group">
                            <p class="text-center">Already Registered? <a href="#" id="login-btn">login Here</a></p>
                        </div>
                    </form>
                </div>
            </div>
            <!-- forgot password -->
            <div class="row">
                <div class="col-lg-4 offset-lg-4 div-trans rounded" id="forgot-box">
                    <h2 class="text-center mt-2">Reset Password</h2>
                    <form action="" method="post" role="form" class="p-2" id="forgot-frm">
                        <div class="form-group">
                            <small class="text-muted">
                                Enter your email Address to reset Password.
                            </small>
                        </div>
                        <div class="form-group">
                            <input type="email" name="femail" class="form-control input-trans"
                                   placeholder="E-Mail" required>
                        </div>
                        <div class="form-group">
                            <input type="submit" name="forgot" id="forgot" value="Reset"
                                   class="btn btn-primary btn-block">
                        </div>
                        <div class="form-group text-center">
                            <a href="#" id="back-btn">Back</a>
                        </div>
                    </form>
                </div>
            </div>
        </div>

        <!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
        <script src="js/jquery-3.4.1.min.js"></script>
        <script src="js/popper.min.js"></script>
        <!-- Include all compiled plugins (below), or include individual files as needed -->
        <script src="js/bootstrap.min.js"></script>
        <script src="js/jquery.validate.min.js"></script>
        <script type="text/javascript">
            //script for time and date
            function show2() {
                if (!document.all && !document.getElementById)
                    return
                thelement = document.getElementById ? document.getElementById("tick2") : document.all.tick2
                var Digital = new Date()
                var hours = Digital.getHours()
                var minutes = Digital.getMinutes()
                var seconds = Digital.getSeconds()
                var dn = "PM"
                if (hours < 12)
                    dn = "AM"
                if (hours > 12)
                    hours = hours - 12
                if (hours == 0)
                    hours = 12
                if (minutes <= 9)
                    minutes = "0" + minutes
                if (seconds <= 9)
                    seconds = "0" + seconds
                var ctime = hours + ":" + minutes + ":" + seconds + " " + dn
                thelement.innerHTML = ctime
                setTimeout("show2()", 1000)
            }
            window.onload = show2;

            $(document).ready(function () {
                $("#register-btn").click(function () {
                    $("#register-box").show();
                    $("#login-box").hide();
                });

                $("#login-btn").click(function () {
                    $("#register-box").hide();
                    $("#login-box").show();
                });

                $("#forgot-btn").click(function () {
                    $("#login-box").hide();
                    $("#forgot-box").show();
                });

                $("#back-btn").click(function () {
                    $("#forgot-box").hide();
                    $("#login-box").show();
                });

                $("#login-frm").validate();
                $("#register-frm").validate({
                    rules: {
                        cpass: {
                            equalTo: "#pass",
                        }
                    }
                });
                $("#forgot-frm").validate();

                // submit form without page refresh for registration

                $("#register").click(function (e) {
                    if (document.getElementById('register-frm').checkValidity()) {
                        e.preventDefault();
                        $("#loader").show();
                        $.ajax({
                            url: 'action.php',
                            method: 'post',
                            data: $("#register-frm").serialize() + '&action=register',
                            success: function (response) {
                                $("#alert").show();
                                $("#result").html(response);
                                $("#loader").hide();
                            }
                        });
                    }
                    return true;
                });

// submit form without page refresh for login
                $("#login").click(function (e) {
                    if (document.getElementById('login-frm').checkValidity()) {
                        e.preventDefault();
                        $("#loader").show();
                        $.ajax({
                            url: 'action.php',
                            method: 'post',
                            data: $("#login-frm").serialize() + '&action=login',
                            success: function (response) {
                                if (response === "ok") {
                                    window.location = 'profile.php';
                                } else {
                                    $("#alert").show();
                                    $("#result").html(response);
                                    $("#loader").hide();
                                }
                            }
                        });
                    }
                    return true;
                });

// submit form without page refresh for forgot password
                $("#forgot").click(function (e) {
                    if (document.getElementById('forgot-frm').checkValidity()) {
                        e.preventDefault();
                        $("#loader").show();
                        $.ajax({
                            url: 'action.php',
                            method: 'post',
                            data: $("#forgot-frm").serialize() + '&action=forgot',
                            success: function (response) {
                                $("#alert").show();
                                $("#result").html(response);
                                $("#loader").hide();
                            }
                        });
                    }
                    return true;
                });

            });
        </script>
    </div>
</div>
</body>

</html>