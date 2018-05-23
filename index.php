<?php
include 'header.php';
?>
<!--main-container-part-->
    <div id="content">
    <!--breadcrumbs-->
        <div id="content-header">
            <div id="breadcrumb"> 
                <a href="index.php" title="Go to Home" class="tip-bottom"><i class="icon-home"></i> Home</a>                
            </div>
            <h1>Dashboard</h1>
        </div
        <hr>
    <!--End-breadcrumbs-->
    <div  class="quick-actions_homepage">
        <ul class="quick-actions">
            <li class="bg_lg"> <a href="sales.php?id=cash&invoice=<?php echo $orderFinalcode ?>"> <i class="icon-shopping-cart"></i> Sales</a> </li>
            <li class="bg_ly"> <a href="inventory.php"> <i class=" icon-inbox"></i> Inventory </a> </li>
            <li class="bg_lr"> <a href="vendor.php"> <i class=" icon-group"></i> Vendor </a> </li>
            <li class="bg_lb"> <a href="rawMaterial.php"> <i class="icon-sitemap"></i> Raw Material </a> </li>
            <li class="bg_lo"> <a href="purchaseSupply.php?id=cash&orderno=<?php echo $purchaseFinalcode ?>"> <i class="icon-truck"></i> Purchase Supply </a> </li>
            <li class="bg_ls"> <a href="pendingItem.php"> <i class="icon-retweet"></i> Receive Item</a> </li>
        </ul>
    </div>
    <!--Action boxes-->
        <div class="container-fluid">
            <div class="row-fluid">
                <div class="span6">
                    <div class="widget-box">
                        <div class="widget-title bg_lg"><span class="icon"><i class="icon-inbox"></i></span>
                            <h5>Receive Item (Today)</h5>
                            <div class="buttons"> <a href="pendingItem.php" class="btn btn-mini btn-inverse"><i class="icon-arrow-right icon-white"></i> View Details</a></div>
                        </div>
                        <div class="widget-content nopadding">
                            <table class="table table-bordered table-hover">
                                <thead>
                                    <tr>
                                        <th class="span1">SL No</th>
                                        <th class="span2">Order No</th>
                                        <th class="span3">Item Name</th>
                                        <th class="span3">Supplier</th>
                                        <th class="span2">Qty</th>
                                    </tr>
                                </thead>
                                <tbody>
                                <?php
                                $dateToday = date("Y-m-d");
                                $query = "SELECT * from purchase_item WHERE status = '0' AND date='$dateToday' ORDER BY date, order_no;";
                                $runQuery = mysql_query($query);
                                $count = 1;
                                while($row = mysql_fetch_array($runQuery)) {
                                    //echo "<tr>"; 
                                    ?>
                                    <tr>
                                        <?php
                                        $queryInner = "SELECT * from raw_material WHERE id = '".$row['item_id']."'";
                                        $runQueryInner = mysql_query($queryInner);
                                        $rowInner = mysql_fetch_array($runQueryInner);
                                        ?>
                                        <td><?php echo $count ?></td>
                                        <td><?php echo $row['order_no']; ?></td>
                                        <td><?php echo $rowInner['name']; ?></td>
                                        <td>
                                            <?php
                                            $queryName = "SELECT * from vendor WHERE id='".$row['vendor_id']."'";
                                            $runQueryName = mysql_query($queryName);
                                            $rowName = mysql_fetch_array($runQueryName); 
                                            echo $rowName['name']; ?>
                                        </td>
                                        <td><?php echo $row['amount'];?></td>
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
                <div class="span6">
                    <div class="widget-box">
                        <div class="widget-title bg_lg"><span class="icon"><i class="icon-inbox"></i></span>
                            <h5>Online Order (Today)</h5>
                        </div>
                        <div class="widget-content nopadding">
                            <table class="table table-bordered table-hover">
                                <thead>
                                    <tr>
                                        <th class="span1">SL No</th>
                                        <th class="span2">Teacher Name</th>
                                        <th class="span3">Item Name</th>
                                        <th class="span3">Amount</th>
                                        <th class="span3">Time</th>
                                        <th class="span3">Price</th>
                                    </tr>
                                </thead>
                                <tbody>
                                <?php
                                $today = date("Y-m-d");
                                $query = "SELECT * from online_order WHERE status = '1' AND date = '$today' ORDER BY time";
                                $runQuery = mysql_query($query);
                                $count = 1;
                                while($row = mysql_fetch_array($runQuery)) {
                                    echo "<tr>"; 
                                    ?>
                                    <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>" name="dltupForm" method="post">
                                        <td><?php echo $count ?></td>
                                        <td><?php 
                                            $queryIn = "SELECT * from user_info WHERE id = '".$row['user_id']."'";
                                            $runQueryIn = mysql_query($queryIn);
                                            $rowIn = mysql_fetch_array($runQueryIn);
                                            echo $rowIn['name'];?></td>
                                        <td><?php echo $row['product_name'];?></td>
                                        <td><?php echo $row['product_amount'];?></td>
                                        <td><?php echo $row['time'];?></td>
                                        <td><?php echo $row['total_price'];?></td>
                                        <input type="hidden" name="id" value="<?php echo $row['id']?>">
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

<?php
include 'footer.php';
?>