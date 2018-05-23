<?php
require 'connect.php';
require 'core.php';

$today = date("Y-m-d H:i:s");
if (isset($_POST['deleteBtn'])) {
    $id = testInput($_POST['id']);
    //header("location: onlineOrder.php?id=$id");
    $query = "DELETE FROM online_order WHERE id = '$id' AND status <> 1";
    $runQuery = mysql_query($query);
    if ($runQuery) {
        //header("location: onlineOrder.php");
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
            <li class=""><a href="logoutUser.php"><i class="icon icon-share-alt"></i> <span class="text">Logout</span></a></li>
            </ul>
    </div>
    <!--close-top-Header-menu-->
    <!--start-top-serch-->
    
    <!--close-top-serch-->
    <!--sidebar-menu-->
    <div id="sidebar"><a href="#" class="visible-phone"><i class="icon icon-home"></i> Dashboard</a>
        <ul>
            <li class=""> <a href="onlineOrder.php?id=Online Order&invoice=<?php echo $orderFinalcode ?>"><i class="icon icon-shopping-cart"></i> <span>Online Order</span></a> </li>
            <li class="active"> <a href="orderHistory.php"><i class="icon icon-search"></i> <span>History</span></a> </li>
        </ul>
    </div>
    <!--sidebar-menu-->

    <div id="content">
    <!--breadcrumbs-->
        <div id="content-header">
            <div id="breadcrumb">
                <a href="orderHistory.php" title="Go to Online Order History" class="tip-bottom"><i class="icon-home"></i> Online Order History</a></div>
                <h1>Order History</h1>
        </div>
    <!--End-breadcrumbs-->

        <div class="container-fluid">
            <hr>
                    
                <div class="row-fluid">
                    <div class="span12">
                        <div class="widget-box">
                            <div class="widget-title"> <span class="icon"> <i class="icon-search"></i> </span>
                                <h5>Your History </h5>
                            </div>
                            <div class="widget-content nopadding">
                                <div class="row-fluid">
                                    <div class="span12">
                                        <table class="table table-bordered table-hover">
                                            <thead>
                                                <tr>
                                                    <th>SL No</th>
                                                    <th class="span3">Item Name</th>
                                                    <th class="span2">Qty</th>
                                                    <th>Delivery Time</th>
                                                    <th>Date</th>
                                                    <th >Subtotal</th>
                                                    <th>Status</th>
                                                    <th >Action</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                            <?php
                                            $query = "SELECT * from online_order WHERE user_id = '".$_SESSION['userId']."' ORDER BY time,date";
                                            $runQuery = mysql_query($query);
                                            $count = 1;
                                            while($row = mysql_fetch_array($runQuery)) {
                                                echo "<tr>"; 
                                                ?>
                                                <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>" name="dltupForm" method="post">
                                                    <td><?php echo $count ?></td>
                                                    <td><?php echo $row['product_name']; ?></td>
                                                    <td><?php echo $row['product_amount'];?></td>
                                                    <td><?php echo $row['time'];?></td>
                                                    <td><?php echo $row['date'];?></td>
                                                    <input type="hidden" name="id" value="<?php echo $row['id']?>">
                                                    <td><?php echo formatMoney($row['total_price'], true); ?></td>
                                                    <td><?php if($row['status'] == 0) {
                                                                echo "PENDING";}
                                                            else if ($row['status'] == 1){
                                                                echo "COMPLETED";
                                                            } else if ($row['status'] == 2){
                                                                echo "DENIED";
                                                            }?>
                                                    </td>
                                                    <td><?php if($row['status'] == 0) {?>
                                                        <button type="submit" name="deleteBtn" class="btn btn-danger btn-small"><i class="icon icon-rempve"></i> REMOVE </button>
                                                    <?php } else echo 'No Action';?>
                                                    </td>
                                                </form>
                                                    <?php
                                                $count++;
                                                echo "</tr>";
                                                }
                                                ?>
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                        </div>
                </div>
            </div>
        <?php include 'footer.php';?>