<?php 
include 'header.php';
if(!loggedinadmin()) { 
    header("location: index.php");
}

if (isset($_POST['addBtn'])) {
    $nameInc = testInput($_POST['name']);
    $addressInc = testInput($_POST['address']);
    $emailInc = testInput($_POST['email']);
    $phoneNoInc = testInput($_POST['phoneNo']);
    $categoryInc = testInput($_POST['employeeCategory']);
    
    //header("location: index.php");
            
    if(!empty($nameInc) && !empty($addressInc) && !empty($phoneNoInc) && !empty($categoryInc)) {
        $query = "INSERT INTO employee_info(name,address,email,phone_no,category) VALUES('$nameInc', '$addressInc', '$emailInc', '$phoneNoInc', '$categoryInc')";
        $runQuery = mysql_query($query);
        if ($runQuery) {
            
        }
    }
}

if (isset($_POST['dltBtn'])) {
    $id = testInput($_POST['id']);
    
    $query = "DELETE from employee_info WHERE id = '$id'";
    $runQuery = mysql_query($query);
    if ($runQuery) {
        
    }
}

if (isset($_POST['updateBtn'])) {
    $id = testInput($_POST['id']);
    $nameInc = testInput($_POST['name']);
    $addressInc = testInput($_POST['address']);
    $emailInc = testInput($_POST['email']);
    $phoneNoInc = testInput($_POST['phoneNo']);
    $categoryInc = testInput($_POST['employeeCategory']);
    
    $query = "UPDATE employee_info SET name = '$nameInc', address = '$addressInc', email = '$emailInc', phone_no = '$phoneNoInc', category = '$categoryInc' WHERE id = '$id'";
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
                <a href="index.php" title="Go to Home" class="tip-bottom"><i class="icon-home"></i> Home</a> <a href="#" title="Admin Panel" class="tip-bottom"><i class="icon-user"></i> Admin</a> <a href="employeeCategory.php" class="current">Employee Info</a></div>
                <h1>Employee Info</h1>
        </div>
    <!--End-breadcrumbs-->
    
        <div class="container-fluid">
            <hr>
            <div class="row-fluid">
                <div class="span12">
                    <div class="widget-box">
                        <div class="widget-title"> <span class="icon"> <i class="icon-align-justify"></i> </span>
                          <h5>Employee Info</h5>
                        </div>
                        <div class="widget-content">
                            <div class="input-append">
                                <input type="text" id="searchInput" onkeyup="searchFunction()" placeholder="Search for employee names.." title="Type in a name" class="span11">
                                <span class="add-on"><i class="icon icon-search"></i></span>
                            </div>   
                        <table class="table table-bordered data-table" id="myTable">
                            <thead>
                                <tr>
                                    <th class="span1">SL</th>
                                    <th class="span1">Employee ID</th>
                                    <th class="span4">Name</th>
                                    <th class="span3">Category</th>
                                    <th class="span2">Action</th
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                $query = "SELECT * from employee_info ORDER BY category,name";
                                $runQuery = mysql_query($query);
                                $count = 1;
                                while($row = mysql_fetch_array($runQuery)) {
                                    echo "<tr>"; 
                                    ?>
                                        <input type="hidden" name="id" value="<?php echo $row['id']; ?>" />
                                        <td><?php echo $count; ?></td>
                                        <td><?php echo $row['id']; ?></td>
                                        <td><?php echo $row['name']; ?></td>
                                        <td><?php
                                            $queryIn = "SELECT * from employee_category WHERE id = '".$row['category']."'";
                                            $runQueryIn = mysql_query($queryIn);
                                            $rowIn = mysql_fetch_array($runQueryIn);
                                            echo $rowIn['name']; 
                                            ?>
                                        </td>
                                        <td>
                                            <a href="employeeInfoEdit.php?id=<?php echo $row['id'];?>" class="tip-right" data-original-title="Edit"><i class="icon-edit"></i></a>
                                        </td>
                                    <?php
                                    $count++;
                                    echo "</tr>";
                                    } ?>
                            </tbody>
                            </table>
                        </div>
                    </div>
                    <div class="row-fluid">
                        <div class="span8">
                            <div class="widget-box">
                                <div class="widget-title"> <span class="icon"> <i class="icon-plus-sign"></i> </span>
                                    <h5>Add New Employee</h5>
                                </div>
                                <div class="widget-content nopadding">
                                    <form class="form-horizontal" method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>" autocomplete="off">
                                        <div class="control-group">
                                          <label class="control-label">Employee Name</label>
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
                                                <input type="text" name="phoneNo">
                                            </div>
                                        </div>
                                        <div class="control-group">
                                            <label class="control-label">Category</label>
                                            <div class="controls">
                                                <select id="position" name="employeeCategory">
                                                    <option></option>
                                                    <?php
                                                    $query = "SELECT * from employee_category ORDER BY name";
                                                    $runQuery = mysql_query($query);
                                                    while($row = mysql_fetch_array($runQuery)) {?>
                                                        <option value="<?php echo $row['id'];?>"><?php echo $row['name']; ?></option>
                                                <?php } ?>
                                                </select>
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
