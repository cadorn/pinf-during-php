<?php

/**
 * ZendX_Console_Command_Unix allows you to execute a shell command and deal with the result
 * 
 * Assumes use of a Bourne Shell.
 * 
 * @see http://www.mathinfo.u-picardie.fr/asch/f/MeCS/courseware/users/help/general/unix/redirection.html
 */
class ZFI_Console_Command_Unix
{
    private $_commandID = null;
    private $_manageOutput = true;
    
    /**
     * Used when $_manageOutput = false
     * @var boolean
     */
    private $_redirectErrToOut = true;
    
    private $_command = null;
    private $_error = null;
    private $_output = null;
    private $_stdoutFile = null;
    private $_stderrFile = null;

    public function __construct($command=null)
    {
        $this->_commandID = md5(uniqid());
        $this->setCommand($command);
    }
    
    public function __destruct()
    {
        $this->cleanup();
    }
    
    public function cleanup()
    {
        if($this->_stdoutFile!==null &&
           file_exists($this->_stdoutFile)) {
            unlink($this->_stdoutFile);     
        }
        if($this->_stderrFile!==null &&
           file_exists($this->_stderrFile)) {
            unlink($this->_stderrFile);     
        }
    }
    
    public function setCommand($command)
    {
        $this->_command = $command;
    }
    
    public function setManageOutput($manage)
    {
        $this->_manageOutput = $manage;  
    }
    
    public function execute()
    {
        $command = $this->_command;
        
        if($this->_manageOutput) {
          
          // TODO: Verify that Bourne Shell is used
          
          $this->_stdoutFile = tempnam(sys_get_temp_dir(), $this->_commandID . '-out-');
          $this->_stderrFile = tempnam(sys_get_temp_dir(), $this->_commandID . '-err-');

          $command .= ' > ' . $this->_stdoutFile . ' 2> ' . $this->_stderrFile;
        } else
        if($this->_redirectErrToOut) {
          
          // Redirect standard error to standard output
          
          $command .= ' 2>&1';
        }

        ob_start();
        passthru($command);
        
        if($this->_manageOutput) {

          ob_end_clean();

          $this->_output = file_get_contents($this->_stdoutFile);
          if($this->_output=='') {
              $this->_output = false;
          }
          
          $this->_error = file_get_contents($this->_stderrFile);
          if($this->_error=='') {
              $this->_error = false;
          }
          
        } else {
            $this->_output = ob_get_clean();
        }
    }
    
    public function hasOutput()
    {
        return ($this->_output!==false);  
    }

    public function getOutput()
    {
        return $this->_output;
    }

    public function hasError()
    {
        return ($this->_error!==false);  
    }
    
    public function getError()
    {
        return $this->_error;
    }
}
