<?php
namespace Fw2\Model;

use Fw2\Core\Db as Db;

class Goods {


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

    return Db::getInstance()->delete(
      $query, ['productId' => $productId]);
  }
}