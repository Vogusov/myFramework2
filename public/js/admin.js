$(document).ready(function () {


//------ AJAX queries -------------
  btn = $('.js-admin-product-delete')

  btn.click(function (e) {
    e.preventDefault();
    productId = $(this).data('id')
    console.log('product to delete: ', `${productId};\n`)

    $.ajax({
      type: 'POST',
      url: '/index.php?path=adminGoods',
      data:
        {
          action: 'delete',
          id: productId
        },
      error: function () {
        alert("ошибка при удалении товара админом")
      },
      success: function (response) {
        if (response) {
          console.log('Товаров удалено: ', response)
          $('.js-admin-goods-table tr[data-id =' + productId + ']').remove()
          // alert('Товар ' + response + ' удален из корзины')


        }
      }
    })
  })
})



