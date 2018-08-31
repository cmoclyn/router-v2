<?php

namespace Router\Annotations;

/**
 * @Annotation
 * @Target({"METHOD"})
 */
class Route{

  /**
   * @Required
   * @var string
   */
  public $name;

  /**
   * @Required
   * @var string
   */
  public $path;
}
