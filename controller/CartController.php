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

  /**
   * @param array $data
   *
   * @return array
   */
  function index($data)
  {
    $products = $this->getProducts();

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
   * @param array $data
   *
   * @return array
   */
  function delete($data)
  {
    $productId = $data['id'];
    return $this->cart->remove($productId);
  }

  /**
   * @param array $data
   *
   * @return array
   */
  function changeQnt($data)
  {
    $_SESSION['asAjax'] = true;
    $productId = $data['id'];
    $quantity = $_POST['quantity'];

    if (isset($_POST['sign'])) {
      // выбираем знак
      if ($_POST['sign'] == '+') {
        $this->add($data);
        return ++$quantity;

      } elseif ($_POST['sign'] == '-') {

        // если товар один в корзине, то удаляем его
        if ($quantity == 1) {
          if ($rem = $this->cart->remove($productId)) {
            echo 0;
          } else {
            echo 'Не удалился';
          }
          // если товар не один, то уменьшаем на 1
        } elseif ($quantity > 1) {
          if ($this->cart->decrease($productId)) {
            return --$quantity;
          } else {
            return $quantity;
          }
        }
      } else {
        echo 'Неопознанный знак';
      }
    } else {
      echo 'Нет знака!';
    }
  }

  function getProducts()
  {
    if (isset($_SESSION['logged_user'])) {
      return $this->cart->getAll();
    } else {
      echo 'Нужно залогиниться';
    }
  }


  /**
   * @param array $data ['id']
   *
   * @return int
   */
  function add(array $data)
  {
    if (isset($_SESSION['logged_user'])) {
      if (isset($data)) {
        $productId = $data['id'];

        //1. Проверяем, есть ли товар в корзине
        if (!$this->cart->isProductInCart($productId)) {

          //2. Нет - Дописываем строку в корзину
          $lastId = $this->cart->add($productId);
          echo 'Мы тут!';
          $_SESSION['asAjax'] = true;
          return $lastId;

        } else {
          //2. Есть - увеличиваем
          $resultRow = $this->cart->increase($productId);
          $_SESSION['asAjax'] = true;
          return $resultRow;
        }

//      $_SESSION['id_in_cart'][] = $productId;
//      $_SESSION['asAjax'] = true;
      } else {
        echo "Data [ID] is empty!!!";
      }
    } else {
      echo 'Нужно авторизоваттьяся!';
  }

  }
}
//site/index.php?path=index/test/5