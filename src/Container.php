<?php

    /**
     * The Container class is an empty container, that displays its children.
     * 
     * It is suitable, if we want to add several widgets to a parent widget, without
     * being wrapped in extra code. It will accept no style, attribute, etc.
     * configurations. If you need to access the parent widget from children, use the
     * S_Containers parent widget.
     * <code>
     * // Creating a new instance of Container
     * $container = new S_Container();
     *     $container->child(s_label()->text("One")->foreground("red"));
     *     $container->child(s_label()->text("Two")->foreground("green"));
     *     $container->child(s_label()->text("Three")->foreground("blue"));
     *
     * // Using the shortcut function
     * $container = s_container()
     *     ->child(s_label()->text("One")->foreground("red"));
     *     ->child(s_label()->text("Two")->foreground("green"));
     *     ->child(s_label()->text("Three")->foreground("blue"));
     * </code>
     * @package GUI
     */
class Container extends S_Widget{
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
	        if(is_object($child) && is_subclass_of($child,"S_Widget")){
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
	        if(is_object($child) && is_subclass_of($child,"S_Widget")){
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