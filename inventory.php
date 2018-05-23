<?php 
include 'header.php';

if (isset($_POST['addBtn'])) {
    $nameInc = testInput($_POST['name']);
    $amountInc = testInput($_POST['amount']);
    $priceInc = testInput($_POST['price']);
    if(!empty($nameInc) && !empty($amountInc) && !empty($priceInc)) {
        $query = "INSERT INTO inventory(food_name,food_amount,food_price) VALUES('$nameInc', '$amountInc', '$priceInc')";
        $runQuery = mysql_query($query);
    }
}

if (isset($_POST['dltBtn'])) {
    $id = testInput($_POST['id']);
    
    $query = "DELETE from inventory WHERE food_id = '$id'";
    $runQuery = mysql_query($query);
    if ($runQuery) {
        
    }
}

if (isset($_POST['updateBtn'])) {
    $id = testInput($_POST['id']);
    $amountInc = testInput($_POST['amount']);
    $priceInc = testInput($_POST['price']);
    
    $query = "UPDATE inventory SET food_amount = '$amountInc', food_price = '$priceInc' WHERE food_id = '$id'";
    $runQuery = mysql_query($query);
    if ($runQuery) {
        //header("location: sales.php?id=cash&invoice=$invoiceInc");
    }
}
?>
    <div id="content">
    <!--breadcrumbs-->
        <div id="content-header">
            <div id="breadcrumb">
                <a href="#" title="Go to Home" class="tip-bottom"><i class="icon-home"></i> Home</a> <a href="#" class="current">Inventory</a></div>
                <h1>Inventory</h1>
        </div>
    <!--End-breadcrumbs-->
    
        <div class="container-fluid">
            <hr>
            <div class="row-fluid">
                <div class="span12">
                    <div class="widget-box">
                        <div class="widget-title"> <span class="icon"> <i class="icon-inbox"></i> </span>
                          <h5>Current Inventory</h5>
                        </div>
                        <div class="widget-content">
                            <div class="input-append">
                                <input type="text" id="searchInput" onkeyup="searchFunction()" placeholder="Search for food names.." title="Type in a name" class="span11" autofocus>
                                <span class="add-on"><i class="icon icon-search"></i></span>
                            </div>   
                        <table class="table table-bordered data-table" id="myTable">
                            <thead>
                                <tr>
                                    <th class="span1">SL</th>
                                    <th>Food ID</th>
                                    <th class="span4">Food Name</th>
                                    <th>Currently Available (Unit)</th>
                                    <th>Price/Unit</th>
                                    <th>Actions</th
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                $query = "SELECT * from inventory ORDER BY food_name ASC";
                                $runQuery = mysql_query($query);
                                $count = 1;
                                while($row = mysql_fetch_array($runQuery)) {
                                    echo "<tr>"; 
                                    ?>
                                    <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>" name="dltupForm" method="post">
                                        <input type="hidden" name="id" value="<?php echo $row['food_id']; ?>" />
                                        <td><?php echo $count; ?></td>
                                        <td><?php echo $row['food_id']; ?></td>
                                        <td><?php echo $row['food_name']; ?></td>
                                        <td><input type="number" name="amount" class="text-center" autocomplete="off" value="<?php echo $row['food_amount'];?>" ></td>
                                        <td>
                                            <input type="number" name="price" class="text-center" autocomplete="off" value="<?php echo $row['food_price']; ?>" >
                                        </td>
                                        <td>
                                            <button type="submit" name="updateBtn" class="btn btn-success btn-mini tip-bottom" data-original-title="Confirm"><i class="icon icon-ok"></i>  </button>
                                            <button type="submit" name="dltBtn" class="btn btn-danger btn-mini tip-bottom" onclick=" return ConfirmDelete()" data-original-title="Remove"><i class="icon icon-remove"></i> </button>
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
                        <div class="widget-title"> <a data-toggle="collapse" href="#collapseOne"> <span class="icon"> <i class="icon-plus-sign"></i> </span>
                                <h5>Add New Product</h5> </a>
                        </div>
                        <div id="collapseOne" class="collapse in">
                            <div class="widget-content">
                                <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>" name="addForm" method="post">
                                <div class="controls controls-row">
                                    <input type="text" name="name" placeholder="Type Product Name .." class="span4 m-wrap">
                                    <input type="number" name="amount" placeholder="Current Amount" class="span3 m-wrap">
                                    <input type="text" name="price" placeholder="Unit Price" class="span3 m-wrap">
                                    <button type="submit" name="addBtn" class="btn btn-success btn-small span1 m-wrap" > <i class="icon icon-plus-sign"> </i> Add</button>
                                </div>
                                </form>
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
                td = tr[i].getElementsByTagName("td")[2];
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
?>
