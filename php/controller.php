<?php
    global $id;
    global $ids;
    //error_reporting(0);
    function Login()
    {
        session_start();
        require 'connection/db_connection.php';
        if(isset($_POST['btnLogin']))
        {
            $userid = mysqli_real_escape_string($con,$_POST['userid']);
            $password = mysqli_real_escape_string($con,$_POST['password']);
            $encPassword = md5(sha1($password));
            $loginQuery = mysqli_query($con,"SELECT * FROM tbl_user WHERE userid = '{$userid}' AND password = '{$encPassword}' ");
            // $loginRow = mysqli_fetch_assoc($loginQuery);
            if($loginRow = mysqli_fetch_assoc($loginQuery))
            {
                $id = $loginRow['id'];
                if($loginRow['status'] == "Active")
                {
                    $_SESSION['user'] = $id;
                    echo '
                    <div class="notification-success">
                    <p style="text-align:center">You are logged in. Please wait.</p>
                    </div>
                    ';
                    if($loginRow['role'] == "ADMINISTRATOR")
                    {
                        header("Refresh:2; URL = View/admin_view/admin_dashboard.php");
                    }
                    else 
                    {
                        echo '
                        <div class="notification-success">
                        <p style="text-align:center">STAFF</p>
                        </div>
                        ';
                    }
                }
                else 
                {
                     echo 
                    '
                    <div class="notification-invalid">
                    <p style="text-align:center">INACTIVE</p>
                    </div>
                    ';
                }
            }
            else
            {
                echo 
                '
                <div class="notification-invalid">
                <p style="text-align:center">Invalid username or password</p>
                </div>
                ';
                header("Refresh:2; URL = index.php");
            }
        }
    }

    // GENERAL FUNCTION
    function displayName()
    {
        require 'connection/db_connection.php';
        $displayName = mysqli_query($con,"SELECT name FROM tbl_user WHERE id = '{$_SESSION['user']}' ");
        if($nameRow = mysqli_fetch_array($displayName))
        {
            echo 'WELECOME : '.$nameRow['name'];
        }
    }

    function notifCount()
    {
        require 'connection/db_connection.php';
        $notifSql = mysqli_query($con,"SELECT user,hostname,iMonitor_Status,connection_status FROM tbl_log WHERE 
        (iMonitor_Status = 'End Task' OR connection_status = 'UNESTABLISHED') AND user != 'Administrator' ");
        $notifSql2 = mysqli_query($con,"SELECT hostname,agent_version FROM tbl_computer_details 
        WHERE agent_version != '9.614' AND agent_version != '9.617'");
        $notifCount = 0;
        $notifCount2 = 0;
        while($notifRow = mysqli_fetch_array($notifSql))
        {
            $notifCount++;
        }
        // while($notifRow2 = mysqli_fetch_array($notifSql2))
        // {
        //     $notifCount2++;
        // }
        //echo $notifCount + $notifCount2 ;
        echo $notifCount;
    }

    function notifDisplay()
    {
        require 'connection/db_connection.php';
        $notifSql = mysqli_query($con,"SELECT user,hostname,iMonitor_Status,connection_status FROM tbl_log WHERE 
        (iMonitor_Status = 'End Task' OR connection_status = 'UNESTABLISHED') AND user != 'Administrator' LIMIT 5");
        $notifSql2 = mysqli_query($con,"SELECT hostname,agent_version,branch FROM tbl_computer_details 
        WHERE agent_version != '9.614' AND agent_version != '9.617' LIMIT 5");
        while($notifRow = mysqli_fetch_array($notifSql))
        {
            echo '
                <li>
                    <a href="#"><strong>'.$notifRow['hostname'].'</strong><br>
                    <small><em>'.$notifRow['iMonitor_Status'].'</em></small></a>
                    <small><em>'.$notifRow['connection_status'].'</em></small></a>
                </li>
                <li class="divider"></li>
                ';
        }
        // while($notifRow2 = mysqli_fetch_array($notifSql2))
        // {
        //     echo '
        //         <li>
        //             <a href="#"><strong>'.$notifRow2['hostname'].'</strong><br>
        //             <small><em>'.$notifRow2['agent_version'].'</em></small></a>
        //             <small><em>'.$notifRow2['branch'].'</em></small></a>
        //         </li>
        //         <li class="divider"></li>
        //         ';
        // }
    }

    function displayAllNotif()
    {
        require 'connection/db_connection.php';
        $notifSql = mysqli_query($con,"SELECT user,hostname,iMonitor_Status,connection_status,scan_time,branch FROM tbl_log WHERE 
        (iMonitor_Status = 'End Task' OR connection_status = 'UNESTABLISHED') AND user != 'Administrator' LIMIT 5");
        $notifSql2 = mysqli_query($con,"SELECT hostname,agent_version,branch,scan_time FROM tbl_computer_details 
        WHERE agent_version != '9.614' AND agent_version != '9.617' LIMIT 5");
        while($row = mysqli_fetch_array($notifSql))
        {
            echo '
                <tr>
                    <td>iMonitor : '.$row['iMonitor_Status'].'<br/> Port Connection:'.$row['connection_status'].'<br/> Scan Time:'.$row['scan_time'].'</td>
                    <td>Hostname: '.$row['hostname'].' <br> User: '.$row['user'].'<br/> Building : '.$row['branch'].'</td>
                    <td>'.$row['scan_time'].'</td>
                </tr>
                ';
        }
        // while($row2 = mysqli_fetch_array($notifSql2))
        // {
        //     echo '
        //         <tr>
        //             <td>Agent_version:  '.$row2['agent_version'].'</td>
        //             <td>Hostname: '.$row2['hostname'].'<br/> Building : '.$row2['branch'].'</td>
        //             <td>'.$row2['scan_time'].'</td>
        //         </tr>
        //     ';
        // }
    }

    function sidebarComputerList()
    {
        require 'connection/db_connection.php';
        $listSql = mysqli_query($con,"select DISTINCT branch_name from tbl_department ORDER BY branch_name ASC");
        while($row = mysqli_fetch_assoc($listSql))
		{
            echo '<li><a href="admin_viewing.php">'.$row['branch_name'].'</a></li>';
        }
    }

    function Logout()
    {
        require 'connection/db_connection.php';
        if(isset($_POST['btnLogout']))
        {
            unset($_SESSION['user']);
            session_destroy();
            if (!isset($_SESSION['user']))
            {
                header("Refresh:0; URL =  ../../index.php");
                exit();
            }
        }
    }

    //END

    //ADMIN USER
    function displayUser()
    {
        require 'connection/db_connection.php';
        $userDisplay = mysqli_query($con,"SELECT id, userid, name, department, position, status, role FROM tbl_user WHERE role <> 'SUPER ADMIN'");
        foreach($userDisplay as $row)
        {
            $userids = $row['id'];
            echo '
            <tr>
            <td>'.$row['userid'].'</td>
            <td>'.$row['name'].'</td>
            <td>'.$row['department'].'</td>
            <td>'.$row['position'].'</td>
            <td>'.$row['role'].'</td>
            <td>'.$row['status'].'</td>
            <input type="hidden" value="?id='.$userids.'" />
            <td><a type="button" href="edit_modal.php" class="btn btn-primary">Edit</a></td>
            </tr>';
            // <td><input type="submit" name="btnEditRecord" class="btn btn-primary" value="'.$_SESSION['userid'].'"></td>
            // <td><a href="'.$_SESSION['userid'] = $row['userid'].'"data-toggle="modal"><button class="btn btn-primary">Edit Record</button></a></td>
            // userEdit();
            // <!-- 'include('edit_modal.php')' -->
        }
    }

    function userEdit()
    {
        //echo '<script>window.alert('.$_SESSION['userid'].')</script>';
    }

    function addUser()
    {
        require 'connection/db_connection.php';
        if(isset($_POST['btnRegister']))
        {
            $userid = mysqli_real_escape_string($con,$_POST['userid']);
            $name = mysqli_real_escape_string($con,$_POST['name']);
            $department = mysqli_real_escape_string($con,$_POST['department']);
            $role = mysqli_real_escape_string($con,$_POST['role']);
            $status = mysqli_real_escape_string($con,$_POST['status']);
            $password = "Aa123456";
            $enc = md5(sha1($password));

            $selUsers = mysqli_query($con,"SELECT * FROM tbl_user WHERE userid = '$userid'");
            $checkRow = mysqli_fetch_array($selUsers);
            if($checkRow>0)
            {
                echo '<script type="text/javascript">window.alert("This User '.$userid.' Already Exist!")</script>';
            }
            else{
                $sqlRegister = mysqli_query($con,"INSERT INTO tbl_user(userid,name,department,role,status,password) 
                VALUES('$userid','$name','$department','$role','$status','$enc') ");
                header("Location:admin_users.php");
            }
            
        }
    }

    //ADMIN VIEWING
    function listDepartment()
    {
        require 'connection/db_connection.php';
        $listDept = mysqli_query($con,"SELECT DISTINCT building FROM tbl_vlan ORDER BY building ASC");
        while($row = mysqli_fetch_assoc($listDept))
		{
            echo '<option value="'.$row['building'].'">'.$row['building'].'</option>'; 
        }
    }

    function displayDept()
    {   require 'connection/db_connection.php';
            // if(isset($_POST['dept_viewing']))
            // {
            //     $s = $_GET['sel'];
            //     $deptSqls = mysqli_query($con,"SELECT compID, hostname, ip, status, remarks, agent_Version,branch FROM tbl_computer_details WHERE branch = '$s' ");
            //     while($row = mysqli_fetch_array($deptSqls))
            //     {
            //         $ids = $row['compID'];
                
            //     echo '
            //                 <tr>
            //                 <td> '.$row['compID'].'</td>
            //                 <td> '.$row['hostname'].'</td>
            //                 <td>'.$row['ip'].'</td>
            //                 <td>'.$row['status'].'</td>
            //                 <td>'.$row['remarks'].'</td>
            //                 <td>'.$row['agent_Version'].'</td>
            //                 <input type="hidden" value="?id='.$ids.'" />
            //                 <td><a href="viewing.php?id='.$ids.'" data-toggle="modal"><input type="button" value="View" class="btn btn-primary"></a></td> 
            //                 ';
            //                 //include('admin_viewing_modal.php');
            //     echo '</tr>';
            //     }
            // }
        if(isset($_POST['bntSearch']))
        {
            $selectDepartment = mysqli_real_escape_string($con,$_POST['dept_viewing']);
            // $selectSubDepartment = $_POST['dub_dept'];
            $getSearch = mysqli_real_escape_string($con,$_POST['search']);
            if($selectDepartment == "All")
            {
                $deptSql = mysqli_query($con,"SELECT compID, hostname, ip, status, remarks, agent_Version,branch FROM tbl_computer_details");
                if(empty($getSearch) || $getSearch == null || $getSearch == '')
                {
                    $deptSql = mysqli_query($con,"SELECT compID, hostname, ip, status, remarks, agent_Version,branch FROM tbl_computer_details
                    WHERE branch = '$selectDepartment' OR hostname = '$getSearch' ");
                }else
                {
                    $deptSql = mysqli_query($con,"SELECT compID, hostname, ip, status, remarks, agent_Version,branch FROM tbl_computer_details
                    WHERE hostname = '$getSearch' ");
                }
                
            }
            else
            {
                if(empty($getSearch) || $getSearch == null || $getSearch == '')
                {
                    $deptSql = mysqli_query($con,"SELECT compID, hostname, ip, status, remarks, agent_Version,branch FROM tbl_computer_details
                    WHERE branch = '$selectDepartment' OR hostname = '$getSearch' ");
                }else
                {
                    $deptSql = mysqli_query($con,"SELECT compID, hostname, ip, status, remarks, agent_Version,branch FROM tbl_computer_details
                    WHERE hostname = '$getSearch' ");
                }
            }
            while($row = mysqli_fetch_array($deptSql))
            {
                $ids = $row['compID'];
                echo '
                    <tr>
                    <td> '.$row['compID'].'</td>
                    <td> '.$row['hostname'].'</td>
                    <td>'.$row['ip'].'</td>
                    <td>'.$row['status'].'</td>
                    <td>'.$row['remarks'].'</td>
                    <td>'.$row['agent_Version'].'</td>
                    <input type="hidden" value="?id='.$ids.'" />
                    <td><a href="viewing.php?id='.$ids.'" data-toggle="modal"><input type="button" value="View" class="btn btn-primary"></a></td> 
                    ';
                    //include('admin_viewing_modal.php');
                echo '</tr>';
            }   
            
        }
    }

    function updateComp()
    {
        require 'connection/db_connection.php';
        if(isset($_POST['btnUpdate']))
        {
            $remarks = mysqli_real_escape_string($con,$_POST['remarks']);
            $Agent_version = mysqli_real_escape_string($con,$_POST['agent_version']);
            $updateComp = mysqli_query($con,"UPDATE tbl_computer_details SET remarks = '$remarks', agent_version = '$Agent_version' WHERE compID = '{$_SESSION['compID']}' ");
            if($updateComp)
            {
                echo '<script>window.alert("UPDATED")</script>';
                header("Refresh:0; URL=admin_viewing.php");
            }
            else
            {
                echo '<script>window.alert("ERROR IN QUERY")</script>';
            }
        }
    }

    //ADMIN REPORTS
    function displayLogReport()
    {
        require 'connection/db_connection.php';
        $sqlLogReport = mysqli_query($con,"SELECT user, domain_name, hostname, ip_address, ip_date_modified,
        iMonitor_Status, services, sysSetting_File, serverIP, connection_status, branch, scan_time FROM tbl_log 
        WHERE user != 'Administrator'");
        $count = 1;
        foreach($sqlLogReport as $row)
        {
            echo '
            <tr> 
            <td>'.$count++.'</td>
            <td>'.$row['user'].'</td>
            <td>'.$row['hostname'].'</td>
            <td>'.$row['domain_name'].'</td>
            <td>'.$row['ip_address'].'</td>
            <td>'.$row['ip_date_modified'].'</td>
            <td>'.$row['iMonitor_Status'].'</td>
            <td>'.$row['services'].'</td>
            <td>'.$row['sysSetting_File'].'</td>
            <td>'.$row['serverIP'].'</td>
            <td>'.$row['connection_status'].'</td>
            <td>'.$row['branch'].'</td>
            <td>'.$row['scan_time'].'</td>
            </tr>
            ';
        }

    }

    function displayReports()
    {   require 'connection/db_connection.php';    
        if(isset($_POST['bntSearch']))
        {
            $selectDepartment = mysqli_real_escape_string($con,$_POST['dept_viewing']);
            // $selectSubDepartment = $_POST['dub_dept'];
            $getSearch = mysqli_real_escape_string($con,$_POST['search']);
            if($selectDepartment == "All")
            {
                $deptSql = mysqli_query($con,"SELECT compID, hostname, ip, status, remarks, agent_Version,branch FROM tbl_computer_details");
                if(empty($getSearch) || $getSearch == null || $getSearch == '')
                {
                    $deptSql = mysqli_query($con,"SELECT compID, hostname, ip, status, remarks, agent_Version,branch FROM tbl_computer_details
                    WHERE branch = '$selectDepartment' OR hostname = '$getSearch' ");
                }else
                {
                    $deptSql = mysqli_query($con,"SELECT compID, hostname, ip, status, remarks, agent_Version,branch FROM tbl_computer_details
                    WHERE hostname = '$getSearch' ");
                }
                
            }
            else
            {
                if(empty($getSearch) || $getSearch == null || $getSearch == '')
                {
                    $deptSql = mysqli_query($con,"SELECT compID, hostname, ip, status, remarks, agent_Version,branch FROM tbl_computer_details
                    WHERE branch = '$selectDepartment' OR hostname = '$getSearch' ");
                }else
                {
                    $deptSql = mysqli_query($con,"SELECT compID, hostname, ip, status, remarks, agent_Version,branch FROM tbl_computer_details
                    WHERE hostname = '$getSearch' ");
                }
            }
            while($row = mysqli_fetch_array($deptSql))
            {
                $ids = $row['compID'];
                echo '
                    <tr>
                    <td> '.$row['compID'].'</td>
                    <td> '.$row['hostname'].'</td>
                    <td>'.$row['ip'].'</td>
                    <td>'.$row['status'].'</td>
                    <td>'.$row['remarks'].'</td>
                    <td>'.$row['agent_Version'].'</td>
                    <input type="hidden" value="?id='.$ids.'" />
                    <td><a href="viewing.php?id='.$ids.'" data-toggle="modal"><input type="button" value="View" class="btn btn-primary"></a></td> 
                    ';
                    //include('admin_viewing_modal.php');
                echo '</tr>';
            }   
            
        }
    }


    function pdfs()
    {
        require('../../public/libraries/fpdf181/fpdf.php');
        $pdf = new FPDF('P','mm','A4');
        $pdf->AddPage();
        $pdf->SetFont('Arial','B',16);
        
       if(isset($_POST['btnPrint']))
       {
        $pdf->Cell(40,10,'Hello World !',1);
       }
    }    
?>