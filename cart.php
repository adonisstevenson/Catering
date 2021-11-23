<?php 

$selected = explode(',', $_GET['products']);
session_start();
$_SESSION['selected_products'] = $selected;

$conn = mysqli_connect('localhost', 'root', '', 'catering');

if($conn->connect_error){

    die("Connection failed: ".$conn->connect_error);
}

$q_ordered = "SELECT P.id, P.name, P.price, P.img_src, K.name as category
FROM Potrawy as P JOIN Kategorie as K on P.category_id = K.id ORDER BY category";

$result_ordered = $conn->query($q_ordered);

$products = array();

while($row = mysqli_fetch_array($result_ordered)){
    $products[] = $row;
}

$sum_price = 0;

?>

<!DOCTYPE html>
<html>
<head>
<link rel="stylesheet" href="../style.css">
<meta name="viewport" content="width=device-width, initial-scale=1">
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
</head>

<body>
    
<?php include('navbar.php'); ?>

<div class="container" style="margin-top: 100px;">

    <div class="card">
        <h5 class="card-header">
            Zamówienie
        </h5>
        <div class="card-body">
            <table class="table table-light">
            <thead>
            <tr>
                <th>L.P.</th>
                <th>Produkt</th>
                <th>Cena</th>
            </tr>
            </thead>
            <tbody>
                <?php foreach($selected as $key => $selected_item){ ?>
                    <?php foreach($products as $key => $product){ ?>
                    <?php if ($product['id'] == $selected_item){ ?>
                    <tr>
                        <td>1</td>
                        <td><?php echo $product['name'] ?></td>
                        <td><?php echo $product['price'] ?></td>
                        <?php 
                            $sum_price += $product['price'];
                        ?>
                    </tr>
                    <?php } ?>
                    <?php } ?>
                <?php } ?>
                <tr>
                    <th></th>
                    <th></th>
                    <th>Razem: <?php echo $sum_price ?>PLN</th>
                </tr>
            </tbody>
            </table>
    </div>
</div>
<br>
    <div class="card">
        <h5 class="card-header">
            Dane zamawiającego
        </h5>
        <div class="card-body">
        <form class="row g-3" action="/Catering/order.php" method="POST">
            <div class="col-md-6">
                <label for="inputEmail4" class="form-label">Email</label>
                <input type="email" class="form-control" id="inputEmail4">
            </div>
            <div class="col-md-6">
                <label for="inputPassword4" class="form-label">Imie i nazwisko</label>
                <input type="text" class="form-control">
            </div>

            <div class="col-12">
                <label for="inputAddress2" class="form-label">Adres</label>
                <input type="text" class="form-control" id="inputAddress2" placeholder="Ulica, numer ulicy & numer domu">
            </div>
            <div class="col-md-6">
                <label for="inputCity" class="form-label">Miasto</label>
                <input type="text" class="form-control" id="inputCity">
            </div>

            <div class="col-md-2">
                <label for="inputZip" class="form-label">K. pocztowy</label>
                <input type="text" class="form-control" id="inputZip">
            </div>

            <div class="col-12">
                <button type="submit" class="btn btn-primary">Złóż zamówienie</button>
            </div>
        </form>
            
        </div>

        </div>
    </div>

</div>

</body>

</html>