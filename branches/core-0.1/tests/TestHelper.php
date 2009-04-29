<?php

if(!class_exists('PINF')) {
    throw new Exception('These PHPUnit tests must be run via PINF!');
}

/*
 * Start output buffering
 */
ob_start();

/*
 * Set error reporting to the level to which Zend Framework code must comply.
 */
error_reporting( E_ALL | E_STRICT );

/*
 * Omit from code coverage reports the contents of the tests directory
 */
foreach (array('php', 'phtml', 'csv') as $suffix) {
    PHPUnit_Util_Filter::addDirectoryToFilter(dirname(__FILE__), ".$suffix");
}

/*
 * Prepend the tests/ directories to the
 * include_path. This allows the tests to run out of the box.
 */
$path = array(
    dirname(__FILE__),
    get_include_path()
    );
set_include_path(implode(PATH_SEPARATOR, $path));

/*
 * Load the user-defined test configuration file, if it exists; otherwise, load
 * the default configuration.
 */
if (is_readable(dirname(__FILE__) . DIRECTORY_SEPARATOR . 'TestConfiguration.php')) {
    require_once dirname(__FILE__) . DIRECTORY_SEPARATOR . 'TestConfiguration.php';
} else {
    require_once dirname(__FILE__) . DIRECTORY_SEPARATOR . 'TestConfiguration.php.dist';
}

/*
 * Unset global variables that are no longer needed.
 */
unset($path);



/*
 * Add the CoreTest package to the PINF package repository for the default environment
 */
$package = new PINF_Package();
$package->initFromXML(dirname(__FILE__) . DIRECTORY_SEPARATOR .
                      '_files' . DIRECTORY_SEPARATOR .
                      'org.pinf.package.CoreTest' . DIRECTORY_SEPARATOR .
                      'pinf.xml');

PINF::GetEnvironment()->getPackageRegistry()->addPackage($package);
