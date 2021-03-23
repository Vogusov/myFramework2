<?php
namespace Fw2\Controller;

class CartController extends Controller
{

  function __construct()
  {
    parent::__construct();
    $this->title = 'Корзина';
    $this->view = 'cart/index.html';
  }

  /**
   * @param array $data
   * @return array ['sitename', 'content_data', 'title', 'view']
   * */
  function index($data)
  {
    return [
      'sitename' => $this->sitename,
      'content_data' => "Это ваша корзина! Она пока пуста. Дождитесь, пока появятся товары в нашем <a href=\"/index.php?path=catalog/\">магазине</a>",
      'title' => $this->title,
      'view' => $this->view
    ];
  }
}

//site/index.php?path=index/test/5