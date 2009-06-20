<?php

class PINF_Environment
{
    protected $_packageRegistry = null;
  
    protected $_loader = null;
    
    
    public function __construct()
    {
        $this->_packageRegistry = new PINF_Package_Registry();
      
        $loaderClass = 'PINF_Package_Loader_'.ucfirst(strtolower(PINF::GetMode())).'Loader';
        $this->_loader = new $loaderClass();
        $this->_loader->setRegistry($this->_packageRegistry);
        $this->_loader->load();
    }
    
    
    public function getPackageRegistry()
    {
        return $this->_packageRegistry;
    }
}
