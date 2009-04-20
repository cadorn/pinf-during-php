<?php

$includePaths = array();

if('##MODE##'=='development') {
  $includePaths[] = '##DEV-PACKAGE-DIR##' . DIRECTORY_SEPARATOR . 
                    'build' . DIRECTORY_SEPARATOR . 
                    'pear' . DIRECTORY_SEPARATOR . 
                    'pinf' . DIRECTORY_SEPARATOR . 
                    'org.pinf.package.Core';
  $includePaths[] = '##DEV-PACKAGE-DIR##' . DIRECTORY_SEPARATOR . 
                    'override';
  $includePaths[] = '##DEV-PACKAGE-DIR##' . DIRECTORY_SEPARATOR . 
                    'library';
  $includePaths[] = '##DEV-PACKAGE-DIR##' . DIRECTORY_SEPARATOR . 
                    'build' . DIRECTORY_SEPARATOR . 
                    'pear';
  $includePaths[] = '@PEAR-DIR@';
} else {
  $includePaths[] = '@PEAR-DIR@' . DIRECTORY_SEPARATOR . 
                    'pinf' . DIRECTORY_SEPARATOR . 
                    'org.pinf.package.Core';
  $includePaths[] = '@PEAR-DIR@';
}

$includePaths[] = get_include_path();

set_include_path(implode(PATH_SEPARATOR, $includePaths));
unset($includePaths);


require_once 'PINF/Tool/Client/Console.php';

PINF_Tool_Client_Console::main();
