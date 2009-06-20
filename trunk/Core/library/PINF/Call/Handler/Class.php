<?php


class PINF_Call_Handler_Class extends PINF_Call_Handler_Abstract
{
    protected $_handlerType = 'class';
    
    
    protected function _handleCall()
    {
        return $this->_provider->handleCall($this->_arguments);
    }
       
}
