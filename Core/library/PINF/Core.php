<?php

class PINF_Core
{
  
    protected static $_mode = null;
    protected static $_environment = null;
    
        
    public static function SetMode($mode)
    {
        if(self::$_mode!==null) {
            throw new Exception('The runtime mode as already been set to "'. self::$_mode .'". You may not set it again!');
        }
        self::$_mode = $mode;
    }
    
    public static function GetMode()
    {
        if(self::$_mode===null) {
            throw new Exception('The runtime mode as not been set. You must set it first!');
        }
        return self::$_mode;
    }
  
    public static function SetEnvironment($environment)
    {
        self::$_environment = $environment;
    }
  
    public static function GetEnvironment()
    {
        return self::$_environment;
    }
  
    public static function Call($uri, $arguments=null)
    {
        $uriParts = parse_url($uri);
        
        // TODO: Call handlers are wildfire channel plugins
        
        $handlerClass = 'PINF_Call_Handler_'.ucfirst(strtolower($uriParts['scheme']));
        
        $handler = new $handlerClass();
        $handler->setEnvironment(self::$_environment);

        return $handler->call($uriParts, $arguments);
    }
  
  
}
