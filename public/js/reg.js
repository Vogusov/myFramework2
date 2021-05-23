$(document).ready(function () {

  /* Logout */
  const btnUserLogout = $('.js-user-logout')
  btnUserLogout.click(function (e) {

    $.ajax({
      type: 'POST',
      url: '/index.php?path=user/logout',
      data:
        {
          action: 'logout'
        },
      success: function (responseData) {
        if (responseData) {
          console.log('logout: ' + responseData)
          window.location = 'index.php'
          alert('Вы вышли из аккаунта!')
        }
      },
    })
  })


})
