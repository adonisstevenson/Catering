<?php 

$conn = mysqli_connect('localhost', 'root', '', 'catering');

if($conn->connect_error){

    die("Connection failed: ".$conn->connect_error);
}

$q_dishes = "SELECT P.name as dish_name, K.name as category
    FROM Potrawy as P JOIN Kategorie as K 
    on P.category_id = K.id order by category";

$result_dishes = $conn->query($q_dishes);

$dishes = array();

while($row = mysqli_fetch_array($result_dishes)){
    $dishes[] = $row;
}

$q_categories = "SELECT * FROM Kategorie";

$result_categories = $conn->query($q_categories);

$categories = array();

while($row = mysqli_fetch_array($result_categories)){
    $categories[] = $row;
}

?>

<!DOCTYPE html>
<html>
<head>
<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="stylesheet" href="style.css">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">


</head>
<body>



<div class="topnav" id="myTopnav">
  <a href="#home" class="active">Home</a>
  <a href="#news">News</a>
  <a href="#contact">Contact</a>
  <img src="img/logo_sign_64.png">
  <a href="cart.php" style="float:right;">Koszyk</a>
</div>

<div class="content">

<div class="panel">
    <h2>Fast-food</h2>
</div>

<div class="panel">
    <h2>Pizza</h2>
</div>

<div class="panel">
    <h2>Napoje</h2>
</div>

<div class="panel">
    <h2>Alkohol</h2>
</div>

</div>


</body>
</html>
