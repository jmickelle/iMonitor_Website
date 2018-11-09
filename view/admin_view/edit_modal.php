<!DOCTYPE html>
<html lang="en">
<?php
    require '../../php/connection/db_connection.php';
    include '../../php/controller.php';
	$id = $_GET['id'];
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
		color: #000;
		border-radius: 12px;
	}.has-feedback {
		position: relative;
	}
	.form-group {
		margin-bottom: 20px;
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
	<?php
    require '../../php/connection/db_connection.php';
    $users = mysqli_query($con,"SELECT * FROM tbl_user WHERE userid = '$id'");
    if($row = mysqli_fetch_assoc($users)){
    ?>
	<div class="login-logo">
        <img src="../../public/images/icons/sky_luster.png" style=" width:90px; height: 100px; "></a>
	</div>
	<div class="login-box-body" style="margin: 20px 600px;">
        <h3 class="login-box-msg">Edit User Information</h3>
        <form  method="post" accept-charset="utf-8">        
			<div class="form-group has-feedback">
            	<input type="text" name="idnum" value="<?php echo $row['userid'] ?>" placeholder="ID Number" class="form-control" id="idnum" maxlength="7" size="30" disabled> 
            	<span></span>
			</div>
	<?php } ?>
			<div class="form-group has-feedback">
            	<input type="text" name="name" value="" placeholder="Name" class="form-control" id="name" maxlength="30" size="30"> 
            	<span></span>
			</div>
			<div class="form-group has-feedback">
            	<select name="dept" id="dept" class="form-control">
					<option value="">--Select Department--</option>
				</select>
            	<span></span>
			</div>
			<div class="form-group has-feedback">
            	<select name="role" id="role" class="form-control">
					<option value="">--Select Role--</option>
				</select>
            	<span></span>
			</div>
			<div class="form-group has-feedback">
            	<select name="stats" id="stats" class="form-control">
					<option value="">--Select Status--</option>
				</select>
            	<span></span>
        	</div>
			
        	<div class="form-group has-feedback">
            	<input type="password" name="password" value="Aa123456" placeholder="Password" class="form-control" id="myCheck" size="30">           
            	<span></span>
			</div>
			<div class="form-group has-feedback">
				<div class="checkbox">
					<label><input type="checkbox" onclick="resetPass()">Reset password</label>
				</div>
            	<span></span>
        	</div>
            <div class="row">
            	<div class="col-xs-6">
					<input type="submit" name="submit" value="Update" id="submit" class="btn btn-primary btn-block btn-flat">            
				</div>
				<div class="col-xs-6">
					<a type="button" href="admin_users.php" id="back" class="btn btn-default btn-block btn-flat">Back</a>          
				</div>
            </div>
        </form> 
	</div>
</body>
</html>

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
