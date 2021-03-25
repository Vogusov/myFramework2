<?php
namespace Fw2\Model;

use Fw2\Core\Db as Db;

class Goods {


    public static function getAllGoods()
    {
      $query = "SELECT * FROM `goods`";

      if (!empty($limit)) {
        echo $limit;
        $query .= " limit $limit";
        echo $query;
      }

        return Db::getInstance()->select(
          $query, []);
    }

  public static function getProduct($id)
  {
    return Db::getInstance()->getRow(
      "select * from `goods` where `id` = :id;" , ['id' => $id]);
  }
}