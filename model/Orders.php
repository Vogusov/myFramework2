<?php


namespace Fw2\Model;

use Fw2\Core\Db as Db;
use mysql_xdevapi\Exception;

class Orders
{

  /**
   * Записываем из таблицы Cart в таблицу Orders данные о товарах
   * Потом в таблицу Orders_Products
   * Потом в удаляем из корзины (или меняем статус на 'оформлен')
   * @return array $products
   * */
  public function formOrder($user_id)
  {

    try {
      Db::getInstance()->beginTransaction();

      //  1. Получаем все записи (активные) из cart с userId
      $usersCart = Db::getInstance()->select('select * from `cart`
        where cart.user_id = :user_id',
        ['user_id' => $user_id]);

      //  2. Записывам в `orders_products` список товаров для каждого заказа с колличесвом из Корзины.

      //  3. Очищаем корзину

      Db::getInstance()->commitTransaction();
      return [];

    } catch (Exception $e) {
      Db::getInstance()->rollbackTransaction();
      echo "Ошибка: " . $e->getMessage();
    }


  }
}