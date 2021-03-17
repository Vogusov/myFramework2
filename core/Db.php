<?php
namespace Fw2\Core;


class Db
{
  private static $_instance = null;

  private $db; // Ресурс работы с БД


  /*
   * Получаем объект для работы с БД
   */
  public static function getInstance()
  {
    if (self::$_instance == null) {
      self::$_instance = new Db();
    }
    return self::$_instance;
  }


  /*
   * Запрещаем копировать объект
   */
  private function __construct()
  {
  }

  private function __sleep()
  {
  }

  private function __wakeup()
  {
  }

  private function __clone()
  {
  }


  /*
   * Выполняем соединение с базой данных
   * @return \PDO
   */
  public function connect($user, $password, $base, $host = 'localhost', $port = 3306)
  {
    // Формируем строку соединения с сервером
    $connectString = 'mysql:host=' . $host . ';port= ' . $port . ';dbname=' . $base . ';charset=UTF8;';
    $this->db = new \PDO($connectString, $user, $password,
      [
        \PDO::ATTR_DEFAULT_FETCH_MODE => \PDO::FETCH_ASSOC, // возвращать ассоциативные массивы
        \PDO::ATTR_ERRMODE => \PDO::ERRMODE_EXCEPTION // возвращать Exception в случае ошибки
      ]
    );
  }

  /**
   *
   * @param string $query
   * @param array $args
   * @return \PDOStatement
   */
  private static function query(string $query, array $args)
  {
    echo "<pre>" . $query . "</pre>";
    $sth = self::getInstance()->prepare($query);
    $sth->execute($args);
    if ($sth) {
      return $sth;
    } else {
      echo "Выполнить запрос к БД не удалось";
    }

  }

  /**
   *
   * @param string $query
   * @param array $args
   * @return array
   */
  public function select(string $query, array $args)
  {
    return self::query($query, $args)->fetchAll();
  }

  /**
   *
   * @param string $query
   * @param array $args
   * @return array
   */
  public static function getRow(string $query, array $args)
  {
    return self::query($query, $args)->fetch();
  }


  /**
   *
   * @param string $query
   * @param array $args
   * @return integer ID
   */
  public static function insert(string $query, array $args)
  {
    self::query($query, $args);
    return self::getInstance()->lastInsertId();
  }

  /**
   *
   * @param string $query
   * @param array $args
   * @return integer affected rows
   */
  public static function update(string $query, array $args)
  {
    $stmt = self::query($query, $args);
    return $stmt->rowCount();
  }

  /**
   *
   * @param string $query
   * @param array $args
   * @return integer affected rows
   */
  public static function delete(string $query, array $args)
  {
    $stmt = self::query($query, $args);
    return $stmt->rowCount();
  }


}

?>
