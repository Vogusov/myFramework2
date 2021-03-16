<?php

namespace Fw2\Controller;

use \Fw2\Core\Config as Config;

class Controller
{
  public $view;
  public $title;

  function __construct()
  {
    $this->title = Config::get('sitename');
  }

  public function index(array $data)
  {
    return [];
  }
}