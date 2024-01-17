<?php
    session_start();
    include "../general/dbconnect.php";
    if(!isset($_SESSION['x'])||!isset($_SESSION['admin_id']))
        header("location:admin_login.php");


        if(isset($_POST['updt'])){
            $c_idd=$_SESSION['cid_update'];
            $fir_data=$_POST['fir_data'];
            $ipc_sections=$_POST['ipc_sec'];
            
            $query="UPDATE fir SET fir_data = '$fir_data',ipc_sections = '$ipc_sections' WHERE cid = '$c_idd' ";
            $res=mysqli_query($conn,$query);
            
            if($res!=1)
            {
                $message1 = "Updation not Success!";
                echo "<script type='text/javascript'>alert('$message1');</script>";
            }
            else
            {
              $message = "Status Updated Successfully";
              echo "<script type='text/javascript'>alert('$message','hello');</script>";
            }        
        }
    
        if(isset($_POST['updtfirmanually'])){
            $c_idd=$_SESSION['cid_update'];
            $fir_data=$_POST['fir_data1'];
            $ipc_sections=$_POST['ipc_sec1'];
            
            $query="UPDATE fir SET fir_data = '$fir_data',ipc_sections = '$ipc_sections' WHERE cid = '$c_idd' ";
            $res=mysqli_query($conn,$query);
            
            if($res!=1)
            {
                $message1 = "Updation not Success!";
                echo "<script type='text/javascript'>alert('$message1');</script>";
            }
            else
            {
              $message = "Status Manually Updated Successfully";
              echo "<script type='text/javascript'>alert('$message','hello');</script>";
            }        
        }

        header("location:admin_update_complaints2.php");


    
    ?>