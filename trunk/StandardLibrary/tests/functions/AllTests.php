<?php

if(!defined('PINF_TEST_FRAMEWORK')) {
    throw new Exception('This PHPUnit test must be run via PINF!');
}

if (!defined('PHPUnit_MAIN_METHOD')) {
    define('PHPUnit_MAIN_METHOD', 'PINF_StandardLibrary_functions_AllTests::main');
}

require_once 'scandir_recursive_test.php';
require_once 'str_to_argv_test.php';

class PINF_StandardLibrary_functions_AllTests
{
    public static function main()
    {
        PHPUnit_TextUI_TestRunner::run(self::suite());
    }

    public static function suite()
    {
        $suite = new PHPUnit_Framework_TestSuite('PINF Standard Library - Functions');

        $suite->addTestSuite('scandir_recursive_test');
        $suite->addTestSuite('str_to_argv_test');

        return $suite;
    }
}

if (PHPUnit_MAIN_METHOD == 'PINF_StandardLibrary_functions_AllTests::main') {
    PINF_StandardLibrary_functions_AllTests::main();
}
