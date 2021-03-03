<?php

class IndexController extends Controller
{
  public $view = 'index';
  public $title;

  function __construct()
  {
    parent::__construct();
    $this->title .= ' | Главная страница';
  }

  //метод, который отправляет в представление информацию в виде переменной content_data
  function index($data)
  {
    return "Сработал {$data['page']} метод контролллера! Здесь должны отобразиться данные этой страницы!";
  }

  /*function test($id){

    }
*/

}

//site/index.php?path=index/test/5