<?php

namespace Fw2\Controller;

use Fw2\Model\Goods as Goods;

class AdminGoodsController extends Controller
{
  public array $products;
  protected Goods $goods;

  function __construct()
  {
    $this->products = Goods::getAll();
    parent::__construct();
    $this->title = 'Управление товарами';
    $this->view = 'admin/goods.html';
  }


  function index($data)
  {
    if (!isset($_POST)) {
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

    if ($_POST['action']) {
      $_SESSION['asAjax'] = true;
    }

    switch ($_POST['action']) {

      case 'delete':
        $productId = $_POST['id'];
        $rows = Goods::deleteProduct($productId);
        return $rows;
//          [
//          'sitename' => $this->sitename,
//          'content_data' => [
//            'text' => 'Добавление и редактирование товаров',
//          ],
//          'admin_content' => [
//            'products' => $this->products,
//            'rows' => $rows
//          ],
//          'title' => $this->title,
//          'view' => 'admin/goods.html'
//        ];

    }


  }



  /*

  function goods($data) {
//    print_r($this->products);
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

  */
}