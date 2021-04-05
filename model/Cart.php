<?php


namespace Fw2\Model;

use Fw2\Core\Db as Db;

class Cart
{

// Записываем новую строку в корзину
  public function add(int $id):int
  {
    return Db::getInstance()->insert('insert into `cart` (`product_id`, `session_id`) 
        values (:product_id, :session_id)', ['product_id' => $id, 'session_id' => session_id()]);
  }

  // Увеличиваем количество товара на 1
  public function increase(int $id):int
  {
    return Db::getInstance()->update('update `cart` set `quantity` = `quantity` + 1, `date_changed` = now() where `product_id` = :id', ['id' => $id]);
  }

  // Уменьшаем количкство товара на 1
  public function decrease(int $id):int
  {
    return Db::getInstance()->update('update `cart` set `quantity` = `quantity` - 1, `date_changed` = now() where `product_id` = :id', ['id' => $id]);
  }

  // Удалить из корзины 1 товар. Возврщает кол-во рядов
  public function remove(int $id) {
    return Db::getInstance()->delete('delete from `cart` where `product_id` = :product_id AND `session_id` = :session_id',
      ['product_id' => $id, 'session_id' => session_id()]);
  }

  // Проверяем, есть ли товар
  public function isProductInCart(int $id)
  {
    return Db::getInstance()->getRow(
      'select * from `cart` where `product_id` = :id and `session_id` = :session_id',
      ['id' => $id, 'session_id' => session_id()]);
  }

  // Все товары в корзине по заданному ID
  public function getAll($sessionId)
  {
    return Db::getInstance()->select(
      'select cart.product_id as id, 
       goods.name as name,
       cart.quantity as quantity,
       goods.price as price,
       goods.description as description,
       goods.img as img
        from `cart`
        inner join `goods` on cart.product_id = goods.id
        where cart.session_id = :session_id',
      ['session_id' => $sessionId]);
    }
}