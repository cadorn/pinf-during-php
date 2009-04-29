<?php

/**
 * Test helper
 */
require_once dirname(__FILE__) . '/../TestHelper.php';


class PINF_CallTest extends PHPUnit_Framework_TestCase
{
    public function setUp()
    {
        
        
        
        
        
    }

    public function testHelloWorld()
    {
        
        $obj = PINF::Call('class://org.pinf.package.CoreTest/HelloWorld');
        
        $this->assertEquals($obj->say('Hello World'), 'Hello World');
      
    }

}

