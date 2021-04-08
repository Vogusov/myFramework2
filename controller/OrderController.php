<?php

namespace Fw2\Controller;

use Fw2\Model\Orders as Orders;
//use Fw2\Model\User as User;

class OrderController extends Controller
{
  private Orders $orders;
  function __construct()
  {
    $this->orders = new Orders;
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
    $products = [];
    // formorder
    $this->formOrderHandler($userId);

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

  /**
   * @param int $userId
   * @return array $products
   * */
  private function formOrderHandler($userId)
  {
    $this->orders->formOrder($userId);
  }
}