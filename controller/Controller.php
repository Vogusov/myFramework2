<?php

namespace Fw2\Controller;

use \Fw2\Core\Config as Config;

class Controller
{
  public string $view; // название папки с шаблоном
  public string $sitename;
  public string $title;

  public function __construct()
  {
    $this->sitename = Config::get('sitename');

  }

  public function index(array $data)
  {
    return [];
  }

  protected function isGet()
  {
    return $_SERVER['REQUEST_METHOD'] == 'GET';
  }

  //
  // Запрос произведен методом POST?
  //
  protected function isPost()
  {
    return $_SERVER['REQUEST_METHOD'] == 'POST';
  }

}