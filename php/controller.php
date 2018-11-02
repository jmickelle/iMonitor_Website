<?php
    Global $id;
    function Login()
    {
        session_start();
        require 'connection/db_connection.php';
        if(isset($_POST['btnLogin']))
        {
            $userid = mysqli_real_escape_string($con,$_POST['userid']);
            $password = mysqli_real_escape_string($con,$_POST['password']);
            $encPassword = md5(sha1($password));
            $loginQuery = mysqli_query($con,"SELECT * FROM tbl_user WHERE userid = '{$userid}' ");
            $loginRow = mysqli_fetch_assoc($loginQuery);
            if(password_verify($password, $loginRow['password']))
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
        $notifCount = 0;
        while($notifRow = mysqli_fetch_array($notifSql))
        {
            $notifCount++;
        }
        echo $notifCount;
    }

    function notifDisplay()
    {
        require 'connection/db_connection.php';
        $notifSql = mysqli_query($con,"SELECT user,hostname,iMonitor_Status,connection_status FROM tbl_log WHERE 
        (iMonitor_Status = 'End Task' OR connection_status = 'UNESTABLISHED') AND user != 'Administrator' LIMIT 5");
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
            echo '
            <tr>
            <td>'.$row['id'].'</td>
            <td>'.$row['userid'].'</td>
            <td>'.$row['name'].'</td>
            <td>'.$row['department'].'</td>
            <td>'.$row['position'].'</td>
            <td>'.$row['role'].'</td>
            <td>'.$row['status'].'</td>
            <td><a  data-toggle="modal"><button class="btn btn-primary">Edit Record</button></a></td>
            </tr>';
            // <!-- 'include(edit_modal.php')' -->
        }
    }
?>