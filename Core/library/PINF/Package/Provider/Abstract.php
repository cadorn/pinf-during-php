<?php

/**
 * Only one provider is instanciated per provider config entry. The same provider
 * is re-used if more than one call is made.
 */
abstract class PINF_Package_Provider_Abstract
{
    
    protected $_package = null;
    protected $_config = null;
    
    
    public function setPackage($package)
    {
        $this->_package = $package;
    }
    
    public function setConfig($config)
    {
        $this->_config = $config;
    }
    
    public function getName()
    {
        return $this->_config->getAttribute('name');
    }
    
    public function handleCall($arguments)
    {
        return $this->_handleCall($arguments);
    }
      
    public abstract function _handleCall($arguments);
    
    
    public function locateFile($path)
    {
        return $this->_package->locateFile($path);
    }
  
}
