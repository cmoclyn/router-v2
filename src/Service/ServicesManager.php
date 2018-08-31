<?php

namespace Router\Service;

class ServicesManager{
  private static $services = array();


  /**
   * Get the value of Services
   *
   * @return array
   */
  public static function getServices()
  {
      return self::$services;
  }

  /**
   * Add a value to Services
   *
   * @param mixed services
   *
   * @return self
   */
  public static function addService($service)
  {
      self::$services[$service->getType()] = $service;
  }

}
