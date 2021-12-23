<?php 
include("../../config/config.php");

// Attempt search query execution
try{
    if(isset($_GET["query"])){
        // create prepared statement
        if ($_GET["country"] == 'England') {
            $sql = "SELECT * FROM uk_towns WHERE name LIKE :term AND country='England' LIMIT 6";
        } elseif ($_GET["country"] == 'Northern Ireland') {
            $sql = "SELECT * FROM uk_towns WHERE name LIKE :term AND country='Northern Ireland' LIMIT 6";
        } elseif ($_GET["country"] == 'Scotland') {
            $sql = "SELECT * FROM uk_towns WHERE name LIKE :term AND country='Scotland' LIMIT 6";
        } elseif ($_GET["country"] == 'Wales') {
            $sql = "SELECT * FROM uk_towns WHERE name LIKE :term AND country='Wales' LIMIT 6";
        }
        $stmt = $con->prepare($sql);
        $term = $_GET["query"] . '%';
        // bind parameters to statement
        $stmt->bindParam(":term", $term);
        // execute the prepared statement
        $stmt->execute();
        $return = ['suggestions' => []];
        if($stmt->rowCount() > 0){
            while($row = $stmt->fetch()){       
                $v = sprintf('%s, %s', $row["name"], $row["county"]);   
                $return['suggestions'][] = ['data' => $v, 'value' => $v];               
            }
        } 

        echo json_encode($return);
    }  
} catch(PDOException $e){
    die("ERROR: Could not able to execute $sql. " . $e->getMessage());
}
 
// Close statement
unset($stmt);

?>