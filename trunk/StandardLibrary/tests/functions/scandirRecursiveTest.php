<?php

require_once dirname(dirname(__FILE__)) . DIRECTORY_SEPARATOR . 'TestHelper.php';


class PINF_StandardLibrary_functions_scandirRecursiveTest extends PHPUnit_Framework_TestCase
{
    public function setUp()
    {
    }

    public function testDirTree1()
    {
        $paths = scandir_recursive(dirname(__FILE__).DIRECTORY_SEPARATOR.'_files'.DIRECTORY_SEPARATOR.'DirTree1');

        // Strip temporary files
        $ignore_dirs = array();
        for( $i=0 ; $i<sizeof($paths) ; $i++ ) {
            $path_info = pathinfo($paths[$i]);
            if(substr($path_info['basename'],0,4)=='.tmp' ||
               $path_info['basename']=='.svn') {

              array_splice($paths,$i,1);
              $i--;
                
              if($path_info['basename']=='.svn') {
                $ignore_dirs[] = (($path_info['dirname']!='.')?$path_info['dirname'].DIRECTORY_SEPARATOR:'') . $path_info['basename'];
              }
            } else {
              foreach( $ignore_dirs as $ignore_dir ) {
                
                if(substr($path_info['dirname'],0,strlen($ignore_dir))==$ignore_dir) {
                  array_splice($paths,$i,1);
                  $i--;
                }
              }
            }
        }

        $paths_expected = array();
        $paths_expected[] = 'Dir1';
        $paths_expected[] = 'Dir1/Dir1';
        $paths_expected[] = 'Dir1/Dir1/File1.php';
        $paths_expected[] = 'Dir1/File1.php';
        $paths_expected[] = 'Dir2';
        $paths_expected[] = 'Dir2/File1.php';

        $this->assertEquals($paths, $paths_expected);
    }

}

