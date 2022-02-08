function search_dish(){
    var dish_info = document.getElementById("search-input").value;

    $('#search-dish-modal').modal('show');

    $.ajax({
        url: 'http://localhost/Catering/search_products.php',
        dataType: 'json',
        type: "GET",
        data: {search_phrase: dish_info},
        success: function(data){
            
            if (jQuery.isEmptyObject(data)){
                $('#search-result-modal')
                .text("Nie znaleziono produktów spełniających kryteria wyszukiwania.");
            }else{
                $.each (data, function (key, value) {
                    $('#search-result-modal').append(`
                    <div class='row'>
                        <div class='col-md-12'>
                            <div class='card'>
                                <img src="img/${value.img_src}" alt="" class="card-img-top">
                                <div class='card-body'>
                                    <h5 class='card-title'> ${value.name} </h5>
                                    <p class="card-text">${value.description}</p>
                                    <button href="#" onclick="add_prod(${value.id})" class="btn btn-primary">Dodaj do koszyka</button>
                                </div>
                            </div>
                        </div>
                    </div>
                    <br>
                    `);
                    console.log(key + '=>' + value.name);
                 });
            }
            
        },
        error: function (data) {
            $('#search-result-modal')
            .text("Wystąpił błąd. Spróbuj ponownie.");
        }
    });
}

$('#search-result-modal').on('hide.bs.modal', function () { 
    console.log('Fired at start of hide event!');
});