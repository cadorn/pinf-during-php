<?php

require_once 'Zend/Tool/Framework/Manifest/Interface.php';

require_once 'PINF/Tool/Action/Show.php';
require_once 'PINF/Tool/Provider/Version.php';


class PINF_Tool_Lanifest implements Zend_Tool_Framework_Manifest_Interface
{

    public function getProviders()
    {
        $providers = array(
            new PINF_Tool_Provider_Version()
            );

        return $providers;
    }
    
    
    public function getActions()
    {
        $actions = array(
            new PINF_Tool_Action_Show()
            );

        return $actions;
    }

}
