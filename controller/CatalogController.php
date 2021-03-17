<?php
namespace Fw2\Controller;

class CatalogController extends Controller
{
  public $title;

  function __construct()
  {
    parent::__construct();
    $this->title = 'Каталог';
    $this->view = 'catalog';
  }

  //метод, который отправляет в представление информацию в виде переменной content_data
  //параметр -> GET Array([path]=>Catalog/index/6 [page]=>Catalog [action]=>index [id]=>6 )
  function index($data)
  {
    return "Это страница католога! Скоро здесь будет отображаться {$data['id']} товаров!";
  }

}

//site/index.php?path=index/test/5