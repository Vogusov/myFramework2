<?php

namespace Fw2\Controller;

use \Fw2\Model\Goods as Goods;
use Fw2\Model\Orders as Orders;

class AdminController extends Controller
{
  public array $products;
  public array $orders;
//  protected Goods $goods;
  function __construct()
  {
    $this->orders = Orders::getAll();
    $this->products = Goods::getAllWithDeleted();
    parent::__construct();
    $this->title = 'Панель управления и администрирования';
    $this->view = 'admin/goods.html';
  }



  function index($data) {
    return $this->goods($data);
  }

  function goods($data) {
    return [
      'sitename' => $this->sitename,
      'content_data' => [
        'text' => 'Добавление и редактирование товаров',
      ],
      'admin_content' => [
        'products' => $this->products
      ],
      'title' => $this->title,
      'view' => 'admin/goods.html'
    ];
  }

  function orders($data) {
print_r($this->orders);
      return [
        'sitename' => $this->sitename,
        'content_data' => [
          'text' => 'Управление заказами',
        ],
        'admin_content' => [
          'orders' => $this->orders
        ],
        'title' => $this->title,
        'view' => 'admin/orders.html'
      ];

  }

  function content($data) {

    return [
      'sitename' => $this->sitename,
      'content_data' => [
        'text' => 'Редактирование контента',
      ],
      'title' => $this->title,
      'view' => 'admin/content.html'
    ];
  }
}