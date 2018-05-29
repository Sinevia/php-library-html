<?php
/**
 * @package GUI
 */
//============================= START OF CLASS ==============================//
// CLASS: S_TabbedPanel                                                      //
//===========================================================================//
   /**
    * Creates an HTML Panel with tabs.
    * <code>
    * // Creating a new Tabbed Panel
    * $tp = new S_TabbedPanel();
    * // Setting all tabs' border, background, font color
    * $tp->tab_selected("silver","beige","red");
    * // Setting selected tab border, background, font color
    * $tp->tab_selected("silver","#eaeaea","black");
    * </code>
    */
class TabbedPanel extends Element{
	//========================= START OF METHOD ===========================//
    //  CONSTRUCTOR: __construct                                           //
    //=====================================================================//
	   /**
        * The constructor of TabbedPanel. As a default TabbedPanel stretches to fit its parent
        * widget, and content is horizontally and verticaly centered.
        * @param integer width in pixels, or percentage value of the parent width
        * @param integer width in pixels, or percentage value of the parent height
        * @construct
        */
    function __construct($width="100%",$height="100%"){
        parent::__construct();
        $this->js_file(s::surl()."/includes/js/jquery.js");
        $this->js_file(s::surl()."/includes/js/simplest.js");
        $this->width($width);
        $this->height($height);
        $this->attribute("border","0");
        $this->attribute("cellpadding","0");
        $this->attribute("cellspacing","0");
        $this->tab_border_color = "silver";
        $this->tab_background_color = "beige";
        $this->tab_font_color = "silver";
        $this->tab_selected_border_color = "black";
        $this->tab_selected_background_color = "white";
        $this->tab_selected_font_color = "black";
        $this->tabs_alignment = "left";
    }
	//=====================================================================//
    //  METHOD: __construct                                                //
    //========================== END OF METHOD ============================//
    
    function tabs($border_color,$background_color,$font_color){
        $this->tab_border_color = $border_color;
        $this->tab_background_color = $background_color;
        $this->tab_font_color = $font_color;
        return $this;
        
    }
    
    function tab_selected($border_color,$background_color,$font_color){
        $this->tab_selected_border_color = $border_color;
        $this->tab_selected_background_color = $background_color;
        $this->tab_selected_font_color = $font_color;
        return $this;
    }
    function tabs_align($alignment){
        $this->tabs_alignment = $alignment;
        return $this;
    }
    
	//========================= START OF METHOD ===========================//
    //  METHOD: width                                                      //
    //=====================================================================//
       /** Sets or retrieves the width of this TabbedPanel.
         * @return mixed The width in pixels or percentage or an instance of this Widget
         * @access public
         */
    /**
    function width($width=null){
	    if(func_num_args()>0){
		    if(s::str_ends_with($width,"%")){
			    $this->attribute("width",$width);
	        }else{
		        $this->attribute('width',$width.'px');
		    }
		    return $this;
		}else{
			return $this->attribute('width');
		}
	}
    */
	//=====================================================================//
    //  METHOD: width                                                    //
    //========================== END OF METHOD ============================//
    
    //========================= START OF METHOD ===========================//
    //  METHOD: to_xhtml                                                   //
    //=====================================================================//
       /**
        * Returns the XHTML representation of this Panel with its children.
        * @param compressed compresses the XHTML, removing the new lines and indent
        * @param level the level of this widget
        * @return String html string
        */
    function to_xhtml($compressed=true,$level=0){
        // JavaScript for initiating the tree
            $this->js("$(document).ready(function(){ s_tabbed_panel('#".$this->id()."').tabs_align('".$this->tabs_alignment."').tabs('".$this->tab_border_color."','".$this->tab_background_color."','".$this->tab_font_color."').tab_selected('".$this->tab_selected_border_color."','".$this->tab_selected_background_color."','".$this->tab_selected_font_color."').init(); });");
	        $this->attribute("id",$this->id());
        if($compressed==false){$nl = "\n";$tab="    ";$indent=str_pad("",($level*4));}else{$nl="";$tab="";$indent="";}
		$html = $indent.'<table'; if(count($this->attribute)>0){$html .= $this->attributes_to_html();} if(count($this->style)>0){$html .= ' '.$this->styles_to_html();} $html .= '>'.$nl;
        // START:TABS 
		    $html .= $indent.$tab.'<tr style="height:1px;">'.$nl;
			$html .= $indent.$tab.$tab.'<td align="center" valign="middle">'.$nl;
			$html .= $indent.$tab.$tab.$tab.'<ul style="list-style-type:none;margin:0px;">'.$nl;//position:relative;top:3px;
			for($i=0;$i<count($this->children);$i++){
    			$this->children[$i]->on_click('s_tabbed_panel("#'.$this->id().'").selected('.($i+1).')');
    			//$this->children[$i]->attributes_to_html();exit;
    			$this->children[$i]->height(20);
		        $html .= $indent.$tab.$tab.$tab.$tab.'<li style="display:inline;">&nbsp;<a href="#" '.$this->children[$i]->attributes_to_html().' '.$this->children[$i]->styles_to_html().'>&nbsp;&nbsp;'.$this->children[$i]->title().'&nbsp;&nbsp;</a></li>'.$nl;
		    }
		    $html .= $indent.$tab.$tab.$tab.'</ul>'.$nl;
			$html .= $indent.$tab.$tab.'</td>'.$nl;
			$html .= $indent.$tab.'</tr>'.$nl;
	    // END: TABS
	    // START: PANES
	    foreach($this->children as $child){
    	    if($child->selected()==true){
        	    $html .= $indent.$tab.'<tr class="selected">'.$nl;
        	}else{
            	$html .= $indent.$tab.'<tr>'.$nl;
            }
            $halign=$child->halign();
            $valign=$child->valign();
			$html .= $indent.$tab.$tab.'<td align="'.$halign.'" valign="'.$valign.'" style="'.$child->styles_to_html().'">'.$nl;
		    $html .= $child->to_xhtml($compressed,$level+3);
		    $html .= $indent.$tab.$tab.'</td>'.$nl;
			$html .= $indent.$tab.'</tr>'.$nl;
		} 
		// END: PANES
	    $html .= $indent.'</table>';
		return $html;
    }
    //=====================================================================//
    //  METHOD: to_xhtml                                                   //
    //========================== END OF METHOD ============================//
}
//===========================================================================//
// CLASS: S_TabPanel                                                         //
//============================== END OF CLASS ===============================//
