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
    <meta http-equiv="Cache-Control" content="no-cache, no-store, must-revalidate" />
    <meta http-equiv="Pragma" content="no-cache" />
    <meta http-equiv="Expires" content="0" />
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
    
    <link rel="stylesheet" href="../../public/css/style.css">
    <!-- <link rel="stylesheet" href="../../public/css/viewing.css"> -->

</head>
<body onchange="handleSelect2()">
    <nav class="navbar navbar-default navbar-fixed-top" class="col-lg-12 col-md-12 col-sm-12" style="background-color: #fffafa;">
		<div class="navbar-header">
            <img class="nav-logo" src="../../public/images/icons/sky_luster.png">
            <label class="nav-label">iMonitoring</label>
            <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1" aria-expanded="false">
                <span class="sr-only">Toggle navigation</span>
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
                    <?php displayName(); ?>
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
        </div>
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
		        <li class="active">
		            <a href="#" ><i class="glyphicon glyphicon-list-alt"></i>Computer List</a>
		            <!-- <ul class="collapse list-unstyled" id="homeSubmenu"> data-toggle="collapse" aria-expanded="false"
		                <li>
                           
                       </li> 
		            </ul> -->
		        </li>
		        <li>
		            <a href="admin_users.php"><i class="glyphicon glyphicon-edit"></i>User Accounts</a>
		        </li>
		        <li>
		            <a href="admin_reports.php"><i class="glyphicon glyphicon-duplicate"></i>Reports</a>
                </li>	
                <li class="nav-item">
		            <a class="text-center" href="#"><i class="glyphicon glyphicon-info-sign"></i>About</a>
		        </li>	  
	   		</ul>
        </nav>
        <div class="container" style="width:100%;">
            <div class="well">Computer List</div>
            <div class="container-fluid">
                <div class="card">
                    <div class="card-header"></div>
                    <div class="card-body"> 
                        <div class="row">
                            <div class="col-md-6" style="padding-top:0px; margin-right: -260px;">                                  
                                <form method="POST">
                                    <select name="dept_viewing" id="dept_viewing" class="form-control" style ="width:50%;">
                                        <option value="All" selected>--All Department--</option>
                                            <?php listDepartment(); ?>
                                    </select> 
                                </form>
                            </div>
                            <div class="col-md-6" style="padding-top:0px; margin-right: -260px;"></div>
                        </div>
                        <div class="row">
                            <div class="col-md-6" style="padding-bottom: 10px;">
                                <input type="text" class="form-control" name="search" placeholder="Search ...">
                            </div>
                            <div class="col-md-6">
                                <input type="submit" id="search" name="bntSearch" value="Search" class="btn btn-primary">
                                <input type="button" id="reset" name="clear" value="Clear" class="btn btn-default">
                                     <!-- <input type="button" name="btnExport" id="btnExport" value="Export as Excel" class="btn btn-success" onclick="fnExcelReport();">
                                    <input type="button" name="btn_print" id="btn_print" value="Print" class="btn btn-danger" onclick="javascript:printDiv('printablediv')" /> -->
                            </div>
                        </div>
                        <div style="clear:both"></div> 
                        <br>
                        <div class="table-responsive" style="overflow-x:auto; padding-right:5px;" id="tb_div">
                            <table class="table table-bordered" style="background: #ffffff;" id="comp_logs">
                                <thead>
                                    <tr id="comp_list">
                                        <th>No</th>
                                        <th>Computer Name</th>
                                        <th>IP Address</th>
                                        <th>Status</th>
                                        <th>Remark</th>
                                        <th>Agent Version</th>
                                        <th>Options</th>
                                    </tr>
                                </thead>
                                <tbody id = "load_data">
                                    <?php displayDept(); ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                            <!-- <div class="col-md-6" style="padding-top:15px;">
                                <input type="submit" id="search" name="bntSearch" value="Search" class="btn btn-primary">
                                <input type="button" id="reset" name="clear" value="Clear" class="btn btn-default">
                                         <input type="button" name="btnExport" id="btnExport" value="Export as Excel" class="btn btn-success" onclick="fnExcelReport();">
                                        <input type="button" name="btn_print" id="btn_print" value="Print" class="btn btn-danger" onclick="javascript:printDiv('printablediv')" /> --> 
                            <!-- </div>
                        </div>
                        <div style="clear:both"></div>
                        <br>
                        <div class="table-responsive" style="overflow-x:auto; padding-right:5px;" id="tb_div">
                            <table class="table table-bordered" style="background: #ffffff;" id="comp_logs">
                                <thead>
                                    <tr>
                                        <th>No</th>
                                        <th>Computer Name</th>
                                        <th>IP Address</th>
                                        <th>Status</th>
                                        <th>Remarks</th>
                                        <th>Agent Version</th>
                                        <th>Options</th>
                                    </tr>
                                </thead>
                                <tbody id = "load_data">
                                     displayDept(); ?>
                                </tbody>
                            </table>
                        </div> -->
                    <div class="card-footer"></div>
                </div>
            </div>
        </div>
        <div class="footer">
            <i class="glyphicon glyphicon-copyright-mark"><p style="padding:5px;">Copyrights 2018</p></i>
        </div>
    </div>
                                      
	<!-- End of Sidebar -->

    <!-- Edit Modal -->
    <div id="myModalEdit" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel"aria-hidden="true" style="width:100%; margin-left:0px; margin-top:50px; position:absolute; overflow:hidden;">
        <div class="modal-dialog modal-md" style="position:fixed; width:100%; height:100%;">
            <div class="modal-content" style="border:2px solid #3c7dcf; box-shadow:none;">
            <form method="POST">
                <div class="modal-header" style="background-color:#f5f5f5;">
                    <button type ="button" class="close" data-dismiss="modal">&times;</button>
                    <h4 style="font-size:2em; color:black;">Computer Details | ITOMAU033022</h4>
                </div>
                <div class="modal-body" style="margin-left:-180px; width:97%; ">
                    <div class="panel panel-default" style="margin-left:200px; padding-right:-30px; width:100%">
                        <div class="panel-heading" style="padding:20px; font-size:18px;">
                            <h4><strong>Remarks</strong></h4>
                            <select name="remarks" id="">
                                <option value="leave">Active</option>
                                <option value="leave">On leave</option>
                                <option value="resigned">Resigned</option>
                                <option value="transferred">Transferred</option>
                                <option value="renamed">Old PC name</option>
                            </select>
                            <h4><strong>Agent Version</strong></h4>
                            <input type="text" class="form-control" style="width: 10%; height: 30px;">
                        </div>
                        <div class="panel-body" style="padding:10px; margin-left:-200px; width:100%">
                            <div class="modal-container" style="margin: 10px; padding-left: 120px; margin-right: -80px;">
                                <table class="table table-bordered" style="margin-left:90px;">
                                    <thead>
                                        <tr style="padding:50px;">
                                        <th style="padding-bottom:15px;">Processor</th>
                                        <th style="padding-bottom:15px;">HDD Serial</th>
                                        <th style="padding-bottom:15px;">MAC Address</th>
                                        <th style="padding-bottom:15px;">Motherboard Manufacturer</th>
                                        <th style="padding-bottom:15px;">Motherboard Product</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr>
                                            <?php displayComp(); ?>
                                            <!-- <td style="padding-top:15px;">
                                                <input type="text" class="form-control" style="display: -webkit-inline-box;"> 
                                            </td>
                                            <td class="input-Remarks "style="padding-top:15px;">
                                                <select name="remarks" id="">
                                                    <option value="leave">Active</option>
                                                    <option value="leave">On leave</option>
                                                    <option value="resigned">Resigned</option>
                                                    <option value="transferred">Transferred</option>
                                                    <option value="renamed">Old PC name</option>
                                                </select>
                                            </td> -->
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                        <div class="panel-footer">
                            <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                            <input type="submit" name="btnUpdate" class="btn btn-success" data-dismiss="modal" value="Update">
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                </div>
            </form>
            </div>   
        </div>
    </div>
    <!-- End of Edit Modal -->

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

</body>
</html>

