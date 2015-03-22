# Requirements #

  * UNIX
  * SVN Client (used by PEAR:VersionControl\_SVN)
  * PHP 5.2+
  * PEAR

# Checkout #

PINF Core: http://pinf.googlecode.com/svn/trunk/Core

See http://code.google.com/p/pinf/source/checkout for specifics.


# Setup #

<font color='red'><b>NOTE:</b> If the setup does not run successfully, please post any error messages/patches and feedback below.</font>

```
bootstrap.sh
```

Run with --help to print usage message.

The bootstrap script will:

  * Install [Phing](Phing.md)
  * Install [PEAR:VersionControl\_SVN]
  * Checkout source copies of [Phing](Phing.md), [ZendFramework](ZendFramework.md) and [PHPUnit](PHPUnit.md) into _./build/pear_
  * Build and publish development bootstrap files for PINF into _./build/pear/pinf_
  * Install _./build/pear/pinf/package.xml_ using your default PEAR installer

To update your development environment simply re-run bootstrap.sh. On occasion the SVN paths and versions to some of the integrated tools will change. In these cases you will need to run:

```
bootstrap.sh clean all
```

# Verify Setup #

If the following command works the core of PINF should be installed successfully (in development mode).

```
pinf show version
```

## Running Unit Tests ##

To verify that all PINF features are working as intended you can run the test suite.

```
cd tests
pinf phpunit AllTests
```