<!DOCTYPE html>
<html>
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
        <!-- Meta, title, CSS, favicons, etc. -->
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>24CinL - Admin | Login</title>

        <!-- Bootstrap -->
        <link href="templates/css/bootstrap.min.css" rel="stylesheet">
        <!-- Font Awesome -->
        <link href="templates/plugins/font-awesome/css/font-awesome.min.css" rel="stylesheet">
        <!-- NProgress -->
        <link href="templates/plugins/nprogress/nprogress.css" rel="stylesheet">
        <!-- Animate.css -->
        <link href="templates/plugins/animate.css/animate.min.css" rel="stylesheet">
        <!-- Custom Theme Style -->
        <link href="templates/css/custom.min.css" rel="stylesheet">
        <!-- Custom Team style -->
        <link href="templates/css/24CinL-admin.css" rel="stylesheet">
    </head>

    <body class="login">
        <div class="login_wrapper">
            <div class="animate form login_form">
                <section class="login_content">

                    <!-- login-logo -->
                    <div class="login-logo">
                        <a href="login.php">
                            <i class="fa fa-cube"></i>&nbsp
                            24<b>CinL</b>
                        </a>
                    </div>

                    <form id="login-form" action="controllers/login_service.php" method="POST" name="login_form" OnSubmit="return check_login(this)">
                        <!-- Username -->
                        <div class="form-group has-feedback">
                            <input id="username" name="username" type="text" class="form-control" placeholder="Username"  onblur="return check_user_field(this)">
                            <span class="fa fa-android form-control-feedback"></span>
                        </div>
                        <!-- Password -->
                        <div class="form-group has-feedback">
                            <input id="password" name="password" type="password" class="form-control" placeholder="Password" onblur="check_password_field(this)">
                            <span class="glyphicon glyphicon-lock form-control-feedback"></span>
                        </div>

                        <div class="col-xs-4" style="margin-left:-10px;">
                            <button type="submit" class="btn btn-primary btn-block btn-flat" name="login"> Login </button>
                        </div>
                    </form>

                    <!-- Error message -->
                    <div class="row">
                        <div class="col-md-12 text-center">
                          <div name="error" class="login-error-message" {if isset($error)} style="display:block;"{/if}>
                              <strong id="error">{$error} </strong>
                              <span id="type-error">{$type_error}</span>
                          </div>
                        </div>
                    </div>

                    <div class="clearfix"></div>

                    <div class="separator">
                        <div class="to-blog">
                            <a href="../index.php">Back to Blog?</a>
                        </div>

                        <div class="clearfix"></div>
                        </br>

                        <div class="login-copyright">
                            <p>©2014 All Rights Reserved. 24CinL is a developer team created by 3 universitary students. Privacy and Terms.</p>
                        </div>
                    </div>
                </section>
            </div>
        </div>

        <!-- jQuery 2.1.4 -->
        <script src="templates/plugins/jQuery/jQuery-2.1.4.min.js"></script>
        <!-- Bootstrap 3.3.5 -->
        <script src="templates/js/bootstrap.min.js"></script>
        <!-- Team javascript for login -->
        <script src="templates/js/24CinL-admin.login.js"></script>

    </body>
</html>
