<?php

namespace Fw2\Model;

use Fw2\Core\Db as Db;

class Goods
{


  public static function getAll()
  {
    $query = "SELECT * FROM `goods` where `deleted` != '1';";

    return Db::getInstance()->select(
      $query, []);
  }


  public static function getProduct($productId)
  {
    $query = "select * from `goods` where `id` = :id and `deleted` != '1';";

    return Db::getInstance()->getRow(
      $query, ['id' => $productId]);
  }


  public static function deleteProduct($productId)
  {
    $query = "update `goods` set `deleted` = '1' where `goods`.`id` = :productId;";

    return Db::getInstance()->update(
      $query, ['productId' => $productId]);
  }


  public static function editProduct( array $product)
  {
    $query = "update `goods` set
                   `name` = :productName,
                   `price` = :productPrice,
                   `category` = :productCategory,
                   `description` = :productDescription,
                   `status` = :productStatus,
                   `img` = :productImg
            where `goods`.`id` = :productId;";

    return Db::getInstance()->update(
      $query, [
        'productId' => $product['id'],
        'productName' => $product['name'],
        'productPrice' => $product['price'],
        'productCategory' => $product['category'],
        'productDescription' => $product['description'],
        'productStatus' => $product['status'],
        'productImg' => $product['img']
      ]);
  }
}