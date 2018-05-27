<?php

// ========================================================================= //
// SINEVIA PUBLIC                                        http://sinevia.com  //
// ------------------------------------------------------------------------- //
// COPYRIGHT (c) 2018 Sinevia Ltd                        All rights resrved! //
// ------------------------------------------------------------------------- //
// LICENCE: All information contained herein is, and remains, property of    //
// Sinevia Ltd at all times.  Any intellectual and technical concepts        //
// are proprietary to Sinevia Ltd and may be covered by existing patents,    //
// patents in process, and are protected by trade secret or copyright law.   //
// Dissemination or reproduction of this information is strictly forbidden   //
// unless prior written permission is obtained from Sinevia Ltd per domain.  //
//===========================================================================//

namespace Sinevia\Html;

/**
* The Container class is an empty container, that displays its children.
* 
* It is suitable, if we want to add several widgets to a parent widget, without
* being wrapped in extra code. It will accept no style, attribute, etc.
* configurations. If you need to access the parent widget from children, use the
* Containers parent widget.

* <code>
* // Creating a new instance of Container
* $container = new Container();
*     $container->child(s_label()->text("One")->foreground("red"));
*     $container->child(s_label()->text("Two")->foreground("green"));
*     $container->child(s_label()->text("Three")->foreground("blue"));
*
* // Using the shortcut function
* $container = (new Container())
*     ->child(s_label()->text("One")->foreground("red"));
*     ->child(s_label()->text("Two")->foreground("green"));
*     ->child(s_label()->text("Three")->foreground("blue"));
* </code>
* @package GUI
*/
class Container extends Element{
    //========================= START OF METHOD ===========================//
    //  METHOD: to_html                                                    //
    //=====================================================================//
       /**
        * Returns the HTML representation of this Panel with its children.
        * @param compressed compresses the HTML, removing the new lines and indent
        * @param level the level of this widget
        * @return String html string
        */
    function to_html($compressed=true,$level=0){
        if($compressed==false){$nl = "\n";$tab="    ";$indent=str_pad("",($level*4));}else{$nl="";$tab="";$indent="";}
        $html="";
		foreach($this->children as $child){
	        if(is_object($child) && is_subclass_of($child,"Sinevia\Html\Element")){
		        $html .= $child->to_xhtml($compressed,$level).$nl;
		    }else{
			    $html .= $indent.$tab.$child.$nl;
			}
	    }
	    return $html;
    }
    //=====================================================================//
    //  METHOD: to_html                                                    //
    //========================== END OF METHOD ============================//
    
    //========================= START OF METHOD ===========================//
    //  METHOD: to_xhtml                                                   //
    //=====================================================================//
       /**
        * Returns the XHTML representation of the children of this Container.
        * @param compressed compresses the XHTML, removing the new lines and indent
        * @param level the level of this widget
        * @return String html string
        */
    function to_xhtml($compressed=true,$level=0){
        if($compressed==false){$nl = "\n";$tab="    ";$indent=str_pad("",($level*4));}else{$nl="";$tab="";$indent="";}
        $xhtml="";
		foreach($this->children as $child){
	        if(is_object($child) && is_subclass_of($child,"Sinevia\Html\Element")){
		        $xhtml .= $child->to_xhtml($compressed,$level).$nl;
		    }else{
			    $xhtml .= $indent.$tab.$child.$nl;
			}
	    }
	    return $xhtml;
    }
    //=====================================================================//
    //  METHOD: to_xhtml                                                   //
    //========================== END OF METHOD ============================//
}
