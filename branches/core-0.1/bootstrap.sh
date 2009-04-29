#!/bin/sh

######################################################
# Bootstrapping script to setup PINF for development #
######################################################

PEAR_GUESS=`which pear`
if [ -n "$PEAR_GUESS" ]; then
	PRINT_DEFAULT_PEAR="[$PEAR_GUESS]"
fi
echo "Welcome to the PINF bootstrapping script!"
while [ ! -x "$PEAR_BIN" ]; do 
	echo "Please provide a path to pear $PRINT_DEFAULT_PEAR:"
	read PEAR_BIN
	if [ -z $PEAR_BIN ];then
		PEAR_BIN=$PEAR_GUESS
	fi
done
if ! $PEAR_BIN info phing/phing 2>&1 >/dev/null; then
	$PEAR_BIN channel-discover pear.phing.info 
	if ! $PEAR_BIN install phing/phing;then 
		echo "Failed to install phing which is required for PINF"
		exit 1
	fi
fi
if ! $PEAR_BIN info VersionControl_SVN 2>&1 >/dev/null; then
	if ! $PEAR_BIN install channel://pear.php.net/VersionControl_SVN-0.3.1; then
		echo "Failed to install VersionControl_SVN which is required for PINF"
		exit 1
	fi
fi
BIN_DIR=`$PEAR_BIN config-get bin_dir`
$BIN_DIR/phing dev-setup
