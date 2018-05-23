<?php
include 'header.php';
?>

<script language="javascript">
    function Clickheretoprint()
    { 
      var disp_setting="toolbar=yes,location=no,directories=yes,menubar=yes,"; 
          disp_setting+="scrollbars=yes,width=800, height=400, left=100, top=25"; 
      var content_vlue = document.getElementById("contentx").innerHTML; 

      var docprint=window.open("","",disp_setting); 
       docprint.document.open(); 
       docprint.document.write('</head><body onLoad="self.print()">');          
       docprint.document.write(content_vlue); 
       docprint.document.close(); 
       docprint.focus(); 
    }
</script>
<div id="content">
    <!--breadcrumbs-->
        <div id="content-header">
            <div id="breadcrumb">
                <a href="index.php" title="Go to Home" class="tip-bottom"><i class="icon-home"></i> Home</a> <a href="#" title="Admin Panel" class="tip-bottom"><i class="icon-user"></i> Sales</a> <a href="#" class="current">Preview Receipt</a></div>
                <h1>Preview Receipt</h1>
        </div>
    <!--End-breadcrumbs-->

        <div class="container-fluid">
            <hr>
                <div class="row-fluid">
                    <div class="span12">
                        <div class="widget-box">
                            <div class="widget-title"> <span class="icon"> <i class="icon-briefcase"></i> </span>
                                <h5> Payment Counter </h5>
                            </div>
                            <div class="widget-content" style="font-size: 13px" id="contentx">
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
                                                    <td><strong><?php echo date("Y-m-d");?></strong></td>
                                                </tr>
                                                <tr>
                                                    <td>Payment Method:</td>
                                                    <td><strong>Cash</strong></td>
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
                                                    <td><?php echo $count ?></td>
                                                    <td><?php echo $row['product_name']; ?></td>
                                                    <td><?php echo $row['product_amount'];?></td>
                                                    <td><?php //$oprice=$row['food_price'];
                                                        echo formatMoney($row['unit_price'], true); ?>
                                                    </td>
                                                    <td><?php echo formatMoney($row['total_price'], true); ?></td>
                    
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
                                                <input type="text" name="name" placeholder="Customer Name" class="span6 m-wrap">
                                                <input type="number" name="cash" placeholder="Cash Amount" class="span5 m-wrap">
                                                                                            </div>
                                        </div>

                                        <div class="pull-right">
                                            <h4><span>Amount Due:</span> <?php echo formatMoney($row['sum(total_price)'], TRUE); echo '&#2547'; ?></h4>
                                            <br>
                                            <button class="btn btn-primary btn-large pull-right" type="submit" name="payInvoiceBtn">Pay Invoice</button>
                                        </div>
                                        </form>
                                        
		<a href="javascript:Clickheretoprint()" style="font-size:20px;"><button class="btn btn-success btn-large"><i class="icon-print"></i> Print</button></a>

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
<?php
include 'footer.php';
?>