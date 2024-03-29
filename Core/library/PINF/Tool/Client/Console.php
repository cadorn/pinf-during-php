<?php

class PINF_Tool_Client_Console extends Zend_Tool_Framework_Client_Console {
        
        
    protected $_loader = null;
    
    public function __construct($context)
    {
        $this->_loader = new PINF_Tool_Loader();
        $this->_loader->setContext($context);
    }        
        
    public static function main()
    {
        switch($_SERVER['argv'][1]) {

          case 'phing':
              array_splice($_SERVER['argv'], 1, 1);
              $_SERVER['argc'] -= 1;
      
              ZFI_Build_Phing_Client_Console::main();
              break;

          case 'pear':
              global $argv, $argc;
              
              array_splice($_SERVER['argv'], 1, 1);
              $_SERVER['argc'] -= 1;
  
              $argv = $_SERVER['argv'];
              $argc = $_SERVER['argc'];
              
              include('pearcmd.php');
              break;

          case 'zf':
              array_splice($_SERVER['argv'], 1, 1);
              $_SERVER['argc'] -= 1;
  
              ini_set('display_errors', true);
              $cliClient = new self('ZF');
              $cliClient->dispatch();
              break;
              
          case 'phpunit':
              array_splice($_SERVER['argv'], 1, 1);
              $_SERVER['argc'] -= 1;
      
              ZFI_Test_PHPUnit_Client_Console::main();
              break;

          default:
              // Call the default Zend_Tool_Framework_Client_Console which
              // we customize with _preInit()
              ini_set('display_errors', true);
              $cliClient = new self('PINF');
              $cliClient->dispatch();
              break;
        }
    }
    
    
    protected function _preInit()
    {
        $this->_registry->setLoader($this->_loader);
        parent::_preInit();
    }  
}
