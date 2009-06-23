<?php

require_once 'phing/Phing.php';


class ZendL_Build_Phing_Client_Console
{
  
  
  public static function main() {
    
    try {
    	
    	/* Setup Phing environment */
    	Phing::startup();
    
    	// Set phing.home property to the value from environment
    	// (this may be NULL, but that's not a big problem.) 
    	Phing::setProperty('phing.home', getenv('PHING_HOME'));
    
    	// Grab and clean up the CLI arguments
    	$args = isset($argv) ? $argv : $_SERVER['argv']; // $_SERVER['argv'] seems to not work (sometimes?) when argv is registered
    	array_shift($args); // 1st arg is script name, so drop it
    	
    	// Invoke the commandline entry point
    	Phing::fire($args);
    	
    	// Invoke any shutdown routines.
    	Phing::shutdown();
    	
    } catch (ConfigurationException $x) {
    	
    	Phing::printMessage($x);
//    	exit(-1); // This was convention previously for configuration errors.
    	
    } catch (Exception $x) {
    	
    	// Assume the message was already printed as part of the build and
    	// exit with non-0 error code.
    	
//    	exit(1);
    	
    }    
    
  }
  
  
  
  
}