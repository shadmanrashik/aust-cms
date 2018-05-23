<?php
include 'header.php';

$invoiceNo = testInput($_GET['invoice']);
//$today = date("F j, Y, g:i a"); 
$today = date("Y-m-d H:i:s");
if (isset($_POST['addBtn'])) {
    $invoiceInc = testInput($_POST['invoice']);
    $producInc = testInput($_POST['product']);
    $amountInc = testInput($_POST['amount']);
    if(!empty($producInc) && !empty($amountInc)) {
        $query = "SELECT * from inventory WHERE food_id= '$producInc'";
        $runQuery = mysql_query($query);
        $amount = mysql_result($runQuery, 0, 'food_amount');
        $price = mysql_result($runQuery, 0, 'food_price');
        $name = mysql_result($runQuery, 0, 'food_name');
        if($amount >= $amountInc) {
            $amountLeft = $amount - $amountInc;
            $totalPrice = $price * $amountInc;
            $query = "INSERT INTO temp(invoice_no,product_id,product_name,product_amount,product_remain,unit_price,total_price) VALUES('$invoiceInc', '$producInc', '$name' , '$amountInc', '$amountLeft', '$price' , '$totalPrice');";
            $runQuery = mysql_query($query);
            header("location: sales.php?id=Cash&invoice=$invoiceInc");
        } else {
            $alert = TRUE;
            header("location: sales.php?id=cash&invoice=$invoiceInc&alt=1");
        }
    } else {
        header("location: sales.php?id=Cash&invoice=$invoiceInc");
    }
}

if (isset($_POST['dltBtn'])) {
    $invoiceInc = testInput($_POST['invoice']);
    $hdnId = testInput($_POST['hdnId']);
    
    $query = "DELETE from temp WHERE product_id = '$hdnId' AND invoice_no = '$invoiceInc'";
    $runQuery = mysql_query($query);
    if ($runQuery) {
        header("location: sales.php?id=Cash&invoice=$invoiceInc");
    }
}

if (isset($_POST['updateBtn'])) {
    $invoiceInc = testInput($_POST['invoice']);
    $hdnId = testInput($_POST['hdnId']);
    $amount = testInput($_POST['changeAmount']);
    $unitPrice = testInput($_POST['unitPrice']);
    $totalPrice = $unitPrice * $amount;
    $query = "UPDATE temp SET product_amount = '$amount', total_price = '$totalPrice' WHERE invoice_no = '$invoiceInc' AND product_id = '$hdnId'";
    $runQuery = mysql_query($query);
    if ($runQuery) {
        header("location: sales.php?id=Cash&invoice=$invoiceInc");
    }
}

if (isset($_POST['payInvoiceBtn'])) {
    $nameInc = testInput($_POST['name']);
    $cashInc = testInput($_POST['cash']);
    $invoiceInc = testInput($_POST['invoiceNo']);
    $dateTimeInc = date("Y-m-d H:i:s");;
    if(!empty($dateTimeInc) && !empty($cashInc) && !empty($invoiceInc)) {
        
            $query = "INSERT INTO customer_info(name,order_date_time,order_id,cash) VALUES('$nameInc', '$dateTimeInc', '$invoiceInc', '$cashInc');";
            $runQuery = mysql_query($query);
            if($runQuery){
                header("location: preview1.php?id=Cash&invoice=$invoiceInc");
            }                    
    } else {
        //header("location: index.php");
    }
}

?>

    <div id="content">
    <!--breadcrumbs-->
        <div id="content-header">
            <div id="breadcrumb">
                <a href="index.php" title="Go to Home" class="tip-bottom"><i class="icon-home"></i> Home</a> <a href="#" class="current">Sales</a></div>
                <h1>Sales</h1>
        </div>
    <!--End-breadcrumbs-->

        <div class="container-fluid">
            <hr>
            <div class="row-fluid">
                <div class="span12">
                    <div class="widget-box">
                        <div class="widget-title"> <span class="icon"> <i class="icon-shopping-cart"></i> </span>
                          <h5>Add an item to Cart</h5>
                        </div>
                        <div class="widget-content nopadding">
                            <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>" method="post" class="form-horizontal">
                                <div class="control-group ">
                                    <label class="control-label">Select Food : </label>
                                    <div class="controls">
                                        <input type="hidden" name="invoice" value="<?php echo $_GET['invoice']; ?>" />            
                                        <select id="position" name="product" class="span11">
                                            <option></option>
                                            <?php

                                            //include('../connect.php');
                                            $query = "SELECT * from inventory ORDER BY food_name ASC";
                                            $runQuery = mysql_query($query);
                                            $count = 1;
                                            while($row = mysql_fetch_array($runQuery)) {?>
                                                <option value="<?php echo $row['food_id'];?>"><?php echo $row['food_name']; ?> <?php //echo $row['food_amount']; ?></option>
                                            <?php
                                                $count++;
                                            }?>
                                        </select>
                                    </div>
                                </div>
                                <div class="control-group">
                                    <label class="control-label">Amount :</label>
                                    <div class="controls">
                                        <input type="text" name="amount"  class="span11 tip-bottom" title="Numeric Value Only" autocomplete="off" required />
                                    </div>
                                </div>
                                <div class="control-group">
                                    <div class="controls">
                                        <?php if(isset($_GET['alt'])=='1') { ?>
                                            <div class="alert alert-danger span11">
                                                <button class="close" data-dismiss="alert">×</button>
                                                Failed to add to cart. Amount not available.
                                            </div> <?php
                                        } ?>
                                    </div>
                                </div>
                                <div class="form-actions">
                                    <button type="submit" name="addBtn" class="btn btn-large btn-success pull-right span3"><i class="icon icon-plus"> </i>Add</button>
                                </div>
                            </form>
                        </div>
                    </div>
                <div class="row-fluid">
                    <div class="span12">
                        <div class="widget-box">
                            <div class="widget-title"> <span class="icon"> <i class="icon-briefcase"></i> </span>
                                <h5> Payment Counter </h5>
                            </div>
                            <div class="widget-content" style="font-size: 13px">
                                <div class="row-fluid">
                                    <div class="span6"><br><br>
                                        <table class="">
                                            <tbody>
                                                <tr>
                                                    <td><h4>AUST Canteen</h4></td>
                                                </tr>
                                                <tr>
                                                    <td>Ahsanullah University of Science & Technology</td>
                                                </tr>
                                                <tr>
                                                    <td>141 & 142, Love Rd,</td>
                                                </tr>
                                                <tr>
                                                    <td>Dhaka, 1208</td>
                                                </tr>
                                                <tr>
                                                    <td>Mobile Phone: +88-017XXXXXXXX</td>
                                                </tr>
                                                <tr>
                                                    <td >acms@aust.edu</td>
                                                </tr>
                                            </tbody>
                                        </table>
                                    </div>
                                    <div class="span6">
                                        <table class="table table-bordered table-invoice">
                                            <thead>
                                            <th colspan="2">Order Details</th>
                                            </thead>
                                            <tbody>
                                              <tr>
                                                    <td class="width30">Invoice ID:</td>
                                                    <td class="width70"><strong><?php echo $invoiceNo;?></strong></td>
                                                </tr>
                                                <tr>
                                                    <td>Issue Date:</td>
                                                    <td><strong><?php echo $today;?></strong></td>
                                                </tr>
                                                <tr>
                                                    <td>Payment Method:</td>
                                                    <td><strong><?php echo $_GET['id'] ?></strong></td>
                                                </tr>
                                                <br><br><br>
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                                <hr>
                                <div class="row-fluid">
                                    <div class="span12">
                                        <table class="table table-bordered table-hover">
                                            <thead>
                                                <tr>
                                                    <th>SL No</th>
                                                    <th class="span5">Item Name</th>
                                                    <th class="span3">Qty</th>
                                                    <th >Price/Unit</th>
                                                    <th >Subtotal</th>
                                                    <th >Action</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                          <!--                    <tr>
                                              <td>Firefox</td>
                                              <td>Ut perspiciatis unde omnis iste natus error sit voluptatem accusantium doloremque laudantium, totam rem aperiam, eaque ipsa quae ab illo inventore veritatis et quasi architecto beatae</td>
                                              <td class="right">2</td>
                                              <td class="right">$150</td>
                                              <td class="right"><strong>$300</strong></td>
                                              <td class="right"><a class="btn btn-danger btn-small"><i class="icon icon-minus-sign"></i></a></td>
                                            </tr>-->
                                            <?php
                                            $query = "SELECT * from temp WHERE invoice_no = '$invoiceNo'";
                                            $runQuery = mysql_query($query);
                                            $count = 1;
                                            while($row = mysql_fetch_array($runQuery)) {
                                                echo "<tr>"; 
                                                ?>
                                                <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>" name="dltupForm" method="post">
                                                    <input type="hidden" name="invoice" value="<?php echo $_GET['invoice']; ?>" />
                                                    <input type="hidden" name="unitPrice" value="<?php echo $row['unit_price']; ?>" />                                
                                                    <td><?php echo $count ?></td>
                                                    <td><?php echo $row['product_name']; ?></td>
                                                    <td><input class="text-center" type="number" autocomplete="off" name="changeAmount" value="<?php echo $row['product_amount'];?>"></td>
                                                    <td><?php //$oprice=$row['food_price'];
                                                        echo formatMoney($row['unit_price'], true); ?>
                                                    </td>
                                                    <input type="hidden" name="hdnId" value="<?php echo $row['product_id']?>">
                                                    <td><?php echo formatMoney($row['total_price'], true); ?></td>
                    <!--                                    <td>
                                                        <a href="user.html"><i class="fa fa-pencil"></i></a>
                                                        <a href="#myModal" role="button" data-toggle="modal"><i class="fa fa-trash-o"></i></a>
                                                    </td>-->
                                                    <td>
                                                        <button type="submit" name="updateBtn" class="btn btn-primary btn-small"><i class="icon icon-ok"></i> Update </button>
                                                        <button type="submit" name="dltBtn" class="btn btn-danger btn-small"><i class="icon icon-remove"></i> Remove</button>

                    <!--                                        <a href="javascript:void()" onclick="document.getElementById('dltupForm').submit();" class="tip-top" data-original-title="Delete"><i class="icon-remove icon-2x"></i></a>-->
                                                    </td>
                    <!--                                    <td>
                                                        <button type="submit" name="dltBtn" class="btn btn-danger btn-small"><i class="icon icon-minus-sign"></i> Cancel</button>
                                                    </td>-->
                                                </form>
                                                    <?php
                                                $count++;
                                                echo "</tr>";
                                                }
                                                ?>
                                            <tr>
                                                    <td colspan="3"></td>
                                                    <td><strong>Total: </strong></td>
                                                    <td><?php 
                                                        $getTotalQuery = "SELECT sum(total_price) from temp GROUP BY invoice_no HAVING invoice_no = '$invoiceNo'";
                                                        $runGetTotalQuery = mysql_query($getTotalQuery);
                                                        $row = mysql_fetch_array($runGetTotalQuery);
                                                        echo formatMoney($row['sum(total_price)'], TRUE);
                                                    ?></td>
                                                </tr>
                                            </tbody>
                                        </table>
                                        <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>" name="confirmForm" method="post">
                                        <div class="span9 nopadding">
                                            <br>
                                            <h5>Customer Information</h5>
                                            <div class="controls controls-row">
                                                <input type="text" name="name" placeholder="Customer Name" class="span6 m-wrap" required>
                                                <input type="number" name="cash" placeholder="Cash Amount" class="span5 m-wrap" required>
                                                <input type="hidden" name="invoiceNo" value="<?php echo $_GET['invoice']; ?>">
                                                <input type="hidden" name="dateTime" value="<?php echo date("Y-m-d H:i:s"); ?>">
                                            </div>
                                        </div>

                                        <div class="pull-right">
                                            <h4><span>Amount Due:</span> <?php echo formatMoney($row['sum(total_price)'], TRUE); echo '&#2547'; ?></h4>
                                            <br>
                                            <button class="btn btn-primary btn-large pull-right" type="submit" name="payInvoiceBtn">Pay Invoice</button>
                                        </div>
                                        </form>
                                        
                        <!--                <table class="table table-bordered table-invoice-full">
                                        <tbody>
                                          <tr>

                                            <td class="right"><strong>Subtotal</strong> <br>
                                              <strong>Tax (5%)</strong> <br>
                                              <strong>Discount</strong></td>
                                            <td class="right"><strong>$7,000 <br>
                                              $600 <br>
                                              $50</strong></td>
                                          </tr>
                                        </tbody>
                                      </table>
                                      <div class="pull-right">
                                        <h4><span>Amount Due:</span> $7,650.00</h4>
                                        <br>
                                        <a class="btn btn-primary btn-large pull-right" href="">Pay Invoice</a> </div>-->
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
<?php
include 'footer.php';
?>