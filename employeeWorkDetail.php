<?php 
include 'header.php';
if(!loggedinadmin()) { 
    header("location: index.php");
}

if (isset($_POST['payBtn'])) {
    $idInc = testInput($_POST['id']);
    $query = "UPDATE employee_work_detail SET paid_status='1' WHERE employee_id = '$idInc'";
    $runQuery = mysql_query($query);
    if ($runQuery) {
        
    }
}
?>
    <div id="content">
    <!--breadcrumbs-->
        <div id="content-header">
            <div id="breadcrumb">
                <a href="index.php" title="Go to Home" class="tip-bottom"><i class="icon-home"></i> Home</a> <a href="#" title="Admin Panel" class="tip-bottom"><i class="icon-user"></i> Admin</a> <a href="employeeCategory.php" class="current">Employee Work Detail</a></div>
                <h1>Employee Work Detail</h1>
        </div>
    <!--End-breadcrumbs-->
    
        <div class="container-fluid">
            <hr>
            <div class="row-fluid">
                <div class="span12">
                    <div class="widget-box">
                        <div class="widget-title"> <span class="icon"> <i class="icon-align-justify"></i> </span>
                          <h5>Employee Work Detail</h5>
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
                                    <th class="span2">Category</th>
                                    <th class="span3">Salary Due</th>
                                    <th class="span3">Action</th
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
                                    <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>" method="post">
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
                                        <td><?php
                                            $queryIn = "SELECT sum(salary_due) from employee_work_detail GROUP BY employee_id,paid_status HAVING employee_id = '".$row['id']."' AND paid_status = '0' ";
                                            $runQueryIn = mysql_query($queryIn);
                                            $rowIn = mysql_fetch_array($runQueryIn);
                                            echo $rowIn['sum(salary_due)']; 
                                            ?>
                                        </td>
                                        <td>
                                            <button type="submit" name="payBtn" class="btn btn-success btn-mini" > Pay Due </button>
<!--                                            <button type="submit" name="dltBtn" class="btn btn-inverse btn-mini"  onclick=" return ConfirmDelete()" ><i class="icon icon-search"></i> Calculate </button>-->
                                            <a href="calculateWorkDetail.php?id=<?php echo $row['id'];?>" class="btn btn-inverse btn-mini" > Calculate </a>
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
                    
                </div>
            </div>

    
<?php 
include 'footer.php';
?>
