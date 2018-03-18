<!DOCTYPE html>
<html lang="en">
<?php if(!isset($_COOKIE['Success'])) { header("location: login.php"); } ?>
<head>
    <meta charset="utf-8">
    <title>Main Page</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href='https://fonts.googleapis.com/css?family=Lobster' rel='stylesheet' type='text/css'>
    <link href="https://fonts.googleapis.com/css?family=Raleway" rel="stylesheet" type='text/css'>
    <link href='https://fonts.googleapis.com/css?family=Open+Sans' rel='stylesheet' type='text/css'>
    <link href="https://fonts.googleapis.com/css?family=Josefin+Sans" rel="stylesheet" type='text/css'>
    <!--<link rel="stylesheet" href="css/bootstrap.min.css" />-->
    <link rel="stylesheet" href="css/as2.min.css" />
    <link rel="stylesheet" href="css/captions.css" />
    <link rel="stylesheet" href="css/bootstrap-theme.css" />    
    <link rel="stylesheet" href="css/myown.css"/>
</head>

<body>
    <?php include 'includes/header.inc.php';?>
    <!-- Page Content -->
    <main class="container-fluid">
        <div class="row">
                <div class="card col-sm-3">
                     <a href="images/misc/home_countries.jpg"><img src="images/misc/home_countries.jpg"  alt="countries"></a>
                     <h4>Countries</h4>
                     <p>See all countries for which we have images.</p>
                     <hr>
                     <p><a href="browse-countries.php">View Countries</a></p> <!-- ($pdo) ?>-->
                 </div>
              
                  
                 <div class="card col-sm-3">
                     <a href="images/misc/home_image.jpg"><img src="images/misc/home_images.jpg"  alt="images"></a>
                     <h4>Images</h4>
                     <p>See all countries for which we have images.</p>
                     <hr>
                     <p><a href="browse-images.php">View Images</a></p>
                  </div>
                  
                 <div class="card col-sm-3">
                     <a href="images/misc/home_users.jpg"><img src="images/misc/home_users.jpg"  alt="users"></a>
                     <h4>Users</h4>
                     <p>See information about our contributing users.</p>
                     <hr>
                     <p><a href="browse-users.php">View Users</a></p>
                  </div>
                  
           </div>
    </main>
    <?php include 'includes/footer.inc.php'; ?>
        <script src="https://code.jquery.com/jquery-2.2.4.min.js" integrity="sha256-BbhdlvQf/xTY9gja0Dq3HiwQF8LaCRTXxZKRutelT44=" crossorigin="anonymous"></script>
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js" integrity="sha384-0mSbJDEHialfmuBBQP6A4Qrprq5OVfW37PRR3j5ELqxss1yVqOtnepnHVP9aJ7xS" crossorigin="anonymous"></script>
</body>

</html>