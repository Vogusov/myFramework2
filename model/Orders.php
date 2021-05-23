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
   *
   * @return array
   * */
  public function formOrder($user_id, $info)
  {

    try {
      Db::getInstance()->begin();

      //  1. Записывам в `orders`. Формируем номер заказа
      $orderId = Db::getInstance()->insert('insert into `orders` (`user_id`, `additional_info`, `date_time_formed`) values (:user_id, :info, now())',
        ['user_id' => $user_id, 'info' => $info]);

      //  2. Получаем все записи (активные) из cart с userId
      $usersCart = Db::getInstance()->select('select * from `cart` where cart.user_id = :user_id',
        ['user_id' => $user_id]);

      //  3. Записывам в `orders_products`
      foreach ($usersCart as $product) {
        $row[] = Db::getInstance()->insert('insert into `orders_products` (`order_id`, `product_id`, `quantity`) values (:order_id, :product_id, :quantity)',
          ['order_id' => $orderId, 'product_id' => $product['product_id'], 'quantity' => $product['quantity']]);
      }

      // 4. Отобразим в корзине: ...;
      $rows = Db::getInstance()->delete('delete from `cart` where `user_id` = :user_id', ['user_id' => $user_id]);

      Db::getInstance()->commitTransaction();

    } catch (Exception $e) {
      Db::getInstance()->rollbackTransaction();
      echo $e->getMessage();
    }


  }

  public function getOrders($userId)
  {
    return Db::getInstance()->select('select orders.id as order_id,
       orders.additional_info as info,
       g.name                 as name,
       g.status as status,
       product_id,
       quantity,
       price,
       category,
       description,
       img,
       (`quantity` * `price`) as `sum`

from orders
         inner join orders_products op on orders.id = op.order_id
         inner join goods g on op.product_id = g.id
         inner join categories cat on g.category = cat.id_category
where `orders`.`user_id` = :id',
      ['id' => $userId]);
  }

  public function usersOrders($userId) {
    return Db::getInstance()->select('select * from `orders` where `user_id` = :user_id', ['user_id' => $userId]);
  }

  public function ordersProducts($userId, $orderId)
  {
    return Db::getInstance()->select('
    select orders.id              as order_id,
       orders.additional_info as info,
       g.name                 as name,
       g.status as status,
       product_id,
       quantity,
       price,
       category,
       description,
       img,
       (`quantity` * `price`) as `sum`

from orders
         inner join orders_products op on orders.id = op.order_id
         inner join goods g on op.product_id = g.id
         inner join categories cat on g.category = cat.id_category
where `orders`.`user_id` = :user_id and order_id = :order_id
    ', ['user_id' => $userId, 'order_id' => $orderId]);
  }
}