<?php
/**
 * @package GUI
 */
//============================= START OF CLASS ==============================//
// CLASS: S_LightPanel                                                       //
//===========================================================================//
   /**
    * Creates an HTML LightPanel. LightPanel uses div as outer container.
    * Take care that for the moment the vertical alignment "middle" has
    * problems with IE. If you intend to use it,please consider the usage
    * of the Panel widget.
    * <code>
    * // Creating a new LightPanel
    * $panel = new S_LightPanel();
    *   $panel->child(new Label("Panel"));
    *   $panel->halign("center");
    *   $panel->valign("top");
    *   $panel->width("100");
    *
    * // The same as above using the shortcut function and method chaining
    * $panel = s_panel()->child(new Label("Panel"))->halign("center")->valign("top")->width("100");
    * </code>
    * @package GUI
    */
class LightPanel extends Element{
	//========================= START OF METHOD ===========================//
    //  CONSTRUCTOR: __construct                                           //
    //=====================================================================//
       /**
        * The constructor of this LightPanel.
        * @construct
        */
	function __construct($width="100%",$height="100%",$halign="center",$valign="middle"){
		parent::__construct();
		$this->width($width);		
		$this->height($height);
		$this->halign($halign);
        $this->valign($valign);
	}
    //=====================================================================//
    //  CONSTRUCTOR: __construct                                           //
    //========================== END OF METHOD ============================//
    
    //========================= START OF METHOD ===========================//
    //  METHOD: valign                                                     //
    //=====================================================================//	
	   /**
        * Sets the vertical alignment of Panel.
        * @param String horizontal alignment (top,bottom or middle)
        * @return LightPanel an instance of this object
        */
    function valign($valign=null){
	    if(func_num_args()>0){
		    $allowed_params = array("top","middle","bottom");
		    if(in_array($valign,$allowed_params)==false){
			    trigger_error('ERROR: In class <b>'.get_class($this).'</b> in method <b>set_valign($halign)</b>: Parameter <b>$valign</b> MUST BE of type String('.implode(", ",$allowed_params).') - <b style="color:red">'.gettype($valign).'</b> given!',E_USER_ERROR);
			}
			$this->style("vertical-align",$valign);
			return $this;
		}else{
			return $this->style("vertical-align");
		}
	}
    //=====================================================================//
    //  METHOD: valign                                                     //
    //========================== END OF METHOD ============================//
	
    //========================= START OF METHOD ===========================//
    //  METHOD: to_html                                                    //
    //=====================================================================//
       /**
        * Returns the HTML representation of this TextArea
        * @param Boolean whether the HTML output should be compressed
        * @param Integer the level of nesting of this widget
        * @return String the HTML representation of this widget
        */
	function to_html($compressed=true,$level=0){
	    if($compressed==false){$nl = "\n";$tab="    ";$indent=str_pad("",($level*4));}else{$nl="";$tab="";$indent="";}
	    $html = $indent.'<div'; if(count($this->attribute)>0){$html .= $this->attributes_to_html();} if(count($this->style)>0){$html .= ' '.$this->styles_to_html();} $html .= '>'.$nl;
	        foreach($this->children as $child){
		        if(is_object($child) && is_subclass_of($child,"S_Widget")){
			        $html .= $child->to_html($compressed,$level+1).$nl;
			    }else{
				    $html .= $indent.$tab.$child.$nl;
				}
		    }
		$html .= $indent.'</div>';
		return $html;
	}
    //=====================================================================//
    //  METHOD: to_html                                                    //
    //========================== END OF METHOD ============================//
    
    //========================= START OF METHOD ===========================//
    //  METHOD: to_xhtml                                                   //
    //=====================================================================//
       /**
        * Returns the XHTML representation of this LightPanel
        * @param Boolean whether the XHTML output should be compressed
        * @param Integer the level of nesting of this widget
        * @return String the XHTML representation of this widget
        */
	function to_xhtml($compressed=true,$level=0){
	    if($compressed==false){$nl = "\n";$tab="    ";$indent=str_pad("",($level*4));}else{$nl="";$tab="";$indent="";}
	    $html = $indent.'<div'; if(count($this->attribute)>0){$html .= $this->attributes_to_html();} if(count($this->style)>0){$html .= ' '.$this->styles_to_html();} $html .= '>'.$nl;
	        foreach($this->children as $child){
		        if(is_object($child) && is_subclass_of($child,"S_Widget")){
			        $html .= $child->to_xhtml($compressed,$level+1).$nl;
			    }else{
				    $html .= $indent.$tab.$child.$nl;
				}
		    }
		$html .= $indent.'</div>';
		return $html;
	}
    //=====================================================================//
    //  METHOD: to_xhtml                                                    //
    //========================== END OF METHOD ============================//
}
//===========================================================================//
// CLASS: S_LightPanel                                                       //
//============================== END OF CLASS ===============================//
