<?php

namespace Fw2\Controller;

use \Fw2\Model\Goods as Goods;

class AdminController extends Controller
{
  public array $products;
//  protected Goods $goods;
  function __construct()
  {
    $this->products = Goods::getAll();
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

      return [
        'sitename' => $this->sitename,
        'content_data' => [
          'text' => 'Управление заказами',
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