<?php 
include 'header.php';
if(!loggedinadmin()) { 
    header("location: index.php");
}

if (isset($_POST['addBtn'])) {
    $nameInc = testInput($_POST['name']);
    $salaryInc = testInput($_POST['salary']);
    $overtimeSalaryInc = testInput($_POST['overtimeSalary']);
    if(!empty($nameInc) && !empty($salaryInc) && !empty($overtimeSalaryInc)) {
        $query = "INSERT INTO employee_category(name,salary,overtime_salary) VALUES('$nameInc', '$salaryInc', '$overtimeSalaryInc')";
        $runQuery = mysql_query($query);
    }
}

if (isset($_POST['dltBtn'])) {
    $id = testInput($_POST['id']);
    
    $query = "DELETE from employee_category WHERE id = '$id'";
    $runQuery = mysql_query($query);
    if ($runQuery) {
        
    }
}

if (isset($_POST['updateBtn'])) {
    $id = testInput($_POST['id']);
    $salaryInc = testInput($_POST['salary']);
    $overtimeSalaryInc = testInput($_POST['overtimeSalary']);
    
    $query = "UPDATE employee_category SET salary = '$salaryInc', overtime_salary = '$overtimeSalaryInc' WHERE id = '$id'";
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
                <a href="index.php" title="Go to Home" class="tip-bottom"><i class="icon-home"></i> Home</a> <a href="#" title="Admin Panel" class="tip-bottom"><i class="icon-user"></i> Admin</a> <a href="employeeCategory.php" class="current">Employee Category</a></div>
                <h1>Employee Category</h1>
        </div>
    <!--End-breadcrumbs-->
    
        <div class="container-fluid">
            <hr>
            <div class="row-fluid">
                <div class="span12">
                    <div class="widget-box">
                        <div class="widget-title"> <span class="icon"> <i class="icon-align-justify"></i> </span>
                          <h5>Edit Category</h5>
                        </div>
                        <div class="widget-content">
                            <div class="input-append">
                                <input type="text" id="searchInput" onkeyup="searchFunction()" placeholder="Search for category names.." title="Type in a name" class="span11">
                                <span class="add-on"><i class="icon icon-search"></i></span>
                            </div>   
                        <table class="table table-bordered data-table" id="myTable">
                            <thead>
                                <tr>
                                    <th class="span1">SL</th>
                                    <th class="span2">Category ID</th>
                                    <th class="span4">Category Name</th>
                                    <th class="span2">Salary(Per Day)</th>
                                    <th class="span2">Overtime Salary(Per hour)</th>
                                    <th class="span2">Actions</th
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                $query = "SELECT * from employee_category ORDER BY name ASC";
                                $runQuery = mysql_query($query);
                                $count = 1;
                                while($row = mysql_fetch_array($runQuery)) {
                                    echo "<tr>"; 
                                    ?>
                                    <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>" name="dltupForm" method="post">
                                        <input type="hidden" name="id" value="<?php echo $row['id']; ?>" />
                                        <td><?php echo $count; ?></td>
                                        <td><?php echo $row['id']; ?></td>
                                        <td><?php echo $row['name']; ?></td>
                                        <td><input type="text" name="salary" style="width: 8em" class="text-center" autocomplete="off" value="<?php echo $row['salary'];?>" ></td>
                                        <td>
                                            <input type="text" name="overtimeSalary" style="width: 8em" class="text-center" autocomplete="off" value="<?php echo $row['overtime_salary']; ?>" >
                                        </td>
                                        <td>
                                            <button type="submit" name="updateBtn" class="btn btn-success btn-mini tip-bottom" data-original-title="Update"><i class="icon icon-ok"></i>  </button>
                                            <button type="submit" name="dltBtn" onclick="return ConfirmDelete()" class="btn btn-danger btn-mini tip-bottom" data-original-title="Remove"><i class="icon icon-remove"></i> </button>
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
                                <h5>Add New Employee Category</h5> </a>
                        </div>
                        <div id="collapseOne" class="collapse in">
                            <div class="widget-content">
                                <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>" name="addForm" method="post">
                                <div class="controls controls-row">
                                    <input type="text" name="name" placeholder="Type Category Name .." class="span4 m-wrap">
                                    <input type="text" name="salary" placeholder="Salary" class="span3 m-wrap">
                                    <input type="text" name="overtimeSalary" placeholder="Overtime Salary" class="span3 m-wrap">
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
