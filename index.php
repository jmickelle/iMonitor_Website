<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="x-ua-compatible" content="ie=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, shrink-to-fit=no">
    <title>Skyluster Technology Inc.</title>
    <link rel="stylesheet" href="Public/css/Style.css">
    <!-- <link rel="stylesheet" type="text/css" href="../public/css/login.css"> -->
    <link href="Public/css/bootstrap.min.css" rel="stylesheet">
</head>
<style type="text/css">
    body
    {
            height:100vh;
            height: -webkit-fill-available;
            background-image: url(Public/images/background1.jpg);
            background-size: cover;
            background-repeat: no-repeat;
            background-position: center;
            overflow-y: auto;
    }
</style>
<body style="height: -webkit-fill-available;">
    <div class="container">
        <div class="row">
            <div class="Absolute-Center is-Responsive">
                <div class="col-sm-12 col-md-10 col-md-offset-1">
                    <?php 
                        require 'php/controller.php';
                        Login();
                    ?>
                    <form method="POST">
                        <div class="form-group input-group" style="margin-left: -90px; padding: 30px 30px; margin-bottom: 0px;">
                            <span class="input-group-addon"><i class="glyphicon glyphicon-user"></i></span>
                            <input class="form-control" id="userid" placeholder="User ID" name="userid" type="text" autofocus="autofocus" style="width: 150%;"required>
                        </div>
                        <div class="form-group input-group" style="margin-left: -90px; padding: 0px 30px;">
                            <span class="input-group-addon"><i class="glyphicon glyphicon-lock"></i></span>
                            <input class="form-control" id="password" placeholder="Password" name="password" type="password" title="Must contain at least one number and one uppercase and lowercase letter, and at least 8 or more characters" style="width: 150%;" required>
                        </div>
                        <div class="form-group">
                            <button type="submit" name="btnLogin" class="btn btn-primary btn-block" style="width:70%; margin-left:50px; position: inherit;">Login</button></a>
                        </div>
                        <div class="form-group text-center">
                            <!-- <a href="#" style="color:white;">Forgot Password</a> -->
                            
                        </div>
                    </form>
                    <!-- <h1 style="padding-top:110px; font-family: Verdana, Geneva, sans-serif; color: white; text-align:center; font-size: 60px; letter-spacing: 5px;">SKYLUSTER TECHNOLOGY INC.</h1> -->
                </div>
            </div>
        </div>
    </div>

</body>
</html>