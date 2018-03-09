<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <title>Browse Posts</title>

     <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href='https://fonts.googleapis.com/css?family=Lobster' rel='stylesheet' type='text/css'>
    <link href='https://fonts.googleapis.com/css?family=Open+Sans' rel='stylesheet' type='text/css'>
    <link rel="stylesheet"  href="css/bootstrap.min.css"/>
    <link rel="stylesheet"  href="css/bootstrap-theme.css"/>
</head>

<body>
   <?php include "includes/header.inc.php"; 
         include "includes/config.inc.php";
         $postsDB = new PostsGateway($connection);
         $DBGateway = $postsDB;?>
    <!-- Page Content -->
    <main class="container">
        <div class="row">
                <?php include 'includes/left.inc.php'; ?>
            <div class="col-md-10">
                <div class="jumbotron" id="postJumbo">
                    <h1>Posts</h1>
                    <p>Read other travellers' posts ... or create your own.</p>
                    <p><a class="btn btn-warning btn-lg">Learn more &raquo;</a></p>
                </div>        
                 <!-- start post summaries -->
                 <div class="postlist">
                        <?php $results = $postsDB->findAll("PostTime DESC");
                         foreach ($results AS $row)  {?>
                        
                        <div class='row'>
                                <div class="col-md-4"> 
                                        <a href="single-post.php?id=<?php echo $row['PostID'];?>"><img src="images/medium/<?php echo $row['Path'];?>" alt="<?php echo $row['Title'];?>"class="img-responsive"/></a>
                                </div>
                                <div class="col-md-8">
                                    <h2><?php echo $row['Title'];?></h2>
                                            <div class="details">
                                            Posted by: <a href="single-user.php?id=<?php echo $row['UserID'];?>"><?php echo $row['FullName'];?></a>
                                            <span class="pull-right"><?php echo  date("M d, Y", strtotime($row['PostTime']));?></span>
                                            </div>
                                                <p class="excerpt"><?php echo substr($row['Message'],0,250);?></p>
                                         <p class="pull-right">
                                            <a href="single-post.php?id=<?php echo $row['PostID'];?>" class="btn btn-primary btn-sm">Read more</a>
                                         </p>
                                </div>
                        </div>  
                                  <hr/>  <!-- underline -->
                        <?php } ?>
                                          
                 </div>  <!-- end postlist -->         
                            
            </div>  <!-- end col-md-10 -->
        </div>   <!-- end row -->
    </main>
    

        <script src="https://code.jquery.com/jquery-2.2.4.min.js" integrity="sha256-BbhdlvQf/xTY9gja0Dq3HiwQF8LaCRTXxZKRutelT44=" crossorigin="anonymous"></script>
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js" integrity="sha384-0mSbJDEHialfmuBBQP6A4Qrprq5OVfW37PRR3j5ELqxss1yVqOtnepnHVP9aJ7xS" crossorigin="anonymous"></script>
</body>

</html>