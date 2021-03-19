<?php


namespace Fw2\Model;

use Fw2\Core\Db as Db;

class User
{

  public bool $success;

  public function __construct()
  {
    $this->success = false;
  }


// хэширование пароля
  protected function hashUserPassword($password)
  {
    return password_hash($password, PASSWORD_BCRYPT);
  }

  // проверка наличия пользователя в БД по логину
  protected function loginExists($login)
  {
    return Db::getInstance()->getRow(
      'select * from `users` where `login` = :login',
      ['login' => $login]
    );
  }


  // проверка наличия пользователя в БД по email
  protected function emailExists($email)
  {
    return Db::getInstance()->getRow(
      'select * from `users` where `email` = :email',
      ['email' => $email]
    );
  }

  // проверка наличия пользователя в БД по телефону
  protected function phoneExists($phone)
  {
    return Db::getInstance()->getRow(
      'select * from `users` where `phone` = :phone',
      ['phone' => $phone]
    );
  }


  // проверка формы на валидность пустоту
  protected function formIsValid($data)
  {
    $errors = [];

    if (trim($data['login']) == '') {
      $errors[] = 'Введите логин!';
    }

    if (($data['password']) == '') {
      $errors[] = 'Введите пароль!';
    }

    if ($data['password2'] != $data['password']) {
      $errors[] = 'Повторный пароль введен не верно!';
    }

    if (trim($data['name']) == '') {
      $errors[] = 'Введите имя!';
    }

    if (trim($data['email']) == '') {
      $errors[] = 'Введите почту!';
    }

    if (trim($data['phone']) == '') {
      $errors[] = 'Введите телефон!';
    }

    // Проверка на существование одинакового логина
    if ($this->loginExists($data['login'])) {
      $errors[] = 'Пользователь с таким логином уже существует';
    }

    // Проверка на существование одинакового email
    if ($this->emailExists($data['email'])) {
      $errors[] = 'Пользователь с такой почтой уже существует';
    }

    // Проверка на существование одинакового телефона
    if ($this->phoneExists($data['phone'])) {
      $errors[] = 'Пользователь с таким номером телефона уже существует';
    }

    if (empty($errors)) {
      $this->success = true;
      echo "valid, data: " . print_r($data);
      return $data;
    } else {
      $this->success = false;
      echo "invalid, errors: " . print_r($errors);
      return $errors;
    }
  }



// записываем в БД нового поьзователя
  public function registrate(array $data)
  {
    $validatedData = $this->formIsValid($data);
    if ($this->success) {
      $login = $validatedData['login'];
      $name = $validatedData['name'];
      $password = $validatedData['password'];
      $email = $validatedData['email'];
      $phone = $validatedData['phone'];

      $validatedData['success'] = $this->success;
      $validatedData['id'] =  Db::getInstance()->insert(
        'insert into `users` (`login`, `name`, `password`, `email`, `phone`) values (:login, :name, :password, :email, :phone)',
        ['login' => $login, 'name' => $name, 'password' => $password, 'email' => $email, 'phone' => $phone]);
      return $validatedData;
    } else {
      $validatedData['success'] = $this->success;
      echo "Не зарегались(((";
      return $validatedData;
    }
  }
}