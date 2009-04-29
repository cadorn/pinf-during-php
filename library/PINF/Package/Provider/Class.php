<?php

class PINF_Package_Provider_Class extends PINF_Package_Provider_Abstract
{
    
    
    
    public function _handleCall($arguments)
    {
        if($arguments) {
            throw new Exception('Calling class providers with constructor arguments is not supported yet!');
        }
        
        $class = $this->getName();
        $file = $this->locateFile($class . '.php');
        
        require_once($file);
        
        $obj = new $class();
        
        return $obj;
    }
      
  
}
