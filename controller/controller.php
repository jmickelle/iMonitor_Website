<?php
    function Login()
    {
        session_start();
        require "connection/db_connection.php";

        $userid = $_POST['userid'];
        $password = $_POST['password'];
    
        $stmt = $db->prepare("SELECT * FROM tbl_user WHERE userid=:userid LIMIT 1"); 
        $stmt->bindValue(':userid', $userid, PDO::PARAM_STR); 
        $stmt->execute(); 
        $row = $stmt->fetchAll(PDO::FETCH_ASSOC); 

        if (count($row) > 0) 
        {
            $hashed_password = $row[0]['password']; 
            $status = $row[0]['status']; 
            $role = $row[0]['role']; 
                if($status == 'Inactive') 
                {
                    header("Location: ../../view/index.php?msg2=wrong");
                }
                elseif(($status == 'Active') && (password_verify($password, $hashed_password))) { 
                        $_SESSION["userid"] = $row[0]['userid']; 
                        if($role == "ADMINISTRATOR")
                            echo "<script>alert('Welcome Admin!');location.href='../../view/admin_view/admin_users.php';</script>";
                            // header("Location: ../../iMonitor_Website/admin_dashboard.php"); 
                        else
                        echo "<script>alert('Welcome Staff!');location.href='../../view/admin_view/user_dashboard.php';</script>";
                }
                else {  
                header("Location: ../../iMonitor_Website/index.php?msg=wrong"); 
                }
        }
        else
        {
            header("Location: ../../iMonitor_Website/index.php?msg=wrong"); 
        } 
    }
?>