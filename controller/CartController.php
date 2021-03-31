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
    if (isset($_POST['action'])){
      // делаем action
      session_start();
      $_SESSION['id_in_cart'][] = self::add($_POST['id']);
      $_SESSION['asAjax'] = true;
      echo "сессия в корзине: ";
      print_r($_SESSION['id_in_cart']);
      return count($_SESSION['id_in_cart']);
//      echo '!Data from PHP!';
    } else {
      // возвращаем индексную страницу
      return [
        'sitename' => $this->sitename,
        'content_data' => "Это ваша корзина! Она пока пуста. Дождитесь, пока появятся товары в нашем <a href=\"/index.php?path=catalog/\">магазине</a>",
        'title' => $this->title,
        'view' => $this->view
      ];

    }
  }

  protected static function add($id) {

    if (!empty($id)){

      return "$id!";

    } else {
      echo "Data [ID] is empty!!!";
    }

//    return "есть контакт!";
  }
}

//site/index.php?path=index/test/5