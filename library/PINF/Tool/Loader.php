<?php

require_once 'Zend/Tool/Framework/Loader/IncludePathLoader.php';

require_once 'Zend/Tool/Framework/Manifest/Interface.php';
require_once 'Zend/Tool/Framework/Provider/Interface.php';

class PINF_Tool_Loader extends Zend_Tool_Framework_Loader_IncludePathLoader {


    protected $_context = null;
    
    
    public function setContext($context)
    {
        $this->_context = $context;
    }
    

    protected function _getFiles()
    {
        $files = array();
      
        switch($this->_context) {
          
            case 'PINF':
                $files[] = $this->_locateFile('Zend/Tool/Framework/Client/Console/Manifest.php');
                $files[] = dirname(__FILE__) . DIRECTORY_SEPARATOR . 'Manifest.php';
                break;
                
            case 'ZF':
                // Remove our own manifests as we don't want them to interfere with
                // the default ZF ones
                $path = dirname(dirname(__FILE__)) . DIRECTORY_SEPARATOR;
                $files = parent::_getFiles();
                for( $i=sizeof($files) ; $i>0 ; $i-- ) {
                  
                  if(substr($files[$i-1],0,strlen($path))==$path) {
                    array_splice($files, $i-1,1);
                  }
                }
                break;
        }
        
        return $files;
    }
    
    
    /**
     * Locate a file with path inn the include path and return
     * the absolute filepath.
     * 
     * @param string $path The file/path to find
     * @return mixed The string filepath if found, FALSE otherwise
     */
    protected function _locateFile($path)
    {
        foreach( explode(PATH_SEPARATOR, get_include_path()) as $dir ) {
            $file = realpath($dir . DIRECTORY_SEPARATOR . $path);
            if(file_exists($file)) {
                return $file;
            }
        }
        return false;
    }
}
