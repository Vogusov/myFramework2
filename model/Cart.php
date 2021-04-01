<?php


namespace Fw2\Model;

use Fw2\Core\Db as Db;

class Cart
{

// Записываем новую строку в корзину
  public function add(int $id)
  {
    return Db::getInstance()->insert('insert into `cart` (`product_id`, `session_id`) 
        values (:product_id, :session_id)', ['product_id' => $id, 'session_id' => session_id()]);
  }

  // Увеличиваем количество товара на 1
  public function increase(int $id)
  {
    return Db::getInstance()->update('update `cart` set `quantity` = `quantity` + 1, `date_changed` = now() where `product_id` = :id', ['id' => $id]);
  }

  // Уменьшаемколичкство товара на 1
  public function decrease($id)
  {

  }

  // Проверяем, есть ли товар
  public function isProductInCart(int $id)
  {
    return Db::getInstance()->getRow(
      'select * from `cart` where `product_id` = :id and `session_id` = :session_id',
      ['id' => $id, 'session_id' => session_id()]);
    }
}