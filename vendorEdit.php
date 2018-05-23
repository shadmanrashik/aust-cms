<?php
include 'header.php';

$id = testInput($_GET['id']);

if (isset($_POST['dltBtn'])) {
    $id = testInput($_POST['id']);
    
    $query = "DELETE from vendor WHERE id = '$id'";
    $runQuery = mysql_query($query);
    if ($runQuery) {
       //header("location: vendor.php");
       //echo $id;
    }
}

if (isset($_POST['updateBtn'])) {
    $id = testInput($_POST['id']);
    $nameInc = testInput($_POST['name']);
    $addressInc = testInput($_POST['address']);
    $emailInc = testInput($_POST['email']);
    $phnNoInc = testInput($_POST['phnNo']);
    
    if(!empty($nameInc) && !empty($addressInc) && !empty($emailInc) && !empty($phnNoInc)) {
        $query = "UPDATE vendor SET name = '$nameInc', address = '$addressInc', email = '$emailInc', phone_no = '$phnNoInc' WHERE id = '$id'";
        $runQuery = mysql_query($query);
        if ($runQuery) {
            header("location: vendor.php");
        }
    }
}

?>

    <div id="content">
    <!--breadcrumbs-->
        <div id="content-header">
            <div id="breadcrumb">
                <a href="#" title="Go to Home" class="tip-bottom"><i class="icon-home"></i> Home</a> <a href="vendor.php" class="current">Vendor</a></div>
                <h1>Vendor Edit</h1>
        </div>
    <!--End-breadcrumbs-->
    
        <div class="container-fluid">
            <hr>
            <?php
            $query = "SELECT * from vendor where id='$id'";
            $runQuery = mysql_query($query);
            $row = mysql_fetch_array($runQuery);
                ?>
            <div class="row-fluid">
                <div class="span8">
                    <div class="widget-box">
                        <div class="widget-title"> <span class="icon"> <i class="icon-edit"></i> </span>
                            <h5>Edit Vendor Information</h5>
                        </div>
                        <div class="widget-content nopadding">
                            <form class="form-horizontal" method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>" autocomplete="off">
                                <div class="control-group">
                                  <label class="control-label">Vendor Id</label>
                                  <div class="controls">
                                      <input type="text" name="id" value="<?php echo $row['id']; ?>" >
                                  </div>
                                </div>
                                <div class="control-group">
                                  <label class="control-label">Vendor Name</label>
                                  <div class="controls">
                                        <input type="text" name="name" value="<?php echo $row['name']; ?>" >
                                  </div>
                                </div>
                                <div class="control-group">
                                    <label class="control-label">Address</label>
                                    <div class="controls">
                                        <input type="text" name="address" value="<?php echo $row['address'];?>" >
                                    </div>
                                </div>
                                <div class="control-group">
                                    <label class="control-label">Email</label>
                                    <div class="controls">
                                        <input type="email" name="email" value="<?php echo $row['email'];?>" >
                                    </div>
                                </div>
                                <div class="control-group">
                                    <label class="control-label">Phone Number</label>
                                    <div class="controls">
                                        <input type="text" name="phnNo" value="<?php echo $row['phone_no']; ?>" >
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