<?php

namespace Fw2\Controller;

use Fw2\Model\User as User;

class UserController extends Controller
{

  private User $user;

  function __construct()
  {
    $this->user = new User;
    parent::__construct();
    $this->view = 'user/login.html';
  }


  /**
   * Индексный метод.
   */
  public function index($data = [])
  {
    if (isset($_SESSION['logged_user'])) {
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
//      $user = new User();

      if ($result = $this->user->auth($data)) {
        // Если авторизовались, то переходим в личный кабинет:
        if ($result['success']) {
          if (isset($_SESSION['logged_user'])) {
            $id = $_SESSION['logged_user'];
            $userData = $this->user->getData($id);
            $_SESSION['role'] = $userData['role'];
//            print_r($userData);
            $userName = $userData['name'];
            $userEmail = $userData['email'];
            $userPhone = $userData['phone'];
            $userLogin = $userData['login'];
            return [
              'sitename' => $this->sitename,
              'content_data' => [
                'user' => [
                  'name' => $userName,
                  'email' => $userEmail,
                  'phone' => $userPhone,
                  'login' => $userLogin,
                ]
              ],
              'title' => 'Личный кабинет',
              'view' => 'user/account.html'
            ];
          }
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
      return $result;
    }

  }


  public function logout()
  {
    if ($this->user->unsetLoggedSession()) {
      $_SESSION['asAjax'] = true;
      return true;
//        [
//        'sitename' => $this->sitename,
//        'view' => 'index/index.html',
//        'content_data' => [
//          'message' => "Вы вышли из аккаунта! ",
//        ],
//      ];
    } else {
      $_SESSION['asAjax'] = true;
      return false;
//        [
//        'sitename' => $this->sitename,
//        'view' => 'index/index.html',
//        'content_data' => [
//          'message' => "Вы НЕ вышли из аккаунта! ",
//        ]
//      ];
    }
  }


  public function account()
  {
    if (isset($_SESSION['logged_user'])) {
      $id = $_SESSION['logged_user'];
      $userData = $this->user->getData($id);
//      print_r($userData);
      $userName = $userData['name'];
      $userEmail = $userData['email'];
      $userPhone = $userData['phone'];
      $userLogin = $userData['login'];
      return [
        'sitename' => $this->sitename,
        'view' => 'user/account.html',
        'title' => 'Личный кабинет',
        'content_data' => [
          'user' => [
            'name' => $userName,
            'email' => $userEmail,
            'phone' => $userPhone,
            'login' => $userLogin,
          ]
        ],
      ];
    } else {
      return $this->index();
    }

  }


  /**
   * Функция устарела
   * Регистрация нового пользователя
   *
   * @param array $data
   * @return array ['sitename', 'content_data', 'title', 'view']
   * */
//  public function signup1()
//  {
//    // регистрация нового пользователя
//    if (isset($_POST['reg'])) {
//      $data = $_POST;
//      $user = new User();
//
//      if ($result = $user->registrate($data)) {
//
//        if ($result['success']) {
//          echo 'Есть результат! ';
//          print_r($result);
//          return $this->login($result);
//
//        } else {
//          return [
//            'sitename' => $this->sitename,
//            'content_data' => [
//              'message' => array_shift($result),
//              'login' => $_POST['login'],
//              'name' => $_POST['name'],
//              'email' => $_POST['email'],
//              'phone' => $_POST['phone'],
//            ],
//            'title' => 'Регистрация',
//            'view' => 'user/registration.html'
//          ];
//        }
//      }
//
//    } // если нет поста, отображается страница регистрации по умолчанию
//    else {
//      return [
//        'sitename' => $this->sitename,
//        'content_data' => [
//          'message' => 'Зарегистрируйтесь на нашем сайте. Пожалуйста: ',
//        ],
//        'title' => 'Регистрация',
//        'view' => 'user/registration.html'
//      ];
//    }
//  }

  /**
   * открывает страницу регистрации
   *
   * @return array
   */
  public function signupPage()
  {
    return [
      'sitename' => $this->sitename,
      'content_data' => [
        'message' => 'Зарегистрируйтесь на нашем сайте. Пожалуйста: ',
      ],
      'title' => 'Регистрация',
      'view' => 'user/registration.html'
    ];
  }

  /**
   * принимает и обрабатывает форму регистрации пользователя
   */
  public function signup()
  {
    $_SESSION['asAjax'] = true;
    if (!$_POST) {
      die('Нет данных нового пользователя для обработки');
    }

    $json = file_get_contents('php://input');
    $data = json_decode($json, true);

    $user = new User();
    return json_encode($user->registrate($data));
  }

}
