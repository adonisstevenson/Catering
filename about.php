<?php 

$conn = mysqli_connect('localhost', 'root', '', 'catering');

if($conn->connect_error){

    die("Connection failed: ".$conn->connect_error);
}

$q_dishes = "SELECT P.name as name, K.name as category, P.img_src, P.id, P.description
    FROM Potrawy as P JOIN Kategorie as K 
    on P.category_id = K.id order by category";

$result_dishes = $conn->query($q_dishes);

$dishes = array();

while($row = mysqli_fetch_array($result_dishes)){
    $dishes[] = $row;
}

$q_categories = "SELECT name FROM Kategorie";

$result_categories = $conn->query($q_categories);

$categories = array();

while($row = mysqli_fetch_array($result_categories)){
    $categories[] = $row;
}

?>

<!DOCTYPE html>
<html>
<head>
<script
			  src="https://code.jquery.com/jquery-3.6.0.js"
			  integrity="sha256-H+K7U5CnXl1h5ywQfKtSj8PCmoN9aaq30gDh27Xc0jk="
			  crossorigin="anonymous"></script>
<link rel="stylesheet" href="style.css">
<meta name="viewport" content="width=device-width, initial-scale=1">
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">

</head>
<body>

<?php include('navbar.php') ?>

<div class="container" style="margin-top: 100px;">

    <div class="row">
       About page
    </div>

</div>

<?php include('footer.php') ?>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>
<script src="https://kit.fontawesome.com/abd48bc107.js" crossorigin="anonymous"></script>
<script src="script.js"></script> 
</body>
</html>
