<?php

/**
 * A new call handler is instanciated for every call.
 */
abstract class PINF_Call_Handler_Abstract
{
    
    protected $_environment = null;
    protected $_handlerType = null;
    protected $_uriParts = null;
    protected $_arguments = null;
    protected $_package = null;
    protected $_provider = null;
    
    
    public function setEnvironment($environment)
    {
        $this->_environment = $environment;
    }
    
    public function call($uriParts, $arguments)
    {
      
      $this->_uriParts = $uriParts;
      $this->_arguments = $arguments;
      
      $this->_loadPackage();
      $this->_loadProvider();
      
      return $this->_handleCall();
    }
    
    
    protected function _loadPackage()
    {
        $this->_package = $this->_environment->getPackageRegistry()->getPackage($this->_uriParts['host']);
    }
    
    protected function _loadProvider()
    {
        $name = substr($this->_uriParts['path'],1);
      
        // Ensure class provider is declared in package
        $this->_provider = $this->_package->getProvider($this->_handlerType, $name);
        
        if(!$this->_provider) {
            throw new Exception('Provider with name "'.$name.'" and type "'.$this->_handlerType.'" not defined in package with name "'.$this->_package->getName().'"!');
        }
    }
    
    protected abstract function _handleCall();
       
}
