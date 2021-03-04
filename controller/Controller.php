<?php
namespace Fw2\Controller;

use \Fw2\Base\Config as Config;

class Controller
{
    public $view = 'admin';
    public $title;

    function __construct()
    {
        $this->title = Config::get('sitename');
    }

    public function index($data) {
        return [];
    }
}