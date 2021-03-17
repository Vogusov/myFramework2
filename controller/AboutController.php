<?php
namespace Fw2\Controller;

class AboutController extends Controller
{
  public $title;

  function __construct()
  {
    parent::__construct();
    $this->title = 'О нас';
    $this->view = 'about';
  }

  //метод, который отправляет в представление информацию в виде переменной content_data
  //параметр -> GET Array([path]=>Catalog/index/6 [page]=>Catalog [action]=>index [id]=>6 )
  function index($data)
  {
    return "Это страница c интересной информацией о нас и нашем магазине!";
  }

}

//site/index.php?path=index/test/5