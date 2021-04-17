<?php

namespace Fw2\Controller;

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
    if (!isset($data['id']))
      return false;

    $userId = $data['id'];
    $products = $this->formOrderHandler($userId);;
    // form order
    unset($_SESSION['confirmOrder']);


    return [
      'sitename' => $this->sitename,
      'content_data' => [
        'text' => 'Это страница с вашими заказами.',
        'products' => $products,
      ],
      'title' => $this->title,
      'view' => $this->view
    ];
  }

  public function confirmOrder() {
    $products = $this->cart->getAll();
    $_SESSION['confirmOrder'] = true;
    return [
      'sitename' => $this->sitename,
      'content_data' => [
        'text' => 'Нажмите "оформить", чтобы подтвердить заказ. Мы Вам перезвоним',
        'products' => $products,
      ],
      'title' => $this->title,
      'view' => $this->view
    ];
  }

  /**
   * @param int $userId
   * @return array $products
   * */
  private function formOrderHandler(int $userId)
  {
    return $this->orders->formOrder($userId);
  }
}