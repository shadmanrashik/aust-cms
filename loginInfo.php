<?php 
include 'header.php';
if(!loggedinadmin()) { 
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
                            <div class="widget-title"> <span class="icon"> <i class="icon-search"></i> </span>
                                <h5>Login Information</h5>
                            </div>
                        </div>
                        <div class="widget-content">
                            <div class="input-append">
                                <input type="text" id="searchInput" onkeyup="searchFunction()" placeholder="Search for user ID.." title="Type in an id" class="span11">
                                <span class="add-on"><i class="icon icon-search"></i></span>
                            </div>
                            <table class="table table-bordered data-table" id="myTable">
                            <thead>
                                <tr>
                                    <th class="span1">SL</th>
                                    <th class="span1">User ID</th>
                                    <th class="span4">User Name</th>
                                    <th class="span3">Type</th>
                                    <th class="span2">Action</th
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                $query = "SELECT * from login";
                                $runQuery = mysql_query($query);
                                $count = 1;
                                while($row = mysql_fetch_array($runQuery)) {
                                    echo "<tr>"; 
                                    ?>
                                        <input type="hidden" name="id" value="<?php echo $row['id']; ?>" />
                                        <td><?php echo $count; ?></td>
                                        <td><?php echo $row['user_id']; ?></td>
                                        <td><?php echo $row['user_name'];?>
                                        </td>
                                        <td><?php
                                            $queryIn = "SELECT * from user_info WHERE id = '".$row['user_id']."'";
                                            $runQueryIn = mysql_query($queryIn);
                                            $rowIn = mysql_fetch_array($runQueryIn);
                                            if($rowIn['type']=='0') {echo "ADMIN";} 
                                            else if($rowIn['type']=='1') {echo "Student";}
                                            else if($rowIn['type']=='2') {echo "Teacher";}
                                            else {echo "Employee";}?></td>
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
                    <div class="widget-box collapsible">
                        <div class="widget-title"> <a data-toggle="collapse" href="#collapseOne"> <span class="icon"> <i class="icon-plus-sign"></i> </span>
                                <h5>Sign Up Form</h5> </a>
                        </div>
                        <div id="collapseOne" class="collapse">
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
