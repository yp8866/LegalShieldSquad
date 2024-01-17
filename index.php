<!DOCTYPE html>
<html>

<head>

  <title>Legal_Shield_Squad</title>
  <link rel="stylesheet" type="text/css" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/css/bootstrap.min.css">
  <link rel="stylesheet" type="text/css"
    href="https://maxcdn.bootstrapcdn.com/font-awesome/4.4.0/css/font-awesome.min.css">
  <link href="http://fonts.googleapis.com/css?family=Lato:300,400,700,300italic,400italic,700italic" rel="stylesheet"
    type="text/css">
  <link rel="stylesheet" type="text/css" href="home.css">
  <style>
    body {
      background-size: cover;
      background-image: url(./images/home.jpg);
      background-position: center;
    }

    body,
    html {
      width: 100%;
      height: 100%;
      font-family: "Lato";
      color: white;
    }

    h1 {
      font-weight: 700;
      font-size: 5em;
    }


    .content {
      padding-top: 25%;
      text-align: center;
      text-shadow: 0px 4px 3px rgba(0, 0, 0, 0.4),
        0px 8px 13px rgba(0, 0, 0, 0.1),
        0px 18px 23px rgba(0, 0, 0, 0.1);
    }

    hr {
      width: 250px;
      border-top: 1px solid #f8f8f8;
      border-bottom: 1px solid rgba(0, 0, 0, 0.2);
    }

    .hover-hand:hover {
            color: blue;
        }
  </style>

</head>

<body>


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
        <a class="navbar-brand" href="index.php"><b>Legal_Shield_Squad</b></a>
      </div>
      <div id="navbar" class="collapse navbar-collapse">
        <ul class="nav navbar-nav">
          <li class="active"><a href="index.php">Home</a></li>
        </ul>
        <ul class="nav navbar-nav navbar-right">
          
          <li><a href="./user/user_login.php">User Login <i class="fa fa-user"></i></a></li>
          <li><a href="./admin/admin_login.php">Admin Login <i class="fa fa-user"></i></a></li>
        </ul>
      </div>
    </div>
  </nav>

  <div class="container">
    <div class="row">
      <div class="col-lg-12">
        <div class="content">
          <h1>Have a Complaint ?</h1>
          <h3>Register Below &nbsp &nbsp<i class="fa fa-hand-o-down hover-hand" aria-hidden="true"></i></h3>
          <hr>
          <a href="./user/user_registration.php" class="btn btn-default btn-lg" role="button" aria-pressed="true">Sign
            Up!</a>
        </div>
      </div>
    </div>
  </div>

  <?php
    include "./general/footer.php";
  ?>

  <script type="text/javascript" src="https://code.jquery.com/jquery-2.1.4.js"></script>
  <script type="text/javascript" src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/js/bootstrap.min.js"></script>

</body>

</html>