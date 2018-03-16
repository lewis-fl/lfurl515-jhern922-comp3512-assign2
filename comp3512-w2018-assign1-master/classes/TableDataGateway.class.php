<?php
abstract class TableDataGateway
{
    protected $connection;
    
    public function __construct($connect) {
        if (is_null($connect)) {
            throw new Exceptionm("Connection is null");
        }
        $this->connection = $connect;
    }
    
    abstract protected function getSelectStatement();
    
    abstract protected function getOrderFields();
    
    abstract protected function getPrimaryKeyName();
    
    abstract protected function getPageName();
    
    abstract protected function getLabel();
    
    
    public function findAll($sortFields=null) {
        $sql = $this->getSelectStatement();
        if (!is_null($sortFields)) {
            $sql .= ' ORDER BY ' . $sortFields;
        }
        $statement = DatabaseHelper::runQuery($this->connection, $sql, null);
        return $statement->fetchAll();
    }
    
    public function findAllSorted($ascending) {
        $sql = $this->getSelectStatement() . 'GROUP BY ' . $this->getOrderFields() . ' ORDER BY ' . $this->getOrderFields();
        if (! $ascending) {
            $sql .= " DESC";
        }
        $statement = DatabaseHelper::runQuery($this->connection, $sql, null);
        return $statement->fetchAll();
    }
    
    public function findById($id) {
        $sql = $this->getSelectStatement() . ' WHERE ' . $this->getPrimaryKeyName() . '=:id';
        $statement = DatabaseHelper::runQuery($this->connection, $sql, Array(':id' => $id));
        return $statement->fetch();
    }
    
    //ide exists needs to be created more dynamic for any table..
    public function IDExists($id) {
        $exists = false;
        $row = $this->findById($id);
        if($row) {
            $exists = true;
        }
        return $exists;
    }
    
     public function displayContinentPanelList(){
                $sql = "SELECT ContinentName, ContinentCode
                    FROM Continents
                    ORDER BY 1 ASC";
            $statement = $this->connection->prepare($sql);
            $statement->execute();
            while($row = $statement->fetch()){
               echo "<li class='list-group-item'><a href='browse-images.php?Continent=".$row['ContinentCode']."'>".$row['ContinentName']."</a></li>"; 
            }
        }
        
        
     public function displayCountriesPanelList(){
            $sql = "SELECT CountryName, ISO 
                    FROM Countries
                    INNER JOIN ImageDetails
                    ON ImageDetails.CountryCodeISO = Countries.ISO
                    GROUP BY 1
                    ORDER BY 1 ASC";
            $statement = $this->connection->prepare($sql);
            $statement->execute();
            while($row = $statement->fetch()){
              echo "<li class='list-group-item'><a href='browse-images.php?Country=".$row['ISO']."'>".$row['CountryName']."</a></li>"; 
            }
        }

    
    function printRelatedImages($id){
                  $sql = "SELECT ImageID, Title, Path
                        FROM ImageDetails
                        WHERE ". $this->getForeignKey() ."=:id
                        ORDER BY 1 ASC";
                $statement = DatabaseHelper::runQuery($this->connection, $sql, Array(':id' => $id));
                while($row = $statement->fetch()){
                     $this->printSmallImage($row['Path'],$row['Title'],$row['ImageID']);
                } 
                $this->closeDB();
                }
     function printSmallImage($path,$title,$id) {
         echo "<a href='single-image.php?id=$id'><img src='images/square-small/$path' title='$title' alt='$title' class='img-thumbnail'></a>";
    }
    
    function printResultsInTable() {
    $page = $this->getPageName();
    $results = $this->findAllSorted(true);
    $idName = $this->getPrimaryKeyName();
    $label = $this->getLabel();
    $counter = 0; //ensures that there are only 4 links per row
    foreach($results as $row)
    {
        if($counter == 0){
            echo "<tr>";
        }
        if($counter == 4){
            echo "</tr>";
            $counter = 0;
        }
        echo "<td class='removeBorder'><a href=".$page.$row[$idName].">".$row[$label]."</a></td>"; 
        $counter++;
    }
    $this->closeDB();
    }
    
    function closeDB(){
        $this->connection = null;
    }
    
    // not sure if this was just used for testing
    // public function testFind($sql) {
    //    $statement = DatabaseHelper::runQuery($this->connection, $sql, null);
    //    return $statement->fetch();
    //}
}





























?>