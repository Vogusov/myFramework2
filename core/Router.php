<?php

namespace Fw2\Core;

use Fw2\Core\Db as Db;

require_once '../vendor/autoload.php';

class Router
{
  public static function init()
  {
    Db::getInstance()->connect(Config::get('db_user'), Config::get('db_password'), Config::get('db_base'));

    if (php_sapi_name() !== 'cli' && isset($_SERVER) && isset($_GET)) {
      self::run($_GET['path'] ?? '');
    }
  }

  //http://site.ru/index.php?path=News/delete/5


  protected static function run($url)  //РОУТЕР!!!
  {
    /**
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
        if (!empty($url[2])) {//формальный параметр для метода контроллера
          $_GET['id'] = $url[2];
        }
      } else {
        $_GET['action'] = 'index';
      }
    } else {
      $_GET['page'] = 'index';
    }


    /**
     * Определяем контроллер и исполняемый метод;
     * Запускаем Метод контроллера
     * На основании этого метода формируем массив $data для шаблонизатора Twig;
     * $data = ['sitename', 'content_data', 'title', 'view']
     * Рендерим Twig.
     * */
    if (isset($_GET['page'])) {
      $controllerName = Config::get('namespace_controller') . ucfirst($_GET['page']) . 'Controller';//IndexController
      $methodName = $_GET['action'] ?? 'index';

      $controller = new $controllerName();

      $data = $controller->$methodName($_GET); // Массив с данными для представления шаблонизатору


      // выполняем асинхронно, если asAjax. Рендерим страницу, если нет!
      if (!isset($_SESSION['asAjax'])) {

        if (!empty($data)) {
          if (!empty($data['view'])) {
            $view = $data['view']; // строка. Путь до шаблона.
          } else {
            echo "view is empty!!!";
          }
        } else {
          echo 'Дата пуста((( ';
        }

//        print_r($_SESSION);

        $loader = new \Twig\Loader\FilesystemLoader(Config::get('path_templates'));
        $twig = new \Twig\Environment($loader);
        $twig->addGlobal('session', $_SESSION);
        $twig->addGlobal('admin_role', Config::get('admin_role'));
        $twig->addGlobal('img_path', Config::get('catalog_images'));
        $twig->addGlobal('img_sm_path', Config::get('catalog_images_sm'));
        echo $template = $twig->render($view, $data);


      } else {

        // Если asAjax - Возвращение данных в JS
        // add - возвращает колличество вещей в корзине
        echo $data;
        unset($_SESSION['asAjax']);
      }



    }
  }


}