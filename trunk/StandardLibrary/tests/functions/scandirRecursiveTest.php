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
        for( $i=sizeof($paths)-1 ; $i>0 ; $i-- ) {
            $path_info = pathinfo($paths[$i]);
            if(substr($path_info['filename'],0,4)=='.tmp') {
                array_splice($paths,$i,1);
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

