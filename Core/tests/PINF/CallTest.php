<?php

require_once dirname(dirname(__FILE__)) . DIRECTORY_SEPARATOR . 'TestHelper.php';


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

