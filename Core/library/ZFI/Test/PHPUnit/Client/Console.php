<?php

class ZFI_Test_PHPUnit_Client_Console
{
  
  
  public static function main() {
      
      require_once 'PHPUnit/Util/Filter.php';
      
      PHPUnit_Util_Filter::addFileToFilter(__FILE__, 'PHPUNIT');
      
      require 'PHPUnit/TextUI/Command.php';
      
      define('PHPUnit_MAIN_METHOD', 'PHPUnit_TextUI_Command::main');
      
      PHPUnit_TextUI_Command::main();
    
  }
  
}