<?php 
include 'header.php';
if(!loggedinadmin()) { 
    header("location: index.php");
}


if (isset($_POST['deleteBtn'])) {
    $id = testInput($_POST['id']);
    
    $query = "UPDATE online_order SET status = '2' WHERE id='$id'";
    $runQuery = mysql_query($query);
    if ($runQuery) {
        
    }
}

if (isset($_POST['updateBtn'])) {
    $id = testInput($_POST['id']);
    $foodId = testInput($_POST['foodId']);
    $newAmount = testInput($_POST['amountRemain']);
    
    $query = "UPDATE online_order SET status = '1' WHERE id='$id'"; //status 9=temp, 0=ordered, 1=confirmed, 2=denied
    $runQuery = mysql_query($query);
    if ($runQuery) {
        $queryIn = "UPDATE inventory SET food_amount = '$newAmount' WHERE food_id='$foodId'"; //status 9=temp, 0=ordered, 1=confirmed, 2=denied
        $runQueryIn = mysql_query($queryIn);
    }
}
?>
    <div id="content">
    <!--breadcrumbs-->
        <div id="content-header">
            <div id="breadcrumb">
                <a href="index.php" title="Go to Home" class="tip-bottom"><i class="icon-home"></i> Home</a> <a href="#" title="Admin Panel" class="tip-bottom"><i class="icon-user"></i> Admin</a> <a href="employeeCategory.php" class="current">Online Order List</a></div>
                <h1>Online Order List</h1>
        </div>
    <!--End-breadcrumbs-->
    
        <div class="container-fluid">
            <hr>
            <div class="row-fluid">
                <div class="span12">
                    <div class="widget-box">
                        <div class="widget-title"> <span class="icon"> <i class="icon-align-justify"></i> </span>
                            <h5> Pending Online Order </h5>
                        </div>
                        <div class="widget-content nopadding">
                            <div class="row-fluid">
                                <div class="span12">
                                    <table class="table table-bordered table-hover">
                                        <thead>
                                            <tr>
                                                <th>SL No</th>
                                                <th class="span3">Order No</th>
                                                <th class="span2">Teacher Name</th>
                                                <th>Product Name</th>
                                                <th>Amount</th>
                                                <th >Current Amount</th>
                                                <th>Time</th>
                                                <th>Date</th>
                                                <th >Action</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                        <?php
                                        $query = "SELECT * from online_order WHERE status = '0' ORDER BY time,date";
                                        $runQuery = mysql_query($query);
                                        $count = 1;
                                        while($row = mysql_fetch_array($runQuery)) {
                                            echo "<tr>"; 
                                            ?>
                                            <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>" name="dltupForm" method="post">
                                                <td><?php echo $count ?></td>
                                                <td><?php echo $row['invoice_no']; ?></td>
                                                <td><?php 
                                                    $queryIn = "SELECT * from user_info WHERE id = '".$row['user_id']."'";
                                                    $runQueryIn = mysql_query($queryIn);
                                                    $rowIn = mysql_fetch_array($runQueryIn);
                                                    echo $rowIn['name'];?></td>
                                                <td><?php echo $row['product_name'];?></td>
                                                <td><?php echo $row['product_amount'];?></td>
                                                <td><?php 
                                                    $queryIn1 = "SELECT * from inventory WHERE food_id = '".$row['product_id']."'";
                                                    $runQueryIn1 = mysql_query($queryIn1);
                                                    $rowIn1 = mysql_fetch_array($runQueryIn1);
                                                    echo $rowIn1['food_amount'];?></td>
                                                <td><?php echo $row['time'];?></td>
                                                <td><?php echo $row['date'];?></td>
                                                <input type="hidden" name="id" value="<?php echo $row['id']?>">
                                                <input type="hidden" name="foodId" value="<?php echo $rowIn1['food_id']?>">
                                                <input type="hidden" name="amountRemain" value="<?php
                                                echo $amount = $rowIn1['food_amount'] - $row['product_amount']; ?>">
                                                <td>
                                                    <button type="submit" name="updateBtn" class="btn btn-success btn-small" onclick=" return ConfirmOrder()"><i class="icon icon-ok"></i> </button>
                                                    <button type="submit" name="deleteBtn" class="btn btn-danger btn-small" onclick=" return ConfirmDelete()"><i class="icon icon-remove"></i> </button>
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

    <script>
    function ConfirmOrder()
    {
      var x = confirm("Confirm? This action can not be undone!");
      if (x)
          return true;
      else
        return false;
    }
    </script>
<?php 
include 'footer.php';
?>
