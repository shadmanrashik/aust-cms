<?php
include 'header.php';

if (isset($_POST['updateBtn'])) {
    $id = testInput($_POST['id']);
    $amountInc = testInput($_POST['amount']);
    $orderNoInc = testInput($_POST['orderNo']);
    
    $query = "UPDATE purchase_item SET status = '1' WHERE order_no = '$orderNoInc' AND id = '$id'";
    $runQuery = mysql_query($query);
    
    $query2 = "SELECT amount from raw_material WHERE id = '$id'";
    $runQuery2 = mysql_query($query2);
    $amount = mysql_result($runQuery2, 0, 'amount');
    $totalAmount = $amount + $amountInc;
    
    $query3 = "UPDATE raw_material SET amount='$totalAmount' WHERE id = '$id'";
    $runQuery3 = mysql_query($query3);
    
    if ($runQuery) {
        //header("location: pendingItem.php");
    }
}
if (isset($_POST['dltBtn'])) {
    $id = testInput($_POST['deleteOrderId']);
    
    $query = "DELETE from purchase_item WHERE id = '$id'";
    $runQuery = mysql_query($query);
    if ($runQuery) {
        //header("location: pendingItem.php");
    }
}
?>

    <div id="content">
    <!--breadcrumbs-->
        <div id="content-header">
            <div id="breadcrumb">
                <a href="#" title="Go to Home" class="tip-bottom"><i class="icon-home"></i> Home</a> <a href="#" class="current">Pending Item</a></div>
                <h1>Receive Item</h1>
        </div>
    <!--End-breadcrumbs-->
        <div class="container-fluid">
            <hr>
            <div class="row-fluid">
                <div class="span12">
                    <div class="widget-box">
                        <div class="widget-title"> <span class="icon"> <i class="icon-retweet"></i> </span>
                          <h5>Current Pending Order(s)</h5>
                        </div>
                        <div class="widget-content nopadding">
                            <table class="table table-bordered table-hover">
                                <thead>
                                    <tr>
                                        <th class="span1">SL No</th>
                                        <th class="span2">Receive Date</th>
                                        <th class="span3">Order No</th>
                                        <th class="span3">Item Name</th>
                                        <th class="span3">Supplier</th>
                                        <th class="span2">Qty</th>
                                        <th class="span2" >Subtotal</th>
                                        <th class="span2">Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                <?php
                                $query = "SELECT * from purchase_item WHERE status = '0' ORDER BY date, order_no;";
                                $runQuery = mysql_query($query);
                                $count = 1;
                                while($row = mysql_fetch_array($runQuery)) {
                                    //echo "<tr>"; 
                                    ?>
                                    <tr class="<?php if($row['date'] < date("Y-m-d")) { echo 'error';} else if($row['date'] == date("Y-m-d")) {    echo 'success';   } ?>" >
                                    <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>" name="dltupForm" method="post">
                                        <?php
                                        $queryInner = "SELECT * from raw_material WHERE id = '".$row['item_id']."'";
                                        $runQueryInner = mysql_query($queryInner);
                                        $rowInner = mysql_fetch_array($runQueryInner);
                                        ?>
                                        <input type="hidden" name="deleteOrderId" value="<?php echo $row['id']; ?>" />                                
                                        <input type="hidden" name="orderNo" value="<?php echo $row['order_no']; ?>" />
                                        <input type="hidden" name="id" value="<?php echo $row['item_id']; ?>" />                                
                                        <td><?php echo $count ?></td>
                                        <td><?php echo $row['date']; ?></td>
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
                                        <input type="hidden" name="amount" value="<?php echo $row['amount']; ?>" />                                
                                        <td><?php echo formatMoney($row['total_cost'], true); ?></td>
                                        <td>
                                            <button class="btn btn-success btn-small tip-bottom" type="submit" name="updateBtn" data-original-title="Received" ><i class="icon icon-ok"></i></button>
                                            <button class="btn btn-danger btn-small tip-bottom" type="submit" name="dltBtn" data-original-title="Cancel" onclick=" return ConfirmDelete()" ><i class="icon icon-remove"></i></button>
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
<?php
include 'footer.php';
?>