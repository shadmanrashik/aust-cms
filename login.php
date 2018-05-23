<?php
require 'core.php';
require 'connect.php';
    
    if(loggedin()){
        header("location: onlineOrder.php?id=Online Order&invoice=$orderFinalcode");
    }
    if(isset($_POST['username']) && $_POST['password']) {
        $username = $_POST['username'];
        $password = $_POST['password'];

        //$passwordHash = md5($password); //generated md5 hash string

        if(!empty($username) && !empty($password)) {
            $query = "SELECT id,user_id FROM login WHERE user_name = '".mysql_real_escape_string($username)."' "
                    . "AND user_password = '".mysql_real_escape_string($password)."'";
            //magic_quotes_gpc can be turned 'On' to prevent possible sql injection in php.ini(Line 786)    
            //above feature is no longer supported by current php
            $queryRun = mysql_query($query);
            if($queryRun) {
                $queryNumberOfRows = mysql_num_rows($queryRun);
                if ($queryNumberOfRows == 0) { 
                    $alert = TRUE;
                }
                else if($queryNumberOfRows == 1) {     //will return 1 if the fields are matched since username is unique
                    $id = mysql_result($queryRun, 0, 'id');
                    $userId = mysql_result($queryRun, 0, 'user_id');
                    $queryIn = "SELECT type FROM user_info WHERE id = '$userId'";
                    $queryRunIn = mysql_query($queryIn);
                    $userType = mysql_result($queryRunIn, 0, 'type');
                    
                    $_SESSION['id'] = $id;
                    $_SESSION['userId'] = $userId;
                    $_SESSION['userType'] = $userType;
                    header("location: onlineOrder.php?id=Online Order&invoice=$orderFinalcode");
                }
            }
        }
    }
?>

<!DOCTYPE html>
<html lang="en">
    
<head>
    <title>AUST-CMS-LOGIN</title><meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link rel="stylesheet" href="css/bootstrap.min.css" />
    <link rel="stylesheet" href="css/bootstrap-responsive.min.css" />
    <link rel="stylesheet" href="css/matrix-login.css" />
    <link href="font-awesome/css/font-awesome.css" rel="stylesheet" />
    <link href='http://fonts.googleapis.com/css?family=Open+Sans:400,700,800' rel='stylesheet' type='text/css'>

</head>
<body style="background-image: url(img/bg2.jpg);">
    <div id="loginbox">            
        <form id="loginform" class="form-vertical" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>" autocomplete="off" method="post">
            <div class="control-group normal_text"> <h3><img src="img/logo.png" alt="Logo" /></h3></div>
            <div class="control-group">
                <div class="controls">
                    <div class="main_input_box">
                        <span class="add-on bg_lg"><i class="icon-user"> </i></span><input type="text" name="username" placeholder="Username" />
                    </div>
                </div>
            </div>
            <div class="control-group">
                <div class="controls">
                    <div class="main_input_box">
                        <span class="add-on bg_ly"><i class="icon-lock"></i></span><input type="password" name="password" placeholder="Password" />
                    </div>
                </div>
            </div>
            <div class="control-group">
                <div class="controls">
                    <?php if($alert) { ?>
                        <div class="alert alert-danger">
                            Invalid Username/Password combination.
                        </div> <?php
                    } ?>
                </div>
            </div>
            
            <div class="form-actions">
                <span class="pull-right"><button type="submit" class="btn btn-success" name="loginBtn"/> Login</button></span>
            </div>
        </form>
        <form id="recoverform" action="#" class="form-vertical">
            <p class="normal_text">Enter your e-mail address below and we will send you instructions how to recover a password.</p>
            <div class="controls">
                <div class="main_input_box">
                    <span class="add-on bg_lo"><i class="icon-envelope"></i></span><input type="text" placeholder="E-mail address" />
                </div>
            </div>

            <div class="form-actions">
                <span class="pull-left"><a href="#" class="flip-link btn btn-success" id="to-login">&laquo; Back to login</a></span>
                <span class="pull-right"><a class="btn btn-info"/>Recover</a></span>
            </div>
        </form>
    </div>

    <script src="js/jquery.min.js"></script>  
    <script src="js/matrix.login.js"></script> 
</body>

</html>
