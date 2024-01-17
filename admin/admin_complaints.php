<!DOCTYPE html>
<html>

<head>
  <?php
    session_start();
    if(!isset($_SESSION['x'])||!isset($_SESSION['admin_id']))
        header("location:admin_login.php");
    
    include "../general/dbconnect.php";
    
    
    $query="select * from complaint order by c_id asc";
    $result=mysqli_query($conn,$query);  
    ?>

  <title>View Complaints</title>

  <link rel="stylesheet" type="text/css" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/css/bootstrap.min.css">
  <link rel="stylesheet" type="text/css"
    href="https://maxcdn.bootstrapcdn.com/font-awesome/4.4.0/css/font-awesome.min.css">
  <link href="http://fonts.googleapis.com/css?family=Lato:300,400,700,300italic,400italic,700italic" rel="stylesheet"
    type="text/css">
  <link rel="stylesheet" href="../general/index.css">
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
          <li class="active"><a href="admin_complaints.php">View Complaints</a></li>
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
          <th scope="col">User Id</th>
          <th scope="col">User Adhar</th>
          <th scope="col">User Name</th>
          <th scope="col">Complainant</th>
          <th scope="col">Contact</th>
          <th scope="col">Time Stamp</th>
          <th scope="col">State</th>
          <th scope="col">District</th>
          <th scope="col">Type of Crime</th>
          <th scope="col">Date of Crime</th>
          <th scope="col">Description</th>
          <th scope="col">Status</th>
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
            <?php echo $rows['uid']; ?>
          </td>
          <td style="text-wrap: normal; word-wrap: break-word;">
            <?php echo $rows['u_adhar']; ?>
          </td>
          <td>
            <?php echo $rows['u_name']; ?>
          </td>
          <td>
            <?php echo $rows['cpl_name']; ?>
          </td>
          <td>
            <?php echo $rows['cpl_number']; ?>
          </td>
          <td>
            <?php echo $rows['time_stamp']; ?>
          </td>
          <td>
            <?php echo $rows['location_state']; ?>
          </td>
          <td>
            <?php echo $rows['location_district']; ?>
          </td>
          <td>
            <?php echo $rows['type_crime']; ?>
          </td>
          <td>
            <?php echo $rows['d_o_c']; ?>
          </td>
          <td>
            <button class="w-full inline-flex justify-center align-center rounded-md border border-transparent shadow-sm px-4 py-2 bg-blue-500 text-base font-medium text-white hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500 sm:ml-3 sm:w-auto sm:text-sm" onclick="showDescription1(this)">View Description</button>
            <p style="display:none;"><?php echo ($rows['description']); ?></p>
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
            <button id="hel" class="w-full inline-flex justify-center rounded-md border border-transparent shadow-sm px-4 py-2 bg-blue-500 text-base font-medium text-white hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500 sm:ml-3 sm:w-auto sm:text-sm" onclick="showDescription(this)">View Status</button>
            <p style="display:none;"><?php echo ($fir_data); ?></p>
            <p style="display:none;"><?php echo ($ipc_sections); ?></p>
          </td>
        </tr>
      </tbody>

      <?php
    } 
    ?>

    </table>
  </div>
  <?php

    include "../general/popup_window1.php";
    include "../general/popup_window.php";
    include "../general/footer.php";
  ?>

  <script>
   
  </script>
  
  <script src="../general/index3.js"></script>
  <script type="text/javascript" src="https://code.jquery.com/jquery-2.1.4.js"></script>
  <script type="text/javascript" src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/js/bootstrap.min.js"></script>
</body>

</html>