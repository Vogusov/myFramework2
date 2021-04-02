$(document).ready(function(){


//------ AJAX queries -------------
// запрос на добавление в корзину
    btn = $('.js-add-to-cart')

    btn.click(function (e) {
        e.preventDefault();
        productId = $(this).data('id')
        productName = $(this).data('name')
        console.log('prod: ', `${productId} - ${productName};`)

        $.ajax({
            type: 'POST',
            url: '/index.php?path=cart/add/' + productId,
            data:
              {
                  id: productId
              },
            error: function() {
                alert("Что-то пошло не так...")
            },
            success: function (response) {
                if (response) {
                    console.log('responseDataJs: ' + response)
                    alert('Товар ' + productName + ' добавлен в корзину')

                    // todo Тут посчитать сумму товаров.
                    // countTotalSumInCart()
                }
            }
        })
    })





//---the end;
})




