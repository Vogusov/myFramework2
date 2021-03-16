<?php

namespace Fw2\Model;

use \Fw2\Core\Db as Db;

class Category extends Model
{
  protected static $table = 'categories';

//  protected static function setProperties()
//  {
//    self::$properties['name'] = [
//      'type' => 'varchar',
//      'size' => 512
//    ];
//
//    self::$properties['parent_id'] = [
//      'type' => 'int',
//    ];
//  }

  public static function getCategories($parentId = 0)
  {
    return Db::getInstance()->Select(
      'SELECT id_category, name FROM categories WHERE status=:status AND parent_id = :parent_id',
      ['status' => Status::Active, 'parent_id' => $parentId]);
  }
}