<?php 

$conn = mysqli_connect('localhost', 'root', '', 'catering');

if($conn->connect_error){

    die("Connection failed: ".$conn->connect_error);
}

$q_dishes = "SELECT P.name as name, K.name as category, P.img_src, P.id, P.description
    FROM Potrawy as P JOIN Kategorie as K 
    on P.category_id = K.id 
    where P.name LIKE '%{$_GET['search_phrase']}%' OR P.name LIKE '%{$_GET['search_phrase']}%'
    OR P.description LIKE '%{$_GET['search_phrase']}%' OR P.name LIKE '%{$_GET['search_phrase']}%'
    order by category";

$result_dishes = $conn->query($q_dishes);

$dishes = array();

while($row = mysqli_fetch_array($result_dishes)){
    $dishes[] = $row;
}




header('Content-Type: application/json');
echo json_encode($dishes);
exit;

?>