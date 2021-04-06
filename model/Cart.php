<?php


namespace Fw2\Model;

use Fw2\Core\Db as Db;

class Cart
{
  public $user_id;

  public function __construct()
  {
    $this->user_id = $_SESSION['logged_user'];
//    echo "!!! $this->user_id !!!";
  }

// Записываем новую строку в корзину
  public function add(int $product_id): int
  {
    return Db::getInstance()->insert('insert into `cart` (`product_id`, `user_id`) values (:product_id, :user_id)', ['product_id' => $product_id, 'user_id' => $this->user_id]);

//    return Db::getInstance()->insert('insert into `cart` (`product_id`, `session_id`)
//        values (:product_id, :session_id)', ['product_id' => $id, 'session_id' => session_id()]);
  }

  // Увеличиваем количество товара на 1
  public function increase(int $product_id): int
  {
    return Db::getInstance()->update('update `cart` set `quantity` = `quantity` + 1, `date_changed` = now() 
        where `product_id` = :product_id and `user_id` = :user_id',
        ['product_id' => $product_id, 'user_id' => $this->user_id]);
  }

  // Уменьшаем количкство товара на 1
  public function decrease(int $product_id): int
  {
    return Db::getInstance()->update('update `cart` set `quantity` = `quantity` - 1, `date_changed` = now()
        where `product_id` = :product_id and `user_id` = :user_id',
      ['product_id' => $product_id, 'user_id' => $this->user_id]);
  }

  // Удалить из корзины 1 товар. Возврщает кол-во рядов
  public function remove(int $product_id)
  {
    return Db::getInstance()->delete('delete from `cart` where `product_id` = :product_id AND `user_id` = :user_id',
      ['product_id' => $product_id, 'user_id' => $this->user_id]);
  }

  // Проверяем, есть ли товар
  public function isProductInCart(int $product_id)
  {
    return Db::getInstance()->getRow(
      'select * from `cart` where `product_id` = :product_id and `user_id` = :user_id',
      ['product_id' => $product_id, 'user_id' => $this->user_id]);
  }

  // Все товары в корзине по заданному userID
  public function getAll()
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
        where cart.user_id = :user_id',
      ['user_id' => $this->user_id]);
  }
}