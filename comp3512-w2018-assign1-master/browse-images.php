<?php
    if(!isset($_COOKIE['Success'])) { header("location: login.php"); }
    include 'includes/config.inc.php';
    $imagesDB = new ImagesGateway($connection);
   if((!isset($_GET['Continent']) || ($_GET['Continent']=='-1')) && (!isset($_GET['Country']) || $_GET['Country']=='-1') && (!isset($_GET['City']) || $_GET['City']=='-1') && (!isset($_GET['Title']) || empty($_GET['Title']))){
        $filterType = 'All';
        $filterValue = 'All';
        $sql = $imagesDB->formSQLQuery($filterType, null);
        $statement = DatabaseHelper::runQuery($connection, $sql, null);
   }
    else if(((isset($_GET['Continent'])) && ($_GET['Continent'] != '-1') && (!empty($_GET['Continent'])) && (!$imagesDB->IDExistsExplicit($_GET['Continent'],'Continents','ContinentCode'))) || ((isset($_GET['Country'])) && ($_GET['Country'] != '-1') &&  (!empty($_GET['Country'])) && (!$imagesDB->IDExistsExplicit($_GET['Country'],'Countries','ISO'))) || ((isset($_GET['City']))  && ($_GET['City'] != '-1') && (!empty($_GET['City'])) && (!$imagesDB->IDExistsExplicit($_GET['City'],'Cities','CityCode'))))
   {
        header('Location:error.php?error=invalidID'); 
   }
   else if(isset($_GET['Continent']) && !empty($_GET['Continent']) && ($_GET['Continent']!='-1') && $imagesDB->IDExistsExplicit($_GET['Continent'],'Continents','ContinentCode'))
   {
       $filterType = 'Continent';
       $filterValue = $filterType."=".$_GET['Continent'];
       $sql = $imagesDB->formSQLQuery($filterType,$_GET['Continent']);
       $statement = DatabaseHelper::runQuery($connection, $sql, null);
   }
   else if(isset($_GET['Country']) && !empty($_GET['Country']) && ($_GET['Country']!='-1') && $imagesDB->IDExistsExplicit($_GET['Country'],'Countries','ISO'))
   {
       $filterType = 'Country';
       $filterValue = $filterType."=".$_GET['Country'];
       $sql = $imagesDB->formSQLQuery($filterType,$_GET['Country']);
       $statement = DatabaseHelper::runQuery($connection, $sql, null);
   }
   else if(isset($_GET['City'])  && !empty($_GET['City']) && ($_GET['City']!='-1') && $imagesDB->IDExistsExplicit($_GET['City'],'Cities','CityCode') )
   {
       $filterType = 'City';
       $filterValue = $filterType."=".$_GET['City'];
       $sql = $imagesDB->formSQLQuery($filterType,$_GET['City']);
       $statement = DatabaseHelper::runQuery($connection, $sql, null);
   }
   else if(isset($_GET['Title']) && !empty($_GET['Title']))
   {
       $filterType = 'Text';
       $filterValue = "Title contains the text ".$_GET['Title'];
       $sql = $imagesDB->formSQLQuery($filterType,$_GET['Title']);
       $statement = DatabaseHelper::runQuery($connection, $sql, null);
   }
?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <title>Browse Images</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href='https://fonts.googleapis.com/css?family=Lobster' rel='stylesheet' type='text/css'>
    <link href='https://fonts.googleapis.com/css?family=Open+Sans' rel='stylesheet' type='text/css'>
    <link href="https://fonts.googleapis.com/css?family=Raleway" rel="stylesheet" type='text/css'>
    <link href="https://fonts.googleapis.com/css?family=Josefin+Sans" rel="stylesheet" type='text/css'>
    <!--<link rel="stylesheet" href="css/bootstrap.min.css" />-->
    <link rel="stylesheet" href="css/as2.min.css" />
    <link rel="stylesheet" href="css/captions.css" />
    <link rel="stylesheet" href="css/bootstrap-theme.css" />    
    <link rel="stylesheet" href="css/myown.css" /> 
</head>

<body>
    <?php include 'includes/header.inc.php'; ?>
    
    <!-- Page Content -->
    <main class="container">
        <div class="panel panel-default">
          <div class="panel-heading">Filters</div>
          <div class="panel-body">
            <form action="browse-images.php" method="GET" class="form-horizontal">
              <div class="form-inline">
              <select name="Continent" class="form-control" onchange='this.form.submit()'>
                <option value="-1">Select Continent</option>
                <?php $sql = $imagesDB->formSQLQuery('ContinentList', null);
                $result = DatabaseHelper::runQuery($connection, $sql, null);
                while ($row = $result->fetch()) {
                echo "<option value='".$row["ContinentCode"]. "'>".$row['ContinentName']."</option>"; }?>
              </select>     
              
              <select name="Country" class="form-control" onchange='this.form.submit()'>
                <option value="-1">Select Country</option>
                <?php $sql = $imagesDB->formSQLQuery('CountryList', null);
                $result = DatabaseHelper::runQuery($connection, $sql, null);
                while ($row = $result->fetch()) {
                echo "<option value='".$row['ISO']."'>".$row['CountryName']."</option>"; } ?>
              </select>  
                            
              <select name="City" class="form-control" onchange='this.form.submit()'>
                <option value="-1">Select City</option>
                <?php  $sql = $imagesDB->formSQLQuery('CityList', null);
                $result = DatabaseHelper::runQuery($connection, $sql, null);
                while ($row = $result->fetch()) {
                echo "<option value='".$row['CityCode']."'>".$row['AsciiName']."</option>";} ?>
              </select> 
              <input type="Text"  placeholder="Search Title" class="form-control" name=Title onchange='this.form.submit()'>
              <noscript><input type="submit" value="submit"></noscript>
              <a href="browse-images.php" class="btn btn-success">Clear</a>
              </div>
            </form>
          </div>
        </div>    
            
                <div class="panel panel-default">
                    <div class="panel-heading">Displaying <?php echo $statement->rowCount().' Image(s) where '.$filterValue.''; ?></div>
                     <div class="panel-body">
                     	<ul class="caption-style-2">
                     	    <?php while($row = $statement->fetch()){ ?>
                              <li>
                              <a href="single-image.php?id=<?php echo $row['ImageID'];?>" class='img-responsive'>
                              <img src="images/square-medium/<?php echo $row['Path'];?>" alt='<?php echo $row['Title'];?>'>
                                      <div class='caption'>
                                          <div class="blur"></div>
                                          <div class="caption-text">
                                            <p><?php echo $row['Title'];?></p>
                                          </div>
                                      </div>
                              </a>
                              </li> 
                              <?php } $imagesDB->closeDB(); ?>
                        </ul>
                    </div>   
                </div>
    </main>
    <?php include 'includes/footer.inc.php'; ?>
        <script src="https://code.jquery.com/jquery-2.2.4.min.js" integrity="sha256-BbhdlvQf/xTY9gja0Dq3HiwQF8LaCRTXxZKRutelT44=" crossorigin="anonymous"></script>
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js" integrity="sha384-0mSbJDEHialfmuBBQP6A4Qrprq5OVfW37PRR3j5ELqxss1yVqOtnepnHVP9aJ7xS" crossorigin="anonymous"></script>
</body>

</html>