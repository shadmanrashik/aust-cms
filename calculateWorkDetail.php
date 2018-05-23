<?php 
include 'header.php';
if(!loggedinadmin()) { 
    header("location: index.php");
}
$id = testInput($_GET['id']);

if (isset($_POST['addBtn'])) {
    //header("location: index.php");
    echo $idInc = testInput($_POST['id']);
    echo $monthInc = testInput($_POST['month']);
    echo $dayInc = testInput($_POST['day']);
    echo $hourInc = testInput($_POST['hour']);
    
    //header("location: incoming.php?$id?$monthInc?$dayInc?$hourInc");
            
    if(!empty($idInc) && !empty($monthInc) && !empty($dayInc) && !empty($hourInc)) {
        
        //$query2 ="SELECT category FROM employee_info WHERE id=''";
        $query1 = "SELECT salary,overtime_salary FROM employee_info,employee_category WHERE category=employee_category.id AND employee_info.id='$idInc'";
        $runQuery1 = mysql_query($query1);
        $row1 = mysql_fetch_array($runQuery1);
        if($runQuery1){
            header("location: index.php");
        }
        echo $totalDue = $dayInc * $row1['salary'] + $hourInc * $row1['overtime_salary'];
        
        $query = "INSERT INTO employee_work_detail(employee_id,month,work_day,over_time_hour,salary_due,paid_status) VALUES('$idInc', '$monthInc', '$dayInc', '$hourInc', '$totalDue','0')";
        $runQuery = mysql_query($query);
        if ($runQuery) {
            header("location: calculateWorkDetail.php?id=$idInc");
        }
    }
}

if (isset($_POST['dltBtn'])) {
    $id = testInput($_POST['id']);
    $idInc = testInput($_POST['employeeId']);
    $query = "DELETE from employee_work_detail WHERE id = '$id'";
    $runQuery = mysql_query($query);
    if ($runQuery) {
        header("location: calculateWorkDetail.php?id=$idInc");
    }
}

if (isset($_POST['statusBtn'])) {
    $slid = testInput($_POST['slid']);
    $idInc = testInput($_POST['employeeId']);
    $paidStatus = testInput($_POST['paidStatus']);
    if($paidStatus == '1') {
        $query = "UPDATE employee_work_detail SET paid_status='0' WHERE id = '$slid'";
    } else {
        $query = "UPDATE employee_work_detail SET paid_status='1' WHERE id = '$slid'";
    }
    $runQuery = mysql_query($query);
    if ($runQuery) {
        header("location: calculateWorkDetail.php?id=$idInc");
    }
}
?>
    <div id="content">
    <!--breadcrumbs-->
        <div id="content-header">
            <div id="breadcrumb">
                <a href="index.php" title="Go to Home" class="tip-bottom"><i class="icon-home"></i> Home</a> <a href="#" title="Admin Panel" class="tip-bottom"><i class="icon-user"></i> Admin</a> <a href="employeeWorkDetail.php" class="current">Employee Work Detail</a></div>
                <h1>Add Work Detail</h1>
        </div>
    <!--End-breadcrumbs-->
    
        <div class="container-fluid">
            <hr>
            <div class="row-fluid">
                <div class="span12">
                    <div class="widget-box">
                        <div class="widget-title"> <span class="icon"> <i class="icon-align-justify"></i> </span>
                          <h5>Edit Work Detail</h5>
                        </div>
                        <div class="widget-content">
                            <div>
                                <h3><u>Work History</u></h3>
                            </div>
                            <hr>
                            <table class="table table-bordered data-table" id="myTable">
                                <thead>
                                    <tr>
                                        <th class="span2">SL No</th>
                                        <th>Working Month</th>
                                        <th class="span3">Day Worked</th>
                                        <th>Overtime Worked</th>
                                        <th>Salary</th>
                                        <th>Paid Status</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    $query = "SELECT * from employee_work_detail WHERE employee_id = '$id'";
                                    $runQuery = mysql_query($query);
                                    $count = 1;
                                    while($row = mysql_fetch_array($runQuery)) {
                                        echo "<tr>"; 
                                        ?>
                                            <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>" method="post">
                                                <input type="hidden" name="employeeId" value="<?php echo $_GET['id']; ?>" />
                                                <td><?php echo $row['id']; ?></td>
                                                <input type="hidden" name="slid" value="<?php echo $row['id']; ?>" />
                                                <td><?php echo $row['month']; ?></td>
                                                <td><?php echo $row['work_day']; ?></td>
                                                <td><?php echo $row['over_time_hour']; ?></td>
                                                <td><?php echo $row['salary_due']; ?></td>
                                                <input type="hidden" name="paidStatus" value="<?php echo $row['paid_status']; ?>" />
                                                <td><button type="submit" name="statusBtn" class="btn btn-small tip-bottom" data-original-title="Click to Change"> <?php if($row['paid_status'] == '0') { echo "NO";} else {echo "YES";} ?> </button></td>
                                                <td>
                                                    <button type="submit" name="dltBtn" onclick="return ConfirmDelete()" class="btn btn-danger btn-mini tip-bottom" data-original-title="Remove"><i class="icon icon-remove"></i> </button>
                                                </td>
                                            </form>
                                        <?php
                                        $count++;
                                        echo "</tr>";
                                        } ?>
                                </tbody>
                                </table>
                            </form>
                        </div>
                    </div>
                    <div class="widget-box collapsible">
                        <div class="widget-title"> <a data-toggle="collapse" href="#collapseOne"> <span class="icon"> <i class="icon-plus-sign"></i> </span>
                            <h5>Add Work Detail</h5> </a>
                        </div>
                        <div id="collapseOne" class="collapse in">
                            <div class="widget-content">
                                <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>" name="addForm" method="POST">
                                <div class="controls controls-row">
                                    <input type="hidden" name="id" value="<?php echo $_GET['id'];?>">
                                    <input type="text" name="month" placeholder="Working Month .." class="span4 m-wrap">
                                    <input type="number" name="day" placeholder="Day Worked" class="span4 m-wrap">
                                    <input type="number" name="hour" placeholder="Overtime Worked" class="span3 m-wrap">
                                    <button type="submit" name="addBtn" class="btn btn-success btn-small span1" > <i class="icon icon-plus-sign"> </i> Add</button>
                                </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

    
<?php 
include 'footer.php';
?>
