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
    <meta http-equiv="refresh" content="300">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
    <!-- Our Custom CSS -->
	<style>
	
	.form-control 
	{
    background-color: #ffffff;
    background-image: none;
    border: 1px solid #999999;
    border-radius: 0;
    box-shadow: 0 1px 1px rgba(0, 0, 0, 0.075) inset;
    color: #333333;
    display: block;
    font-size: 14px;
    height: 34px;
    line-height: 1.42857;
    padding: 6px 12px;
    transition: border-color 0.15s ease-in-out 0s, box-shadow 0.15s ease-in-out 0s;
    width: 100%;
	}

	.login-box, .register-box {
		width: 360px;
		margin: 7% auto;
	}.login-page, .register-page {
		background: #d2d6de;
	}

	.login-logo, .register-logo {
		font-size: 35px;
		text-align: center;
		margin-bottom: 25px;
		font-weight: 300;
	}.login-box-msg, .register-box-msg {
		margin: 0;
		text-align: center;
		padding: 0 20px 20px 20px;
	}.login-box-body, .register-box-body {
		background: #ececec;
		padding: 20px;
		border-top: 0;
		color: #666;
	}.has-feedback {
		position: relative;
	}
	.form-group {
		margin-bottom: 15px;
	}.has-feedback .form-control {
		padding-right: 42.5px;
	}.login-box-body .form-control-feedback, .register-box-body .form-control-feedback {
		color: #777;
	}
	.form-control-feedback {
		position: absolute;
		top: 0;
		right: 0;
		z-index: 2;
		display: block;
		width: 34px;
		height: 34px;
		line-height: 34px;
		text-align: center;
		pointer-events: none;
	}.checkbox, .radio {
		position: relative;
		display: block;
		margin-top: 10px;
		margin-bottom: 10px;
	}.icheck>label {
		padding-left: 0;
	}
	.checkbox label, .radio label {
		min-height: 20px;
		padding-left: 20px;
		margin-bottom: 0;
		font-weight: 400;
		cursor: pointer;
	}
	</style>
</head>
<body>
	<div class="login-logo">
        <img src="sky_luster.png" alt="My Ad Cubes" style=" width:45px; height: 50px; "></a>
	</div>
	<div class="login-box-body">
        <p class="login-box-msg">Edit User Information</p>
        <form  method="post" accept-charset="utf-8">        
			<div class="form-group has-feedback">
            	<input type="text" name="idnum" value="" placeholder="ID Number" class="form-control" id="idnum" maxlength="7" size="30" disabled> 
            	<span></span>
			</div>
			<div class="form-group has-feedback">
            	<select name="dept" id="dept">
					<option value="">--Select Department--</option>
				</select>
            	<span></span>
			</div>
			<div class="form-group has-feedback">
            	<select name="role" id="role">
					<option value="">--Select Role--</option>
				</select>
            	<span></span>
			</div>
			<div class="form-group has-feedback">
            	<select name="role" id="role">
					<option value="">--Select Status--</option>
				</select>
            	<span></span>
        	</div>
        	<div class="form-group has-feedback">
            	<input type="password" name="password" value="" placeholder="Password" class="form-control" id="password" size="30">           
            	<span></span>
			</div>
			<div class="form-group has-feedback">
				<div class="checkbox">
					<label><input type="checkbox" onclick="resetPass()">Reset password</label>
				</div>
            	<span></span>
        	</div>
            <div class="row">
            	<div class="col-xs-12">
					<input type="submit" name="submit" value="Sign In" id="submit" class="btn btn-primary btn-block btn-flat">            
				</div>
            </div>
        </form> 
	</div>
</body>
</html>




















<!-- Edit User Modal -->
<form action="../php/connection/user_edit_account_submit.php <?php echo '?id='.$id; ?>" method="POST">
    <div class="modal fade" data-toggle="modal" id="edit_<?php echo $row['id']; ?>" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" arial-hidden="true" style="margin-top:50px;">
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
								<input type="text" class="form-control" id="userid" name="userid" value="<?php echo $row['userid']; ?>" pattern="[0-9]{7}" placeholder="ID Number" required onkeypress="return isNumberKey(event)"/>
								<input type="hidden" id="userid2" name="userid2" value="<?php echo $row['userid']; ?>">
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
								<input type="text" class="form-control" id="name" name="name" value=<?php echo $row['name']?> required placeholder="Name" onkeypress="return LettersrOnly(this, event)" maxlength="30"/>
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
								<select class="form-control" id="dept" name="department" required>
										<?php     
              								$sql = "select department from tbl_user WHERE id='$id'";
              								$stmt = $db->prepare($sql);
              								$stmt->execute();

              								while($row=$stmt->fetch(PDO::FETCH_ASSOC)){
                							echo '<option>'.$row['department'].'</option>'; 
              								}
            							?>
										
										<?php     
              								$sql = "select DISTINCT branch_name from tbl_department ORDER BY branch_name ASC";
              								$stmt = $db->prepare($sql);
              								$stmt->execute();

											  	while($row=$stmt->fetch(PDO::FETCH_ASSOC)){
                								echo '<option>'.$row['branch_name'].'</option>'; 
              									}
            							?>
								</select>
							</div>
						</div>
						<br>
						<div class="form-group">
							<label class="col-sm-12 control-label" for="position">Position</label>
							<div class="col-sm-12">
								<select class="form-control" id="postn" name="position" required>
										
										<?php     
              								$sql = "select position from tbl_user WHERE id='$id'";
              								$stmt = $db->prepare($sql);
              								$stmt->execute();

              								while($row=$stmt->fetch(PDO::FETCH_ASSOC)){
                							echo '<option>'.$row['position'].'</option>'; 
              								}
            							?>

										<?php     
              								$sql = "select DISTINCT sub_department from tbl_department ORDER BY sub_department ASC";
              								$stmt = $db->prepare($sql);
              								$stmt->execute();

											while($row=$stmt->fetch(PDO::FETCH_ASSOC))
											{
                								echo '<option>'.$row['sub_department'].'</option>'; 
              								}
            							?>
								</select>
							</div>
						</div>
						<br>
						<div class="form-group">
							<label class="col-sm-12 control-label" for="role">Role</label>
							<div class="col-sm-12">
								<select class="form-control" name="role" id="role" required>
										
										<?php     
              								$sql = "select role from tbl_user WHERE id='$id'";
              								$stmt = $db->prepare($sql);
              								$stmt->execute();

              								while($row=$stmt->fetch(PDO::FETCH_ASSOC)){
                							echo '<option>'.$row['role'].'</option>'; 
              								}
            							?>
									<option value="ADMINISTRATOR">ADMINISTRATOR</option>
									<option value="STAFF">STAFF</option>
								</select>
							</div>
						</div>
						<br>
						<div class="form-group">
							<label class="col-sm-12 control-label" for="status">Status</label>
							<div class="col-sm-12">
								<select class="form-control" name="status" id="status" required>
										
										<?php     
              								$sql = "select status from tbl_user WHERE id='$id'";
              								$stmt = $db->prepare($sql);
              								$stmt->execute();

              								while($row=$stmt->fetch(PDO::FETCH_ASSOC)){
                							echo '<option>'.$row['status'].'</option>'; 
              								}
            							?>
										<option value="Active">Active</option>
										<option value="Inactive">Inactive</option>
								</select>
							</div>
						</div>
						<br>
						<div class="form-group">
							<label class="col-sm-12 control-label" for="password">Password</label>
							<div class="col-sm-12">
								<input class="form-control" type="password" id="myCheck"  value="Aa123456" name="password" disabled>
							</div>
						</div>
						<br>
						<div class="form-group">
							<div class="col-sm-12">
								<div class="checkbox">
									<label><input type="checkbox" onclick="resetPass()"/>Reset password</label>
								</div>
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
					<button type="button" class="btn btn-default" data-dismiss="modal" onclick="ClearFields();">Close</button>
				</div>
			</div>
		</div>
	</div>
</form>

<script type="text/javascript">
	$("#").change(function() {
  	$("#").load("get_sub_department2.php?branch_name=" + $("#d").val());
	});
</script>


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

<script type="text/javascript">
	function ClearFields() 
		{
			document.getElementById("userid2").value = "";
    	}
</script>