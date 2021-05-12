<?php


namespace Fw2\Model;


class Product
{
  private $id, $name, $price;

  public function __construct($id, $name, $price)
  {
    $this->id = $id;
    $this->name = $name;
    $this->price = $price;
  }

  /**
   * @return mixed
   */
  public function getName()
  {
    return $this->name;
  }

  /**
   * @param mixed $name
   */
  public function setName($name): void
  {
    $this->name = $name;
  }



  function getProduct() {

  }

  function setProduct() {

  }
}