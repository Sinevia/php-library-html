<?php
/**
 * @package GUI
 */
//============================= START OF CLASS ==============================//
// CLASS: S_Menu                                                             //
//===========================================================================//
   /**
    * Creates an HTML menu widget
    * <code>
    * // Creating a new Menu
    * $menu = new S_Menu();
    *   $menu->flow("horizontal");
    *
    * // The same as above using the shortcut function and method chaining
    * $menu = s_menu()->flow("horizontal");
    * </code>
    * @package GUI
    */
class Menu extends Element {
	//========================= START OF METHOD ===========================//
    //  CONSTRUCTOR: __construct                                           //
    //=====================================================================//
       /**
        * The constructor of this Menu.
        * @param String the flow of this Menu - horizontal or vertical(default) 
        * @construct
        */
    function __construct($flow="vertical"){
        parent::__construct();
        $this->flow = $flow;
        $this->level = 0;
        $this->style("list-style-type","none");
        $this->style("margin","0px");
        $this->style("padding","0px");      
    }
    //=====================================================================//
    //  CONSTRUCTOR: __construct                                           //
    //========================== END OF METHOD ============================//
    
	//========================= START OF METHOD ===========================//
    //  METHOD: flow                                                       //
    //=====================================================================//
       /** Sets or retrieves the flow of this Menu.
         * @return mixed The flow as String (null, if not set) or an instance of this widget
         * @access public
         */
    function flow($flow=null){
	    if(func_num_args()>0){
		    $allowed_params = array("horizontal","vertical");
		    if(is_string($flow==false)){throw new IllegalArgumentException('In class <b>'.get_class($this).'</b> in method <b>flow($flow)</b>: Parameter <b>$flow</b> MUST BE of type String('.implode(", ",$allowed_params).') - <b style="color:red">'.gettype($flow).'</b> given!');}
		    if(in_array($flow,$allowed_params)==false){
		        throw new IllegalArgumentException('In class <b>'.get_class($this).'</b> in method <b>set_flow($flow)</b>: Parameter <b>$flow</b> MUST BE of type String('.implode(", ",$allowed_params).') - <b style="color:red">'.$flow.'</b> given!',E_USER_ERROR);
		    }
	        $this->property("flow",$flow);
	        return $this;
        }else{
	        return $this->property("flow");
	    }
	}
	//=====================================================================//
    //  METHOD: flow                                                       //
    //========================== END OF METHOD ============================//

    function child($widget,$position=null){
	    parent::child($widget,$position);
	    if($widget instanceof S_MenuItem){
		    $widget->level = $this->level+1;
		}
		return $this;
	}
    //========================= START OF METHOD ===========================//
    //  METHOD: to_html                                                    //
    //=====================================================================//
       /**
        * Returns the HTML representation of this Menu with its children.
        * @param compressed compresses the HTML, removing the new lines and indent
        * @param level the level of this widget
        * @return String html string
        */
    function to_html($compressed=true,$level=0){
        if($compressed==false){$nl = "\n";$tab="    ";$indent=str_pad("",($level*4));}else{$nl="";$tab="";$indent="";}
        $html = $indent.'<ul'; if(count($this->attribute)>0){$html .= $this->attributes_to_html();} if(count($this->style)>0){$html .= ' '.$this->styles_to_html();} $html .= '>'.$nl;
        if(count($this->children)==0)$this->child(s::menu_item()->child(s::label()->text("&nbsp;")));
        foreach($this->children as $child){
	        if($this->flow()=="horizontal"){$child->style("float","left");}
	        $html .= $child->to_html($compressed,$level+1).$nl; 
	    }		    
	    $html .= $indent.'</ul>';
		return $html;
    }
    //=====================================================================//
    //  METHOD: to_html                                                    //
    //========================== END OF METHOD ============================//
    
    //========================= START OF METHOD ===========================//
    //  METHOD: to_xhtml                                                    //
    //=====================================================================//
       /**
        * Returns the XHTML representation of this Menu with its children.
        * @param compressed compresses the HTML, removing the new lines and indent
        * @param level the level of this widget
        * @return String html string
        */
    function to_xhtml($compressed=true,$level=0){
        if($compressed==false){$nl = "\n";$tab="    ";$indent=str_pad("",($level*4));}else{$nl="";$tab="";$indent="";}
        $html = $indent.'<ul'; if(count($this->attribute)>0){$html .= $this->attributes_to_html();} if(count($this->style)>0){$html .= ' '.$this->styles_to_html();} $html .= '>'.$nl;
        if(count($this->children)==0)$this->child(s::menu_item()->child(s::label()->text("&nbsp;")));
        foreach($this->children as $child){
	        if($this->flow()=="horizontal"){$child->style("float","left");}
	        $html .= $child->to_xhtml($compressed,$level+1).$nl; 
	    }		    
	    $html .= $indent.'</ul>';
		return $html;
    }
    //=====================================================================//
    //  METHOD: to_xhtml                                                    //
    //========================== END OF METHOD ============================//
}
//===========================================================================//
// CLASS: S_Menu                                                             //
//============================== END OF CLASS ===============================//
