<?php 
include 'header.php';
if(!loggedin()) { 
    header("location: index.php");
}

if (isset($_POST['addBtn'])) {
    $idInc = testInput($_POST['id']);
    $nameInc = testInput($_POST['name']);
    $addressInc = testInput($_POST['address']);
    $phoneNoInc = testInput($_POST['phoneNo']);
    $typeInc = testInput($_POST['type']);
    $usernameInc = testInput($_POST['username']);
    $passwordInc = testInput($_POST['password']);
            
    //header("location: index.php");
            
    if(!empty($idInc) && !empty($nameInc) && !empty($addressInc) && !empty($phoneNoInc) && !empty($typeInc)) {
        $query = "INSERT INTO user_info(id,name,address,phone_no,type) VALUES('$idInc', '$nameInc', '$addressInc', '$phoneNoInc', '$typeInc')";
        $runQuery = mysql_query($query);
        if ($runQuery) {
            
        //header("location: index.php");
            $query1 = "INSERT INTO login(user_id,user_name,user_password) VALUES('$idInc', '$usernameInc', '$passwordInc')";
            $runQuery1 = mysql_query($query1);                    
        }
    }
}
?>
    <div id="content">
    <!--breadcrumbs-->
        <div id="content-header">
            <div id="breadcrumb">
                <a href="index.php" title="Go to Home" class="tip-bottom"><i class="icon-home"></i> Home</a> <a href="#" title="Admin Panel" class="tip-bottom"><i class="icon-user"></i> Admin</a> <a href="employeeCategory.php" class="current">Login Info</a></div>
                <h1>Login Info</h1>
        </div>
    <!--End-breadcrumbs-->
    
        <div class="container-fluid">
            <hr>
            <div class="row-fluid">
                <div class="span12">
                    <div class="widget-box">
                        <div class="widget-title">
                            <ul class="nav nav-tabs">
                                <li class="active"><a data-toggle="tab" href="#tab1">Login Info</a></li>
                                <li><a data-toggle="tab" href="#tab2">Sign Up</a></li>
                                <li><a data-toggle="tab" href="#tab3">Tab3</a></li>
                            </ul>
                        </div>
                        <div class="widget-content">
                                <form class="form-horizontal" method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>" autocomplete="off">
                                            <div class="control-group">
                                              <label class="control-label">University ID</label>
                                              <div class="controls">
                                                  <input type="text" name="id" />
                                              </div>
                                            </div>
                                            <div class="control-group">
                                              <label class="control-label">Name</label>
                                              <div class="controls">
                                                  <input type="text" name="name" />
                                              </div>
                                            </div>
                                            <div class="control-group">
                                                <label class="control-label">Address</label>
                                                <div class="controls">
                                                    <input type="text" name="address"/>
                                                </div>
                                            </div>
                                            <div class="control-group">
                                                <label class="control-label">Phone Number</label>
                                                <div class="controls">
                                                    <input type="text" name="phoneNo" />
                                                </div>
                                            </div>
                                            <div class="control-group">
                                                <label class="control-label">Type</label>
                                                <div class="controls">
                                                    <select id="position" name="type">
                                                        <option></option>
                                                        <option value="1">Student</option>
                                                        <option value="2">Teacher</option>
                                                        <option value="3">Employee</option>
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="control-group">
                                              <label class="control-label">Username</label>
                                              <div class="controls">
                                                  <input type="text" name="username" />
                                              </div>
                                            </div>
                                            <div class="control-group">
                                                <label class="control-label">Password</label>
                                                <div class="controls">
                                                    <input type="password" name="password"/>
                                                </div>
                                            </div>
                                            <div class="form-actions">
                                                <button type="submit" name="addBtn" class="btn btn-success pull-right"><i class="icon icon-ok"></i> Submit </button>
                                            </div>
                                        </form>
                                    
                        <div id="tab3" class="tab-pane">
                            <p>And is full of waffle to It has multiple paragraphs and is full of waffle to pad out the comment. Usually, you just wish these sorts of comments would come to an end.multiple paragraphs and is full of waffle to pad out the comment. </p>
                            <img src="img/demo/demo-image3.jpg" alt="demo-image"/></div>
                      </div>
                    </div>
                </div>
            </div>

    
<?php 
include 'footer.php';
?>
