<?php
    if(!isset($_COOKIE['Success'])) { header("location: login.php"); } 
    include 'includes/config.inc.php';
    $postsDB = new PostsGateway($connection);
    if(!isset($_GET['id']) || empty($_GET['id']))
    {
      header('Location:error.php');
    }
    else if((isset($_GET['id']) && !empty($_GET['id'])) && !$postsDB->IDExists($_GET['id']))
    {
       header('Location:error.php?error=invalidID'); 
    }
    else
    {
       $row = $postsDB->findByID($_GET['id']);
    }
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <title><?php echo $row['Title']; ?></title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href='https://fonts.googleapis.com/css?family=Lobster' rel='stylesheet' type='text/css'>
    <link href='https://fonts.googleapis.com/css?family=Open+Sans' rel='stylesheet' type='text/css'>
    <link rel="stylesheet" href="css/bootstrap.min.css" />
    <link rel="stylesheet" href="css/captions.css" />
    <link rel="stylesheet" href="css/bootstrap-theme.css" />    
    <link rel="stylesheet" href="css/myown.css"/>
    <link href="carousel.css" rel="stylesheet">
</head>

<body>
    <?php include 'includes/header.inc.php';?>
    <?php $results = $postsDB->getRelatedPostImages($_GET['id']); ?>
    <!-- Page Content -->
    <main class="container">
        <div class="row">
            <div class="col-md-10">
                <div class="row">
                    <h1><?php echo $row['Title'];?></h1>
                       <!-- Carousel  -->
    <div id="myCarousel" class="carousel slide" data-ride="carousel">
      <!-- Indicators -->
      <ol class="carousel-indicators">
        <li data-target="#myCarousel" data-slide-to="0" class="active"></li>
        <?php $picsRelatedCount = sizeOf($results) + 1; 
        for($i=1;$i<$picsRelatedCount;$i++){?>
        <li data-target="#myCarousel" data-slide-to=<?php echo $i; ?>></li>
        <?php } ?>
      </ol>
      
      <div class="carousel-inner" role="listbox">
        <div class="item active">
          <img src='images/medium/<?php echo $row['Path']; ?>' alt=<?php echo $row['Title']; ?>>
          <div class="container">
            <div class="carousel-caption">
              <h1><?php echo $row['MainImageTitle']; ?></h1>
              <p><a class="btn btn-sm btn-primary" role="button" href="single-image.php?id=<?php echo $row['MainPostImage']; ?>">Learn More</a></p>
            </div>
          </div>
        </div>
        
        <?php foreach ($results AS $pic) { ?>
        <div class="item">
          <img src='images/medium/<?php echo $pic['Path']; ?>' alt=<?php echo $pic['Title']; ?>>
          <div class="container">
            <div class="carousel-caption">
              <h1><?php echo $pic['Title']; ?></h1>
              <p><a class="btn btn-sm btn-primary" role="button" href="single-image.php?id=<?php echo $pic['ImageID']; ?>">Learn More</a></p>
            </div>
          </div>
        </div>
        <?php } ?>
      </div>
      <a class="left carousel-control" href="#myCarousel" role="button" data-slide="prev">
        <span class="glyphicon glyphicon-chevron-left"></span>
        <span class="sr-only">Previous</span>
      </a>
      <a class="right carousel-control" href="#myCarousel" role="button" data-slide="next">
        <span class="glyphicon glyphicon-chevron-right"></span>
        <span class="sr-only">Next</span>
      </a>
    </div><!-- Carousel end -->
                
                    <h6>Posted by: <a href="single-user.php?id=<?php echo $row['UserID'];?>"><?php echo $row['FullName'];?></a></h6>
                    <h6><?php echo date("M d, Y", strtotime($row['PostTime']));?></h6>
                    <p class="excerpt"><?php echo $row['Message'];?></p> 
                </div>  <!-- end row -->
            </div>  <!-- end main content area -->
        </div>
    </main>
    
    <footer>
        <div class="container-fluid">
                    <div class="row final">
                <p>Copyright &copy; 2017 Creative Commons ShareAlike</p>
                <p><a href="#">Home</a> / <a href="#">About</a> / <a href="#">Contact</a> / <a href="#">Browse</a></p>
            </div>            
        </div>

    </footer>
        <script src="https://code.jquery.com/jquery-2.2.4.min.js" integrity="sha256-BbhdlvQf/xTY9gja0Dq3HiwQF8LaCRTXxZKRutelT44=" crossorigin="anonymous"></script>
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js" integrity="sha384-0mSbJDEHialfmuBBQP6A4Qrprq5OVfW37PRR3j5ELqxss1yVqOtnepnHVP9aJ7xS" crossorigin="anonymous"></script>
</body>

</html>