<?php

namespace Fw2\Controller;

use Fw2\Model\User as User;

class CatalogController extends Controller
{

  function __construct()
  {
    parent::__construct();
    $this->title = 'Каталог';
    $this->view = 'catalog/index.html';
  }

  /**
   * @param array $data
   * @return array ['sitename', 'content_data', 'title', 'view']
   * */
  function index(array $data = [])
  {
    $id = !isset($data['id']) ? 10 : $data['id'];
    $goods = Goods::getAllGoods();

    return [
      'sitename' => $this->sitename,
      'content_data' => [
        'message' => "Это страница католога! Скоро здесь будет отображаться $id товаров!",
      'products' => $goods,
      ],
      'title' => $this->title,
      'view' => $this->view
    ];
  }

  function product($data) {
    $product = Goods::getProduct($data['id']);
    print_r($product);
    return [
      'sitename' => $this->sitename,
      'content_data' => [
        'id' => $data['id'],
        'message' => "Это страница товара {$product['name']}!",
        'product' => $product,
      ],
      'title' => $product['name'],
      'view' => 'catalog/product.html'
    ];
  }

}

//site/index.php?path=index/test/5