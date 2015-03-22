# Introduction #

We need a tool that can auto-patch source files according to structured source file annotations.

Syntax for such annotations is proposed below.

This tool is best implemented as a [Phing](Phing.md) Task.

# Sample Annotations #

```
/**
 * <?phing.codewrangler parse-source-file ?>
 *****************************************************************
 * THIS FILE IS AUTO-UPDATED BY Phing Code Wrangler IF POSSIBLE! *
 *****************************************************************
 * Wrap any changes in:                                          */ 

  /** @phing.codewrangler <custom> **/

  // CHANGES
  
  /** @phing.codewrangler </custom> **/      
 
/**                                                              *
 * For syntax see:                                               *
 *                                                               *
 *   http://code.google.com/p/pinf/wiki/PhingCodeWrangler        *
 *                                                               *
 *****************************************************************
 * <phing><codewrangler><source><file>
 */

%%PackageName%%.LIB = {

    // Extension singleton shortcut
    app: %%PackageName%%,

    // XPCOM shortcuts
    Cc: Components.classes,
    Ci: Components.interfaces,
    Cr: Components.results,

    // In case firebug (tracing console) is not installed
    console: {
        enabled: false,
        dump: function() {
          dump(arguments.join(' : '));
        }
    },

    /** @phing.codewrangler <custom> **/
    
    
    // TODO: Make additions here
    
    
    /** @phing.codewrangler </custom> **/

};

/**
 * </file></source></codewrangler></phing>
/*****************************************************************
 * THIS FILE IS AUTO-UPDATED BY Phing Code Wrangler IF POSSIBLE! *
 *****************************************************************
 */
```