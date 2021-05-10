<?php

namespace Fw2\Controller;

use Fw2\Model\Goods as Goods;

class AdminGoodsController extends Controller
{
  public array $products;

  function __construct()
  {
    $this->products = Goods::getAll();
    parent::__construct();
    $this->title = 'Управление товарами';
    $this->view = 'admin/goods.html';
  }


  function index($data)
  {
    if (!isset($_POST['action'])) {
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


    }



  }

  function edit($data) {
    if (!isset($data['id'])) {
      echo 'Нет ИД товара';
    }
    $productId = $data['id'];

    if (isset($_POST['save-edited']))
    return self::saveEdited($productId);

    $product = Goods::getProduct($productId);
//    print_r($product);

    $result = [
      'sitename' => $this->sitename,
      'content_data' => [],
      'admin_content' => [
        'product' => $product
      ],
      'title' => 'Редактирование товара',
      'view' => 'admin/edit.html'
    ];

    return $result;
  }

  private function saveEdited($productId) {
    if (!isset($_POST['save-edited'])) {
      echo 'Нет поста!';
    }

    if ($productId != $_POST['id']) {
      echo 'Что-то не так с ID товара! ';
    }

    $product = [];
    $product['id'] = $_POST['id'];
    $product['name'] = $_POST['name'];
    $product['price'] = $_POST['price'];
    $product['category'] = $_POST['category'];
    $product['description'] = $_POST['description'];
    $product['status'] = $_POST['status'];
    $product['img'] = $_POST['img'];

    $rows = Goods::editProduct($product);
    $this->products = Goods::getAll();
    return self::index([]);
  }


}