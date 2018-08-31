<?php

namespace Router;

use Router\Annotations\Route as RouteAnnotation;
use Doctrine\Common\Annotations\AnnotationReader;

class RouteFinder{
  private $directory;
  private $files = "*.php";

  public function loadRoutes(){
    $reader = new AnnotationReader();
    foreach(glob($this->directory.$this->files) as $file){
      $reflectionClass = new \ReflectionClass($this->convertFileToClass($file));
      foreach($reflectionClass->getMethods() as $method){
        foreach($reader->getMethodAnnotations($method, RouteAnnotation::class) as $annotation){
          $route = new Route();
          $route->setPath($annotation->path);
          $route->setName($annotation->name);
          $route->setMethodName($method->name);
          $route->setClassName($method->class);
          foreach($method->getParameters() as $param){
            $parameter = new RouteParameter();
            $parameter->setType($param->getType()->getName());
            $parameter->setName($param->getName());
            $route->addArg($parameter);
          }
          RouteManager::addRoute($route);
        }
      }
    }
  }


  private function extract_namespace($file) {
      $ns = NULL;
      $handle = fopen($file, "r");
      if ($handle) {
          while (($line = fgets($handle)) !== false) {
              if (strpos($line, 'namespace') === 0) {
                  $parts = explode(' ', $line);
                  $ns = rtrim(trim($parts[1]), ';');
                  break;
              }
          }
          fclose($handle);
      }
      return $ns;
  }

  private function convertFileToClass($file){
    $namespace = $this->extract_namespace($file);
    $classname = "$namespace\\".basename($file, '.php');
    return $classname;
  }

  /**
   * Get the value of Directory
   *
   * @return string
   */
  public function getDirectory()
  {
    return $this->directory;
  }

  /**
   * Set the value of Directory
   *
   * @param string directory
   *
   * @return self
   */
  public function setDirectory($directory)
  {
    if(!in_array(substr($directory, 0, -1), array('/', '\\'))){
      $directory .= DIRECTORY_SEPARATOR;
    }
    $this->directory = $directory;

    return $this;
  }

  /**
   * Get the value of Files
   *
   * @return string
   */
  public function getFiles()
  {
    return $this->files;
  }

  /**
   * Set the value of Files
   *
   * @param string files
   *
   * @return self
   */
  public function setFiles($files)
  {
    $this->files = $files;

    return $this;
  }

}
