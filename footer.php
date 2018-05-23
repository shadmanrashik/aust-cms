
        </div>
    </div>
    <div class="modal fade" id="loginModal">
        <form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>" autocomplete="off">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">×</button>
                <h3>Administrator Login</h3>
            </div>
            <div class="modal-body">
                <p>Password:</p>
                <p>
                    <input id="event-name" type="password" name="password" autofocus/>
                </p>
            </div>
            <div class="modal-footer"> 
                <a href="#" class="btn" data-dismiss="modal">Cancel</a> 
                <button type="submit" id="add-event-submit" name="loginBtn" class="btn btn-primary">Login</button> 
            </div>
        </form>
    </div>

    <!--end-main-container-part-->

    <!--Footer-part-->

    <div class="row-fluid">
      <div id="footer" class="span12"> 2017 &copy; Prepared by AUST Canteen Management System </div>
    </div>

    <!--end-Footer-part-->
    
    <script src="select2.js"></script>
    <script src="js/excanvas.min.js"></script> 
    <script src="js/jquery.min.js"></script> 
    <script src="js/jquery.ui.custom.js"></script> 
    <script src="js/bootstrap.min.js"></script> 
    <script src="js/jquery.flot.min.js"></script> 
    <script src="js/jquery.flot.resize.min.js"></script> 
    <script src="js/jquery.peity.min.js"></script> 
    <script src="js/fullcalendar.min.js"></script> 
    <script src="js/matrix.js"></script> 
    <script src="js/matrix.dashboard.js"></script> 
    <script src="js/jquery.gritter.min.js"></script> 
    <script src="js/matrix.interface.js"></script> 
    <script src="js/matrix.chat.js"></script> 
    <script src="js/jquery.validate.js"></script> 
    <script src="js/matrix.form_validation.js"></script> 
    <script src="js/jquery.wizard.js"></script> 
    <script src="js/jquery.uniform.js"></script> 
<!--    <script src="js/select2.min.js"></script> -->
    <script src="js/matrix.popover.js"></script> 
    <script src="js/jquery.dataTables.min.js"></script> 
    <script src="js/matrix.tables.js"></script> 

    <script type="text/javascript">
        // This function is called from the pop-up menus to transfer to
        // a different page. Ignore if the value returned is a null string:
        function goPage (newURL) {

            // if url is empty, skip the menu dividers and reset the menu selection to default
            if (newURL != "") {

                // if url is "-", it is this page -- reset the menu:
                if (newURL == "-" ) {
                    resetMenu();            
                } 
                // else, send page to designated URL            
                else {  
                  document.location.href = newURL;
                }
            }
        }

    // resets the menu selection upon entry to this page:
    function resetMenu() {
        document.gomenu.selector.selectedIndex = 2;
    }
    </script>
    
    <script>
    function ConfirmDelete()
    {
      var x = confirm("Are you sure you want to delete?");
      if (x)
          return true;
      else
        return false;
    }
    </script>
</body>
</html>
