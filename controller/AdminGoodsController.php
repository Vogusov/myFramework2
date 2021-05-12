<?php

namespace Fw2\Controller;

use Fw2\Core\Config;
use Fw2\Model\Funcs as Funcs;
use Fw2\Model\Goods as Goods;

class AdminGoodsController extends Controller
{
  public array $products;
  public $admC;

  function __construct()
  {
    $this->admC = new AdminController();
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

  function edit($data)
  {
    if (!isset($data['id'])) {
      echo 'Нет ИД товара';
    }
    $productId = $data['id'];

    // Если ПОСТ, то сохраняем данные о продукте
    if (isset($_POST['save-edited'])) {
      $rows = self::saveEdited($productId);
      if ($rows <= 0) {
        echo "Товар не изменен";
      }
      $products = Goods::getAll();
      $this->admC->index([]);

//      return
//        [
//          'sitename' => $this->sitename,
//          'content_data' => [
//            'text' => 'Добавление и редактирование товаров',
//          ],
//          'admin_content' => [
//            'products' => $products
//          ],
//          'title' => $this->title,
//          'view' => 'admin/goods.html'
//        ];
    }

    // по умолчанию открываем форму редактирования
    $product = Goods::getProduct($productId);

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


  /**
   * Обработка и сохранение каринки.
   * todo: Разобрать по классам и методам
   */
  private function saveEdited($productId): int
  {
    if (!isset($_POST['save-edited'])) {
      echo 'Нет поста!';
    }

    if ($productId != $_POST['id']) {
      echo 'Что-то не так с ID товара! ';
    }

    //картинка:
    if (isset($_FILES['file-img'])) {
      $img_file_name = Funcs::translit($_FILES['file-img']['name']);
      $path = Config::get('catalog_images') . $img_file_name;
      $path_sm = Config::get('catalog_images_sm') . $img_file_name;
      $file_size = $_FILES['file-img']['size'];

      // валидация картинки
      if ($_FILES['file-img']['error']) {
        print_r($_FILES['file-img']['error']);
        echo 'Ошибка загрузки файла';
      } elseif ($_FILES['file-img']['size'] > 1000000) {
        echo "Файл слишком большой. Заргружаемый файл должен быть не больше 1Мб <br> <a href=\"index.php\">К галерее</a>";
      } elseif (strlen($img_file_name) > 30) {
        echo "Имя файла слишком длинное. Переименуйте файл перед загрузкой. Имя файла должно быть короче 30 символов.";
      } elseif (
        $_FILES['file-img']['type'] == 'image/jpeg' ||
        $_FILES['file-img']['type'] == 'image/png' ||
        $_FILES['file-img']['type'] == 'image/gif'
      ) {
        print_r($_FILES['file-img']['tmp_name']);
        // копируем картинку в нашу папку, уменьшаем и копируем в папку с маленькими
        if (copy($_FILES['file-img']['tmp_name'], $path)) {
          Funcs::resizeImg($path, $path_sm, Config::get('catalog_sm_img_size'));

          echo "Файл загружен! <br>";
        } else {
          echo "Обшибка при загрузке файла";
        }
      }
// todo: если не загружена картинка, назначить ее имя. Или сохранить имеющуюся
      $product = [];
      $product['id'] = $productId;
      $product['name'] = trim(strip_tags($_POST['name']));
      $product['price'] = trim(strip_tags($_POST['price']));
      $product['category'] = (int)trim(strip_tags($_POST['category']));
      $product['description'] = trim(strip_tags($_POST['description']));
      $product['status'] = trim(strip_tags($_POST['status']));
      if (!empty($img_file_name)) {
//        echo " name: $img_file_name !";
        $product['img'] = $img_file_name;
      } else {
        $prod = Goods::getProduct($productId);
        $product['img'] = $prod['img'];
      }
    }
    // если не загружена картинка, то вводим ее имя в поле
//    if (isset($_POST['img']))
//      $product['img'] = $_POST['img'];

    $rows = Goods::editProduct($product);
//    $products = Goods::getAll();
    return $rows;

  }

  function addNew()
  {
    // по умолчанию открываем страницу с формой добавления товара
    if (!isset($_POST['add-new']))
      return [
        'sitename' => $this->sitename,
        'content_data' => [],
        'admin_content' => [
          'products' => $this->products
        ],
        'title' => 'Добавление нового товара',
        'view' => 'admin/addNew.html'
      ];

    // если есть пост, то выполняем сохранение и возврощаем индексную страницу
    $productData = $_POST;
    $productId = self::saveNew($productData);
    if ($productId)

      return [
        'sitename' => $this->sitename,
        'content_data' => [
          'text' => "Новы товар успешно сохранен с ID $productId! ",
        ],
        'admin_content' => [
          'products' => $this->products
        ],
        'title' => $this->title,
        'view' => 'admin/goods.html'
      ];
  }


  private static function saveNew(array $productData): int
  {
    $data = [
      'name' => trim($productData['name']),
      'price' => trim($productData['price']),
      'category' => trim($productData['category']),
      'description' => trim($productData['description']),
      'status' => trim($productData['status']),
      'img' => trim($productData['img']),
    ];


    return $productId = Goods::saveNewProduct($data);
  }


}