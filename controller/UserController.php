<?php
namespace Fw2\Controller;

class UserController extends Controller
{
//  public

  function __construct()
  {
    parent::__construct();
    $this->view = 'user';

  }

  //метод, который отправляет в представление информацию в виде переменной content_data
  //параметр -> GET Array([path]=>Catalog/index/6 [page]=>Catalog [action]=>index [id]=>6 )
  function login($data)
  {
    echo "Hello";
    $this->title = 'Вход';
    return "Войдите или зарегистрируйтесь!" . $this->title;
  }

  function registration($data)
  {
    $this->title = 'Регистрация';
    return "Введите данные для регистрации: ";
  }

}

//site/index.php?path=index/test/5