<?php

namespace Router;

class RouteManager{
  private static $routes = array();


  /**
   * Get the value of Routes
   *
   * @return array
   */
  public static function getRoutes()
  {
    return self::$routes;
  }

  /**
   * Set the value of Routes
   *
   * @param Route route
   */
  public static function addRoute($route)
  {
    if(!in_array($route, self::$routes)){
      self::$routes[] = $route;
    }
  }

  public static function findByName(string $name){
    foreach(self::$routes as $route){
      if($route->getName() == $name){
        return $route;
      }
    }
    throw new RouteException("No route found with the name '$name'");
  }

  public static function findByPath(string $path){
    foreach(self::$routes as $route){
      if($route->match($path)){
        return $route;
      }
    }
    throw new RouteException("No route found with the path '$path'");
  }

}
