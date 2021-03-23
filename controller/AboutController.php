<?php
namespace Fw2\Controller;

class AboutController extends Controller
{

  function __construct()
  {
    parent::__construct();
    $this->title = 'О нас';
    $this->view = 'about/index.html';
  }

  /**
   * @param array $data
   * @return array ['sitename', 'content_data', 'title', 'view']
   * */
  function index($data)
  {
    return [
      'sitename' => $this->sitename,
      'content_data' => "Это страница c интересной информацией о нас и нашем магазине!",
      'title' => $this->title,
      'view' => $this->view
    ];
  }

}

//site/index.php?path=index/test/5