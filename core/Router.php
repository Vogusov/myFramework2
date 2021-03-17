<?php

namespace Fw2\Core;

use Fw2\Core\Db as Db;
use \Fw2\Model\Category as Category;

require_once '../vendor/autoload.php';

class Router
{
  public static function init()
  {
    Db::getInstance()->connect(Config::get('db_user'), Config::get('db_password'), Config::get('db_base'));
//
//    echo "<br>DB0: ";
//    print_r( Db::getInstance());


    if (php_sapi_name() !== 'cli' && isset($_SERVER) && isset($_GET)) {
      self::run($_GET['path'] ?? '');
    }
  }

  //http://site.ru/index.php?path=News/delete/5


  protected static function run($url)//РОУТЕР!!!
  {
    /*
     * Разбираем url на параметры
     * */
    $url = explode("/", $url);
    if (!empty($url[0])) {
      $_GET['page'] = $url[0];//Часть имени класса контроллера
      if (!empty($url[1])) {
        if (is_numeric($url[1])) {
          $_GET['id'] = $url[1];
        } else {
          $_GET['action'] = $url[1];//часть имени метода
        }
        if (!empty($url[2 ])) {//формальный параметр для метода контроллера
          $_GET['id'] = $url[2];
        }
      } else {
        $_GET['action'] = 'index';
      }
    } else {
      $_GET['page'] = 'index';
    }


    /*
     * Определяем контроллер и исполняемый метод;
     * На основании этого метода формируем массив $data для шаблонизатора Twig;
     * Рендерим Twig.
     * */
    if (isset($_GET['page'])) {
      $controllerName = Config::get('namespace_controller') . ucfirst($_GET['page']) . 'Controller';//IndexController
      $methodName = $_GET['action'] ?? 'index';

      $controller = new $controllerName();

      // Ключи данного массива доступны в любой вьюшке
      // Массив data - это массив для использования в любой вьюшке
      $data = [
        'sitename' => $controller->sitename,
        'content_data' => $controller->$methodName($_GET), // вызов метода контроллера с параметром (если есть)
        'title' => $controller->title,
      ];
      print_r($data);
      $view = $controller->view . '/' . $methodName . '.html';

      echo "<br>DB: ";
     print_r( Db::getInstance());

      if (!isset($_GET['asAjax'])) {
        $loader = new \Twig\Loader\FilesystemLoader(Config::get('path_templates'));
        $twig = new \Twig\Environment($loader);
        echo $template = $twig->render($view, $data);

      } else {
        echo json_encode($data);
      }
    }
  }


}