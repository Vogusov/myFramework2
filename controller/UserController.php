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
  function login()
  {
    if (isset($_POST['auth'])) {
      $data = $_POST;
      $user = new User();
      if ($result = $user->login($data)) {
        return [
          'sitename' => $this->sitename,
          'content_data' => [
            'login' => $_POST['login'],
//            'name' => $_SESSION['name'],
            'email' => $_SESSION['email'],
            'phone' => $_SESSION['phone'],
          ],
          'title' => 'Личный кабинет',
          'view' => 'user/account.html'
        ];


      }
    } else {

      return [
        'sitename' => $this->sitename,
        'content_data' => [
          'message' => 'Вы не смогли войти.',
          'login' => $_POST['login']

        ],
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
  function signup()
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
              'login' => $_POST['login'],
              'name' => $_POST['name'],
              'email' => $_POST['email'],
              'phone' => $_POST['phone'],
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
