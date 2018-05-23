<?php
include 'header.php';

if (isset($_POST['addBtn'])) {
    $nameInc = testInput($_POST['name']);
    $addressInc = testInput($_POST['address']);
    $emailInc = testInput($_POST['email']);
    $phnNoInc = testInput($_POST['phnNo']);
    //header("location: index.php");
            
    if(!empty($nameInc) && !empty($addressInc) && !empty($emailInc) && !empty($phnNoInc)) {
        $query = "INSERT INTO vendor(name,address,email,phone_no) VALUES('$nameInc', '$addressInc', '$emailInc', '$phnNoInc')";
        $runQuery = mysql_query($query);
        if ($runQuery) {
            
        }
    }
}
?>

    <div id="content">
    <!--breadcrumbs-->
        <div id="content-header">
            <div id="breadcrumb">
                <a href="#" title="Go to Home" class="tip-bottom"><i class="icon-home"></i> Home</a> <a href="#" class="current">Vendor</a></div>
                <h1>Vendor</h1>
        </div>
    <!--End-breadcrumbs-->
    
        <div class="container-fluid">
            <hr>
            <div class="row-fluid">
                <div class="span12">
                    <div class="widget-box">
                        <div class="widget-title"> <span class="icon"> <i class="icon-group"></i> </span>
                            <h5>Current Vendor</h5>
                        </div>
                        <div class="widget-content">
                            <div class="input-append">
                                <input type="text" id="searchInput" onkeyup="searchFunction()" placeholder="Search for vendor names.." title="Type in a name" class="span11">
                                <span class="add-on"><i class="icon icon-search"></i></span>
                            </div>   
                            <table class="table table-bordered data-table" id="myTable">
                            <thead>
                                <tr>
<!--                                    <th class="span1">SL</th>-->
                                    <th>Vendor ID</th>
                                    <th>Vendor Name</th>
                                    <th>Actions</th
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                $query = "SELECT * from vendor";
                                $runQuery = mysql_query($query);
                                $count = 1;
                                while($row = mysql_fetch_array($runQuery)) {
                                    echo "<tr>"; 
                                    ?>
                                        <input type="hidden" name="id" value="<?php echo $row['id']; ?>" />
<!--                                        <td><?php echo $count; ?></td>-->
                                        <td class="span1"><?php echo $row['id']; ?></td>
                                        <td><?php echo $row['name']; ?></td>
                                        <td class="taskOptions">
                                            <a href="vendorEdit.php?id=<?php echo $row['id'];?>" class="tip-right" data-original-title="Edit"><i class="icon-edit"></i></a>
                                        </td>

                                    <?php
                                    $count++;
                                    echo "</tr>";
                                    } ?>
                            </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row-fluid">
                <div class="span6">
                    <div class="widget-box">
                        <div class="widget-title"> <span class="icon"> <i class="icon-plus-sign"></i> </span>
                            <h5>Add New Vendor</h5>
                        </div>
                        <div class="widget-content nopadding">
                            <form class="form-horizontal" method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>" autocomplete="off">
                                <div class="control-group">
                                  <label class="control-label">Vendor Name</label>
                                  <div class="controls">
                                      <input type="text" name="name">
                                  </div>
                                </div>
                                <div class="control-group">
                                    <label class="control-label">Address</label>
                                    <div class="controls">
                                        <input type="text" name="address">
                                    </div>
                                </div>
                                <div class="control-group">
                                    <label class="control-label">Email</label>
                                    <div class="controls">
                                        <input type="email" name="email">
                                    </div>
                                </div>
                                <div class="control-group">
                                    <label class="control-label">Phone Number</label>
                                    <div class="controls">
                                        <input type="text" name="phnNo">
                                    </div>
                                </div>
                                <div class="form-actions">
                                    <input type="submit" name="addBtn" value="Submit" class="btn btn-success pull-right">
                                </div>
                            </form>
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
?>