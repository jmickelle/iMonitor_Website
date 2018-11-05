<?php
    require '../../php/connection/db_connection.php';
    include '../../php/controller.php';
    $id = $_GET['id'];
    $_SESSION['compID'] = $id;
?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta http-equiv="refresh" content="300">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
    <!-- Our Custom CSS -->
    <!-- <link rel="stylesheet" href="viewing.css"> -->
    <link rel="stylesheet" href="style1.css">
    <!-- <link rel="stylesheet" href="styleIndex.css"> -->
</head>
<body style="margin-top:30px;">
    <?php
    require '../../php/connection/db_connection.php';
    $compSql = mysqli_query($con,"SELECT * FROM tbl_computer_details WHERE compID = '$id'");
    if($row = mysqli_fetch_assoc($compSql)){
    ?>
    <div class="container1" style="width: 100%; padding-left: 25px; padding-right: 20px;">
        <div class="container2">
        <?php updateComp(); ?>
        <form method="POST">
            <table class="tbl-view">
                <tr>
                    <td><h1 style="margin-bottom:30px; margin-right:1130px;"><?php echo $row['hostname']; ?></h1></td>
                    <td><h4 style="margin-right:20px;"><strong>Remarks:</strong></h4></td>
                    <td>
                        <select name="remarks" id="stats">
                        <option value="<?php $row['remarks']; ?>"><?php echo $row['remarks']; ?></option>
                            <option value="Active">Active</option>
                            <option value="Resigned">Resigned</option>
                            <option value="Transferred">Transferred</option>
                            <option value="Old PC name">Old PC name</option>
                        </select>
                    </td>
                </tr>
            </table>
        </div>                                      
    </div>
    <div class="container">
        <div class="panel panel-default">
            <div class="panel-heading">
                <h4 style="font-size:20px;">Computer Details</h4>
            </div>
            <div class="panel-body" style="margin-left: -90px; padding-right: 115px;">
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
                        <td style="padding:15px;"><?php echo $row['processor'] ?></td>
                        <td style="padding:15px;"><?php echo $row['hdd_Serial']; ?></td>
                        <td style="padding:15px;"><?php echo $row['mac_Address']; ?></td>
                        <td style="padding:15px;"><?php echo $row['mb_manufacturer']; ?></td>
                        <td style="padding:15px;"><?php echo $row['mb_product']; ?></td>
                    </tr>
                    <?php }?>
                </tbody>
            </table>
        </div>
    </div>
    <div class="footer">
            <i class="glyphicon glyphicon-copyright-mark"><p style="padding:5px;">Copyrights 2018</p></i>
    </div>
    <div>
        <a href="admin_viewing.php" class="btn btn-default" style="float:right; width:130px;" >Back</a>
        <input type="submit" value="Update" name="btnUpdate" class="btn btn-success" style="float:right; width:130px; margin-right:15px;" />
        <!-- <a href=""><button class="btn btn-success" style="float:right; width:130px; margin-right:15px;">Update</button></a> -->
    </div>
    </form>
</body>
</html>