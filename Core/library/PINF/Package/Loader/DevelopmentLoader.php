<?php

class PINF_Package_Loader_DevelopmentLoader extends PINF_Package_Loader_Abstract 
{
    /**
     * _getFiles()
     * 
     * Typical development filesystem layout:
     * 
     *   /pinf/
     *     packages-alpha/
     *     packages-beta/
     *     packages-stable/
     *       [PackageName]/
     *         pinf.xml
     *
     * @return array Array of files to load
     */
    protected function _getFiles()
    {
        // Go up to the Core package root directory
        $packageDir = dirname(dirname(dirname(dirname(dirname(__FILE__)))));
        
        // Go up to the directory containing groups of packages in subdirectories
        $packagesDir = dirname(dirname($packageDir));

        $files = array();

        // Try and find packages via pinf.xml files        
        foreach( new DirectoryIterator($packagesDir) as $packageSetDir ) {
          
            if(!$packageSetDir->isDot() && $packageSetDir->isDir()) {
              
                foreach( new DirectoryIterator($packageSetDir->getPathname()) as $packageDir ) {

                    if(!$packageDir->isDot() && $packageDir->isDir()) {
                        
                        $file = $packageDir->getPathname() . DIRECTORY_SEPARATOR . 'pinf.xml';
                        
                        if(file_exists($file)) {
                            $files[] = array('hint'=>'pinf.xml',
                                             'path'=>$file);
                        }
                    }
                }
            }
        }
        
        return $files;
    }
    
}
