<?php
namespace Fw2\Controller;

use Fw2\Model\Cart;

class CartController extends Controller
{

  /**
   * @var Cart
   */
  private Cart $cart;

  function __construct()
  {
    $this->cart = new Cart();

    parent::__construct();
    $this->title = 'Корзина';
    $this->view = 'cart/index.html';

  }

  private function getProducts($sessionId) {
    return $this->cart->getAll($sessionId);
  }

  /**
   * @param array $data
   *
   * @return array
   */
  function index($data)
  {
    $products=$this->getProducts(session_id());

    return [
      'sitename' => $this->sitename,
      'content_data' => [
        'empty_message' => "Это ваша корзина! Она пока пуста. Дождитесь, пока появятся товары в нашем <a href=\"/index.php?path=catalog/\">магазине</a>",
        'products' => $products
      ],
      'title' => $this->title,
      'view' => $this->view
    ];

  }

  /**
   * @param array $data ['id']
   *
   * @return int
   */
  function add(array $data)
  {
    if (isset($data)) {
      $productId = $data['id'];

      //1. Проверяем, есть ли товар в корзине
      if (!$this->cart->isProductInCart($productId)) {

        //2. Нет - Дописываем строку в корзину
        $this->cart->add($productId);

      } else {
      //2. Есть - увеличиваем
      $this->cart->increase($productId);
      }

      $_SESSION['id_in_cart'][] = $productId;
      $_SESSION['asAjax'] = true;
      return count($_SESSION['id_in_cart']);
    } else {
      echo "Data [ID] is empty!!!";
    }
  }
}
//site/index.php?path=index/test/5