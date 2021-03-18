<?php
namespace Fw2\Controller;

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
  function index($data)
  {
    return [
      'sitename' => $this->sitename,
      'content_data' => "Это страница католога! Скоро здесь будет отображаться {$data['id']} товаров!",
      'title' => $this->title,
      'view' => $this->view
    ];
  }

}

//site/index.php?path=index/test/5