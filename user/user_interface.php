<!DOCTYPE html>
<html>

<?php
session_start();
    if(!isset($_SESSION['x']) || !isset($_SESSION['u_id']))
        header("location:user_login.php");
    
    
        include "../general/dbconnect.php";
    
    
        $u_id=$_SESSION['u_id'];
        
        $result=mysqli_query($conn,"SELECT a_no FROM user where u_id='$u_id' ");
        $q2=mysqli_fetch_assoc($result);
        $a_no=$q2['a_no'];
    
        $result1=mysqli_query($conn,"SELECT u_name FROM user where u_id='$u_id' ");
        $q2=mysqli_fetch_assoc($result1);
        $u_name=$q2['u_name'];
    
    
if(isset($_POST['s'])){
    if($_SERVER["REQUEST_METHOD"]=="POST")
    {
        // $u_id,$a_no,$u_name,
        // $cpl_name,$cpl_number,$location_state,$location_dist,$type_crime,$d_o_c,$description, form submit name-s
        
        $cpl_name=$_POST['cpl_name'];
        $cpl_number=$_POST['cpl_number'];
        $location_state=$_POST['location_state'];
        $location_dist=$_POST['location_dist'];
        $type_crime=$_POST['type_crime'];
        $otherCrime=$_POST['otherCrime'];
        $d_o_c=$_POST['d_o_c'];
        $description=$_POST['description'];
        
        $var=strtotime(date("Ymd"))-strtotime($d_o_c);
        
        if($type_crime == 'other'){
          $type_crime = $otherCrime;  
        }
        
    if($var>=0)
    {

      
      if(strlen($description) >=100){

      

        
        // inserting into complaint table
        $comp="INSERT into complaint(uid,u_adhar,u_name,cpl_name,cpl_number,location_state,location_district,type_crime,d_o_c,description) values('$u_id','$a_no','$u_name','$cpl_name','$cpl_number','$location_state','$location_dist','$type_crime','$d_o_c','$description')";        
        $res=mysqli_query($conn,$comp);
        
        if(!$res)
        {
          $message1 = "Complaint already filed";
          echo "<script type='text/javascript'>alert('$message1');</script>";
        }
        else
        {

          // inserting into fir table
          $res=mysqli_query($conn,"SELECT c_id FROM complaint where uid='$u_id' ");
          $c_id=0;
          while($q2=mysqli_fetch_assoc($res)){
            $c_id=$q2['c_id'];
          }
          $firr="INSERT into fir (uid,cid) values('$u_id','$c_id')";

          $res2= mysqli_query($conn,$firr);

          if($res2){
            $message = "Complaint Registered Successfully with cid ".$c_id;
            echo "<script type='text/javascript'>alert('$message');</script>";
          }
          else{
            $message = "Complaint Registered Successfully But not in Complaint Database";
            echo "<script type='text/javascript'>alert('$message');</script>";
          }
        }
      }
      else{
        $message3 = "Description should be atleast 100 characters.";
        echo "<script type='text/javascript'>alert('$message3');</script>";
      }
    }
    else
    {
     $message = "Enter Valid Date";
      echo "<script type='text/javascript'>alert('$message');</script>";
    }
  }
}
?>

<script>
  var isPressed=false;
  function f1() {
      
    // var sta1 = document.getElementById("description").value;
    
    var sta2 = document.getElementById("cpl_name").value;
    var x2 = sta2.trim();

    var sta3 = document.getElementById("cpl_number").value;
    var x3 = sta3.trim();
    var mobileNumberPattern = /^\d{10}$/;

    var sta4 = document.getElementById("location_state").value;
    var sta6 = document.getElementById("location_dist").value;

    var sta5 = document.getElementById("type_crime").value;

    if (sta2 == "" || (sta2 != "" && x2 == "")) {
      document.getElementById("cpl_name").value = "";
      document.getElementById("cpl_name").focus();
      alert("Enter Valid Name");
      return 0;
    }
    else if (!mobileNumberPattern.test(sta3)) {
      document.getElementById("cpl_number").value = "";
      document.getElementById("cpl_number").focus();
      alert("Enter Valid Number");
      return 0;
    }
    else if (sta4 == "") {
      document.getElementById("location_state").value = "";
      document.getElementById("location_state").focus();
      alert("Select Valid State");
      return 0;
    }
    else if (sta6 == "") {
      document.getElementById("location_dist").value = "";
      document.getElementById("location_dist").focus();
      alert("Select Valid District");
      return 0;
    }

    else if(sta5 == "") {
      document.getElementById("type_crime").value = "";
      document.getElementById("type_crime").focus();
      alert("Select Valid Type of Crime");
      return 0;
    }
    else if(sta5 == "other" && document.getElementById("otherCrime").value == "") {
      document.getElementById("otherCrime").value = "";
      document.getElementById("otherCrime").focus();
      alert("Enter Other Type of Crime");
      return 0;
    }
    // else if(sta1=="" || sta1.length <100){
    //   // document.getElementById("otherCrime").value = "";
    //   document.getElementById("description").focus();
    //   alert("Enter valid description of atleat 100 words..");
    //   return 0;
    // }
 
    return 1;
  }
</script>

<head>
  <title>User Home Page</title>

  <link rel="stylesheet" type="text/css" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/css/bootstrap.min.css">

  <link rel="stylesheet" type="text/css"
    href="https://maxcdn.bootstrapcdn.com/font-awesome/4.4.0/css/font-awesome.min.css">

  <link href="http://fonts.googleapis.com/css?family=Lato:300,400,700,300italic,400italic,700italic" rel="stylesheet"
    type="text/css">

  <link href="./user_interface.css" rel="stylesheet" type="text/css" media="all" />
  <link rel="stylesheet" crossorigin href="../general/index.css">
  <style>
    .selected{
      border-color: green;
    }
    *:disabled{
     cursor: not-allowed! important;
           opacity: 0.6;
    }
  </style>

</head>

<body style="background-size: cover;
    background-image: url(../images/bg-home.jpg);
    background-position: center;">
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
        <a class="navbar-brand" href="ulogout.php"><b>Legal_Shield_Squad</b></a>
      </div>
      <div id="navbar" class="collapse navbar-collapse">
        <ul class="nav navbar-nav">
          <li><a href="ulogout.php">User Login</a></li>
          <li class="active"><a href="user_interface.php">User Home</a></li>
        </ul>

        <ul class="nav navbar-nav navbar-right">
          <li class="active"><a href="user_interface.php">Log New Complain</a></li>
          <li><a href="user_complain_history.php">Complaint History</a></li>
          <li><a href="ulogout.php">Logout &nbsp <i class="fa fa-sign-out" aria-hidden="true"></i></a></li>
        </ul>
      </div>
    </div>
  </nav>

  <section class="flex  flex-col items-center justify-center">
        <div style="margin-top: 100px;" class="text-3xl text-center font-semibold font-sans pt-6 text-white">Enter Your
            Complaint Here</div>
        <!-- $cpl_name,$cpl_number,$location_state,$location_dist,$type_crime,$d_o_c,$description, form submit name-s -->
        <form method="post" id="cplform" class="my-10 rounded-2xl py-3 px-8 w-[64rem] bg-black/60 border border-black">
            <div class="space-y-12">
                <div class="border-b border-white pb-12">

                    <div class="mt-10 grid grid-cols-1 gap-x-6 gap-y-8 sm:grid-cols-6">
                        <div class="flex   col-start-1 col-end-7">

                            <div class="w-1/2 ">
                                <label for="username"
                                    class="block font-medium leading-6 text-lg text-white">Name</label>
                                <div class="mt-2">
                                    <div
                                        class=" bg-black/80 flex rounded-md shadow-sm ring-1 ring-inset ring-white focus-within:ring-2 focus-within:ring-inset focus-within:ring-indigo-600 sm:max-w-md">
                                        <input type="text" name="cpl_name" id="cpl_name" autocomplete="username"
                                            class="block flex-1 border-0 bg-transparent py-1.5 pl-1 text-white focus:ring-0 sm:text-sm sm:leading-6 "
                                            placeholder="Your name" required="">
                                    </div>
                                </div>
                            </div>
                            <div class="w-1/2">
                                <label for="username"
                                    class="block font-medium leading-6 text-lg text-white">Phone No.</label>
                                <div class="mt-2">
                                    <div
                                        class="bg-black/80 flex rounded-md shadow-sm ring-1 ring-inset ring-white focus-within:ring-2 focus-within:ring-inset focus-within:ring-indigo-600 sm:max-w-md">
                                        <input type="number" name="cpl_number" id="cpl_number"  autocomplete="username"
                                            class="block flex-1 border-0 bg-transparent py-1.5 pl-1 text-white focus:ring-0 sm:text-sm sm:leading-6 [appearance:textfield] [&::-webkit-outer-spin-button]:appearance-none [&::-webkit-inner-spin-button]:appearance-none"
                                            placeholder="Your Ph. no." required="">
                                    </div>
                                </div>
                            </div>

                        </div>

                        <p class="leading-6 col-span-full text-xl font-semibold text-white -mb-8 ">Location <span style="color: gray;" >( Of Crime )</span></p>
                        <div class="col-span-full flex justify-between">
                            <select id="location_state" name="location_state"  class="text-lg py-2.5 px-0 w-1/6  text-white bg-transparent border-0 border-b-2 border-gray-200 appearance-none focus:outline-none focus:ring-0 focus:border-gray-200 peer">
                                    <option  value="">State</option>                                
                                    <option  value="Rajasthan">Rajasthan</option>                                
                                    <option  value="Punjab">Punjab</option>                                
                            </select>
                            <select name="location_dist" id="location_dist" class=" py-2.5 px-0 w-1/6 text-lg text-white bg-transparent border-0 border-b-2 border-gray-200 appearance-none focus:outline-none focus:ring-0 focus:border-gray-200 peer">
                                <option value="">District</option>
                                <option value="">Select a State</option>
                            </select>
                            <input id="datePicker"  class="rounded-md bg-transparent border text-white font-bold px-2" type="date" name="d_o_c" id="d_o_c" required="">
                            <select id="type_crime" name="type_crime" class=" py-2.5 px-0 w-1/6 text-lg text-white bg-transparent border-0 border-b-2 border-gray-200 appearance-none focus:outline-none focus:ring-0 focus:border-gray-200 peer" required>
                                <option value="">Type of crime</option>
                                <option value="other">Other</option>
                            </select>
                        </div>
                        
                        <input type="text" id="otherCrime" name="otherCrime" placeholder="Specify-crime" class="hidden transition-all col-start-5 rounded-md placeholder:text-slate-300 col-end-7 border bg-transparent py-1.5 pl-1 text-white focus:ring-0 sm:text-sm sm:leading-6 ">

                      

                        <div class="col-start-1 col-end-6">
                            <label for="cover-photo" class=" block text-white font-medium leading-6">Upload
                                Image</label>
                            <input aria-describedby="user_avatar_help" type="file" id="inputFile" onchange="inputValid()"
                                class="text-sm text-white leading-6  mt-2 flex justify-center rounded-lg border-2 border-dashed border-white  w-full py-10 px-72">
                                <button id="ocrButton" title="upload image to Perform OCR" class="mt-4 block m-auto rounded-md bg-indigo-600 px-3 py-2  text-sm font-semibold text-white shadow-sm hover:bg-indigo-500 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-indigo-600" >Perforn OCR</button>
                        </div>
                        <div class="flex justify-start gap-8 items-center flex-col">
                            <p class="text-white font-medium">Speech-to-Text</p>
                            <button id="voice" class="hover:border-dashed p-4 rounded-full border text-white font-semibold hover:bg-indigo-600  transition-all "><img class="invert " src="data:image/svg+xml,%3csvg%20xmlns='http://www.w3.org/2000/svg'%20height='24'%20viewBox='0%20-960%20960%20960'%20width='24'%3e%3cpath%20d='M680-560q-33%200-56.5-23T600-640v-160q0-34%2023.5-57t56.5-23q34%200%2057%2023t23%2057v160q0%2034-23%2057t-57%2023ZM200-80q-33%200-56.5-23.5T120-160v-640q0-33%2023.5-56.5T200-880h320v80H200v640h440v-80h80v80q0%2033-23.5%2056.5T640-80H200Zm80-160v-80h280v80H280Zm0-120v-80h200v80H280Zm440%2040h-80v-104q-77-14-128.5-74.5T460-640h80q0%2058%2041%2099t99%2041q59%200%2099.5-41t40.5-99h80q0%2081-51%20141.5T720-424v104Z'/%3e%3c/svg%3e" alt=""></button>

                        </div>
                       

                        <div class="col-span-full">
                            <label for="about" class="text-lg text-white block  font-medium leading-6 " required="">Description</label>
                            <div class="mt-2">
                                <textarea id="description" name="description" rows="8" cols="12" placeholder="write here"                             
                                    class="p-6 block w-full ring-white rounded-md border-0 py-1.5 shadow-sm ring-1 ring-inset focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6 bg-black/60 text-white"></textarea>
                                    <button id="translateButton" title="Rember to Translate,before submit" class="mt-4 block m-auto rounded-md bg-indigo-600 px-3 py-2  text-sm font-semibold text-white shadow-sm hover:bg-indigo-500 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-indigo-600" >Translate</button>
                            </div>
                        </div>
                        <!-- <div>
                          <p class="text-white mb-5" style="margin-bottom: 1rem;" >Language of Description</p>
                          <select id="languageSelect"class=" py-2.5 px-0 w-full text-lg text-white bg-transparent border-0 border-b-2 border-gray-200 appearance-none focus:outline-none focus:ring-0 focus:border-gray-200 peer">
                            <option value="en-US">English</option>
                            <option value="hi-IN">Hindi</option>
                          </select>
                        </div>   -->
                                             
                    </div>
                </div>
            </div>

            <div class="mt-6 flex items-center justify-end gap-x-6">
                <input type="reset" id="cancel"
                    class=" text-sm font-semibold leading-6 text-white border py-1 rounded-lg px-3" value="Cancel">
                <input type="submit" id="submitbtn" name="s" value="Submit" onclick="f1()" disabled title="Translate before submission"
                    class="rounded-md bg-indigo-600 px-3 py-2 text-sm font-semibold text-white shadow-sm hover:bg-indigo-500 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-indigo-600">
            </div>
        </form>
    </section>
 
  <?php
    include "../general/footer.php";
  ?>
  
  <script src="../general/index.js"></script>
  <!-- <script src="../general/index3.js"></script> -->
  <script type="text/javascript" src="https://code.jquery.com/jquery-2.1.4.js"></script>
  <script type="text/javascript" src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/js/bootstrap.min.js"></script>
</body>

</html>