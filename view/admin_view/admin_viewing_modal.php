<?php
    require '../../php/connection/db_connection.php';
    $id = $_GET['id'];
?>
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
                                            <?php 
                                                require 'connection/db_connection.php';
                                                $compSql = mysqli_query($con,"SELECT * FROM tbl_computer_details WHERE compID = '{$id}'");
                                                if($row = mysqli_fetch_assoc($compSql)){
                                                    echo '
                                                    <td style="padding-top:15px;">'.$row['compID'].'</td>
                                                    <td style="padding-top:15px;">'.$row['hostname'].'</td>
                                                    <td style="padding-top:15px;">'.$row['processor'].'</td>
                                                    <td style="padding-top:15px;">'.$row['hdd_Serial'].'</td>
                                                    <td style="padding-top:15px;">'.$row['mac_Address'].'</td>
                                                    <td style="padding-top:15px;">'.$row['mb_manufacturer'].'</td>
                                                    <td style="padding-top:15px;">'.$row['mb_product'].'</td>
                                                    ';
                                                }
                                            ?>
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