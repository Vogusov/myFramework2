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

/**
 * todo: реализовать добавление в корзину!!!
 *
 * */
  function add($data)
  {
    if (isset($data)) {
      session_start();
      $_SESSION['id_in_cart'][] = $data['id'];
      $_SESSION['asAjax'] = true;
      return count($_SESSION['id_in_cart']);
    } else {
      echo "Data [ID] is empty!!!";
    }
  }
}
//site/index.php?path=index/test/5