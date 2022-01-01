<?php 
session_start();

$name = explode(" ", $_POST['name']);

echo $_POST['email'].'<br>';
echo $_POST['name'].'<br>';
echo $_POST['address'].'<br>';
echo $_POST['city'].'<br>';
echo $_POST['postal_code'].'<br>';

$conn = mysqli_connect('localhost', 'root', '', 'catering');


if ($conn->connect_error){
    die("Problem z połączeniem bazy danych: ".$conn->connect_error);
}

// check if e-mail exists in database

$q= "SELECT id from Klienci WHERE email = '{$_POST['email']}'";

$user_exists = $conn->query($q)->fetch_row();

if($user_exists == NULL){
    $q_client = "INSERT INTO Klienci (name, surname, email, address, city, postal_code)
    VALUES ('{$name[0]}', '{$name[1]}', '{$_POST['email']}', '{$_POST['address']}', '{$_POST['city']}', '{$_POST['postal_code']}')";

    if (!$conn->query($q_client)){
        $_SESSION['db_error'] = $conn->error;
        header('Location: ' . $_SERVER['HTTP_REFERER']);
    }

    $user_id = $conn->insert_id;
    
}else{
    $user_id = $user_exists[0];
}

$_SESSION['user_id'] = $user_id;

$q_cart = "INSERT INTO Koszyki (user_id) VALUES ('{$user_id}')";

if (!$conn->query($q_cart)){
    $_SESSION['db_error']  = $conn->error;
    header('Location: ' . $_SERVER['HTTP_REFERER']);
    //TODO: if cart_error exists in cart view
}

$cart_id = $conn->insert_id;

foreach($_SESSION['selected_products'] as $product){
    $q_cart_prod = "INSERT INTO koszyk_produkt (cart_id, dish_id) 
    VALUES ('{$cart_id}', '{$product}');";

    if (!$conn->query($q_cart_prod)){
        $_SESSION['db_error']  = $conn->error;
        header('Location: ' . $_SERVER['HTTP_REFERER']);
        //TODO: if cart_error exists in cart view
    }

}

$current_time = time();
$delivery_time = $current_time + 1200;

$q_delivery = "INSERT INTO Zamowienia (cart_id, order_date, delivery_date)
VALUES ('{$cart_id}', '{$current_time}', '{$delivery_time}')";


if (!$conn->query($q_delivery)){
    $_SESSION['db_error']  = $conn->error;
    header('Location: ' . $_SERVER['HTTP_REFERER']);
}

header('Location: order.php');

?>