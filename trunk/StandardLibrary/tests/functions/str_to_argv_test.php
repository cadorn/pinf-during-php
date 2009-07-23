<?php

if(!defined('PINF_TEST_FRAMEWORK')) {
    throw new Exception('This PHPUnit test must be run via PINF!');
}

class str_to_argv_test extends PHPUnit_Framework_TestCase
{
    public function setUp()
    {
    }

    public function testStrings()
    {
        
        $str = '--exclude-group EXTENDED-TEST';
        $argv = array('--exclude-group', 'EXTENDED-TEST');
        
        $this->assertEquals(str_to_argv($str), $argv);
      
    }

}

