<?php

require_once dirname(dirname(__FILE__)) . DIRECTORY_SEPARATOR . 'TestHelper.php';

if (!defined('PHPUnit_MAIN_METHOD')) {
    define('PHPUnit_MAIN_METHOD', 'PINF_AllTests::main');
}


class PINF_AllTests
{
    public static function main()
    {
        PHPUnit_TextUI_TestRunner::run(self::suite());
    }

    public static function suite()
    {
        $suite = new PHPUnit_Framework_TestSuite('PINF Core - PINF');

        $suite->addTestSuite('PINF_CallTest');
        
        $suite->addTestSuite(PINF_StandardLibrary_functions_AllTests::suite());

        return $suite;
    }
}

if (PHPUnit_MAIN_METHOD == 'PINF_AllTests::main') {
    PINF_AllTests::main();
}
