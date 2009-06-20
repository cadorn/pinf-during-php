<?php
/*
 *
 * THIS SOFTWARE IS PROVIDED BY THE COPYRIGHT HOLDERS AND CONTRIBUTORS
 * "AS IS" AND ANY EXPRESS OR IMPLIED WARRANTIES, INCLUDING, BUT NOT
 * LIMITED TO, THE IMPLIED WARRANTIES OF MERCHANTABILITY AND FITNESS FOR
 * A PARTICULAR PURPOSE ARE DISCLAIMED. IN NO EVENT SHALL THE COPYRIGHT
 * OWNER OR CONTRIBUTORS BE LIABLE FOR ANY DIRECT, INDIRECT, INCIDENTAL,
 * SPECIAL, EXEMPLARY, OR CONSEQUENTIAL DAMAGES (INCLUDING, BUT NOT
 * LIMITED TO, PROCUREMENT OF SUBSTITUTE GOODS OR SERVICES; LOSS OF USE,
 * DATA, OR PROFITS; OR BUSINESS INTERRUPTION) HOWEVER CAUSED AND ON ANY
 * THEORY OF LIABILITY, WHETHER IN CONTRACT, STRICT LIABILITY, OR TORT
 * (INCLUDING NEGLIGENCE OR OTHERWISE) ARISING IN ANY WAY OUT OF THE USE
 * OF THIS SOFTWARE, EVEN IF ADVISED OF THE POSSIBILITY OF SUCH DAMAGE.
 *
 * This software consists of voluntary contributions made by many individuals
 * and is licensed under the LGPL. For more information please see
 * <http://code.google.com/p/pinf>.
 */





/**
 *
 * @author   Jess Portnoy <kernel01@gmail.com> 
 * @package  pinf.tasks.ext
 * @version  $Revision$
 */
class BuildPinfPEARPackageTask extends MatchingTask {

    /** Base directory for reading files. */
    private $dir;

	private $version;
	private $state = 'alpha';
	private $notes;
	
	private $filesets = array();
	
    /** Package file */
    private $packageFile;

    public function init() {
        include_once 'PEAR/PackageFileManager2.php';
        if (!class_exists('PEAR_PackageFileManager2')) {
            throw new BuildException("You must have installed PEAR_PackageFileManager2 (PEAR_PackageFileManager >= 1.6.0) in order to create a PEAR package.xml file.");
        }
    }

    private function setOptions($pkg){

		$options['baseinstalldir'] = 'pinf';
        $options['packagedirectory'] = $this->dir->getAbsolutePath();

        if (empty($this->filesets)) {
			throw new BuildException("You must use a <fileset> tag to specify the files to include in the package.xml");
		}

		$options['filelistgenerator'] = 'Fileset';

		// Some PHING-specific options needed by our Fileset reader
		$options['pinf_project'] = $this->getProject();
		$options['pinf_filesets'] = $this->filesets;
		
		if ($this->packageFile !== null) {
            // create one w/ full path
            $f = new File($this->packageFile->getAbsolutePath());
            $options['packagefile'] = $f->getName();
            // must end in trailing slash
            $options['outputdirectory'] = $f->getParent() . DIRECTORY_SEPARATOR;
            $this->log("Creating package file: " . $f->getPath(), PROJECT_MSG_INFO);
        } else {
            $this->log("Creating [default] package.xml file in base directory.", PROJECT_MSG_INFO);
        }
		
		// add install exceptions
		$options['installexceptions'] = array(	'bin/pinf.php' => '/',
												'bin/pear-pinf' => '/',
												'bin/pear-pinf.bat' => '/',
												);

		$options['dir_roles'] = array(	'pinf_guide' => 'doc',
										'etc' => 'data',
										'example' => 'doc');

		$options['exceptions'] = array(	'bin/pear-pinf.bat' => 'script',
										'bin/pear-pinf' => 'script',
										'CREDITS' => 'doc',
										'CHANGELOG' => 'doc',
										'README' => 'doc',
										'TODO' => 'doc');

		$pkg->setOptions($options);

    }

    /**
     * Main entry point.
     * @return void
     */
    public function main() {

        if ($this->dir === null) {
            throw new BuildException("You must specify the \"dir\" attribute for PEAR package task.");
        }

		if ($this->version === null) {
            throw new BuildException("You must specify the \"version\" attribute for PEAR package task.");
        }

		$package = new PEAR_PackageFileManager2();

		$this->setOptions($package);

		// the hard-coded stuff
		$package->setPackage('pinf');
		$package->setSummary('PINF is a collection of tools designed to streamline the management of your PHP toolchain.');
		$package->setDescription('The PINF toolchain spans project and dependency management, development, debugging, testing, distribution, deployment and monitoring tools for PHP-based applications as well as software libraries, plugins and services used by your application.');
		$package->setChannel('pear.pinf.info');
		$package->setPackageType('php');

		$package->setReleaseVersion($this->version);
		$package->setAPIVersion($this->version);
		
		$package->setReleaseStability($this->state);
		$package->setAPIStability($this->state);
		
		$package->setNotes($this->notes);
		
		$package->setLicense('LGPL', 'http://www.gnu.org/licenses/lgpl.html');
		
		// Add package maintainers
		$package->addMaintainer('lead', 'christoph', 'Christoph Dorn', 'christoph.dorn@gmail.com');
		$package->addMaintainer('developer', 'jess', 'Jess Portnoy', 'kernel01@gmail.com');
		
		
		// creating a sub-section for UNIX based systems 
			$package->addRelease();
			//$package->setOSInstallCondition('(*ix|*ux|darwin*|*BSD|SunOS*)');
			$package->addInstallAs('bin/pinf.php', 'pinf.php');
			$package->addInstallAs('bin/pear-pinf', 'pinf');
			$package->addIgnoreToRelease('bin/pear-pinf.bat');

		// creating a sub-section for 'windows'
			$package->addRelease();
			$package->setOSInstallCondition('windows');
			$package->addInstallAs('bin/pinf.php', 'pinf.php');
			$package->addInstallAs('bin/pear-pinf.bat', 'pinf.bat');
			$package->addIgnoreToRelease('bin/pear-pinf');
		

		// "core" dependencies
		$package->setPhpDep('5.2.0');
		$package->setPearinstallerDep('1.4.0');
		
		// "package" dependencies
		$package->addPackageDepWithChannel( 'required', 'VersionControl_SVN', 'pear.php.net', '0.3.0alpha1');
		$package->addPackageDepWithChannel( 'required', 'Phinf', 'pear.phing.info');

		// now add the replacements ....
		$package->addReplacement('Pinf.php', 'pear-config', '@DATA-DIR@', 'data_dir');
		$package->addReplacement('bin/pear-pinf.bat', 'pear-config', '@PHP-BIN@', 'php_bin');
		$package->addReplacement('bin/pear-pinf.bat', 'pear-config', '@BIN-DIR@', 'bin_dir');
		$package->addReplacement('bin/pear-pinf.bat', 'pear-config', '@PEAR-DIR@', 'php_dir');
		$package->addReplacement('bin/pear-pinf', 'pear-config', '@PHP-BIN@', 'php_bin');
		$package->addReplacement('bin/pear-pinf', 'pear-config', '@BIN-DIR@', 'bin_dir');
		$package->addReplacement('bin/pear-pinf', 'pear-config', '@PEAR-DIR@', 'php_dir');
		
		// now we run this weird generateContents() method that apparently 
		// is necessary before we can add replacements ... ?
		$package->generateContents();
		
        $e = $package->writePackageFile();

        if (PEAR::isError($e)) {
            throw new BuildException("Unable to write package file.", new Exception($e->getMessage()));
        }

    }

    /**
     * Used by the PEAR_PackageFileManager_FileSet lister.
     * @return array FileSet[]
     */
    public function getFileSets() {
        return $this->filesets;
    }

    // -------------------------------
    // Set properties from XML
    // -------------------------------

    /**
     * Nested creator, creates a FileSet for this task
     *
     * @return FileSet The created fileset object
     */
    function createFileSet() {
        $num = array_push($this->filesets, new FileSet());
        return $this->filesets[$num-1];
    }

	/**
     * Set the version we are building.
     * @param string $v
     * @return void
     */
	public function setVersion($v){
		$this->version = $v;
	}

	/**
     * Set the state we are building.
     * @param string $v
     * @return void
     */
	public function setState($v) {
		$this->state = $v;
	}
	
	/**
	 * Sets release notes field.
	 * @param string $v
	 * @return void
	 */
	public function setNotes($v) {
		$this->notes = $v;
	}
    /**
     * Sets "dir" property from XML.
     * @param File $f
     * @return void
     */
    public function setDir(File $f) {
        $this->dir = $f;
    }

    /**
     * Sets the file to use for generated package.xml
     */
    public function setDestFile(File $f) {
        $this->packageFile = $f;
    }

}


