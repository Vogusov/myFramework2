<?php

namespace Fw2\Controller;

use \Fw2\Core\Config as Config;

class Controller
{
  public $view;
  public $sitename;

  function __construct()
  {
    $this->sitename = Config::get('sitename');
  }

  public function index(array $data)
  {
    return [];
  }
}