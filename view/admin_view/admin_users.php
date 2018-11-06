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
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
    <!-- Our Custom CSS -->
	<link rel="stylesheet" href="../../public/css/style.css">
</head>
<body>
    <!-- Top Navigation -->
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

                <!-- Message Dropdown -->
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
                    <form method="POST">
					<button type="button" class="btn btn-default" data-dismiss="modal" style="font-size: 12px;;">Cancel</button>
                    <input type="submit" class="btn btn-warning" name="btnLogout" style="font-size: 12px;" value="Logout">
					<!-- <a class="btn btn-warning" href="../php/connection/logout.php" style="font-size:12px;"> Logout</i></a> -->
                    </form>
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
		        <li >
		            <a href="admin_viewing.php"><i class="glyphicon glyphicon-list-alt"></i>Computer List</a>
		            <!-- <ul class="collapse list-unstyled" id="homeSubmenu">  data-toggle="collapse" aria-expanded="false"
		                <li id="branch">
                            
                        </li>
		            </ul> -->
		        </li>
		        <li class="active">
		            <a href="admin_users.php"><i class="glyphicon glyphicon-edit"></i>User Accounts</a>
		        </li>
		        <li>
		            <a href="admin_reports.php"><i class="glyphicon glyphicon-duplicate"></i>Reports</a>
		        </li>	  
	   		</ul>
		</nav>
		<div class="container" style="width:100%;">
			<div class="well">User Accounts</div>
				<div class="container-fluid">
						<div class="card">
							<div class="card-header">
								<a href="#addUser" data-toggle="modal"><i class="glyphicon glyphicon-plus"></i><u>Add User</u></a>
							</div>
							<div class="card-body">
								<div class="table-responsive">
									<table class="table table-bordered">
										<thead>
											<tr>
												<th style="padding-bottom:15px;">ID Number</th>
												<th style="padding-bottom:15px;">Name</th>
												<th style="padding-bottom:15px;">Department</th>
												<th style="padding-bottom:15px;">Position</th>
												<th style="padding-bottom:15px;">Role</th>
												<th style="padding-bottom:15px;">Status</th>
												<th style="padding-bottom:15px;">Option</th>
											</tr>
										</thead>
									</table>
									<tbody>

									</tbody>
							</div>

						</div>
				</div>
			</div>
		</div>
		<div class="footer">
            <p style="padding:5px;">Copyrights 2018</p>
        </div>
    </div>              

	<!-- End of Sidebar -->

<!-- Add User Modal -->
<form action="../php/connection/user_account_submit.php" method="POST">
    <div class="modal fade" id="addUser" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" arial-hidden="true" style="margin-top:50px;">
		<div class="modal-dialog modal-md" role="document">
			<div class="modal-content" style="height: -webkit-fill-available;">
				<div class="modal-header">
					<button type="button" class="close" class="btn btn-default" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
					<h4 class="modal-title" id="myModalLabel">User Registration</h4>
				</div>

				<div class="modal-body">
					<?php  addUser(); ?>
					<form class="form-horizontal" role="form" method="POST">
						<div class="form-group">
							<label class="col-sm-12 control-label" for="userID">ID Number</label>
							<div class="col-sm-12">
								<input type="text" class="form-control" id="userid" name="userid" pattern="[0-9]{7}" required placeholder="ID Number" onkeypress="return isNumberKey(event)"/>
							</div>
								<script type="text/javascript">
									function isNumberKey(evt)
									{
										var charCode = (evt.which) ? evt.which : evt.keyCode;
										if (charCode > 31 && (charCode < 48 || charCode > 57))
											return false;
											return true;
									}
								</script>
						</div>
						<br>
						<div class="form-group">
							<label class="col-sm-12 control-label" for="department">Department</label>
							<div class="col-sm-12">
								<select class="form-control" id="department" name="department" required>
									<option value=" ">--Select Department--</option>
									<?php
										listDepartment();
									?>
								</select>
							</div>
						</div>
						<br>
						<div class="form-group">
							<label class="col-sm-12 control-label" for="role">Role</label>
							<div class="col-sm-12">
								<select class="form-control" id="role" name="role" required>
									<option value=" ">--Select Role--</option>
									<option value="Administrator">ADMINISTRATOR</option>
									<option value="STAFF">STAFF</option>
								</select>
							</div>
						</div>
						<br>
						<div class="form-group">
							<label class="col-sm-12 control-label" for="status">Status</label>
							<div class="col-sm-12">
								<select class="form-control" id="status" name="status" required>
										<option value="">--Select Status--</option>
										<option value="Active">Active</option>
										<option value="Inactive">Inactive</option>
								</select>
							</div>
						</div>
						<br>
						<div class="form-group">
							<label class="col-sm-12 control-label" for="password">Password</label>
							<div class="col-sm-12">
								<input class="form-control" type="text" id="password" name="password" value="Aa123456" disabled>
							</div>
						</div>
						<br>
						<div class="form-group">
							<div class="col-sm-12">
								<input type="submit" class="btn btn-success" value="Register" name="btnRegister" style="margin: auto; margin-top: 15;">
							</div>
						</div>
					</form>
				</div>
				<!-- <div class="modal-footer">
					<button type="button" class="btn btn-default" data-dismiss="modal" onclick="ClearFields();">Close</button>	

					<script type="text/javascript">
						function mirrorFunction()
							{
								document.getElementById('password2').value = document.getElementById('password').value;
							}
					</script>

					<script type="text/javascript">
					function ClearFields() 
						{
        					document.getElementById("userid").value = "";
							document.getElementById("name").value = "";
							document.getElementById("department").selectedIndex = "0";
							document.getElementById("position").selectedIndex = "0";
							document.getElementById("status").selectedIndex = "0";
							document.getElementById("role").selectedIndex = "0";
							document.getElementById("password2").value = "";
    					}
					</script>
				</div> -->
			</div>
		</div>
	</div>
</form>
<!-- End of Add User Modal  -->


<!-- Edit User Modal -->
<!--<form action="../php/connection/user_account_submit.php" method="POST">
    <div class="modal fade" id="editUser" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" arial-hidden="true" style="margin-top:50px;">
		<div class="modal-dialog modal-md" role="document">
			<div class="modal-content">
				<div class="modal-header">
					<button type="button" class="close" class="btn btn-default" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
					<h4 class="modal-title" id="myModalLabel">Edit User Information</h4>
				</div>

				<div class="modal-body1" style="height: 570px;">
					<form class="form-horizontal" role="form">
						<div class="form-group">
							<label class="col-sm-12 control-label" for="userID">ID Number</label>
							<div class="col-sm-12">
								<input type="text" class="form-control" id="userid" name="userid" value="" pattern="[0-9]{7}" placeholder="ID Number" required onkeypress="return isNumberKey(event)"/>

								<script type="text/javascript">
									function isNumberKey(evt)
									{
										var charCode = (evt.which) ? evt.which : evt.keyCode;
										if (charCode > 31 && (charCode < 48 || charCode > 57))
											return false;
											return true;
									}
								</script>
							</div>
						</div>
						<br>
						<div class="form-group">
							<label class="col-sm-12 control-label" for="Name">Name</label>
							<div class="col-sm-12">
								<input type="text" class="form-control" id="name" name="name" required placeholder="Name" onkeypress="return LettersrOnly(this, event)" maxlength="30"/>
							</div>

								<script type="text/javascript">
									function LettersrOnly(txt, e) 
									{
            							var arr = "ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz ";
            							var code;
            							if (window.event)
										code = e.keyCode;
										else
                						code = e.which;
            							var char = keychar = String.fromCharCode(code);
            							if (arr.indexOf(char) == -1)
                							return false;
        							}
    							</script>

						</div>
						<br>
						<div class="form-group">
							<label class="col-sm-12 control-label" for="department">Department</label>
							<div class="col-sm-12">
								<select class="form-control" id="department" name="department" required>
									<option value="">--Select Department--</option>
								</select>
							</div>
						</div>
						<br>
						<div class="form-group">
							<label class="col-sm-12 control-label" for="position">Position</label>
							<div class="col-sm-12">
								<select class="form-control" id="position" name="position" required>
								</select>
							</div>
						</div>
						<br>
						<div class="form-group">
							<label class="col-sm-12 control-label" for="role">Role</label>
							<div class="col-sm-12">
								<select class="form-control" name="dept" id="role" required>
									<option value="">--Select role--</option>
									<option value="Adminsitrator">Administrator</option>
									<option value="Staff">Staff</option>
								</select>
							</div>
						</div>
						<br>
						<div class="form-group">
							<label class="col-sm-12 control-label" for="status">Status</label>
							<div class="col-sm-12">
								<select class="form-control" name="status" id="status" required>
										<option value="">--Select status--</option>
										<option value="Active">Active</option>
										<option value="Inactive">Inactive</option>
								</select>
							</div>
						</div>
						<br>
						<div class="form-group">
							<label class="col-sm-12 control-label" for="password">Password</label>
							<div class="col-sm-12">
								<input class="form-control" type="password" id="myCheck" name="password" value="Aa123456" disabled>
							</div>
						</div>
						<br>
						<div class="form-group">
							<div class="col-sm-12">
								<div class="checkbox">
									<label><input type="checkbox" onclick="resetPass()"/>Reset password</label>
								</div>

								<script>
									function resetPass() 
									{
										var x = document.getElementById("myCheck");
										if (x.type === "password")
										{
											x.type = "text";
										} 
										else 
										{
											x.type = "password";
										}
									}  
								</script>
								
							</div>
						</div>
						<div class="form-group">
							<div class="col-sm-12">
								<button type="submit" class="btn btn-warning" style="margin: auto; margin-top: 5px;">Update</button>
							</div>
						</div>
					</form>
				</div>

				<div class="modal-footer">
					<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
				</div>
			</div>
		</div>
	</div>
</form>-->			

				<!-- <div class="modal-footer">
					<input type="hidden" id="password2" name="password2"></td>
					<button type="button" class="btn btn-default" data-dismiss="modal" style="font-size:15px;" onclick="ClearFields();">Close</button>
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

</body>
</html>

