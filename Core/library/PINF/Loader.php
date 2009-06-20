<?php

require_once 'Zend/Loader.php';

class PINF_Loader extends Zend_Loader
{
  
    public static function loadClass($class, $dirs = null)
    {
        if($class=='FB') {
            self::loadFile('FirePHP/FB.php', $dirs, true);
        } else {
          return parent::loadClass($class, $dirs);
        }
    }

    /**
     * Redeclare method here same as in superclass due to use of self::
     */
    public static function autoload($class)
    {
        try {
            @self::loadClass($class);
            return $class;
        } catch (Exception $e) {
            return false;
        }
    }
}
