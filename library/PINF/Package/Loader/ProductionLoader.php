<?php

class PINF_Package_Loader_ProductionLoader extends PINF_Package_Loader_Abstract 
{
    /**
     * _getFiles()
     * 
     * Typical production filesystem layout:
     * 
     *   [IncludePath]/
     *     pinf/
     *       [PackageName]/
     *         pinf.xml
     *
     * @return array Array of files to load
     */
    protected function _getFiles()
    {
        $paths = explode(PATH_SEPARATOR, get_include_path());

        $files = array();
        
        foreach ($paths as $path) {
            
            if (!file_exists($path) || $path[0] == '.') {
                continue;
            }
            
            $realIncludePath = realpath($path);

            // Try and find packages via pinf.xml files        
            foreach( new DirectoryIterator($realIncludePath . 'pinf.xml') as $packageDir ) {

                if(!$packageDir->isDot() && $packageDir->isDir()) {
                    
                    $file = $packageDir->getPathname() . DIRECTORY_SEPARATOR . 'pinf.xml';
                    
                    if(file_exists($file)) {
                        $files[] = array('hint'=>'pinf.xml',
                                         'path'=>$file);
                    }
                }
            }
        }      
        
        return $files;
    }
    
}
