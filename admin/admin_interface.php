<!DOCTYPE html>
<html>

<head>

  <?php
    session_start();
    if(!isset($_SESSION['x'])||!isset($_SESSION['admin_id']))
        header("location:admin_login.php");
    
        include "../general/dbconnect.php";
    
    $admin_id=$_SESSION['admin_id'];
    $result1=mysqli_query($conn,"SELECT name FROM admin where adminid='$admin_id' ");
    $q2=mysqli_fetch_assoc($result1);
    $admin_name=$q2['name'];
    
    
    
    
        
?>

  <title>Admin Homepage</title>
  <link rel="stylesheet" type="text/css" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/css/bootstrap.min.css">
  <link rel="stylesheet" type="text/css"
    href="https://maxcdn.bootstrapcdn.com/font-awesome/4.4.0/css/font-awesome.min.css">
  <link href="http://fonts.googleapis.com/css?family=Lato:300,400,700,300italic,400italic,700italic" rel="stylesheet"
    type="text/css">

</head>

<body style="background-image: url(../images/search1.jpeg); ">
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
          <li class="active"><a><b>
                <?php echo "$admin_name" ?>
              </b></a></li>
          <li><a href="admin_complaints.php">View Complaints</a></li>

          <li><a href="alogout.php">Logout &nbsp <i class="fa fa-sign-out" aria-hidden="true"></i></a></li>
        </ul>
      </div>
    </div>
  </nav>

  <div>
    <div class="container">
      <hr> <br><br> <br><br> <br><br> <br><br> <br><br>
      <div class="row text-center">

        <div class="col-md-6 col-sm-12 hero-feature">
          <div class="thumbnail">
            <div class="caption">
              <h3>View Complaints</h3>
              <p>
                <a href="admin_complaints.php" class="btn btn-primary">View Complaints</a>
              </p>
            </div>
          </div>
        </div>

        <div class="col-md-6 col-sm-12 hero-feature">
          <div class="thumbnail">
            <div class="caption">
              <h3>Update Complaints</h3>
              <p>
                <a href="admin_update_complaints.php" class="btn btn-primary">Update Complaints</a>
              </p>
            </div>
          </div>
        </div>


      </div>

      <?php
        include "../general/footer.php";
      ?>


      <script type="text/javascript" src="https://code.jquery.com/jquery-2.1.4.js"></script>
      <script type="text/javascript" src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/js/bootstrap.min.js"></script>
</body>

</html>