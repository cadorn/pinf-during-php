<?php


class PINF_Package_Registry
{
    
    protected $_packages = array();
    
    
    public function addPackage($package)
    {
        $this->_packages[$package->getName()][$package->getStability()] = $package;
    }
    
    public function getPackages($indexedBy=null)
    {
        $packages = array();

        if($indexedBy===null) {
            $packages = array();
            foreach( $this->_packages as $i_name => $i_packages ) {
                foreach( $i_packages as $j_stability => $j_package ) {
                    $packages[] = $j_package;
                }
            }
        } else
        if($indexedBy===true) {
          $packages = $this->_packages;
        }

        return $packages;
    }

    
    public function getPackage($name, $stability=null)
    {
        if(!array_key_exists($name, $this->_packages)) {
            throw new Exception('Package with name "'.$name.'" does not exist in registry!');
        }
        
        if($stability===null) {
            if(count($this->_packages[$name])==1) {
                return current($this->_packages[$name]);
            } else {
                return $this->_packages[$name];
            }
        }
        
        
        if(!array_key_exists($stability, $this->_packages[$name])) {
            throw new Exception('Package with name "'.$name.'" and stability "'.$stability.'" does not exist in registry!');
        }
        
        return $this->_packages[$name][$stability];
    }
  
}
