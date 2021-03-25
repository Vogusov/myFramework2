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

  public function index($data = [])
  {
    if (isset($_SESSION['logged_user'])){
      return $this->account();
    } else return $this->login($data);
  }

  /**
   * Вход в свой аккаунт
   * @param array $data
   * @return array ['sitename', 'content_data', 'title', 'view']
   * */
  public function login(array $data)
  {
    if (isset($_POST['auth'])) {
      $data = $_POST;
      $user = new User();

      if ($result = $user->auth($data)) {
        // Если авторизовались, то переходим в личный кабинет:
        if ($result['success']) {
          return [
            'sitename' => $this->sitename,
            'content_data' => [],
            'title' => 'Личный кабинет',
            'view' => 'user/account.html'
          ];

          // если не success, то оставляем на этой же странице:
        } else {
          return [
            'sitename' => $this->sitename,
            'content_data' => [
              'message' => $result['message'],
            ],
            'title' => 'Вход',
            'view' => $this->view
          ];
        }
      }

      // Если нет поста, то открываем страницу входа!
    } else {
      $result = [
        'sitename' => $this->sitename,
        'content_data' => [
          'message' => 'Войдите или зарегистрируйтесь.',
        ],
        'title' => 'Вход',
        'view' => $this->view
      ];
      if ($data['success']) {
        $result['content_data']['message'] = 'Вы успешно зарегистрировались, войдите под своим именем!';
      }
//      echo 'Result из login: ';
//      print_r($result);
      return $result;
    }

  }


  public function logout()
  {
    $user = new User();
    if ($user->logout()) {
      return [
        'sitename' => $this->sitename,
        'view' => 'index/index.html',
        'content_data' => [
          'message' => "Вы вышли из аккаунта! ",
        ],
      ];
    }
  }


  public function account()
  {
    return [
      'sitename' => $this->sitename,
      'view' => 'user/account.html',
      'title' => 'Личный кабинет',
      'content_data' => [],
    ];
  }


  /**
   * Регистрация нового пользователя
   * @param array $data
   * @return array ['sitename', 'content_data', 'title', 'view']
   * */
  public function signup()
  {
    if (isset($_POST['reg'])) {
      $data = $_POST;
      $user = new User();

      if ($result = $user->registrate($data)) {

        if ($result['success']) {
          echo 'Есть результат! ';
          print_r($result);
          return $this->login($result);
//            [
//            'sitename' => $this->sitename,
//            'content_data' => [
//              'message' => "Вы успешно зарегистрировались c ID: {$result['id']}! Теперь войдите в свой аккакнт: ",
//            ],
//            'title' => 'Вход',
//            'view' => 'user/login.html'
//          ];

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
