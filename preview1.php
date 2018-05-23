<?php
include 'header.php';

$invoiceNo = testInput($_GET['invoice']);

if(isset($_POST['confirmBtn'])) {
    $invoiceNoInc = $_POST['invoice_no'];
    $query = "SELECT product_id,product_remain FROM temp WHERE invoice_no = '$invoiceNoInc'";
    $runQuery = mysql_query($query);
    while($row = mysql_fetch_array($runQuery)) {
        $amount = $row['product_remain'];
        $id = $row['product_id'];
        $queryIn = "UPDATE inventory SET food_amount = '$amount' WHERE food_id = '$id'";;
        $runQueryIn = mysql_query($queryIn);
        if($runQueryIn) {
            header("location: index.php");
        }
    }
}

if(isset($_POST['cancelBtn'])) {
    $invoiceNoInc = $_POST['invoice_no'];
    $query = "DELETE FROM temp WHERE invoice_no = '$invoiceNoInc'";
    $runQuery = mysql_query($query);
    $row = mysql_fetch_array($runQuery);
    if($runQuery) {
        header("location: index.php");
    }
    
    
}
?>

<script language="javascript">
    function Clickheretoprint()
    { 
      var disp_setting="toolbar=yes,location=no,directories=yes,menubar=yes,"; 
          disp_setting+="scrollbars=yes,width=800, height=700, left=100, top=25"; 
      var content_vlue = document.getElementById("contentx").innerHTML; 

      var docprint=window.open("","",disp_setting); 
       docprint.document.open(); 
       docprint.document.write('</head><body onLoad="self.print()" style="width: 800px; font-size: 18px; font-family: sans-serif;">');       docprint.document.write(content_vlue); 
       docprint.document.close(); 
       docprint.focus(); 
    }
</script>
<div id="content">
    <!--breadcrumbs-->
        <div id="content-header">
            <div id="breadcrumb">
                <a href="index.php" title="Go to Home" class="tip-bottom" style="font-family: "><i class="icon-home"></i> Home</a> <a href="#" title="Admin Panel" class="tip-bottom"><i class="icon-user"></i> Sales</a> <a href="#" class="current">Preview Receipt</a></div>
                <h1>Preview Receipt</h1>
        </div>
    <!--End-breadcrumbs-->
        <div class="container-fluid">
            <hr>
            <div class="row-fluid" id="contentx">
                <div class="span12">
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
                    <br> <br>
                    <div class="span6">
                        <table class="table table-bordered table-invoice" style="text-align: left">
                            <thead>
                            <th colspan="2">Order Details</th>
                            </thead>
                            <tbody>
                                <?php
                                $getInfoQuery = "SELECT * from customer_info where order_id = '$invoiceNo'";
                                $runGetInfoQuery = mysql_query($getInfoQuery);
                                $rowInfo = mysql_fetch_array($runGetInfoQuery);
                                ?>
                                <tr>
                                    <td class="width30">Customer Name:</td>
                                    <td class="width70"><strong><?php echo $rowInfo['name'];?></strong></td>
                                </tr>
                                <tr>
                                    <td class="width30">Invoice ID:</td>
                                    <td class="width70"><strong><?php echo $invoiceNo;?></strong></td>
                                </tr>
                                <tr>
                                    <td>Issue Date:</td>
                                    <td><strong><?php echo $rowInfo['order_date_time'];?></strong></td>
                                </tr>
                                <tr>
                                    <td>Payment Method:</td>
                                    <td><strong>Cash</strong></td>
                                </tr>
                            </tbody>
                        </table>
                        
                                <br><br><br>
                    </div>
                    <div class="row-fluid">
                    <table class="table table-bordered table-striped table-hover">
                        <thead>
                            <tr>
                                <th style="width: 100px">SL No</th>
                                <th style="width: 300px">Item Name</th>
                                <th style="width: 200px">Qty</th>
                                <th style="width: 200px">Price/Unit</th>
                                <th style="width: 200px;text-align: center">Subtotal</th>
                            </tr>
                        </thead>
                        <tbody>

                        <?php
                        $query = "SELECT * from temp WHERE invoice_no = '$invoiceNo'";
                        $runQuery = mysql_query($query);
                        $count = 1;
                        while($row = mysql_fetch_array($runQuery)) {
                            echo "<tr>"; 
                            ?>
                                <td style="text-align: center"><?php echo $count ?></td>
                                <td style="text-align: center"><?php echo $row['product_name']; ?></td>
                                <td style="text-align: center"><?php echo $row['product_amount'];?></td>
                                <td style="text-align: center"><?php echo formatMoney($row['unit_price'], true); ?>
                                </td>
                                <td style="text-align: center"><?php echo formatMoney($row['total_price'], true); ?></td>
                                
                            </form>
                                <?php
                            $count++;
                            echo "</tr>";
                            }
                            ?>
                            <tr>
                                <td colspan="3"></td>
                                <td style="text-align: left"><strong>Total: </strong></td>
                                <td style="text-align: center"><?php 
                                    $getTotalQuery = "SELECT sum(total_price) from temp GROUP BY invoice_no HAVING invoice_no = '$invoiceNo'";
                                    $runGetTotalQuery = mysql_query($getTotalQuery);
                                    $row = mysql_fetch_array($runGetTotalQuery);
                                    echo formatMoney($row['sum(total_price)'], TRUE);
                              ?></td>
                            </tr>
                            <tr>
                                <td colspan="3"></td>
                                <td style="text-align: left"><strong>Cash Tendered: </strong></td>
                                <td style="text-align: center"><?php 
                                    echo formatMoney($rowInfo['cash'], TRUE);
                              ?></td>
                            </tr>
                            <tr>
                                <td colspan="3"></td>
                                <td style="text-align: left"><strong>Change: </strong></td>
                                <td style="text-align: center"><?php 
                                    echo formatMoney($rowInfo['cash']-$row['sum(total_price)'], TRUE);
                              ?></td>
                            </tr>
                        </tbody>
                    </table>
                    </div>
                </div>
            </div>
            <div class="row-fluid">
                <div class="span8">
                    <a href="javascript:Clickheretoprint()" style="font-size:20px;"><button class="btn btn-success btn-large"><i class="icon-print"></i> Print</button></a>
                </div>
                <form class="form-inline" method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>">
                <div class="span2">
                    <input type="hidden" name="invoice_no" value="<?php echo $invoiceNo; ?>">
                    <button class="btn btn-large" name="cancelBtn"><i class="icon-rempve"></i> Cancel</button>
                </div>
                <div class="span2 pull-right">
                    <button class="btn btn-primary btn-large" name="confirmBtn"><i class="icon-ok"></i> Finish</button>
                </div>
                </form>
            </div>
<!--            <a href="index.php" style="font-size:20px;"><button class="btn btn-primary btn-large pull-right"><i class="icon-ok"></i> Finish</button></a>-->
                
            
<?php
include 'footer.php';
?>