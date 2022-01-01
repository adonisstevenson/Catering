<?php 

session_start();

if (!isset($_SESSION['user_id'])){
    header('Location: ' . $_SERVER['HTTP_REFERER']);
}

$conn = mysqli_connect('localhost', 'root', '', 'catering');

if($conn->connect_error){

    die("Connection failed: ".$conn->connect_error);
}

$current_time = time();

$q_data = "SELECT * FROM Klienci as KL 
WHERE id = '{$_SESSION['user_id']}'";

$result = $conn->query($q_data);

$client_data = array();

while($row = mysqli_fetch_array($result)){
    $client_data[] = $row;
}

var_dump($client_data[0]);

$q = "SELECT P.name, P.img_src, P.price, Z.delivery_date FROM Koszyki as KO
JOIN Klienci AS KL on KL.id = KO.user_id
JOIN koszyk_produkt AS KP ON KP.cart_id = KO.id
JOIN Potrawy as P on P.id = KP.dish_id
JOIN Zamowienia AS Z ON Z.cart_id = KO.id
WHERE KL.id = {$_SESSION['user_id']}";

$result = $conn->query($q);

$ordered = array();

while($row = mysqli_fetch_array($result)){
    $ordered[] = $row;
}


?>

<!DOCTYPE html>
<html>
<head>
<link rel="stylesheet" href="style.css">
<meta name="viewport" content="width=device-width, initial-scale=1">
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
</head>

<body>
    
<?php include('navbar.php'); ?>

<div class="container" style="margin-top: 100px;">
    <div class="card">
        <h5 class="card-header">
            Podsumowanie
        </h5>
        <div class="card-body">
            <form class="row g-3" action="/Catering/add_order.php" method="POST">
                <fieldset disabled>
                <legend>Dane zamawiającego</legend>
                <div class="col-md-6">
                    <label for="inputEmail4" class="form-label">Email</label>
                    <input type="text" class="form-control" id="disabledTextInput" value=<?php echo $client_data[0]['email']; ?>>
                </div>
                <div class="col-md-6">
                    <label for="inputPassword4" class="form-label">Imie i nazwisko</label>
                    <input type="text" class="form-control" id="disabledTextInput" value="<?php echo $client_data[0]['name']." ".$client_data[0]['surname'] ?>">
                </div>

                <div class="col-12">
                    <label for="inputAddress2" class="form-label">Adres</label>
                    <input type="text" class="form-control" id="disabledTextInput">
                </div>
                <div class="col-md-6">
                    <label for="inputCity" class="form-label">Miasto</label>
                    <input type="text" class="form-control" id="disabledTextInput" value="<?php echo $client_data[0]['city'] ?>">
                </div>
            </form>
        </div>
    </div>

    <div class="card">
        <h5 class="card-header">
            Zamówienia
        </h5>
        <div class="card-body">
            <table class="table">
                <thead>
                    <tr>
                    <th scope="col">1</th>
                    <th scope="col">Produkt</th>
                    <th scope="col">Cena</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach($ordered as $product){ ?>
                    <tr>
                    <th scope="row">1</th>
                    <td><?php echo $product['name'] ?></td>
                    <td><?php echo $product['price'] ?></td>
                    <td>@mdo</td>
                    </tr>
                    <tr>
                    <?php } ?>
                </tbody>
                <thead>
                    <tr>
                    <th scope="col"></th>
                    <th scope="col"></th>
                    <th scope="col">Status:</th>
                    
                     
                    <th scope="col">
                        <?php 
                        if($ordered[0]['delivery_date'] > time()){ 
                            echo 'W trakcie. Godzina dostawy: '.date('H:i:s', $ordered[0]['delivery_date']); 
                        }else{
                            echo 'Zrealizowano.';
                        }
                        ?>  
                    </th>

                    </tr>
                </thead>
                </table>
                <br>
                
        </div>
    </div>

</div>

</body>

</html>