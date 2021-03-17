<?php
namespace Fw2\Controller;

class CartController extends Controller
{

  function __construct()
  {
    parent::__construct();
    $this->title = 'Корзина';
    $this->view = 'cart';
  }

  //метод, который отправляет в представление информацию в виде переменной content_data
  //параметр -> GET Array([path]=>Catalog/index/6 [page]=>Catalog [action]=>index [id]=>6 )
  function index($data)
  {
    return "Это ваша корзина! Она пока пуста. Дождитесь, пока появятся товары в нашем <a href=\"/index.php?path=catalog/\">магазине</a>";
  }

}

//site/index.php?path=index/test/5