PINF is developed using [eclipse](http://www.eclipse.org/) as the IDE, but you do not need to use eclipse to work with PINF (any editor will do). PINF is also aimed for use in Virtualized environments, specifically [Amazon Web Services](http://aws.amazon.com/) which provide [tools for eclipse](http://aws.amazon.com/eclipse/) to speed up your development.

# Typical Eclipse Setup - PHP Development Tools (PDT) #

  1. Download **Eclipse PDT All-in-one** from: http://www.zend.com/en/community/pdt
  1. Install Plugins (Menu: _Help_ -> _Install New Software..._, _Work with:_ -> _Add_):
    1. **Web Tools Platform (WTP)**: http://download.eclipse.org/webtools/updates (Also install _Project Provided Components_)
    1. **Data Tools Platform (DTP)**: http://download.eclipse.org/datatools/updates
    1. **AWS Toolkit for Eclipse**: http://aws.amazon.com/eclipse
    1. SVN Clients
      * **[Subversive](http://www.eclipse.org/subversive/)**: http://download.eclipse.org/technology/subversive/0.7/update-site
        * **Connectors**: http://community.polarion.com/projects/subversive/download/eclipse/2.0/update-site
          * _Native JavaHL_ or _SVNKit_
          * You may need to install SVN Java bindings if using the _Native JavaHL_ connector.
```
sudo port install subversion-javahlbindings
```
> > > OR
      * **[Subclipse](http://subclipse.tigris.org/)**: http://subclipse.tigris.org/update_1.6.x
  1. Menu: _Eclipse_ -> _Preferences_, _General_ ->_Editors_ -> _Text Editors_, check _Insert spaces for tabs_


# Typical Eclipse Setup - Aptana #

  1. Download: http://www.aptana.com/studio/download
  1. Menu: _Window_ -> _Preferences_, _Aptana_ ->_Editors_, _Tab Insertion_, check _Use spaces_ with width set to 4
  1. Menu: _Window_ -> _Preferences_, _General_ ->_Editors_ -> _Text Editors_, check _Show line numbers_