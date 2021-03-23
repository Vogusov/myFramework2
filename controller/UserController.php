<?php

namespace Fw2\Controller;

use Fw2\Model\User as User;

class UserController extends Controller
{
//  public

  function __construct()
  {
    parent::__construct();
    $this->view = 'user/login.html';

  }

  /**
   * Вход в свой аккаунт
   * @param array $data
   * @return array ['sitename', 'content_data', 'title', 'view']
   * */
  function login($data)
  {
    if ($this->isPost() && isset($_POST['auth'])) {
//      $user = new User();
//      $login = trim(strip_tags($_POST['login']));

      return [
        'sitename' => $this->sitename,
        'content_data' => [
          'name' => $_POST['login'],
          'login' => $_POST['login'],
          'email' => 'test',
          'phone' => '777888'
        ],
        'title' => 'Личный кабинет',
        'view' => 'user/account.html'
      ];
    } else {

      return [
        'sitename' => $this->sitename,
        'content_data' => "Войдите или зарегистрируйтесь!",
        'title' => 'Вход',
        'view' => $this->view
      ];
    }

  }


  /**
   * Регистрация нового пользователя
   * @param array $data
   * @return array ['sitename', 'content_data', 'title', 'view']
   * */
  function signup($data)
  {
    if (isset($_POST['reg'])) {
      $data = $_POST;
      $user = new User();

      if ($result = $user->registrate($data)) {

        if ($result['success']) {
          return [
            'sitename' => $this->sitename,
            'content_data' => [
              'message' => "Вы успешно зарегистрировались c ID: {$result['id']}! Теперь войдите в свой аккакнт: ",
            ],
            'title' => 'Вход',
            'view' => 'user/login.html'
          ];

        } else {
          return [
            'sitename' => $this->sitename,
            'content_data' => [
              'message' => array_shift($result),
            ],
            'title' => 'Регистрация',
            'view' => 'user/registration.html'
          ];
        }
      }
    } // если нет поста, отображается страница регистрации по умолчанию
    else {
      return [
        'sitename' => $this->sitename,
        'content_data' => [
          'message' => 'Зарегистрируйтесь на нашем сайте. Пожалуйста: ',
        ],
        'title' => 'Регистрация',
        'view' => 'user/registration.html'
      ];
    }
  }

}
