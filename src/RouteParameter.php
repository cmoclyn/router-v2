<?php

namespace Router;

class RouteParameter{
  private $type;
  private $name;
  private $value;


  /**
   * Get the value of Type
   *
   * @return mixed
   */
  public function getType()
  {
    return $this->type;
  }

  /**
   * Set the value of Type
   *
   * @param mixed type
   *
   * @return self
   */
  public function setType($type)
  {
    $this->type = $type;

    return $this;
  }

  /**
   * Get the value of Name
   *
   * @return mixed
   */
  public function getName()
  {
    return $this->name;
  }

  /**
   * Set the value of Name
   *
   * @param mixed name
   *
   * @return self
   */
  public function setName($name)
  {
    $this->name = $name;

    return $this;
  }

  /**
   * Get the value of Value
   *
   * @return mixed
   */
  public function getValue()
  {
    return $this->value;
  }

  /**
   * Set the value of Value
   *
   * @param mixed value
   *
   * @return self
   */
  public function setValue($value)
  {
    $this->value = $value;

    return $this;
  }

}
