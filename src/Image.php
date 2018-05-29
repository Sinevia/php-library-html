<?php
//============================= START OF CLASS ==============================//
// CLASS: Image                                                            //
//===========================================================================//
   /**
    * Creates an HTML image widget
    * <code>
    * // Creating a new Image
    * $image = new Image();
    *   $image->url(simplest()->root_url."/images/beth.gif");
    *   $image->alt("Image of Beth");
    *   $image->width(200);
    *
    * // The same as above using the shortcut function and method chaining
    * $image = (new Image)->url(simplest()->root_url."/images/beth.gif")alt("Image of Beth")->width(200);
    * </code>
    */
class Image extends Element {
	//========================= START OF METHOD ===========================//
    //  CONSTRUCTOR: __construct                                           //
    //=====================================================================//
       /**
        * The constructor of this Image.
        * @construct
        */
	function __construct($url="#",$width=null,$height=null){
        parent::__construct();
        $this->url($url);
        $this->height = $height;
        $this->width = $width;
        if($width!=null)$this->css_style('width',$width);
        if($height!=null)$this->css_style('height',$height);
        $this->style("vertical-align","middle");
        $this->style("border","0px");
        $this->attribute("alt",basename($url));
        $this->style("margin","0px");
        $this->style("padding","0px");
    }
    //=====================================================================//
    //  CONSTRUCTOR: __construct                                           //
    //========================== END OF METHOD ============================//
    
    //========================= START OF METHOD ===========================//
    //  METHOD: url                                                        //
    //=====================================================================//
       /** Sets or retrieves the URL of this Image.
         * @return mixed The text as String (null, if not set) or an instance of this Label
         * @access public
         */
    function url($url=null){
	    if(func_num_args()>0){
		    if(is_string($url)==false)trigger_error('ERROR: In class <b>'.get_class($this).'</b> in method <b>url($url)</b>: Parameter <b>$url</b> MUST BE of type String - <b style="color:red">'.gettype($url).'</b> given!',E_USER_ERROR);
		    $this->attribute("src",$url);
		    return $this;
		}else{
			return $this->attribute("src");
		}
	}
	//=====================================================================//
    //  METHOD: url                                                        //
    //========================== END OF METHOD ============================//
    
    //========================= START OF METHOD ===========================//
    //  METHOD: alt                                                        //
    //=====================================================================//
       /** Sets or retrieves the alternative text for this Image.
         * @return mixed The text as String (null, if not set) or an instance of this Image
         * @access public
         */
    function alt($alt=null){
	    if(func_num_args()>0){
		    if(is_string($alt)==false)trigger_error('ERROR: In class <b>'.get_class($this).'</b> in method <b>alt($alt)</b>: Parameter <b>$alt</b> MUST BE of type String - <b style="color:red">'.gettype($alt).'</b> given!',E_USER_ERROR);
		    $this->attribute("alt",$alt);
		    return $this;
		}else{
			return $this->attribute("alt");
		}
	}
	//=====================================================================//
    //  METHOD: alt                                                        //
    //========================== END OF METHOD ============================//
    
    //========================= START OF METHOD ===========================//
    //  METHOD: title                                                        //
    //=====================================================================//
       /** Sets or retrieves the title for this Image.
         * @return mixed The text as String (null, if not set) or an instance of this Image
         * @access public
         */
    function title($title=null){
	    if(func_num_args()>0){
		    if(is_string($title)==false)trigger_error('ERROR: In class <b>'.get_class($this).'</b> in method <b>title($title)</b>: Parameter <b>$title</b> MUST BE of type String - <b style="color:red">'.gettype($title).'</b> given!',E_USER_ERROR);
		    $this->attribute("title",$title);
		    return $this;
		}else{
			return $this->attribute("title");
		}
	}
	//=====================================================================//
    //  METHOD: title                                                      //
    //========================== END OF METHOD ============================//
    
    //========================= START OF METHOD ===========================//
    //  METHOD: to_html                                                    //
    //=====================================================================//
       /**
        * Returns the HTML representation of this Image with its children.
        * @param compressed compresses the HTML, removing the new lines and indent
        * @param level the level of this widget
        * @return String html string
        */
    function to_html($compressed=true,$level=0){
	    if($compressed==false){$nl = "\n";$tab="    ";$indent=str_pad("",($level*4));}else{$nl="";$tab="";$indent="";}
        $html = $indent.'<img'; if(count($this->attribute)>0){$html .= $this->attributes_to_html();} if(count($this->style)>0){$html .= ' '.$this->styles_to_html();} $html .= ' />';
        return $html;
	}
    //=====================================================================//
    //  METHOD: to_html                                                    //
    //========================== END OF METHOD ============================//
    
       /**
        * Returns the XHTML representation of this Image with its children.
        * @param compressed compresses the XHTML, removing the new lines and indent
        * @param level the level of this widget
        * @return String html string
        */
    function toXhtml($compressed=true,$level=0){
	    if($compressed==false){$nl = "\n";$tab="    ";$indent=str_pad("",($level*4));}else{$nl="";$tab="";$indent="";}
        $html = $indent.'<img'; if(count($this->attribute)>0){$html .= $this->attributes_to_html();} if(count($this->style)>0){$html .= ' '.$this->styles_to_html();}$html .= ' />';
        return $html;
	}
    //=====================================================================//
    //  METHOD: to_xhtml                                                   //
    //========================== END OF METHOD ============================//
}
//===========================================================================//
// CLASS: Image                                                              //
//============================== END OF CLASS ===============================//
