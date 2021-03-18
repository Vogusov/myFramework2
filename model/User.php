<?php


namespace Fw2\Model;

use Fw2\Core\Db as Db;

class User
{
// хэширование пароля
  protected function hashUserPassword($password)
  {
    return password_hash($password, PASSWORD_BCRYPT);
  }

  // проверка наличия пользователя в БД по логину
  protected function userExists($login)
  {
    return Db::getInstance()->getRow(
      'select * from `users` where `login` = :login',
      ['login' => $login]
    );
  }

// записываем в БД нового поьзователя
  public function registrate(array $data)
  {
    if (!$this->userExists($data['login'])) {
      return Db::getInstance()->insert(
        'insert into `users` (`login`, `name`, `password`, `email`, `phone`) values (:login, :name, :password, :email, :phone)',
        ['login' => $data['login'], 'name' => $data['name'], 'password' => $data['password'], 'email' => $data['email'], 'phone' => $data['phone']]);
    } else {
      return false;
    }
  }
}