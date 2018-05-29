<?php

//============================= START OF CLASS ==============================//
// CLASS: S_Panel                                                            //
//===========================================================================//
   /**
    * The Panel class creates an HTML Panel.
    *
    * Panel uses table as outer container. However, if you do not intend 
    * to use vertical alignment middle use the LighPanel widget instead.
    * 
    * <code>
    * // Creating a new Panel
    * $panel = new Panel();
    *   $panel->child((new Span())->text("Panel"));
    *   $panel->halign("center");
    *   $panel->valign("middle");
    *   $panel->width("100%");
    *
    * // The same as above using the shortcut function and method chaining
    * $panel = s_panel()->child(s_label()->text("Panel"))->halign("center")
    *                   ->valign("middle")->width("100%");
    * </code>
    */
class S_Panel extends S_Widget{
	//========================= START OF METHOD ===========================//
    //  CONSTRUCTOR: __construct                                           //
    //=====================================================================//
	   /**
        * The constructor of Panel. As a default Panel stretches to fit its parent
        * widget, and content is horizontally and verticaly centered.
        * @param integer width in pixels, or percentage value of the parent width
        * @param integer width in pixels, or percentage value of the parent height
        * @construct
        */
    function __construct($width="100%",$height="100%",$halign="center",$valign="middle"){
        parent::__construct();
        $this->width($width);
        $this->height($height);
        $this->spacing(0);
        $this->padding(0);
        $this->attribute("border","0");
        $this->halign($halign);
        $this->valign($valign);
    }
	//=====================================================================//
    //  CONSTRUCTOR: __construct                                           //
    //========================== END OF METHOD ============================//
    
	//========================= START OF METHOD ===========================//
    //  METHOD: halign                                                     //
    //=====================================================================//
	   /**
        * Sets the horizontal alignment of this S_Panel.
        * @param String horizontal alignment (left,right or center)
        * @throws IllegalArgumentException if parameter $halign is not String("left","right","center")
        * @return mixed the horizontal alignment (as String) or  the instance of this S_Panel
        */
    function halign($halign=null){
	    if(func_num_args()>0){
    	    if(is_string($halign)==false){throw new IllegalArgumentException('In class <b>'.get_class($this).'</b> in method <b>halign($halign)</b>: Parameter <b>$halign</b> MUST BE of type String - <b>'.(is_object($halign)?get_class($halign):gettype($halign)).'</b> given!');}
	        $allowed_params = array("left","right","center");
	        if(in_array($halign,$allowed_params)==false){
		        throw new IllegalArgumentException('In class <b>'.get_class($this).'</b> in method <b>halign($halign)</b>: Parameter <b>$halign</b> MUST BE of type String ("left","right","center") - <b>"'.($halign).'"</b> given!');
		    }
	        $this->halign = $halign;
	        return $this;
	    }else{
			return $this->halign;
		}
	}
	//=====================================================================//
    //  METHOD: __halign                                                   //
    //========================== END OF METHOD ============================//
    
    //========================= START OF METHOD ===========================//
    //  METHOD: padding                                                    //
    //=====================================================================//
       /**
        * Sets or retrieves the padding of the content of this Panel.
        * @param Integer the padding from the content
        * @throws IllegalArgumentException if parameter $padding is not Integer
        * @return mixed the spacing (as Integer) or an instance of this S_Panel
        */
    function padding($padding=null,$left=0,$bottom=0,$right=0){
	    if(func_num_args()>0){
		    if(is_int($padding)==false){throw new IllegalArgumentException('In class <b>'.get_class($this).'</b> in method <b>padding($padding)</b>: Parameter <b>$padding</b> MUST BE of type Integer - <b>'.(is_object($padding)?get_class($padding):gettype($padding)).'</b> given!');}
		    $this->attribute("cellpadding",(string)$padding);
	        return $this;
        }else{
	        return (int)$this->attribute("cellpadding");
	    }
	}
	//=====================================================================//
    //  METHOD: padding                                                    //
    //========================== END OF METHOD ============================//
    
    //========================= START OF METHOD ===========================//
    //  METHOD: spacing                                                    //
    //=====================================================================//
       /**
        * Sets or retrieves the spacing of the cells of the Panel.
        * @param Integer the spacing between cells
        * @throws IllegalArgumentException if parameter $spacing is not Integer
        * @return mixed the spacing (as Integer) or the instance of this S_Panel
        */
    function spacing($spacing=null){
	    if(func_num_args()>0){
		    if(is_int($spacing)==false){throw new IllegalArgumentException('In class <b>'.get_class($this).'</b> in method <b>spacing($spacing)</b>: Parameter <b>$spacing</b> MUST BE of type Integer - <b>'.(is_object($spacing)?get_class($spacing):gettype($spacing)).'</b> given!');}
		    $this->attribute("cellspacing",(string)$spacing);
	        return $this;
        }else{
	        return (int)$this->attribute("cellspacing");
	    }
	}
	//=====================================================================//
    //  METHOD: spacing                                                    //
    //========================== END OF METHOD ============================//
	
	//========================= START OF METHOD ===========================//
    //  METHOD: valign                                                     //
    //=====================================================================//
	   /**
        * Sets the vertical alignment of Panel.
        * @param String horizontal alignment (top,bottom or middle)
        * @throws IllegalArgumentException if parameter $valign is not String("top","middle","bottom")
        * @return return mixed the vertical alignment(as String) or S_Panel the instance of this S_Panel
        */
    function valign($valign=null){
	    if(func_num_args()>0){
    	    if(is_string($valign)==false){throw new IllegalArgumentException('In class <b>'.get_class($this).'</b> in method <b>valign($valign)</b>: Parameter <b>$valign</b> MUST BE of type String - <b>'.(is_object($valign)?get_class($valign):gettype($valign)).'</b> given!');}
	        $allowed_params = array("top","middle","bottom");
		    if(in_array($valign,$allowed_params)==false){
			    throw new IllegalArgumentException('In class <b>'.get_class($this).'</b> in method <b>valign($valign)</b>: Parameter <b>$valign</b> MUST BE of type String ("top","middle","bottom") - <b>"'.($valign).'"</b> given!');
		    }
			$this->valign = $valign;
			return $this;
		}else{
			return $this->valign;
		}
	}
	//=====================================================================//
    //  METHOD: __valign                                                   //
    //========================== END OF METHOD ============================//
    
	//========================= START OF METHOD ===========================//
    //  METHOD: width                                                      //
    //=====================================================================//
       /** Sets or retrieves the width of this Panel.
         * @return mixed The width in pixels or percentage or an instance of this Widget
         * @throws IllegalArgumentException if parameter $width is not Integer or String(i.e 100%)
         * @tested true
         * @access public
         */
    function width($width=null){
        if(func_num_args()>0){
            if(is_numeric($width)==false && (is_string($width)==true && s::str_ends_with($width,"%"))==false)throw new IllegalArgumentException('In class <b>'.get_class($this).'</b> in method <b>width($width)</b>: Parameter <b>$width</b> MUST BE of type Integer or String(i.e "100%") - <b style="color:red">'.(is_object($width)?get_class($width):gettype($width)).'</b> given!');
		    if(s::str_ends_with($width,"%")){
			    $this->attribute("width",$width);
	        }else{
		        $this->attribute('width',(string)$width);
		    }
		    return $this;
		}else{
    		$width = str_replace("px","",$this->attribute('width'));
			return is_numeric($width)?(int)$width:$width;
		}
	}
	//=====================================================================//
    //  METHOD: width                                                    //
    //========================== END OF METHOD ============================//
	
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
		$html = $indent.'<table'; if(count($this->attribute)>0){$html .= $this->attributes_to_html();} if(count($this->style)>0){$html .= ' '.$this->styles_to_html();} $html .= '>'.$nl;
        $html .= $indent.$tab.'<tr>'.$nl;
			$html .= $indent.$tab.$tab.'<td align="'.$this->halign.'" valign="'.$this->valign.'"';
			$html .= '>'.$nl;
			// Adding empty label to display correctly
			if(count($this->children)==0)$this->child(g::label()->text("&nbsp;"));
			foreach($this->children as $child){
		        if(is_object($child) && is_subclass_of($child,"S_Widget")){
			        $html .= $child->to_html($compressed,$level+3).$nl;
			    }else{
				    $html .= $indent.$tab.$child.$nl;
				}
		    }
			$html .= $indent.$tab.$tab.'</td>'.$nl;
			$html .= $indent.$tab.'</tr>'.$nl;		    
	    $html .= $indent.'</table>';
		return $html;
    }
    //=====================================================================//
    //  METHOD: to_html                                                    //
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
        if($compressed==false){$nl = "\n";$tab="    ";$indent=str_pad("",($level*4));}else{$nl="";$tab="";$indent="";}
		$html = $indent.'<table'; if(count($this->attribute)>0){$html .= $this->attributes_to_html();} if(count($this->style)>0){$html .= ' '.$this->styles_to_html();} $html .= '>'.$nl;
        $html .= $indent.$tab.'<tr>'.$nl;
			$html .= $indent.$tab.$tab.'<td align="'.$this->halign.'" valign="'.$this->valign.'"';
			$html .= '>'.$nl;
			// Adding empty label to display correctly
			if(count($this->children)==0)$this->child(g::label()->text("&nbsp;"));
			foreach($this->children as $child){
		        if(is_object($child) && is_subclass_of($child,"S_Widget")){
			        $html .= $child->to_xhtml($compressed,$level+3).$nl;
			    }else{
				    $html .= $indent.$tab.$child.$nl;
				}
		    }
			$html .= $indent.$tab.$tab.'</td>'.$nl;
			$html .= $indent.$tab.'</tr>'.$nl;		    
	    $html .= $indent.'</table>';
		return $html;
    }
    //=====================================================================//
    //  METHOD: to_xhtml                                                   //
    //========================== END OF METHOD ============================//
}
//===========================================================================//
// CLASS: S_Panel                                                            //
//============================== END OF CLASS ===============================//
