<!DOCTYPE html>
<html lang="en">
<head>
    <title>UTM PC Audit</title>
    <meta charset="UTF-8">
    <!--===============================================================================================-->
    <link rel="icon" type="image/png" href="images/UTMLOGO.png"/>
    <!--===============================================================================================-->
    <link rel="stylesheet" type="text/css" href="vendor/bootstrap/css/bootstrap.min.css">
    <!--===============================================================================================-->
    <link rel="stylesheet" type="text/css" href="vendor/animate/animate.css">
    <!--===============================================================================================-->
    <link rel="stylesheet" type="text/css" href="vendor/css-hamburgers/hamburgers.min.css">
    <!--===============================================================================================-->
    <link rel="stylesheet" type="text/css" href="vendor/animsition/css/animsition.min.css">
    <!--===============================================================================================-->
    <link rel="stylesheet" type="text/css" href="vendor/select2/select2.min.css">
    <!--===============================================================================================-->
    <link rel="stylesheet" type="text/css" href="vendor/daterangepicker/daterangepicker.css">
    <!--===============================================================================================-->
    <link rel="stylesheet" type="text/css" href="css/util.css">
    <link rel="stylesheet" type="text/css" href="css/main.css">
    <!--===============================================================================================-->
</head>
<body>

<div class="limiter">
    <div class="container-login100">
        <div class="wrap-login100">
            <form ACTION="verifylogin.php" METHOD="POST" class="login100-form validate-form">


                <h2 class="login100-form-title p-b-34 p-t-30">Login</h2>


                <div class="wrap-input100 rs1-wrap-input100 validate-input m-b-20" data-validate="Type user name">

                    <input id="first-name" class="input100" type="text" name="username" placeholder="Username">

                    <span class="focus-input100"></span>
                </div>

                <p>&nbsp;</p>
                <div class="wrap-input100 rs2-wrap-input100 validate-input m-b-20" data-validate="Type password">
                    <input class="input100" type="password" name="password" placeholder="Password">
                    <span class="focus-input100"></span>
                </div>

                <?php if (isset($_GET["error"])): ?>
                    <?php if ($_GET["error"] == 1) : ?>
                        <div class="w-full text-center">
                            <div class="alert alert-danger" role="alert">
                                Invalid Password
                            </div>
                        </div>
                    <?php elseif ($_GET["error"] == 2): ?>
                        <div class="w-full text-center">
                            <div class="alert alert-danger" role="alert">
                                Empty username and Password
                            </div>
                        </div>
                    <?php elseif ($_GET["error"] == 3): ?>
                        <div class="w-full text-center">
                            <div class="alert alert-danger" role="alert">
                                Invalid Username
                            </div>
                        </div>
                    <?php elseif ($_GET["error"] == 4): ?>
                        <div class="w-full text-center">
                            <div class="alert alert-danger" role="alert">
                                Invalid Password
                            </div>
                        </div>
                    <?php elseif ($_GET["error"] == 5): ?>
                        <div class="w-full text-center">
                            <div class="alert alert-danger" role="alert">
                                Please login First
                            </div>
                        </div>
                    <?php endif; ?>
                <?php endif; ?>
                <div class="container-login100-form-btn">

                    <input type="submit" class="login100-form-btn" value="Sign in">

                </div>

            </form>

            <div class="login100-more" style="background-image: url('images/cict.png');"></div>
        </div>
    </div>
</div>


</body>
</html>