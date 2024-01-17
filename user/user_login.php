<!DOCTYPE html>
<html>

<head>
  <?php

    
if(isset($_POST['s']))
{
  include "../general/dbconnect.php";
    
    
    if($_SERVER["REQUEST_METHOD"]=="POST")
    {
        $name=$_POST['email'];
        $pass=$_POST['password'];
        $u_id=$_POST['email'];
        
        
        $result=mysqli_query($conn,"SELECT u_id,u_pass FROM user where u_id='$name'");
       
          
   
        
        if(!$result || mysqli_num_rows($result)==0)
        {
          $message = "Id or Password not Matched.";
          echo "<script type='text/javascript'>alert('$message');</script>";
          
             
        }
        else 
        {
          $temp=mysqli_fetch_assoc($result);
          $hash=$temp['u_pass'];
          if(!password_verify($pass, $hash)){
            $message = "Id or Password not Matched.";
            echo "<script type='text/javascript'>alert('$message');</script>";
          }
          else{
            session_start();
            $_SESSION['u_id']=$u_id;
            $_SESSION['x']=1;
            header("location:user_interface.php");
          }
          
          
        }
    }                
}
?>
  <link rel="stylesheet" type="text/css" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/css/bootstrap.min.css">
  <link rel="stylesheet" type="text/css"
    href="https://maxcdn.bootstrapcdn.com/font-awesome/4.4.0/css/font-awesome.min.css">
  <link href="http://fonts.googleapis.com/css?family=Lato:300,400,700,300italic,400italic,700italic" rel="stylesheet"
    type="text/css">
  <link href="user_interface.css" rel="stylesheet" type="text/css" media="all" />
  <link rel="stylesheet" crossorigin href="../general/index.css">


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

  <title>User Login</title>
</head>

<body style="background-size: cover;
    background-image: url(../images/regi_bg.jpeg);
    background-position: center;">
  <nav class="navbar navbar-default navbar-fixed-top" style="height: 60px;">
    <div class="container">
      <div class="navbar-header">

        <a class="navbar-brand" href="../index.php" style="margin-top: 5%;"><b>Legal_Shield_Squad</b></a>
      </div>
      <div id="navbar" class="collapse navbar-collapse">
        <ul class="nav navbar-nav">
          <li class="active" style="margin-top: 5%;"><a href="user_login.php">User Login</a></li>
        </ul>


      </div>
    </div>
  </nav>

  <!--  -->
  <!-- <div align="center">
    <div class="form" style="margin-top: 15%">
      <form method="post">
        <div class="form-group" style="width: 30%">
          <label for="exampleInputEmail1">
            <h1 style="color: #fff;">User Id</h1>
          </label>
          <input type="email" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" size="5"
            placeholder="Enter Email id" required name="email" onfocusout="f1()">
        </div>
        <div class="form-group" style="width:30%">
          <label for="exampleInputPassword1">
            <h1 style="color: #fff;">Password</h1>
          </label>
          <input type="password" class="form-control" id="exampleInputPassword1" placeholder="Password" required
            name="password" onfocusout="f1()">
        </div>

        <button type="submit" class="btn btn-primary" name="s" onclick="f1()">Submit</button>
      </form>
    </div>
  </div> -->
  <!--  -->

  <section class="flex h-5/6 justify-center items-center mt-10">
    <div class="w-full  rounded-lg shadow dark:border md:mt-0 sm:max-w-md xl:p-0 bg-black/60 border border-black">
      <div class="p-6 space-y-4 md:space-y-6 sm:p-8 mt-10">
        <h1
          class="text-xl font-bold text-center leading-tight tracking-tight text-white-900 md:text-2xl dark:text-white">
          Log in
        </h1>
        <form class="space-y-4 md:space-y-6 " method="post">
          <div>
            <label for="email" class="block mb-2 text-sm font-medium text-white">Your
              E-mail</label>
            <!-- <input type="email" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" size="5"
          placeholder="Enter Email id" required name="email" onfocusout="f1()"> -->
            <input type="email" name="email" id="exampleInputEmail1"
              class=" border bg-black/70 text-white sm:text-sm rounded-lg focus:ring-blue-600 focus:border-blue-600 block w-full p-2.5   border-white"
              placeholder="example@gmail.com" required="" name="email" onfocusout="f1()">
          </div>
          <div>
            <label for="password" class="block mb-2 text-sm font-medium text-white">Password</label>
            <!-- <input type="password" class="form-control" id="exampleInputPassword1" placeholder="Password" required
            name="password" onfocusout="f1()"> -->
            <input type="password" name="password" id="exampleInputPassword1" placeholder="Password"
              class="bg-black/80 border sm:text-sm rounded-lg focus:ring-blue-600 focus:border-blue-600 block w-full p-2.5   border-white text-white"
              required="" onfocusout="f1()">
          </div>
          <!-- <button type="submit" class="btn btn-primary" name="s" onclick="f1()">Submit</button> -->
          <button type="submit" name="s" onclick="f1()"
            class="w-full text-white bg-blue-600 hover:bg-blue-700 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">Sign
            in</button>
          </form>
      </div>
    </div>
    </div>
  </section>

  <?php
  include "../general/footer.php";
?>

</body>

</html>