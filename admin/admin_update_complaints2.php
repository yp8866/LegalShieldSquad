<!DOCTYPE html>
<html>

<head>
    <?php
    session_start();
    include "../general/dbconnect.php";
    if(!isset($_SESSION['x'])||!isset($_SESSION['admin_id']))
        header("location:admin_login.php");


        if(isset($_POST['updtdb'])){
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
    
    ?>

    <title>Update Complaints</title>

    <link rel="stylesheet" type="text/css" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/css/bootstrap.min.css">
    <link rel="stylesheet" type="text/css"
        href="https://maxcdn.bootstrapcdn.com/font-awesome/4.4.0/css/font-awesome.min.css">
    <link href="http://fonts.googleapis.com/css?family=Lato:300,400,700,300italic,400italic,700italic" rel="stylesheet"
        type="text/css">
    <link href="https://unpkg.com/tailwindcss@^2/dist/tailwind.min.css" rel="stylesheet">

    <style>
        body {
            background-color: #343a40;
        }

        .form-container {
            color: #fff;
            background-color: rgba(0, 0, 0, 0.6);
            padding: 20px;
            border-radius: 10px;
            margin: 0 auto;
            max-width: 800px;
            margin-top: 120px;
        }
        ::-webkit-scrollbar {
        width: 5px;
        }

        ::-webkit-scrollbar-thumb {
        background-color: #4a5568; /* Scrollbar color */
        border-radius: 6px;
        }

        ::-webkit-scrollbar-track {
        background-color: #cbd5e0; /* Track color */
        border-radius: 6px;
        }
    </style>
    
</head>


<body style="background-color: #dfdfdf">
    <nav class="navbar navbar-default navbar-fixed-top">
        <div class="container">

            <div class="navbar-header">
                <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar"
                    aria-expanded="false" aria-controls="navbar">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
                <a class="navbar-brand" href="alogout.php"><b>Legal_Shield_Squad</b></a>
            </div>

            <div id="navbar" class="collapse navbar-collapse">
                <ul class="nav navbar-nav">
                    <li><a href="alogout.php">Admin Login</a></li>
                    <li class="active"><a href="admin_interface.php">Admin Home</a></li>
                </ul>

                <ul class="nav navbar-nav navbar-right">
                    <li class="active"><a href="admin_update_complaints2.php">Update Complaints</a></li>
                    <li><a href="alogout.php">Logout &nbsp <i class="fa fa-sign-out" aria-hidden="true"></i></a></li>
                </ul>
            </div>
        </div>
    </nav>





    <div class="container" style="width: 100%;">
        <div class="row">
            <div class="col-md-12">
                <div class="form-container">
                    <h1 class="text-center">Update Complaint for C_ID:
                        <?php echo "{$_SESSION['cid_update']}";  ?>
                    </h1>
                    
                        <br>
                        <h2 class="text-center">Generate FIR and Recommend Accurate IPC Sections</h2>
                        <br>

                        <div class="flex justify-center gap-10">
                            <?php 
                                $c_idd=$_SESSION['cid_update'];
                                $fsd=mysqli_query($conn,"select fir_data,ipc_sections from fir where cid='$c_idd'");
                                $fir_data="PENDING";
                                $ipc_sections="PENDING";
                                if($fsd){
                                    $res_fsd=mysqli_fetch_assoc($fsd);
                                    $fir_data=$res_fsd['fir_data'];
                                    $ipc_sections=$res_fsd['ipc_sections'];
                                }
                                $cdes=mysqli_query($conn,"select description from complaint where c_id='$c_idd'");
                                $des_data="Empty";
                                if($cdes){
                                    $res_cdes=mysqli_fetch_assoc($cdes);
                                    $des_data=$res_cdes['description'];                                    
                                }
                                
                                ?>  
                            <button style="margin-bottom: 20px;" class="btn btn-primary" onclick="showDescription(this)">View Status</button>
                            <p style="display:none;"><?php echo ($fir_data); ?></p>
                            <p style="display:none;"><?php echo ($ipc_sections); ?></p>
                            
                            
                               
                                
                            <button type="submit" name="updt" id="updt" style="margin-bottom: 20px;" class="btn btn-primary" onclick="generateData(this)">Generate FIR & IPC Sections</button>
                            <p style="display:none;"><?php echo ($des_data); ?></p>

                            
                            <form action="#" method="post" id="updtstatus">
                                <input style="display:none;" id="fir_data" name="fir_data">
                                <input style="display:none;" id="ipc_sec" name="ipc_sec">
                                <button type="submit" style="display:none;" name="updtdb" id="updtdb" style="margin-bottom: 20px;" class="btn btn-primary">Update to DataBase</button>
                            </form>
                            
                            <button style="margin-bottom: 20px;" class="btn btn-primary" onclick="showDescription2(this)">Update Manually</button>
                            <p style="display:none;"><?php echo ($fir_data); ?></p>
                            <p style="display:none;"><?php echo ($ipc_sections); ?></p>
                            <a href="./admin_update_complaints.php"><button style="margin-bottom: 20px;" class="btn btn-primary">Back</button></a>
                        </div>
                    
                </div>
            </div>
        </div>
    </div>


    <?php
        include "../general/popup_window.php";
        include "../general/popup_window1.php";
        include "../general/popup_window2.php";
        include "../general/footer.php";
    ?>


    
    <script src="../general/index3.js"></script>
    <script type="text/javascript" src="https://code.jquery.com/jquery-2.1.4.js"></script>
    <script type="text/javascript" src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/js/bootstrap.min.js"></script>
</body>

</html>