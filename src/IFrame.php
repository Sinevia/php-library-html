<?php

//============================= START OF CLASS ==============================//
// CLASS: IFrame                                                           //
//===========================================================================//
    /**
     * The IFrame class provides an internal frame widget.
     * <code>
     * // Creating a new instance of BorderLayout
     * $iframe = new IFrame();
     *     $iframe->source("http://myhomepage.com");
     *
     * // Using the shortcut function and method chaining
     * $iframe = (new IFrame())->source("http://myhomepage.com");
     * </code>
     * @package GUI
     */
class IFrame extends Element {
	//========================= START OF METHOD ===========================//
    //  CONSTRUCTOR: __construct                                           //
    //=====================================================================//
       /**
        * The constructor of this IFrame widget.
        * @construct
        */
	function __construct($items=array()){
        parent::__construct();
        $this->attribute("type","text/html");
        $this->width("100%");
        $this->height("100%");
    }
    //=====================================================================//
    //  CONSTRUCTOR: __construct                                           //
    //========================== END OF METHOD ============================//
    
    //========================= START OF METHOD ===========================//
    //  METHOD: scrol                                                      //
    //=====================================================================//
       /** Sets or retrieves the scrolling of this widget.
         * @param String the scrolling type ("auto","scroll","visible","hidden")
         * @return mixed The scroll as String (null, if not set) or an instance of this IFrame
         * @access public
         */
    function scroll($scroll){
	    if(func_num_args()>0){
	        if(is_string($scroll)==false){s_exception('IllegalArgumentException','In class <b>'.get_class($this).'</b> in method <b>scroll($scroll)</b>: Parameter <b>$scroll</b> MUST BE of type String - <b>'.(is_object($url)?get_class($url):gettype($url)).'</b> given!');}
	        // Checking scroll
            $allowed_params = array("auto","scroll","visible","hidden");
            if(in_array($scroll,$allowed_params)==false){
		        s_exception('IllegalArgumentException','In class <b>'.get_class($this).'</b> in method <b>scroll($scroll)</b>: Parameter <b>$scroll</b> MUST BE of type String('.implode(", ",$allowed_params).') - <b>'.($scroll).'</b> given!');
		    }
		    $this->style("overflow",$scroll);
		    return $this;
		}else{
			return $this->style("overflow");
		}
    }
	//=====================================================================//
    //  METHOD: scrol                                                      //
    //========================== END OF METHOD ============================//
    
    //========================= START OF METHOD ===========================//
    //  METHOD: source                                                     //
    //=====================================================================//
       /** Sets or retrieves the visible rows in the Select widget.
         * @return mixed The rows as Integer (null, if not set) or an instance of this Select
         * @access public
         */
    function source($url){
	    if(func_num_args()>0){
	        if(is_string($url)==false){s_exception('IllegalArgumentException','In class <b>'.get_class($this).'</b> in method <b>source($url)</b>: Parameter <b>$url</b> MUST BE of type String - <b>'.(is_object($url)?get_class($url):gettype($url)).'</b> given!');}
		    $this->attribute("data",$url);
		    return $this;
		}else{
			return $this->attribute("url");
		}
    }
	//=====================================================================//
    //  METHOD: source                                                     //
    //========================== END OF METHOD ============================//
    
	//========================= START OF METHOD ===========================//
    //  METHOD: to_html                                                   //
    //=====================================================================//
       /**
        * Returns the HTML representation of this IFrame widget
        * @param bool true, compresses the HTML, removing the new lines and indent, false, displays the widget micely indented
        * @param int the level of this widget in the widgets' hierarchy
        * @return String the HTML code of this widget
        */   
    function toHtml($compressed=true,$level=0){
        if($compressed==false){$nl = "\n";$tab="    ";$indent=str_pad("",($level*4));}else{$nl="";$tab="";$indent="";}
        $html = $indent.'<iframe'; if(count($this->attribute)>0){$html .= $this->attributes_to_html();} if(count($this->style)>0){$html .= ' '.$this->styles_to_html();} $html .= '>'.$nl;
            $html.=$indent.$tab.'NotSupported'.$nl;
        $html .= $indent.'</iframe>';
        return $html;
	}
	//=====================================================================//
    //  METHOD: to_html                                                   //
    //========================== END OF METHOD ============================//
    
	//========================= START OF METHOD ===========================//
    //  METHOD: to_xhtml                                                   //
    //=====================================================================//
       /**
        * Returns the XHTML representation of this IFrame widget
        * @param bool true, compresses the HTML, removing the new lines and indent, false, displays the widget micely indented
        * @param int the level of this widget in the widgets' hierarchy
        * @return String the HTML code of this widget
        */   
    function toXhtml($compressed=true,$level=0){
        if($compressed==false){$nl = "\n";$tab="    ";$indent=str_pad("",($level*4));}else{$nl="";$tab="";$indent="";}
        $html = $indent.'<object'; if(count($this->attribute)>0){$html .= $this->attributes_to_html();} if(count($this->style)>0){$html .= ' '.$this->styles_to_html();} $html .= '>'.$nl;
            $html.=$indent.$tab.'NotSupported'.$nl;
        $html .= $indent.'</object>';
        return $html;
	}
	//=====================================================================//
    //  METHOD: to_xhtml                                                   //
    //========================== END OF METHOD ============================//
}
//===========================================================================//
// CLASS: S_IFrame                                                           //
//============================== END OF CLASS ===============================//
