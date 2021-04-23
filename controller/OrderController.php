<?php

namespace Fw2\Controller;

use Fw2\Core\Db;
use Fw2\Model\Orders as Orders;
use Fw2\Model\Cart as Cart;

class OrderController extends Controller
{
  private Cart $cart;
  private Orders $orders;

  function __construct()
  {
    $this->cart = new Cart();
    $this->orders = new Orders();
    parent::__construct();
    $this->title = 'Заказы';
    $this->view = 'user/orders.html';
  }

  /**
   * @param array $data
   * @return array ['sitename', 'content_data', 'title', 'view']
   * */
  public function index($data)
  {
    if (!isset($data['id'])){
      $userId = $_SESSION['logged_user'];
    }

    $userId = $data['id'];

    $orders = $this->usersOrdersHandler($userId);
    unset($_SESSION['confirmOrder']);

    return [
      'sitename' => $this->sitename,
      'content_data' => [
        'text' => 'Это страница с вашими заказами.',
        'orders' => $orders,
      ],
      'title' => $this->title,
      'view' => $this->view
    ];
  }

  public function confirmOrder($data) {

    print_r($_SESSION);
    if(!isset($_POST['order'])) {
      $products = $this->cart->getAll();
      print_r($products);
      unset($_SESSION['confirmOrder']);
      $_SESSION['confirmOrder'] = true;
      return [
        'sitename' => $this->sitename,
        'content_data' => [
          'text' => 'Нажмите "оформить", чтобы подтвердить заказ. Мы Вам перезвоним',
          'products' => $products,
        ],
        'title' => 'Подтверждение заказа',
        'view' => 'user/confirmOrders.html'
      ];
    } else {
      if(isset($_POST['info'])){
        $info = $_POST['info'];
//        print_r($info);
        if (isset($_SESSION['confirmOrder'])){
          $userId = $data['id'];
          $this->formOrderHandler($userId, $info);
          $orders = $this->usersOrdersHandler($userId);
          // form order
          unset($_SESSION['confirmOrder']);
          return [
            'sitename' => $this->sitename,
            'content_data' => [
              'text' => 'Это страница с вашими заказами.',
              'orders' => $orders,
            ],
            'title' => $this->title,
            'view' => $this->view
          ];
        } else {
          return $this->index($data);
        }


      }
    }

    }


  /**
   * @param int $userId
   * @param string $info
   * @return array $products
   */
  private function formOrderHandler(int $userId, string $info)
  {
    return $this->orders->formOrder($userId, $info);
  }

  /**
   * @param int $userId
   *
   * @return array $usersOrders
   */
  private function usersOrdersHandler(int $userId)
  {
    $orders = $this->orders->usersOrders($userId);

    foreach ($orders as &$order) {

      $orderId = $order['id'];
      $products = $this->orders->ordersProducts($userId, $orderId);

      $order['products'] = $products;
    }
    return $orders;
  }
}