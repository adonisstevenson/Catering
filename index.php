<?php 

$conn = mysqli_connect('localhost', 'root', '', 'catering');

if($conn->connect_error){

    die("Connection failed: ".$conn->connect_error);
}

$q_dishes = "SELECT P.name as name, K.name as category, P.img_src, P.id
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
<link rel="stylesheet" href="style.css">
<meta name="viewport" content="width=device-width, initial-scale=1">
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">

</head>
<body>

<?php include('navbar.php') ?>

<div class="container" style="margin-top: 100px;">

    <div class="row">
        <?php foreach ($categories as $key => $category){ ?>
        <div class='col-lg-6 col-md-12'>
            <div class="card product-card">
                <h5 class="card-header"><?php echo $category['name'] ?></h5>
                <div class="card-body">
                    <div class="row product-row">
                    <?php foreach($dishes as $key=>$dish){ ?>
                    <?php if ($dish['category'] == $category['name']){ ?>
                        <div class="col-md-6 col-xs-12 product-col">
                            <div class="card" style="width: 18rem;">
                                <img src=<?php echo 'img/'.$dish['img_src'] ?> alt="" class="card-img-top">
                                <div class="card-body">
                                    <h5 class="card-title"> <?php echo $dish['name'] ?> </h5>
                                    <p class="card-text">Some quick example text to build on the card title and make up the bulk of the card's content.</p>
                                    <button href="#" onclick="add_prod(<?php echo $dish['id'] ?>)" class="btn btn-primary">Dodaj do koszyka</button>
                                </div>
                            </div>
                        </div>
                    <?php } ?>
                    <?php } ?>
                    </div>
                </div>
            </div>
        </div>
        <?php } ?>
    </div>
<!-- 
    <div class="row">
        <div class="col-lg-6 col-md-12">
            <div class="card">
                <h5 class="card-header">Fast-food</h5>
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-6 col-xs-12">
                            <div class="card" style="width: 18rem;">
                                <img class="card-img-top" src="img/burger.png" alt="Card image cap">
                                <div class="card-body">
                                    <h5 class="card-title">Hamburger</h5>
                                    <p class="card-text">Some quick example text to build on the card title and make up the bulk of the card's content.</p>
                                    <a href="#" class="btn btn-primary">Go somewhere</a>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6 col-xs-12">
                            <div class="card" style="width: 18rem;">
                                <img class="card-img-top" src="img/cheeseburger.jpg" alt="Card image cap">
                                <div class="card-body">
                                    <h5 class="card-title">Cheeseburger</h5>
                                    <p class="card-text">Some quick example text to build on the card title and make up the bulk of the card's content.</p>
                                    <a href="#" class="btn btn-primary">Go somewhere</a>
                                </div>
                            </div>
                        </div>
                    </div> 
                </div>
            </div>
        </div>
        <div class="col-md-6 col-xs-12">
            <div class="card">
                <h5 class="card-header">Pizza</h5>
                <div class="card-body">
                    <div class="row">
                        <div class="col-lg-6 col-md-12">
                            <div class="card" style="width: 18rem;">
                                <img class="card-img-top" src="..." alt="Card image cap">
                                <div class="card-body">
                                    <h5 class="card-title">Card title</h5>
                                    <p class="card-text">Some quick example text to build on the card title and make up the bulk of the card's content.</p>
                                    <a href="#" class="btn btn-primary">Go somewhere</a>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-6 col-md-12">
                            <div class="card" style="width: 18rem;">
                                <img class="card-img-top" src="..." alt="Card image cap">
                                <div class="card-body">
                                    <h5 class="card-title">Card title</h5>
                                    <p class="card-text">Some quick example text to build on the card title and make up the bulk of the card's content.</p>
                                    <a href="#" class="btn btn-primary">Go somewhere</a>
                                </div>
                            </div>
                        </div>
                    </div>
                    
                </div>
            </div>
        </div>
    </div>
    <br>
    <div class="row">
        <div class="col-lg-6 col-md-12">
             <div class="card">
                <h5 class="card-header">Napoje</h5>
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-6 col-xs-12">
                            <div class="card" style="width: 18rem;">
                                <img class="card-img-top" src="..." alt="Card image cap">
                                <div class="card-body">
                                    <h5 class="card-title">Card title</h5>
                                    <p class="card-text">Some quick example text to build on the card title and make up the bulk of the card's content.</p>
                                    <a href="#" class="btn btn-primary">Go somewhere</a>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6 col-xs-12">
                            <div class="card" style="width: 18rem;">
                                <img class="card-img-top" src="..." alt="Card image cap">
                                <div class="card-body">
                                    <h5 class="card-title">Card title</h5>
                                    <p class="card-text">Some quick example text to build on the card title and make up the bulk of the card's content.</p>
                                    <a href="#" class="btn btn-primary">Go somewhere</a>
                                </div>
                            </div>
                        </div>
                    </div>
                    
                </div>
            </div>
        </div>
        <div class="col-lg-6 col-md-12">
            <div class="card">
                <h5 class="card-header">Alkohole</h5>
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-6 col-xs-12">
                            <div class="card" style="width: 18rem;">
                                <img class="card-img-top" src="..." alt="Card image cap">
                                <div class="card-body">
                                    <h5 class="card-title">Card title</h5>
                                    <p class="card-text">Some quick example text to build on the card title and make up the bulk of the card's content.</p>
                                    <a href="#" class="btn btn-primary">Go somewhere</a>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6 col-xs-12">
                            <div class="card" style="width: 18rem;">
                                <img class="card-img-top" src="..." alt="Card image cap">
                                <div class="card-body">
                                    <h5 class="card-title">Card title</h5>
                                    <p class="card-text">Some quick example text to build on the card title and make up the bulk of the card's content.</p>
                                    <a href="#" class="btn btn-primary">Go somewhere</a>
                                </div>
                            </div>
                        </div>
                    </div>
                    
                </div>
            </div>
        </div>
    </div> -->

</div>

<script>

var products = []
update_cart();

function update_cart(){
    document.getElementById('cart').innerHTML = "Koszyk ("+products.length+")";
}

function add_prod(prod){
    products.push(prod);
    console.log(products);
    update_cart();

}

function to_cart(){
    
    if (products.length < 1){
        alert('Koszyk jest pusty!')
    }
    else{
        window.location = 'cart.php/?products='+products;
    }
}



</script>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>

</body>
</html>
