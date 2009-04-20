<?php

require_once 'Zend/Tool/Framework/Provider/Abstract.php';
require_once 'PINF/Core/Version.php';

class PINF_Tool_Provider_Version extends Zend_Tool_Framework_Provider_Abstract 
{

    public function show()
    {
        $output = 'PINF Core Version: ' . PINF_Core_Version::VERSION;
        $this->_registry->response->appendContent($output);
    }

}
