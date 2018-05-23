<?php
require 'connect.php';
require 'core.php';
if (isset($_POST['loginBtn'])) {
    $loginPasswordInc = testInput($_POST['password']);
            
    if(!empty($loginPasswordInc)) {
        $loginQuery = "SELECT id FROM login WHERE user_name = 'Admin' AND user_password = '".mysql_real_escape_string($loginPasswordInc)."'";
            //magic_quotes_gpc can be turned 'On' to prevent possible sql injection in php.ini(Line 786)    
            //above feature is no longer supported by current php
        $runLoginQuery = mysql_query($loginQuery);
        if ($runLoginQuery) {
            $queryNumberOfRows = mysql_num_rows($runLoginQuery);
            if ($queryNumberOfRows == 0) { 
                //$alert = TRUE;
                header('Location: index.php');
            }
            else if($queryNumberOfRows == 1) {     //will return 1 if the fields are matched since username is unique
                $userId = mysql_result($runLoginQuery, 0, 'id');
                $_SESSION['userid'] = $userId;
                $_SESSION['userType'] = 0;//create current session
                header('Location: employeeCategory.php');
            }
        }
    }
}

?>
<!DOCTYPE html>
<html lang="en">
<head>
<title>AUST CMS</title>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link rel="stylesheet" href="css/bootstrap.min.css" />
    <link rel="stylesheet" href="css/bootstrap-responsive.min.css" />
    <link rel="stylesheet" href="css/datepicker.css" />
    <link rel="stylesheet" href="css/fullcalendar.css" />
    <link rel="stylesheet" href="css/matrix-style.css" />
    <link rel="stylesheet" href="css/matrix-media.css" />
    <link href="font-awesome/css/font-awesome.css" rel="stylesheet" />
    <link rel="stylesheet" href="css/jquery.gritter.css" />
    <link href='http://fonts.googleapis.com/css?family=Open+Sans:400,700,800' rel='stylesheet' type='text/css'>
    <link rel="stylesheet" href="select2.css" />
</head>
<body>

    <!--Header-part-->
    <div id="header">
        <h1><a href="dashboard.html">AUST CMS</a></h1>
    </div>
    <!--close-Header-part--> 


    <!--top-Header-menu-->
    <div id="user-nav" class="navbar navbar-inverse">
        <ul class="nav">
            <li class=""><a title="" href="#"><i class="icon icon-cog"></i> <span class="text">Settings</span></a></li>
            <?php 
            if(!loggedin()) { ?>
            <li class=""><a data-toggle="modal" href="#loginModal"><i class="icon icon-user"></i></i> <span class="text">Admin Login</span></a></li>
            <?php } else {?>
            <li class=""><a href="logout.php"><i class="icon icon-share-alt"></i> <span class="text">Logout</span></a></li>
            <?php }?>
        </ul>
    </div>
    <!--close-top-Header-menu-->
    <!--start-top-serch-->
    
    <!--close-top-serch-->
    <!--sidebar-menu-->
    <div id="sidebar"><a href="#" class="visible-phone"><i class="icon icon-home"></i> Dashboard</a>
        <ul>
            <?php //if (isset($_SESSION['userType']) <> 2) 
                { ?>
            <li class="<?php if($currentPage == '/AUST-CMS/index.php') { echo 'active';} ?>"><a href="index.php"><i class="icon icon-home"></i> <span>Dashboard</span></a> </li>
            <li class="<?php 
            if(isset($_GET['invoice'])) {  
                $n=$_GET['invoice'];  
                if($currentPage == "/AUST-CMS/sales.php?id=Cash&invoice=$n") 
                    { echo 'active';} } ?>"> 
                <a href="sales.php?id=Cash&invoice=<?php echo $orderFinalcode ?>"><i class="icon icon-shopping-cart"></i> <span>Sales</span></a> </li>
            <li class="<?php if($currentPage == '/AUST-CMS/inventory.php') { echo 'active';} ?>"> <a href="inventory.php"><i class="icon icon-inbox"></i> <span>Inventory</span></a> </li>
            <li class="<?php if($currentPage == '/AUST-CMS/vendor.php') { echo 'active';} ?>"><a href="vendor.php"><i class="icon icon-group"></i> <span>Vendor</span></a></li>
            <li class="<?php if($currentPage == '/AUST-CMS/rawMaterial.php') { echo 'active';} ?>"><a href="rawMaterial.php"><i class="icon icon-sitemap"></i> <span>Raw Material</span></a></li>
            <li class="<?php 
            if(isset($_GET['orderno'])) {  
                $n1=$_GET['orderno'];  
                if($currentPage == "/AUST-CMS/purchaseSupply.php?id=cash&orderno=$n1") 
                    { echo 'active';} } ?>"><a href="purchaseSupply.php?id=cash&orderno=<?php echo $purchaseFinalcode ?>"><i class="icon icon-truck"></i> <span>Purchase Supply</span></a></li>
            <li class="<?php if($currentPage == '/AUST-CMS/pendingItem.php') { echo 'active';} ?>"><a href="pendingItem.php"><i class="icon icon-retweet"></i> <span>Receive Item</span></a></li>
            <?php 
            if(loggedinadmin()) { ?>
            <li class="submenu open"> <a href="#"><i class="icon icon-user"></i> <span>Admin Panel</span> <span class=""><i class="icon icon-arrow-down pull-right" style="margin-right: 20px"></i></span></a>
                <ul>
                    <li class="<?php if($currentPage == '/AUST-CMS/employeeCategory.php') { echo 'active';} ?> "><a href="employeeCategory.php">Employee Category</a></li>
                    <li class="<?php if($currentPage == '/AUST-CMS/employeeInfo.php') { echo 'active';} ?> "><a href="employeeInfo.php">Employee Info</a></li>
                    <li class="<?php if($currentPage == '/AUST-CMS/employeeWorkDetail.php') { echo 'active';} ?> "><a href="employeeWorkDetail.php">Employee Work Detail</a></li>
                    <li class="<?php if($currentPage == '/AUST-CMS/loginInfo.php') { echo 'active';} ?> "><a href="loginInfo.php">Log In Info</a></li>
                    <li class="<?php if($currentPage == '/AUST-CMS/onlineOrderInfo.php') { echo 'active';} ?> "><a href="onlineOrderInfo.php">Online Order Info</a></li>
                </ul>
            </li>
            <?php }
            }?>
        </ul>
    </div>
    <!--sidebar-menu-->

    