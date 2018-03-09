<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <title>Login</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href='https://fonts.googleapis.com/css?family=Lobster' rel='stylesheet' type='text/css'>
    <link href='https://fonts.googleapis.com/css?family=Open+Sans' rel='stylesheet' type='text/css'>
    <link rel="stylesheet" href="css/bootstrap.min.css" />
    <link rel="stylesheet" href="css/captions.css" />
    <link rel="stylesheet" href="css/bootstrap-theme.css" />    
    <link rel="stylesheet" href="css/myown.css" /> 
</head>
<body>
    <?php include 'includes/header.inc.php'; 
      include 'includes/config.inc.php'; 
      $userdb = new UsersGateway($connection); 
      $sql = "SELECT Salt FROM UsersLogin WHERE UserName = 'patrick.gray@aol.com'"; 
      $row = $userdb->testFind($sql); 
      $saltTest = "$row[Salt]"; 
      $trytest = "abcd1234";
      $trytest .= $saltTest;
      //$saltTest .= "abcd1234";
      //$saltTest = md5($saltTest);
      $trytest = md5($trytest);
      //echo "$saltTest";
      echo "$trytest";
      ?>
    
    <!-- Page Content -->
    
    <main class="container">
            <div class="row">
                <div class="col-md-offset-5 col-md-3">
                    <div class="form-login">
                        <h3 class="navbar-brand">Welcome back.</h3>
                        <input type="text" id="userName" class="form-control input chat-input" placeholder="username" />
                        </br>
                        <input type="text" id="userPassword" class="form-control input chat-input" placeholder="password" />
                        </br>
                        <div class="wrapper">
                            <span class="group-btn">     
                            <a href="#" class="btn btn-primary btn-md">login <i class="fa fa-sign-in"></i></a>
                            </span>
                        </div>
                    </div>
                </div>
            </div>
    </main>
    
    
        <script src="https://code.jquery.com/jquery-2.2.4.min.js" integrity="sha256-BbhdlvQf/xTY9gja0Dq3HiwQF8LaCRTXxZKRutelT44=" crossorigin="anonymous"></script>
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js" integrity="sha384-0mSbJDEHialfmuBBQP6A4Qrprq5OVfW37PRR3j5ELqxss1yVqOtnepnHVP9aJ7xS" crossorigin="anonymous"></script>
</body>

</html>