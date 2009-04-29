<?php

abstract class PINF_Package_Loader_Abstract
{
    protected $_registry = null;

    private $_retrievedFiles = array();
    
    abstract protected function _getFiles();

    public function setRegistry(PINF_Package_Registry $registry)
    {
        $this->_registry = $registry;
        return $this;
    }

    /**
     * load() - called by the client initialize routine to load files
     *
     */
    public function load()
    {
        $this->loadFromFiles($this->_getFiles());
    }
    
    /**
     * getRetrievedFiles()
     *
     * @return array Array of Files Retrieved
     */
    public function getRetrievedFiles()
    {
        return $this->_retrievedFiles;
    }
    
    /**
     * getLoadedPackages()
     *
     * @return array Array of Loaded packages
     */
    public function getLoadedPackages()
    {
        return $this->_loadedPackages;
    }
    
    /**
     * loadFromFiles()
     *
     * @param array $files
     * @return array Array of loaded packages
     */
    public function loadFromFiles(Array $files)
    {
        $loadedPackages = array();                        
                        
        // Loop through the config files and load the packages
        foreach ($files as $file) {
            
            if(!in_array($file['path'],$this->_retrievedFiles)) {
                
                switch($file['hint']) {
                    case 'pinf.xml':
                      
                        $package = new PINF_Package();
                        $package->initFromXML($file['path']);
                        
                        $this->_registry->addPackage($package);
                        
                        $loadedPackages[$package->getStability()][$package->getName()] = $package;
                        break;
                        
                    case 'pear':
                        
                        // TODO: Add support for loading PEAR packages

                        break; 
                }
                
                $this->_retrievedFiles[] = $file['path'];
            }
        }
        
        return $loadedPackages;
    }
    
}
