class Validator {
  constructor(formId) {
    this.patterns = {
      name: /^[a-zа-яё(\s?)]+$/i,
      phone: /^\+7\(\d{3}\)\d{3}-\d{4}$/,
      // phone: /^\+7\d{10}$/,
      email: /^[\w._-]+@\w+\.[a-z]{2,4}$/i
    }
    this.errors = {
      name: 'Имя содержит только буквы',
      phone: 'Телефон подчиняется шаблону +7(000)000-0000',
      email: 'E-mail выглядит как mymail@mail.com'
    }
    this.errorClass = 'error-msg'
    this.form = formId
    this.valid = false
    this._validateForm()
  }

  _validateForm() {
    // удаляем сообщения об ошибке
    let $errors = [...document.getElementById(this.form).querySelectorAll(`.${this.errorClass}`)]
    for (let error of $errors) {
      error.remove()
    }
    // итерируем массив с input-ами и валидируем каждый
    let formFields = [...document.getElementById(this.form).querySelectorAll(`input`)]
    for (let input of formFields) {
      this._validate(input)
    }
    // если нет классов invalid, то return true
    if (![...document.getElementById(this.form).querySelectorAll(`.invalid`)].length) {
      this.valid = true
    }
  }

  _validate(input) {
    if (this.patterns[input.name]) {
      if (!this.patterns[input.name].test(input.value)) {
        input.classList.add('invalid')
        this._addErrorMsg(input)
        this._watchField(input)
      }
    }
  }

  _addErrorMsg(input) {
    let errorMsg = `<div class="${this.errorClass}" style="color:red">${this.errors [input.name]}</div>`
    input.insertAdjacentHTML('beforebegin', errorMsg)
  }

  _watchField(input) {
    input.addEventListener('input', () => {
      let error = input.parentNode.querySelector(`.${this.errorClass}`)
      if (this.patterns[input.name].test(input.value)) {
        input.classList.remove('invalid')
        input.classList.add('valid')
        if (error) {
          error.remove()
        }
      } else {
        input.classList.add('invalid')
        input.classList.remove('valid')
        if (!error) {
          this._addErrorMsg(input)
        }
      }
    })
  }
}