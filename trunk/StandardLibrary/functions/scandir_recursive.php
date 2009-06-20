<?php
/**
 * scandir_recursive — List files and directories recursively inside the specified path
 * 
 * @see http://www.php.net/manual/en/function.scandir.php
 * 
 * @copyright Copyright (c) 2009 Christoph Dorn
 * @license BSD
 * @author Christoph Dorn <christoph@christophdorn.com>
 */

function scandir_recursive($basePath, $traversalPath='', &$paths=array())
{
//    if(substr($basePath,-1,1)==DIRECTORY_SEPARATOR)
//    {
//        $basePath = substr($basePath, 0, -1);
//    }
    foreach(array_diff(scandir($basePath . DIRECTORY_SEPARATOR . $traversalPath),
                       array('.', '..')) as $path)
    {
        $path = (($traversalPath)?$traversalPath.DIRECTORY_SEPARATOR:'') . $path;
        $paths[] = $path;
        if(is_dir($basePath . DIRECTORY_SEPARATOR . $path)) {
            $paths = scandir_recursive($basePath, 
                                       $path,
                                       $paths);
        }
    }
    return $paths;
}