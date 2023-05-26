<?php 
include 'Conect.php';

$queryResult = $conn->query("SELECT * FROM comentarios");

$result = array();

while($fetchData=$queryResult->fetch_assoc()){
    $result [] = $fetchData;
}

echo json_encode($result);

?>