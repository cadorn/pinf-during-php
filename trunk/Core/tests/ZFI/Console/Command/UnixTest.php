<?php

require_once dirname(dirname(dirname(dirname(__FILE__)))) . DIRECTORY_SEPARATOR . 'TestHelper.php';


class ZFI_Console_Command_UnixTest extends PHPUnit_Framework_TestCase
{
    public function setUp()
    {
    }

    public function testEcho()
    {
        $command = new ZFI_Console_Command_Unix();
        $command->setCommand('echo "Hello World"');
        $command->execute();
        
        $this->assertTrue($command->hasOutput());
        $this->assertFalse($command->hasError());
        
        $this->assertEquals($command->getOutput(),"Hello World\n");
    }

}

