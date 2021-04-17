<?php
namespace Fw2\Core;


class Db
{
  private static $_instance = null;

  private $db; // Ресурс работы с БД
  protected $hasActiveTransaction = false;


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
        \PDO::ATTR_ERRMODE => \PDO::ERRMODE_EXCEPTION, // возвращать Exception в случае ошибки
        \PDO::ATTR_EMULATE_PREPARES => true // за подготовку отвечает PDO
      ]
    );
  }

  /**
   *
   * @param string $query
   * @param array $args
   * @return \PDOStatement
   */
  private function query(string $query, array $args)
  {
//    echo "<pre>" . $query . "</pre>";
    $sth = $this->db->prepare($query);
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
    return $this->query($query, $args)->fetchAll();
  }

  /**
   *
   * @param string $query
   * @param array $args
   * @return array
   */
  public function getRow(string $query, array $args)
  {
    return $this->query($query, $args)->fetch();
  }


  /**
   *
   * @param string $query
   * @param array $args
   * @return integer ID
   */
  public function insert(string $query, array $args)
  {
    $this->query($query, $args);
    return $this->db->lastInsertId();
  }

  /**
   *
   * @param string $query
   * @param array $args
   * @return integer affected rows
   */
  public function update(string $query, array $args):int
  {
    return $this->query($query, $args)->rowCount();
  }

  /**
   *
   * @param string $query
   * @param array $args
   * @return integer affected rows
   */
  public function delete(string $query, array $args):int
  {
    return $this->query($query, $args)->rowCount();
  }

  public function beginTransaction() {
    if ( $this->hasActiveTransaction ) {
      return false;
    } else {
      $this->hasActiveTransaction = $this->beginTransaction ();
      return $this->hasActiveTransaction;
    }
  }

  public function commitTransaction() {
    $this->hasActiveTransaction = false;
    return $this->commit();
  }

  public function rollbackTransaction() {
    $this->hasActiveTransaction = false;
    return $this->rollback();
  }

}

?>
