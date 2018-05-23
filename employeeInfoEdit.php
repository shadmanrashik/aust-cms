<?php
include 'header.php';
if(!loggedinadmin()) { 
    header("location: index.php");
}
$id = testInput($_GET['id']);

if (isset($_POST['dltBtn'])) {
    $id = testInput($_POST['id']);
    
    $query = "DELETE from employee_info WHERE id = '$id'";
    $runQuery = mysql_query($query);
    if ($runQuery) {
        header("location: employeeInfo.php");
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
        header("location: employeeInfo.php");
    }
}
?>
    <div id="content">
    <!--breadcrumbs-->
        <div id="content-header">
            <div id="breadcrumb">
                <a href="index.php" title="Go to Home" class="tip-bottom"><i class="icon-home"></i> Home</a> <a href="#" title="Admin Panel" class="tip-bottom"><i class="icon-user"></i> Admin</a> <a href="employeeInfo.php" class="current">Employee Info</a></div>
                <h1>Edit Employee Info</h1>
        </div>
    <!--End-breadcrumbs-->
    
        <div class="container-fluid">
            <hr>
            <div class="row-fluid">
                <div class="span8">
                    <div class="widget-box">
                        <div class="widget-title"> <span class="icon"> <i class="icon-edit"></i> </span>
                            <h5>Edit Employee Info</h5>
                            <div class="buttons"> <a href="employeeInfo.php" class="btn btn-inverse btn-mini"><i class="icon-arrow-left icon-white"></i> Go Back</a>
                            </div>
                        </div>
                        <div class="widget-content nopadding">
                            <form class="form-horizontal" method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>" autocomplete="off">
                                <?php
                                $query = "SELECT * from employee_info WHERE id ='$id'";
                                $runQuery = mysql_query($query);
                                $count = 1;
                                $row = mysql_fetch_array($runQuery);
                                ?>
                                <div class="control-group">
                                  <label class="control-label">Employee Name</label>
                                  <div class="controls">
                                      <input type="hidden" name="id" value="<?php echo $row['id']; ?>" />
                                      <input type="text" name="name" value="<?php echo $row['name']; ?>" />
                                  </div>
                                </div>
                                <div class="control-group">
                                    <label class="control-label">Address</label>
                                    <div class="controls">
                                        <input type="text" name="address" value="<?php echo $row['address']; ?>"/>
                                    </div>
                                </div>
                                <div class="control-group">
                                    <label class="control-label">Email</label>
                                    <div class="controls">
                                        <input type="text" name="email" value="<?php echo $row['email']; ?>" />
                                    </div>
                                </div>
                                <div class="control-group">
                                    <label class="control-label">Phone Number</label>
                                    <div class="controls">
                                        <input type="text" name="phoneNo" value="<?php echo $row['phone_no']; ?>"/>
                                    </div>
                                </div>
                                <div class="control-group">
                                    <label class="control-label">Category</label>
                                    <div class="controls">
                                        <select id="position" name="employeeCategory">
                                            <option></option>
                                            <?php
                                            $queryIn = "SELECT * from employee_category ORDER BY name";
                                            $runQueryIn = mysql_query($queryIn);
                                            while($rowIn = mysql_fetch_array($runQueryIn)) {?>
                                                <option value="<?php echo $rowIn['id'];?>" <?php if($row['category'] == $rowIn['id']) echo "selected";?> ><?php echo $rowIn['name']; ?></option>
                                        <?php } ?>
                                        </select>
                                    </div>
                                </div>

                                <div class="form-actions">
                                    <button type="submit" name="updateBtn" class="btn btn-success pull-right"><i class="icon icon-ok"></i> Submit </button>
                                    <button type="submit" name="dltBtn" onclick="return ConfirmDelete()" class="btn btn-danger" ><i class="icon icon-remove"></i> Delete</button>
                                </div>
                            </form>
                        </div>
                    </div>

                </div>
            </div>
    
<?php 
include 'footer.php';
?>
