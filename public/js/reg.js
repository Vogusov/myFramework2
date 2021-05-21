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


  /* sign up */
  const btnSignUp = $('.js-regist')
  const $form = $('#form-reg'),
    inputLogin = $form.find('input[name=login]'),
    inputPassword = $form.find('input[name=password]'),
    inputPassword2 = $form.find('input[name=password2]'),
    inputName = $form.find('input[name=name]'),
    inputEmail = $form.find('input[name=email]'),
    inputPhone = $form.find('input[name=phone]')

  // функция подготовки данных к отправке
  function prepareData() {


    $form.find('.error').remove()


    // валидация формы
    if (inputLogin.val() === '') {
      inputLogin.before('<p class="error" style="color:red">Введите логин</p>')
      return false
    }
    if (inputPassword.val() === '') {
      inputPassword.before('<p class="error"style="color:red">Введите пароль</p>')
      return false
    }
    if (inputPassword2.val() === '') {
      inputPassword2.before('<p class="error" style="color:red">Введите пароль повторно</p>')
      return false
    }
    if (inputPassword.val() !== inputPassword2.val()) {
      inputPassword2.before('<p class="error" style="color:red">Введенные пароли не совпадают</p>')
      return false
    }
    if (inputName.val() === '') {
      inputName.before('<p class="error" style="color:red">Введите свое имя</p>')
      return false
    }
    if (inputEmail.val() === '') {
      inputEmail.before('<p class="error" style="color:red">Введите свою электронную почту для связи</p>')
      return false
    }
    if (inputPhone.val() === '') {
      inputPhone.before('<p class="error" style="color:red">Введите свой номер телефона для связи с вами</p>')
      return false
    }


    // сериализуем данные и делаем json
    let serArr = $form.serializeArray()
    let objToSend = {}
    console.log(serArr)

    $.each(serArr, function () {
      objToSend[this.name] = this.value
    })
    objToSend.action = 'signup'
    console.log(objToSend)

    objToSend = JSON.stringify(objToSend)
    console.log(objToSend)

    return objToSend
  }

  // ф-ция успешного приема данных с сервера
  function success1(data) {
    console.log(data)
    // - при успешной регистрации направить в акаунт
    // - при неуспешной вывести Ошибку
  }

  // AJAX запрос
  btnSignUp.click(function (e) {
    e.preventDefault();
    $.post('/index.php?path=user/signup',
      prepareData(),
      function (data) {
        if (!data) {
          $form.prepend('<p class="error" style="color:red">Нет данных от сервера</p>')
        }

        console.log('from server: ', data)

        if (data.errors) {
          $form.prepend(`<p class="error" style="color:red">${data.errors[0]}</p>`)
        }

        if (data.success) {
          document.location.href = "/index.php?path=user/login";
        }


      },
      'json')


  })

  // if (document.referrer === 'index.php?path=user/signuppage') {
  //   $('#message').text('Поздравляем! Вы успешно зарегистрировались!')
  // }


  // the end
})
