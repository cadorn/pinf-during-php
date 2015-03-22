# Introduction #

The _pinf_ command line tool provides a single point of access to your entire PHP toolchain. All commands are exposed via the Zend Tool Framework to any number of clients.

<font color='red'>NOTE: The commands below are implemented to varying degrees. They are not ready for general use although you can begin to play with them.</font>

# Third party wrappers #

```
pinf pear *
pinf phing *
pinf zf *
pinf phpunit *
```

See: [PEAR](PEAR.md), [Phing](Phing.md), [ZendFramework](ZendFramework.md), [PHPUnit](PHPUnit.md)

# PINF commands #

## General ##

```
pinf show version
```

Show version information for PINF components.

## Environment Management ##

```
pinf show environment
```

Show information about the currently active environment.

```
pinf create environment <Name>
```

Initialize a new environment with _`<Name>`_.

```
pinf switch environment <Name>
```

Switch to the _`<Name>`_ environment.


## Platform Management ##

```
pinf discover platform
```

Determine all matching platform drivers and store them in the currently active environment.

```
pinf show platform
```

Show information about the platform for the currently active environment.

## Workspace Management ##

```
pinf init workspace <Name>
```

Initialize a new workspace with _`<Name>`_ in the current directory (must be empty).

```
pinf show workspace
```

Show information about the current workspace determined by the current directory.

## Package Management ##

```
pinf list packages
```

List all packages found based on the current directory.