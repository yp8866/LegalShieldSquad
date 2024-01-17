<!DOCTYPE html>
<html>

<head>
    <?php
    session_start();
    if(!isset($_SESSION['x'])||!isset($_SESSION['admin_id']))
        header("location:admin_login.php");
    
        include "../general/dbconnect.php";
    
    // $query="select c_id,uid,name,type_crime,d_o_c,location,description from complaint order by c_id asc";
    $query="select * from complaint order by c_id asc";
    $result=mysqli_query($conn,$query);
    
    
    if(isset($_POST['update'])){
        $cid=$_POST['cids'];
        $_SESSION['cid_update']=$cid;
        header("location: admin_update_complaints2.php");
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
        
        td,th{
            text-wrap: normal;
            word-wrap: break-word;
            
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
                    <li class="active"><a href="admin_update_complaints.php">Update Complaints</a></li>
                    <li><a href="alogout.php">Logout &nbsp <i class="fa fa-sign-out" aria-hidden="true"></i></a></li>
                </ul>
            </div>
        </div>
    </nav>





    <div style="padding:50px; margin: 50px;">
        <table class="table table-bordered" style="table-layout: fixed;">
            <thead class="thead-dark" style="background-color: black; color: white;">
                <tr>
                    <th scope="col">Complaint Id</th>
                    <th scope="col">User Name</th>
                    <th scope="col">Type of Crime</th>
                    <th scope="col">Date of Crime</th>
                    <th scope="col">Location</th>
                    <th scope="col">Status</th>
                    <th scope="col">Update</th>
                </tr>
            </thead>

            <?php
      while($rows=mysqli_fetch_assoc($result)){
    ?>

            <tbody style="background-color: white; color: black;">
                <tr>
                    <td>
                        <?php $c_idd=$rows['c_id']; echo $c_idd; ?>
                    </td>
                    <td style="text-wrap: normal; word-wrap: break-word;">
                        <?php echo $rows['u_name']; ?>
                    </td>
                    <td>
                        <?php echo $rows['type_crime']; ?>
                    </td>
                    <td>
                        <?php echo $rows['d_o_c']; ?>
                    </td>
                    <td>
                        <?php echo $rows['location_district']; ?>
                    </td>
                    <td>
                        <?php 
                            $fsd=mysqli_query($conn,"select fir_data,ipc_sections from fir where cid='$c_idd'");
                            $fir_data="PENDING";
                            $ipc_sections="PENDING";
                            if($fsd){
                            $res_fsd=mysqli_fetch_assoc($fsd);
                            $fir_data=$res_fsd['fir_data'];
                            $ipc_sections=$res_fsd['ipc_sections'];
                            }

                        ?>  
                        <button id="hel" class="btn btn-primary" onclick="showDescription(this)">View Status</button>
                        <p style="display:none;" class="ds1"><?php echo ($fir_data); ?></p>
                        <p style="display:none;" class="ds2"><?php echo ($ipc_sections); ?></p>
                    </td>
                    <td>
                        <form action="#" method="post">
                            <input type="text" name="cids" value=<?php echo $rows['c_id']; ?> style="display:none">
                            <button type="submit" name="update" class="btn btn-primary update-btn">Update</button>
                        </form>


                    </td>
                </tr>
            </tbody>

            <?php
    } 
    ?>

        </table>
    </div>
    <?php
        include "../general/popup_window.php";
        include "../general/footer.php";
    ?>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
        // Get all the rows in the table body
        var rows = document.querySelectorAll('tbody tr');

        // Iterate through each row and update the button name
        rows.forEach(function(row) {
            var updateButton = row.querySelector('.update-btn');
            var description1 = row.querySelector('.ds1');
            var description2 = row.querySelector('.ds2');

            if (description1.innerText.toLowerCase().trim() === 'pending' || description2.innerText.toLowerCase().trim() === 'pending') {
            updateButton.innerText = 'Update';
            } else {
            updateButton.innerText = 'Updat+';
            }
        });
        });
    </script>
    <script src="../general/index3.js"></script>
    <script type="text/javascript" src="https://code.jquery.com/jquery-2.1.4.js"></script>
    <script type="text/javascript" src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/js/bootstrap.min.js"></script>
</body>

</html>