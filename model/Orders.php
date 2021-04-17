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
  public function formOrder($user_id, $info)
  {

    try {
      Db::getInstance()->begin();
      echo 'транзакция началась!<br>';
      var_dump($user_id);
      var_dump($info);

      //  1. Записывам в `orders`. Формируем номер заказа
      $orderId = Db::getInstance()->insert('insert into `orders` (`user_id`, `additional_info`, `date_time_formed`) values (:user_id, :info, now())',
        ['user_id' => $user_id, 'info' => $info]);
      echo "сформировали заказ: ";
      var_dump($orderId);
      echo "<br>";

      //  2. Получаем все записи (активные) из cart с userId
      $usersCart = Db::getInstance()->select('select * from `cart` where cart.user_id = :user_id',
        ['user_id' => $user_id]);
      echo "Записи из корзинки: ";
      var_dump($usersCart);
      echo "<br>";

      //  3. Записывам в `orders_products`
      foreach ($usersCart as $product) {
        $row[] = Db::getInstance()->insert('insert into `orders_products` (`order_id`, `product_id`, `quantity`) values (:order_id, :product_id, :quantity)',
          ['order_id' => $orderId, 'product_id' => $product['product_id'], 'quantity' => $product['quantity']]);
      }
      echo "Записи в orders_products: ";
      var_dump($row);
      echo "<br>";

      // 4. Отобразим в корзине: ...;
      $rows = Db::getInstance()->delete('delete from `cart` where `user_id` = :user_id', ['user_id' => $user_id]);
      echo "Удалили из корзины: ";
      var_dump($rows);
      echo "<br>";

      Db::getInstance()->commitTransaction();

    } catch (Exception $e) {
      Db::getInstance()->rollbackTransaction();
      echo "Ошибка при транзакции: " . $e->getMessage();
    }


  }

  public function getOrders($order_id)
  {
    Db::getInstance()->select('select orders.id              as order_id,
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
where `orders`.`id` = :id',
      ['id' => $order_id]);
  }
}