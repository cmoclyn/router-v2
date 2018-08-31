<?php

namespace Router;

use Router\Service\ServicesManager;

class Route{
  private $path;
  private $name;
  private $args;
  private $methodName;
  private $className;



  public function match(string $path){
    $pattern = preg_replace("/{.*}/Usi", "(.+)", $this->path);
    if($bool = preg_match("#^$pattern$#Usi", $path, $matches)){
      unset($matches[0]);
      $matches = array_values($matches);
      for($i = $index = 0; $i < count($this->args); $i++){
        $type = $this->args[$i]->getType(); // Type of the current parameter
        $value = null;
        if($index < count($matches)){
          $value = $matches[$index]; // Value of the index parameter
        }
        if($type == getType($value)){
          $this->args[$i]->setValue($value);
          $index++;
        }else{
          $services = ServicesManager::getServices();
          if(isset($services[$type])){
            $this->args[$i]->setValue($services[$type]->getValue());
          }
          else{
            throw new RouteException("Can't set the value of '{$this->args[$i]->getName()}' for the path '$path'");
          }
        }
      }
    }

    return $bool;
  }

  public function call(){
    $obj = new $this->className;
    $args = array();
    foreach($this->args as $arg){
      $args[] = $arg->getValue();
    }
    call_user_func_array(array($obj, $this->methodName), $args);
  }

  /**
   * Get the value of Path
   *
   * @return mixed
   */
  public function getPath()
  {
    return $this->path;
  }

  /**
   * Set the value of Path
   *
   * @param mixed path
   *
   * @return string
   */
  public function setPath($path)
  {
    $this->path = $path;

    return $this;
  }

  /**
   * Get the value of Name
   *
   * @return string
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
   * Get the value of Args
   *
   * @return array
   */
  public function getArgs()
  {
    return $this->args;
  }

  /**
   * Set the value of Args
   *
   * @param array args
   *
   * @return self
   */
  public function setArgs($args)
  {
    $this->args = $args;

    return $this;
  }

  /**
   * Add a value to Args
   *
   * @param RouteParameter arg
   *
   * @return self
   */
  public function addArg($arg)
  {
    $this->args[] = $arg;

    return $this;
  }


    /**
     * Get the value of Method Name
     *
     * @return mixed
     */
    public function getMethodName()
    {
        return $this->methodName;
    }

    /**
     * Set the value of Method Name
     *
     * @param mixed methodName
     *
     * @return self
     */
    public function setMethodName($methodName)
    {
        $this->methodName = $methodName;

        return $this;
    }

    /**
     * Get the value of Class Name
     *
     * @return mixed
     */
    public function getClassName()
    {
        return $this->className;
    }

    /**
     * Set the value of Class Name
     *
     * @param mixed className
     *
     * @return self
     */
    public function setClassName($className)
    {
        $this->className = $className;

        return $this;
    }

}
