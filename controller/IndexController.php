<?php
namespace Fw2\Controller;

class IndexController extends Controller
{

  function __construct()
  {
    parent::__construct();
    $this->title = 'Главная страница';
    $this->view = 'index/index.html';
  }

  /**
   * @param array $data
   * @return array ['sitename', 'content_data', 'title', 'view']
   * */
  function index(array $data)
  {
    return [
      'sitename' => $this->sitename,
      'content_data' => 'Добро пожаловать на наш сайт! Скоро здесь появится много интересного!',
      'title' => $this->title,
      'view' => $this->view
    ];
  }

}

//site/index.php?path=index/test/5