<?php

class PINF_Tool_Manifest implements Zend_Tool_Framework_Manifest_ProviderManifestable,
                                    Zend_Tool_Framework_Manifest_ActionManifestable
{

    public function getProviders()
    {
        $providers = array(
            new PINF_Tool_Provider_Version(),
            new PINF_Tool_Provider_Packages()
            );

        return $providers;
    }
    
    
    public function getActions()
    {
        $actions = array(
            new PINF_Tool_Action_Show(),
            new PINF_Tool_Action_List(),
            new PINF_Tool_Action_Test()
            );

        return $actions;
    }

}
