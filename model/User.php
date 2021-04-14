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
      $errors[] = 'Повторный пароль введен неверно!';
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
      $password = $this->hashUserPassword($data['password']);
      $email = $validatedData['email'];
      $phone = $validatedData['phone'];

      $validatedData['success'] = $this->success;
      $validatedData['id'] = Db::getInstance()->insert(
        'insert into `users` (`login`, `name`, `password`, `email`, `phone`) values (:login, :name, :password, :email, :phone)',
        ['login' => $login, 'name' => $name, 'password' => $password, 'email' => $email, 'phone' => $phone]);
      return $validatedData;
    } else {
      $validatedData['success'] = $this->success = false;
      echo "Не зарегались(((";
      return $validatedData;
    }
  }


// Вход пользователя под учетной записью
  public function auth(array $data)
  {
    if ($user = $this->loginExists(trim($data['login']))) {
      echo "Есть юзер с таким логином {$user['login']}. Его ID: {$user['id']}! ";

      if (password_verify($data['password'], $user['password'])) {
        $_SESSION['logged_user'] = $user['id'];
        echo 'Пароли совпали! ';
        print_r($_SESSION['logged_user']);

        $result['success'] = $this->success = true;
        return $result;

      } else {
        echo 'пароль неверен <br>';
        $result['success'] = $this->success = false;
        $result['message'] = 'Пароль неверен';
        return $result;
      }
    } else {
      $result['success'] = $this->success = false;
      $result['message'] = 'Пользователя с таким логином нет';
      return $result;

    }
  }

  public function unsetLoggedSession()
  {
    echo 'Удаяляемая сессия: ';
    print_r($_SESSION['logged_user']);
    unset($_SESSION['logged_user']);
    if (!isset($_SESSION['logged_user'])) {
      return true;
    } else {
      return false;
    }
  }

  public function getData(int $userId)
  {
    return Db::getInstance()->getRow('select * from `users` where `id` = :id', ['id' => $userId]);
  }


}