<!DOCTYPE html>
<html lang="en">
<?php
    include '../../php/controller.php';
    Login();
    if(!isset($_SESSION["user"])) {
        header("Location: ../../index.php");
    }
    Logout();
?>
<head>
	<meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- <meta http-equiv="refresh" content="300"> -->
    <meta http-equiv="Cache-Control" content="no-cache, no-store, must-revalidate" />
    <meta http-equiv="Pragma" content="no-cache" />
    <meta http-equiv="Expires" content="0" />
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
    
    <link rel="stylesheet" href="../../public/css/style.css">
    <!-- <link rel="stylesheet" href="reports.css"> -->

</head>
<body>
    <nav class="navbar navbar-default navbar-fixed-top" class="col-lg-12 col-md-12 col-sm-12" style="background-color: #fffafa;">
        <div class="navbar-header">
            <img class="nav-logo" src="../../public/images/icons/sky_luster.png">
            <label class="nav-label">iMonitoring</label>
            <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#sidenav" aria-expanded="false">
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </button>
        </div>

        <div class="collapse bs-example-navbar-collapse" id="bs-example-navbar-collapse-1"></div>
            <ul class="nav navbar-nav navbar-right" style="padding-left:-50px; padding-right:25px; padding-top:7px; margin-top: -5px;">
                <li>
                    <p id="demo" hidden>
                        
                    </p>
                </li>

				<!-- <li class="dropdown">
                    <a href="#" style="padding-right: 30px; margin-top: 5px;">
                        <span class="glyphicon glyphicon-envelope"></span>
                    </a>
                </li>  -->

                <!-- Notification Dropdwon -->
				<li class="dropdown">
                    <a class="dropdown-toggle" data-toggle="dropdown" href="#" style="padding-right: 28px;">
                        <span class="glyphicon glyphicon-bell"></span>
                        <span class="label label-pill label-warning count" style="border-radius: 10px;">
                        <?php notifCount(); ?>
                        </span>
                    </a>
                    <ul class="dropdown-menu">
                        <?php notifDisplay(); ?>
                        <li>
                            <a href="admin_notification.php"><small>Show all notifications</small></a>
                        </li>
                    </ul>
                </li>
                <!-- End of Notification Dropdown -->

                <!-- User Dropdown -->
	            <li class="dropdown" style="padding-left: 5px;">
	            	<a class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false" style="padding-right: 30px;"><i class="glyphicon glyphicon-user"></i>
                    
                    <?php displayName();  ?>
	                </a>
	            	<ul class="dropdown-menu" role="menu">
	            		<li class="dropdown-header"><i class="glyphicon glyphicon-cog"></i><b> Settings</b></li>
	            		<li class="sub-header"><a href="#">Account Settings</a></li>
	            		<li class="divider"></li>
	            		<li style="font-size:18px; font-weight:200px;"><a href="#logout" data-toggle="modal"><i class="glyphicon glyphicon-off"></i> Sign out</a></li>
	            	</ul>
                </li>
                <!-- End of User Dropdown -->
            </ul>
	</nav>
	<!-- End of Top Navigation-->

 	<!-- Logout Modal -->
	<div class="modal fade" id="logout" tabindex="-1" role="dialog" aria-labelledby="myModallabel" arial-hidden="true" style="margin-top:150px;">
		<div class="modal-dialog modal-md" role="document">
			<div class="modal-content">
				<div class="modal-header" style="background-color: #ffffff7a;">
					<button type="button" class="close" class="btn btn-default" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
				</div>
				<div class="modal-body">
					<form>
						<p class="logout-modal">Are you sure you want to logout?</p>
					</form>
				</div>
				<div class="modal-footer">
					<button type="button" class="btn btn-default" data-dismiss="modal" style="font-size:12px;">Cancel</button>
					<a class="btn btn-warning" href="../php/connection/logout.php" style="font-size:12px;">Logout</i></a>
				</div>
			</div>
		</div>
	</div>
	<!-- End of Logout Modal -->
    
    <!-- Sidebar -->
	<div class="wrapper">
		<nav id="sidebar">
			<ul class="list-unstyled components">
		        <p></p>
		        <li>
		            <a href="admin_dashboard.php"><i class="glyphicon glyphicon-th-large" ></i> Dashboard</a>
		        </li>
		        <li>
		            <a href="admin_branch.php"><i class="glyphicon glyphicon-home"></i>Branch Settings</a>
		        </li>
		        <li>
		            <a href="admin_viewing.php"><i class="glyphicon glyphicon-list-alt"></i>Computer List</a>
		        </li>
		        <li>
		            <a href="admin_users.php"><i class="glyphicon glyphicon-edit"></i>User Accounts</a>
		        </li>
		        <li class="active">
		            <a href="admin_reports.php"><i class="glyphicon glyphicon-duplicate"></i>Reports</a>
		        </li>	  
	   		</ul>
        </nav>
        <div class="container" style="width:100%;">
            <div class="well" style="padding: 10px;">Reports</div>
            <div class="container-fluid">
                <div class="panel with-nav-tabs panel-default">
                    <div class="panel-heading">
                        <ul class="nav nav-tabs">
                            <li class="active"><a href="#tab0default" data-toggle="tab" style="padding-right:35px;">Computer Logs</a></li>
                            <li><a href="#tab2default" data-toggle="tab" style="padding-right:35px;">History</a></li>
                        </ul>
                    </div>
                    <div class="panel-body">
                        <div class="tab-content">
                            <div class="tab-pane fade in active" id="tab0default">
                                <div class="row">
                                    <div class="col-md-6" style="padding-top:15px;">
                                        <select name="department" id="department" class="form-control">
                                            <option value="All" selected>--All department--</option>
                                                <?php listDepartment(); ?>
                                        </select> 
                                    </div>
                                    <div class="col-md-6" style="padding-top:15px;">
                                        <input type="hidden" class="form-control">
                                    </div>
                                </div>
                                <?php //pdfs(); ?>
                                <form method="POST">
                                <div class="row">
                                    <div class="col-md-6"><br>
                                        <input type="text" id="user" name="user" class="form-control" placeholder="Search for user... ">
                                    </div>
                                    <div class="col-md-6"><br>
                                        <input type="submit" id="search" name="btnSearch" value="Search" class="btn btn-primary">
                                        <input type="button" id="reset" name="clear" value="Clear" class="btn btn-default">
                                        <input type="button" id="btnExport" name="btnExport" value="Export to Excel" class="btn btn-success" onclick="fnExcelReport();">
                                            <!--<input type="button" name="btnExport_PDF" id="btnExport_PDF" value="PDF" class="btn btn-danger" onclick="">-->
                                       <input type="submit" id="print" name="btnPrint" value="Print" class="btn btn-danger" onclick="javascript:printDiv('printablediv')" />
                                    </div>
                                </div>
                                </form>
                                <iframe id="txtArea1" style="display:none"></iframe>
                                <div style="clear:both; padding:15px;"></div>
                                <div class="table-responsive"  style="overflow-x:auto;" id="tb_div">
                                    <table class="table table-bordered" style="background: #ffffff;" id="comp_logs">
                                        <thead>
                                            <tr>
                                                <th>No.</th>
                                                <th>User</th>
                                                <th>Computer Name</th>
                                                <th>Domain</th>
                                                <th>IP Address</th>
                                                <th>Date Modified</th>
                                                <th>iMonitor Status</th>
                                                <th>Services Not Found</th>
                                                <th>SysSetting File</th>
                                                <th>Server IP</th>
                                                <th>Connection Status</th>
                                                <th>Branch</th>
                                                <th>Scan Time</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php displayLogReport(); ?>
                                        </tbody>
                                        <tfoot>
                                            <tr>
                                                    <th>No.</th>
                                                    <th>User</th>
                                                    <th>Computer Name</th>
                                                    <th>Domain</th>
                                                    <th>IP Address</th>
                                                    <th>Date Modified</th>
                                                    <th>iMonitor Status</th>
                                                    <th>Services Not Found</th>
                                                    <th>SysSetting File</th>
                                                    <th>Server IP</th>
                                                    <th>Connection Status</th>
                                                    <th>Branch</th>
                                                    <th>Scan Time</th>
                                            </tr>
                                        </tfoot>
                                    </table>
                                </div>
                            </div>

                        </div>
                    </div>
                    <div class="panel-footer">
                        
                    </div>
            <!-- <div class="col-lg-12">
                <div class="panel with-nav-tabs panel-default" style="width: 103.5%; position: relative;  margin-left: -30px;">
                    <div class="panel-heading">
                        <ul class="nav nav-tabs">
                            <li class="active"><a href="#tab0default" data-toggle="tab" style="padding-right:35px;">Computer Logs</a></li>
                            <li><a href="#tab2default" data-toggle="tab" style="padding-right:35px;">Computer List</a></li>
                        </ul>
                    </div>
                    <div class="panel-body">
                        <div class="tab-content">
                            <div class="tab-pane fade in active" id="tab0default">
                                
                                <div class="table-responsive">
                                    <table class="table table-bordered" style="background: #ffffff;" id="comp_logs">
                                        <thead>
                                            <tr>
                                                <th>No.</th>
                                                <th>User</th>
                                                <th>Computer Name</th>
                                                <th>Domain</th>
                                                <th>IP Address</th>
                                                <th>Date Modified</th>
                                                <th>iMonitor Status</th>
                                                <th>Services Not Found</th>
                                                <th>SysSetting File</th>
                                                <th>Server IP</th>
                                                <th>Connection Status</th>
                                                <th>Branch</th>
                                                <th>Scan Time</th>
                                            </tr>
                                        </thead>
                                        <tbody id = "load_data">
                                            <?php displayLogReport(); ?>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                            <div class="tab-pane fade" id="tab2default">
                                <div class="col-md-6" style="padding-top:15px;">
                                    <select name="department" id="department" class="form-control">
                                        <option value="All" selected>--All department--</option>
                                        ?php     
              								    $sql = "select DISTINCT branch_name from tbl_department ORDER BY branch_name ASC";
              								    $stmt = $db->prepare($sql);
              								    $stmt->execute();

											        while($row=$stmt->fetch(PDO::FETCH_ASSOC))
											        {
                								        echo '<option>'.$row['branch_name'].'</option>'; 
              								        }
            							?>
                                    </select> 
                                </div>
                                <div class="col-md-6" style="padding-top:15px;">
                                    <select name="dub_dept" id="sub_dept" class="form-control">
                                        <option value="" selected>--All sub department</option>
                                        <option value="OM">IT-OM</option>
                                        <option value="AUD">IT-AUD</option>
                                        <option value="WEB">IT-WEB</option>
                                    </select>
                                </div>
                                <div class="col-md-4"><br>
                                    <input type="text" id="userl" name="userl" class="form-control" placeholder="Search for user... ">
                                </div>
                                <div class="col-md-4"><br>
                                    <select name="sub_status" id="sub_status" class="form-control">
                                        <option value="" selected>--Status--</option>
                                        <option value="OM">Active</option>
                                        <option value="AUD">Inactive</option>
                                    </select>
                                </div>
                                <div class="col-md-4">
                                <br>
                                    <input type="button" id="resetl" name="clear" value="Clear" class="btn btn-default">
                                    <input type="button" id="btnExport2" name="btnExport2" value="Export to Exel" class="btn btn-success" onclick="fnExcelReport2();">
                                        <input type="button" name="btn_search" id=btn_search value="PDF" class="btn btn-danger" onclick="">-->
                                    <!-- <input type="button" id="print2" name="print2" value="Print" class="btn btn-danger" onclick="javascript:printDiv2('printable')" />
                                </div>
                                <iframe id="txtArea1" style="display:none"></iframe>
                                <div style="clear:both; padding:15px;"></div>
                                <div class="table-responsive" style="overflow-x:auto; margin-left:15px;" id="tb_div2">
                                    <table class="table table-bordered" style="background: #ffffff;" id="comp_logs2">
                                        <thead>
                                            <tr>
                                                <th>No.</th>
                                                <th>Computer Name</th>
                                                <th>IP Address</th>
                                                <th>Status</th>
                                                <th>Port Connection</th>
                                                <th>Remarks</th>
                                            </tr>
                                        <thead>
                                        <tbody id = "load_datal">
                                            ?php
                                                $sql = "select user,hostname, ip_address,iMonitor_Status,connection_status from tbl_log WHERE user != 'Administrator' ";
                                                $stmt = $db->prepare($sql);
                                                $stmt->execute();
                                                $count = 1;
                                                foreach($stmt as $row) {
                                                //while($row=$stmt->fetch(PDO::FETCH_ASSOC)) {
                                            ?>
                                            <tr>
                                                <td>?php echo $count++ ?></td>
                                                <td>?php echo $row['hostname']; ?></td>
                                                <td>?php echo $row['ip_address']; ?></td>
                                                <td>?php echo $row['iMonitor_Status']; ?></td>
                                                <td>?php echo $row['connection_status']; ?></td>
                                                <td>?php
                                                    if($row['iMonitor_Status'] == 'Running' AND $row['connection_status'] == 'ESTABLISHED')
                                                        echo 'Active';
                                                    else
                                                        echo "Inactive";
                                                ?></td>
                                            </tr>
                                            ?php } ?>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                                                </div> -->
        <!-- </div>
    </div> -->

   <script>

$(document).ready(function(){
    $(".dropdown").hover(            
        function() {
            $('.dropdown-menu', this).not('.in .dropdown-menu').stop(true,true).slideDown("400");
            $(this).toggleClass('open');        
        },
        function() {
            $('.dropdown-menu', this).not('.in .dropdown-menu').stop(true,true).slideUp("400");
            $(this).toggleClass('open');       
        }
    );
});

        $(document).ready(function () {
                $('#sidebarCollapse').on('click', function () {
                    $('#sidebar').toggleClass('active');
                });
            });



    function isNumber(input) {
    var regex =/[^0-9]/gi;
    input.value = input.value.replace(regex,"");
        
    }


    function lettersOnly(input) {
    var regex = /[^a-z]/gi;
    input.value = input.value.replace(regex,"");   
}  

}

</script>   

    <script src = "../js/controller/ajax_bydate.js"></script>
    <script src = "../js/controller/ajax_byname.js"></script>
    <script src = "../js/controller/ajax_bydatel.js"></script>
    <script src = "../js/controller/ajax_bynamel.js"></script>


    <!-- For Printing List-->

    <script type="text/javascript">
    	function printDiv() {
        var divElements = document.getElementById("tb_div").innerHTML;
        var oldPage = document.body.innerHTML;
        document.body.innerHTML = 
          "<html><head><title></title></head><body>" + 
          divElements + "</body>";
        window.print();
        document.body.innerHTML = oldPage;
        }
	</script>

    <!-- For Printing Logs-->

    <script type="text/javascript">
      function printDiv2() {
        var divElements = document.getElementById("tb_div2").innerHTML;
        var oldPage = document.body.innerHTML;
        document.body.innerHTML = 
          "<html><head><title></title></head><body>" + 
          divElements + "</body>";
        window.print();
        document.body.innerHTML = oldPage;
    }
	</script>

    <!-- For Exporting to Exel List-->

    <script type="text/javascript">
     function fnExcelReport()
        {
             var tab_text="<table border='2px'><tr bgcolor='#87AFC6'>";
             var textRange; var j=0;
          tab = document.getElementById('comp_logs'); // id of table


          for(j = 0 ; j < tab.rows.length ; j++) 
          {     
                tab_text=tab_text+tab.rows[j].innerHTML+"</tr>";
                //tab_text=tab_text+"</tr>";
          }

          tab_text=tab_text+"</table>";
          tab_text= tab_text.replace(/<A[^>]*>|<\/A>/g, "");//remove if u want links in your table
          tab_text= tab_text.replace(/<img[^>]*>/gi,""); // remove if u want images in your table
                      tab_text= tab_text.replace(/<input[^>]*>|<\/input>/gi, ""); // reomves input params

               var ua = window.navigator.userAgent;
              var msie = ua.indexOf("MSIE "); 

                 if (msie > 0 || !!navigator.userAgent.match(/Trident.*rv\:11\./))      // If Internet Explorer
                    {
                           txtArea1.document.open("txt/html","replace");
                           txtArea1.document.write(tab_text);
                           txtArea1.document.close();
                           txtArea1.focus(); 
                            sa=txtArea1.document.execCommand("SaveAs",true,"Computer List.xls");
                          }  
                  else                 //other browser not tested on IE 11
                      sa = window.open('data:application/vnd.ms-excel,' + encodeURIComponent(tab_text));  


                      return (sa);
                            }
	</script>

    <!-- For Exporting to Exel Logs-->

    <script type="text/javascript">
     function fnExcelReport2()
        {
             var tab_text="<table border='2px'><tr bgcolor='#87AFC6'>";
             var textRange; var j=0;
          tab = document.getElementById('comp_logs2'); // id of table


          for(j = 0 ; j < tab.rows.length ; j++) 
          {     
                tab_text=tab_text+tab.rows[j].innerHTML+"</tr>";
                //tab_text=tab_text+"</tr>";
          }

          tab_text=tab_text+"</table>";
          tab_text= tab_text.replace(/<A[^>]*>|<\/A>/g, "");//remove if u want links in your table
          tab_text= tab_text.replace(/<img[^>]*>/gi,""); // remove if u want images in your table
                      tab_text= tab_text.replace(/<input[^>]*>|<\/input>/gi, ""); // reomves input params

               var ua = window.navigator.userAgent;
              var msie = ua.indexOf("MSIE "); 

                 if (msie > 0 || !!navigator.userAgent.match(/Trident.*rv\:11\./))      // If Internet Explorer
                    {
                           txtArea1.document.open("txt/html","replace");
                           txtArea1.document.write(tab_text);
                           txtArea1.document.close();
                           txtArea1.focus(); 
                            sa=txtArea1.document.execCommand("SaveAs",true,"Computer Logs.xls");
                          }  
                  else                 //other browser not tested on IE 11
                      sa = window.open('data:application/vnd.ms-excel,' + encodeURIComponent(tab_text));  


                      return (sa);
                            }
	</script>

</body>
</html>
    


