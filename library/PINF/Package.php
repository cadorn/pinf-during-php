<?php


class PINF_Package
{
    protected $_packageRootPath = null;
    protected $_config = null;
    
    
    public function initFromXML($file)
    {
        if(!file_exists($file)) {
            throw new Exception('Package XML config file "'.$file.'" is not a valid filepath or does not exist!');
        }
        
        $this->_packageRootPath = dirname($file);
        
        $this->_config = new Zend_Config_Xml($file, null, array('flattenAttributes'=>false));
    }
        
    public function getName()
    {
        return $this->_config->package->getAttribute('name');        
    }

    public function getVersion()
    {
        return $this->_config->package->version;        
    }

    public function getStability()
    {
        return $this->_config->package->getAttribute('stability');        
    }
    
    public function getProvider($type, $name)
    {
        $providerClass = 'PINF_Package_Provider_'.ucfirst(strtolower($type));
        $provider = new $providerClass();
        $provider->setPackage($this);
        $provider->setConfig($this->_config->package->providers->$type->getWhereAttribute('name',$name));
        return $provider;
    }
    
    public function getClassPaths()
    {
        $paths = array();
        foreach( $this->_config->package->environment->getWhereAttribute('alias',PINF::GetMode()) as $type => $node ) {
            // TODO: Ensure this works when multiple classpaths are defined
            if($type=='classpath') {
                if(substr($node,0,2)=='./') {
                  $paths[] = $this->_packageRootPath . DIRECTORY_SEPARATOR . substr($node,2);
                }
            }
        }
        return $paths;
    }
    
    public function locateFile($path)
    {
        $classPaths = $this->getClassPaths();
        
        foreach( $classPaths as $class_path ) {
            if($file = realpath($class_path . DIRECTORY_SEPARATOR . $path)) {
                return $file;
            }
        }
        
        return false;
    }
  
  
}
