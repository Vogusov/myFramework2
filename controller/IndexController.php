<?php
namespace Fw2\Controller;

class IndexController extends Controller
{
  public $title;
  public $view;


  function __construct()
  {
    parent::__construct();
    $this->title = 'Главная страница';
    $this->view = 'index';
  }

  //метод, который отправляет в представление информацию в виде переменной content_data
  function index($data)
  {
    return "Добро пожаловать на наш сайт! Скоро здесь поя вится много интересного!";
  }

}

//site/index.php?path=index/test/5