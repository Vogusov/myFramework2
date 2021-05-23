$(document).ready(function () {

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
      error: function () {
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


// запрос на изменение клоличества товара в корзине
  btnChangeQnt = $('.js-change-quantity')

  btnChangeQnt.click(function (e) {
    e.preventDefault();
    sign = $(this).val()
    console.log('sign ', sign)

    productId = $(this).closest('tr[data-id]').data('id')
    console.log('id ', productId)

    productQnt = $(this).siblings('.js-cart-quantity').html()
    console.log('qnt: ' + productQnt)

    $.ajax({
      type: 'POST',
      url: '/index.php?path=cart/changeQnt/' + productId,
      data:
        {
          sign: sign,
          id: productId,
          quantity: productQnt
        },
      success: function (qnt) {
        console.log('response_qnt: ' + qnt)
        console.log('Товар ' + productId + ' поменял свое колличество в корзине')

        // отключаем уменьшение кол-ва товаров, если 0, и влючаем, если > 0
        qnt == 0 ? $('.js-cart-table tr[data-id =' + productId + '] .js-change-quantity[value="-"]').attr('disabled', true)
          : $('.js-cart-table tr[data-id =' + productId + '] .js-change-quantity[value="-"]').attr('disabled', false)

        // перерисовываем ко-во товара
        $('.js-cart-table tr[data-id =' + productId + '] .js-cart-quantity').html(qnt)

        // перерисовываем стоимость
        cartPrice = $('.js-cart-table tr[data-id =' + productId + '] .js-cart-price').html()
        $('.js-cart-table tr[data-id =' + productId + '] .js-cart-total').html(qnt * cartPrice)
      }
    })
  })


// запрос на удаление товара из корзины
  btnDeleteProduct = $('.js-cart-delete')

  btnDeleteProduct.click(function (e) {
    productId = $(this).closest('tr[data-id]').data('id')
    console.log('id ', productId)

    productName = $(this).data('name')
    console.log('pr name', productName)

    $.ajax({
      type: 'POST',
      url: '/index.php?path=cart/delete/' + productId,
      data:
        {
          // id: productId
        },
      success: function (responseData) {
        if (responseData) {
          console.log('responseData: ' + responseData)
          alert('Товар ' + productName + ' удален из корзины')
          $('.js-cart-table tr[data-id =' + productId + ']').remove()

          emptyCartMassege = 'Это ваша корзина! Она пока пуста. Дождитесь, пока появятся товары в нашем <a href="/index.php?path=catalog/">магазине</a>'
          //
          if ($('#cart-table tbody').children('tr').length == 0) {
            $('#cart-wrapper').html(emptyCartMassege)
          }
        }
      }
    })
  })



//---the end;
})



