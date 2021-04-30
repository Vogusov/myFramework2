<?php
namespace Fw2\Model;

use Fw2\Core\Db as Db;

class Goods {


    public static function getAll()
    {
      $query = "SELECT * FROM `goods`";

      return Db::getInstance()->select(
          $query, []);
    }

  public static function getProduct($id)
  {
    return Db::getInstance()->getRow(
      "select * from `goods` where `id` = :id;" , ['id' => $id]);
  }
}