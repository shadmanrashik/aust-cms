<?php
include 'header.php';

$orderNo = testInput($_GET['orderno']);
$today = date("F j, Y, g:i a"); 

if (isset($_POST['addBtn'])) {
    $orderNoInc = testInput($_POST['orderNo']);
    //$producInc = testInput($_POST['product']);
    $itemIdInc = testInput($_POST['itemId']);
    $amountInc = testInput($_POST['amount']);
    $unitCostInc = testInput($_POST['unitPrice']);
    $totalCostInc = $unitCostInc * $amountInc;
    $vendorIdInc = testInput($_POST['vendorId']);
    $receiveDateInc = testInput($_POST['receiveDate']);
    if(!empty($itemIdInc) && !empty($amountInc) && !empty($totalCostInc) && !empty($vendorIdInc) && !empty($receiveDateInc)) {
        $query = "INSERT INTO purchase_item(order_no,item_id,amount,total_cost,vendor_id,date,status) VALUES('$orderNoInc', '$itemIdInc', '$amountInc', '$totalCostInc', '$vendorIdInc', '$receiveDateInc', '9');";
        $runQuery = mysql_query($query);
        header("location: purchaseSupply.php?id=cash&orderno=$orderNoInc");
    }
}

if (isset($_POST['updateBtn'])) {
    $orderNoInc = testInput($_POST['orderNo']);
    $id = testInput($_POST['hdnId']);
    $amount = testInput($_POST['changeAmount']);
    if(!empty($id) && !empty($amount)) {
        $query = "UPDATE purchase_item SET amount = '$amount' WHERE item_id = '$id' AND order_no = '$orderNoInc';";
        $runQuery = mysql_query($query);
        header("location: purchaseSupply.php?id=cash&orderno=$orderNoInc");
    }
}

if (isset($_POST['dltBtn'])) {
    $orderNoInc = testInput($_POST['orderNo']);
    $id = testInput($_POST['hdnId']);
    if(!empty($id)) {
        $query = "DELETE FROM purchase_item WHERE item_id = '$id' AND order_no = '$orderNoInc';";
        $runQuery = mysql_query($query);
        header("location: purchaseSupply.php?id=cash&orderno=$orderNoInc");
    }
}

if (isset($_POST['confirmBtn'])) {
    $orderNoInc = testInput($_POST['orderNo']);
    if(!empty($orderNoInc)) {
        $query = "UPDATE purchase_item SET status = '0' WHERE order_no = '$orderNoInc';";
        $runQuery = mysql_query($query);
        if($runQuery) {
            header("location: purchaseSupply.php?id=cash&orderno=$orderNoInc");
        }
    }
}
?>

<div id="content">
    <!--breadcrumbs-->
        <div id="content-header">
            <div id="breadcrumb">
                <a href="#" title="Go to Home" class="tip-bottom"><i class="icon-home"></i> Home</a> <a href="#" class="current">Purchase Supply</a></div>
                <h1>Purchase Supply</h1>
        </div>
    <!--End-breadcrumbs-->
        <div class="container-fluid">
            <hr>
            <div class="row-fluid">
                <div class="span12">
                    <div class="widget-box">
                        <div class="widget-title"> <span class="icon"> <i class="icon-truck"></i> </span>
                          <h5>Add Item(s) to Order</h5>
                        </div>
                        <div class="widget-content">
                            <div class="input-append">
                                <input type="text" id="searchInput" onkeyup="searchFunction()" placeholder="Search for food names.." title="Type in a name" class="span11">
                                <span class="add-on"><i class="icon icon-search"></i></span>
                            </div>   
                        <table class="table table-bordered data-table" id="myTable">
                            <thead>
                                <tr>
                                    <th class="span1">SL</th>
                                    <th class="span2">Raw Mat. Name</th>
                                    <th class="span1">Current Stock Amount(Unit)</th>
                                    <th class="span2">Order Amount</th>
                                    <th>Select Supplier</th>
                                    <th>Receive Date</th>
                                    <th>Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                $queryOut = "SELECT * from raw_material ORDER BY name ASC";
                                $runQueryOut = mysql_query($queryOut);
                                $count = 1;
                                while($rowOut = mysql_fetch_array($runQueryOut)) {
                                    echo "<tr>"; 
                                    ?>
                                    <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>" name="addForm" method="post">
                                        <input type="hidden" name="orderNo" value="<?php echo $_GET['orderno']; ?>">
                                        <input type="hidden" name="itemId" value="<?php echo $rowOut['id']; ?>" />
                                        <td><?php echo $count; ?></td>
                                        <td><?php echo $rowOut['name']; ?></td>
                                        <td><?php echo $rowOut['amount']; ?></td>
                                        <input type="hidden" name="unitPrice" value="<?php echo $rowOut['price']; ?>">
                                        <td><input type="number" name="amount" placeholder="Enter Amount" class="text-center" autocomplete="off"></td>
                                        <td>
                                            <select id="position" name="vendorId" class="span11" required>
                                                <option></option>
                                                <?php
                                                $query = "SELECT * from vendor ORDER BY name ASC";
                                                $runQuery = mysql_query($query);
                                                while($row = mysql_fetch_array($runQuery)) {?>
                                                    <option value="<?php echo $row['id'];?>"><?php echo $row['name']; ?></option>
                                            <?php } ?>
                                            </select>
                                        </td>
                                        <td><input type="date" name="receiveDate" placeholder="dd/mm/yy" min="<?php echo date("Y-m-d");?>"></td>
                                        <td>
                                            <button type="submit" name="addBtn" class="btn btn-success btn-mini"><i class="icon icon-plus-sign"></i> Add </button>
                                        </td>
                                    </form>
                                    <?php
                                    $count++;
                                    echo "</tr>";
                                    } ?>
                            </tbody>
                            </table>
                        </div>
                    </div>
                    <div class="widget-box collapsible">
                        <div id="collapseOne" class="collapse">
                            <div class="widget-content">
                                <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>" name="addForm" method="post">
                                <div class="controls controls-row">
                                    <input type="text" name="name" placeholder="Type Raw Material Name .." class="span4 m-wrap">
                                    <input type="number" name="amount" placeholder="Current Amount" class="span3 m-wrap">
                                    <input type="text" name="price" placeholder="Unit Price" class="span3 m-wrap">
                                    <button type="submit" name="addBtn" class="btn btn-success btn-small span2 m-wrap" > <i class="icon icon-plus-sign"> </i> Add</button>
                                </div>
                                </form>
                            </div>
                        </div>
                    </div>
                    <div class="row-fluid">
                    <div class="span12">
                        <div class="widget-box">
                            <div class="widget-title"> <span class="icon"> <i class="icon-briefcase"></i> </span>
                                <h5> Order Counter </h5>
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
                                                    <td class="width30">Order ID:</td>
                                                    <td class="width70"><strong><?php echo $orderNo;?></strong></td>
                                                </tr>
                                                <tr>
                                                    <td>Issue Date:</td>
                                                    <td><strong><?php echo $today;?></strong></td>
                                                </tr>
                                                <br><br><br><br>
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
                                                    <th class="span1">SL No</th>
                                                    <th class="span3">Item Name</th>
                                                    <th class="span3">Supplier</th>
                                                    <th class="span2">Receive Date</th>
                                                    <th class="span2">Qty</th>
                                                    <th class="span1">Cost/Unit</th>
                                                    <th class="span2" >Subtotal</th>
                                                    <th class="span2">Action</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                            <?php
                                            $query = "SELECT * from purchase_item WHERE order_no = '$orderNo'";
                                            $runQuery = mysql_query($query);
                                            $count = 1;
                                            while($row = mysql_fetch_array($runQuery)) {
                                                echo "<tr>"; 
                                                ?>
                                                <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>" name="dltupForm" method="post">
                                                    <?php
                                                    $queryInner = "SELECT * from raw_material WHERE id = '".$row['item_id']."'";
                                                    $runQueryInner = mysql_query($queryInner);
                                                    $rowInner = mysql_fetch_array($runQueryInner);
                                                    ?>
                                                    <input type="hidden" name="orderNo" value="<?php echo $orderNo; ?>" />
                                                    <input type="hidden" name="unitPrice" value="<?php echo $row['price']; ?>" />                                
                                                    <td><?php echo $count ?></td>
                                                    <td><?php echo $rowInner['name']; ?></td>
                                                    <td>
                                                        <?php
                                                        $queryName = "SELECT * from vendor WHERE id='".$row['vendor_id']."'";
                                                        $runQueryName = mysql_query($queryName);
                                                        $rowName = mysql_fetch_array($runQueryName); 
                                                        echo $rowName['name']; ?>
                                                    </td>
                                                    <td><?php echo $row['date']; ?></td>
                                                    <td><input class="text-center" style="width: 40px" type="text" autocomplete="off" name="changeAmount" value="<?php echo $row['amount'];?>"></td>
                                                    <td><?php //$oprice=$row['food_price'];
                                                        echo formatMoney($rowInner['price'], true); ?>
                                                    </td>
                                                    <input type="hidden" name="hdnId" value="<?php echo $row['product_id']?>">
                                                    
                                                    <td><?php echo formatMoney($row['total_cost'], true); ?></td>
                                                    <td>
                                                        <button type="submit" name="updateBtn" class="btn btn-primary btn-small"><i class="icon icon-ok"></i></button>
                                                        <button type="submit" name="dltBtn" onclick=" return ConfirmDelete()" class="btn btn-danger btn-small"><i class="icon icon-remove"></i></button>
                                                    </td>
                                                </form>
                                                    <?php
                                                $count++;
                                                echo "</tr>";
                                                }
                                                ?>
                                                <tr>
                                                    <td colspan="5"></td>
                                                    <td><strong>Total: </strong></td>
                                                    <td colspan="2"><?php 
                                                        $getTotalQuery = "SELECT sum(total_cost) from purchase_item GROUP BY order_no HAVING order_no = '$orderNo'";
                                                        $runGetTotalQuery = mysql_query($getTotalQuery);
                                                        $row = mysql_fetch_array($runGetTotalQuery);
                                                        echo formatMoney($row['sum(total_cost)'], TRUE);
                                                        
                                                    ?></td>
                                                </tr>
                                            </tbody>
                                        </table>
                                        <div class="pull-right">
                                            <h4><span>Amount Due:</span> <?php echo formatMoney($row['sum(total_cost)'], TRUE); echo '&#2547';?></h4>
                                            <br>
                                            <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>" method="post">
                                                <input type="hidden" name="orderNo" value="<?php echo $orderNo;?>">
                                                <button type="submit" name="confirmBtn" class="btn btn-primary btn-large pull-right">Confirm Order</button>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                </div>
            </div>    
    
            <script>
            function searchFunction() {
                var input, filter, table, tr, td, i;
                input = document.getElementById("searchInput");
                filter = input.value.toUpperCase();
                table = document.getElementById("myTable");
                tr = table.getElementsByTagName("tr");
                for (i = 0; i < tr.length; i++) {
                    td = tr[i].getElementsByTagName("td")[1];
                    if (td) {
                        if (td.innerHTML.toUpperCase().indexOf(filter) > -1) {
                            tr[i].style.display = "";
                        } else {
                            tr[i].style.display = "none";
                        }
                    }       
                }
            }
            
            
            </script>
            
    

<?php
include 'footer.php';