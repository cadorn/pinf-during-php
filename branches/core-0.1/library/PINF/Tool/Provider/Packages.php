<?php

class PINF_Tool_Provider_Packages extends Zend_Tool_Framework_Provider_Abstract 
{

    public function listAction()
    {
        $environment = new PINF_Environment();
        
        $packages = $environment->getPackageRegistry()->getPackages();
        
        if(!$packages) {
          
          $this->_registry->response->appendContent('No packages found!');
                    
        } else {

          $table = new Console_Table();
          $table->setHeaders(
              array('Name', 'Version', 'Stability')
          );

          foreach( $packages as $package ) {

            $row = array();
            $row[] = $package->getName();
            $row[] = $package->getVersion();
            $row[] = $package->getStability();
            
            $table->addRow($row);
          }
          
          $this->_registry->response->appendContent($table->getTable());
        }
    }
}
