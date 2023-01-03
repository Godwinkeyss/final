var del = document.getElementById('del');
console.log(alert)

$(document).ready(function () {
    $('.increment-btn').click(function(e){
        e.preventDefault();
        alert('hello')

        var qty = $(this).closest('.product_data').find('.input-qty').val();
        var value = parseInt(qty, 10);
        value = isNaN(value) ? 0 : value;
        if(value < 10){
            value++;
            $('.input-qty').val(value);
        }
    })
})
$(document).ready(function () {
    $('.decrement-btn').click(function(e){
        e.preventDefault();

        var qty = $(this).closest('.product_data').find('.input-qty').val();
        var value = parseInt(qty, 10);
        value = isNaN(value) ? 0 : value;
        if(value > 1){
            value--;
            $('.input-qty').val(value);
        }
    })
   
    $(document).ready(function () {
        $('.cart-increment-btn').click(function(e){
            e.preventDefault();
    
            var qty = $('.input-qty').val();
            var value = parseInt(qty, 10);
            value = isNaN(value) ? 0 : value;
            if(value < 10){
                value++;
                $('.input-qty').val(value);
            }
        })
    })
    $(document).ready(function () {
        $('.cart-decrement-btn').click(function(e){
            e.preventDefault();
    
            var qty = $('.input-qty').val();
            var value = parseInt(qty, 10);
            value = isNaN(value) ? 0 : value;
            if(value > 1){
                value--;
                $('.input-qty').val(value);
            }
        })
    })
    // $('.addToCartBtn').click(function(e){
    //     e.preventDefault();
    //     var qty = $(this).closest('.product_data').find('.input-qty').val();
    //     var product_id =$(this).val();
        
    //     $.ajax({
    //         method: "POST",
    //         url: "functions/handlecart.php",
    //         data: {
    //             "product_id":product_id,
    //             "product_quantity":qty,
    //             "scope": addToCartBtn,
    //         },
    //         dataType:"dataType",
    //         success: function (response){
    //           if(response == 201){
    //             alert('Product added to cart');
    //           }
    //           else if(response == 401){
    //             alert('Login to continue');
    //           }
    //           else if(response == 500){
    //             alert('something went wrong');
    //           }
    //         }
    //     })
    // })
});


$(function(){
    var countryOptions;
    $.getJSON('data.json', function(result){
        $.each(result, function(i,country){
            // alert(country.name +" "+ country.code);
            // <option value='countrycode'>countryname</option>
            countryOptions+="<option value='"
            +country.code+
            "'>"
            +country.name+
            "</option>";
        })
        $('#country').html(countryOptions);
    })
   })