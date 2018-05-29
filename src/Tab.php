<?php
/**
 * @package GUI
 */
//============================= START OF CLASS ==============================//
// CLASS: S_Tab                                                              //
//===========================================================================//
   /**
    * Creates an Tab for Tabbed Panel.
    * <code>
    * // Creating a new Tabbed Panel
    * $tabbed_panel = new S_TabbedPanel();
    * // Creating a new Tab
    * $tab1 = new S_Tab();
    *   // Setting parent Tabbed Panel and Title
    *   $tab1->parent($tabbed_panel)->title("Tab 1");
    *   // Adding children widgets
    *   $tab1->child(new S_Label("Tab 1 Content"));
    *
    * // The same as above using the shortcut function and method chaining
    * $tabbed_panel = s_tabbed_panel();
    * $tab1 = s_tab->title("Tab 1")->title(s_label("Tab 1"))->child(s_label("Tab 1 Content"));
    * </code>
    */
class Tab extends Element{
	//========================= START OF METHOD ===========================//
    //  CONSTRUCTOR: __construct                                           //
    //=====================================================================//
	   /**
        * The constructor of Tab
        * @construct
        */
    function __construct(){
        parent::__construct();
        $this->valign("top");
        $this->halign("center");
        $this->height("100%");
    }
	//=====================================================================//
    //  METHOD: __construct                                                //
    //========================== END OF METHOD ============================//
    
    //========================= START OF METHOD ===========================//
    //  METHOD: title                                                      //
    //=====================================================================//
       /** Sets or retrieves the title of this Tab.
         * @return mixed The width in pixels or percentage or an instance of this Widget
         * @access public
         */
    function title($title=null){
	    if(func_num_args()>0){
			$this->property("title",$title);
		    return $this;
		}else{
			return $this->property("title");
		}
	}
	//=====================================================================//
    //  METHOD: title                                                      //
    //========================== END OF METHOD ============================//
    
    //========================= START OF METHOD ===========================//
    //  METHOD: selected                                                   //
    //=====================================================================//
       /** Sets or retrieves the selected property of this Tab.
         * @return mixed The width in pixels or percentage or an instance of this Widget
         * @access public
         */
    function selected($is_selected=false){
	    if(func_num_args()>0){
			$this->property("selected",$is_selected);
		    return $this;
		}else{
			return $this->property("selected");
		}
	}
	//=====================================================================//
    //  METHOD: selected                                                   //
    //========================== END OF METHOD ============================//
    
    //========================= START OF METHOD ===========================//
    //  METHOD: to_xhtml                                                   //
    //=====================================================================//
       /**
        * Returns the XHTML representation of this Tab with its children.
        * @param compressed compresses the XHTML, removing the new lines and indent
        * @param level the level of this widget
        * @return String html string
        */
    function to_xhtml($compressed=true,$level=0){
        if($compressed==false){$nl = "\n";$tab="    ";$indent=str_pad("",($level*4));}else{$nl="";$tab="";$indent="";}
	    // START: CONTENT
	    $xhtml = "";
	    foreach($this->children as $child){
    	    if(is_object($child) && is_subclass_of($child,"S_Widget")){
			    $xhtml .= $child->to_xhtml($compressed,$level).$nl;
			}else{
				$xhtml .= $indent.$tab.$child.$nl;
			}		    
		} 
		// END: CONTENT
		return $xhtml;
    }
    //=====================================================================//
    //  METHOD: to_xhtml                                                   //
    //========================== END OF METHOD ============================//
}
//===========================================================================//
// CLASS: S_Tab                                                              //
//============================== END OF CLASS ===============================//
