<?php

require_once 'Zend/Tool/Framework/Provider/Abstract.php';
require_once 'PINF/PackageManager/Version.php';

class PINF_Tool_Provider_Version extends Zend_Tool_Framework_Provider_Abstract 
{

    public function show()
    {
        $output = 'PINF PackageManager Version: ' . PINF_PackageManager_Version::VERSION;
        $this->_registry->response->appendContent($output);
    }

}
