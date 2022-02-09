
<div class="topnav" id="myTopnav">
<div class="container">
  <i class="fas fa-hamburger" style="font-size: 3rem; color: white; float:left; margin: 5px 15px 5px 5px;"></i>
  <a href="index.php" class="active">Strona główna</a>
  <a href="order.php">Zamówienia</a>
  <a href="#contact">Kontakt</a>
  <a href="about.php">O Nas</a>
  <a href="#" onclick="to_cart()" style="float:right;" id="cart">Koszyk</a>
  <div style="float:right;" class="search-box">
    <input type="text" placeholder="Wyszukaj potrawę..." id="search-input">
    <button class="btn btn-light btn-sm" style="vertical-align: baseline;" onclick="search_dish()"><i class="fas fa-search"></i></button>
  </div>
  </div>
</div>
<div class="modal fade" id="search-dish-modal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLongTitle" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLongTitle">Wyszukiwanie potrawy</h5>
      </div>
      <div class="modal-body" id="search-result-modal">
        
      </div>
    </div>
  </div>
</div>
