<?php

namespace Router\Annotations;

class AnnotationsLoader{

  public static function load($dir = __DIR__){
    if(!in_array(substr($dir, 0, -1), array('/', '\\'))){
      $dir .= DIRECTORY_SEPARATOR;
    }
    foreach(glob("$dir*.php") as $annotFile){
      require_once $annotFile;
    }
  }
}
