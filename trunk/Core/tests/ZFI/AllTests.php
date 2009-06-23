<?php

require_once dirname(dirname(__FILE__)) . DIRECTORY_SEPARATOR . 'TestHelper.php';

if (!defined('PHPUnit_MAIN_METHOD')) {
    define('PHPUnit_MAIN_METHOD', 'ZFI_AllTests::main');
}


class ZFI_AllTests
{
    public static function main()
    {
        PHPUnit_TextUI_TestRunner::run(self::suite());
    }

    public static function suite()
    {
        $suite = new PHPUnit_Framework_TestSuite('ZFI');

        $suite->addTestSuite('ZFI_Console_Command_UnixTest');

        return $suite;
    }
}

if (PHPUnit_MAIN_METHOD == 'ZFI_AllTests::main') {
    ZFI_AllTests::main();
}
