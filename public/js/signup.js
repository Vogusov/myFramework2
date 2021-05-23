$(document).ready(function () {
  /* sign up */
  const btnSignUp = $('.js-regist')
  const formId = 'form-reg'
  const $form = $('#form-reg'),
    inputLogin = $form.find('input[name=login]'),
    inputPassword = $form.find('input[name=password]'),
    inputPassword2 = $form.find('input[name=password2]'),
    inputName = $form.find('input[name=name]'),
    inputEmail = $form.find('input[name=email]'),
    inputPhone = $form.find('input[name=phone]')

// функция подготовки данных к отправке
  function prepareData() {

    // валидация (name, phone, email оп регулярным выражениям)
    let valid = new Validator(formId)
    if (!valid.valid) {
      return
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


  // AJAX запрос
  btnSignUp.click(function (e) {

    e.preventDefault();
    $.post('/index.php?path=user/signup',
      prepareData(),
      function (data) {
        if (!data) {
          $form.prepend('<p class="error" style="color:red">Нет данных от сервера</p>')
        }
        // console.log('from server: ', data)
        if (data.errors) {
          $form.prepend(`<p class="error" style="color:red">${data.errors[0]}</p>`)
        }

        if (data.success) {
          document.location.href = "/index.php?path=user/login";
        }
      },
      'json')

  })


// the end
})