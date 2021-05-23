<?php


namespace Fw2\Model;


class Order
{
  private int $id;
  private int $userId; // экземпляр класса User
  private string $additionalInfo;
  private string $dateFormed;
  private array $products; // массив эземпляров класса Product
  private array $productQuantity;
  private int $totalSum;
  private int $status;


  /**
   * Order constructor.
   * @param $id
   */
  function __construct($id)
  {
    $this->id = $id;
    $this->init();
  }

  /**
   * Метод получает из БД данные по ID
   * и заполняет ими соотвутствующие свойства экземпляра класса.
   * Данные хрантся в сыром виде в $itemData
   *
   * @return void
   *
   */
  private function init(): void
  {
    // получение из БД
    // $this->itemData = Db::getData($this->id);
  }

  /**
   * Геттер для свойсва\свойств
   *
   * @param $id
   *
   */
  public function getProp($propertyName)
  {

  }

  /**
   * Сеттер для свойсва\свойств
   *
   * @param $id
   *
   */
  public function setProp($propertyName, $value)
  {

  }
}