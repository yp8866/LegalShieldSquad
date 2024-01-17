<!DOCTYPE html>
<html>

<head>
  <link rel="stylesheet" type="text/css" href="bootstrap.css">
  <link rel="stylesheet" type="text/css" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/css/bootstrap.min.css">
  <link rel="stylesheet" type="text/css"
    href="https://maxcdn.bootstrapcdn.com/font-awesome/4.4.0/css/font-awesome.min.css">
  <link href="http://fonts.googleapis.com/css?family=Lato:300,400,700,300italic,400italic,700italic" rel="stylesheet"
    type="text/css">
  <title>Admin Login</title>
  <?php

  if(isset($_POST['s']))
{
    
  include "../general/dbconnect.php";
    
    
    if($_SERVER["REQUEST_METHOD"]=="POST")
    {
        $name=$_POST['email'];
        $pass=$_POST['password'];
        $result=mysqli_query($conn,"SELECT adminid,password FROM admin where adminid='$name'");
        if(!$result || mysqli_num_rows($result)==0)
        {
            $message = "Id or Password not Matched.";
            echo "<script type='text/javascript'>alert('$message');</script>";
          }
          else 
          {
            $temp=mysqli_fetch_assoc($result);
            $hash=$temp['password'];
            // echo "<script type='text/javascript'>alert('$hash');</script>";

          if(!password_verify($pass, $hash)){
            $message = "Id or Password not Matched.";
            echo "<script type='text/javascript'>alert('$message');</script>";
          }
          else{
            session_start();
            $_SESSION['x']=1;
            $_SESSION['admin_id']=$name;       
            header("location:admin_interface.php");
          }
            
        }
    }                
}
?>

  <script>
    function f1() {

      var sta2 = document.getElementById("exampleInputEmail1").value;
      var sta3 = document.getElementById("exampleInputPassword1").value;
      var x2 = sta2.indexOf(' ');
      var x3 = sta3.indexOf(' ');
      if (sta2 != "" && x2 >= 0) {
        document.getElementById("exampleInputEmail1").value = "";
        document.getElementById("exampleInputEmail1").focus();
        alert("Space Not Allowed");
      }
      else if (sta3 != "" && x3 >= 0) {
        document.getElementById("exampleInputPassword1").value = "";
        document.getElementById("exampleInputPassword1").focus();
        alert("Space Not Allowed");
      }

    }
  </script>


</head>

<body
  style="color: black; background-image: url(../images/locker.jpeg); background-size: cover; background-position: center;">
  <nav class="navbar navbar-default navbar-fixed-top">
    <div class="container">
      <div class="navbar-header">
        <a class="navbar-brand" href="../index.php"><b>Legal_Shield_Squad</b></a>
      </div>
      <div id="navbar" class="collapse navbar-collapse">
        <ul class="nav navbar-nav">

          <li class="active"><a href="admin_login.php">Admin Login</a></li>
        </ul>
      </div>
    </div>
  </nav>
  <div align="center">
    <div class="form" style="margin-top: 15%">
      <form method="post">
        <div class="form-group" style="width: 30%">
          <label for="exampleInputEmail1">
            <h1 style="color:white">Admin Id</h1>
          </label>
          <input type="text" name="email" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp"
            size="5" placeholder="Enter user id" required onfocusout="f1()">
        </div>
        <div class="form-group" style="width:30%">
          <label for="exampleInputPassword1">
            <h1 style="color:white">Password</h1>
          </label>
          <input type="password" name="password" class="form-control" id="exampleInputPassword1" placeholder="Password"
            required onfocusout="f1()">
        </div>


        <button type="submit" class="btn btn-primary" name="s">Submit</button>
      </form>
    </div>
  </div>
  <?php
    include "../general/footer.php";
  ?>


</body>

</html>