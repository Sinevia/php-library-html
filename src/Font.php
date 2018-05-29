<?php

    /**
     * The Font class makes working with fonts easy and intuitive.
     * The Font class supports method chaining, which makes it suitable
     * for direct usage, through the shortcut function <b>s_font()</b>.
     * 
     * <code>
     * // Creating a new instance of Font
     * $font = new S_Font();
     *     $font->size(10);
     *     $font->bold(true);
     *
     * // Using the shortcut function
     * $font = s_font()->size(10)->bold(true);
     * </code>
     */
class Font{
	private $property = array();
    //========================= START OF METHOD ===========================//
    //  CONSTRUCTOR: __construct                                           //
    //=====================================================================//
       /**
        * The constructor of this Font.
        * @construct
        */
    public function __construct(){}
	//=====================================================================//
    //  CONSTRUCTOR: __construct                                           //
    //========================== END OF METHOD ============================//
    
	//========================= START OF METHOD ===========================//
    //  METHOD: bold                                                       //
    //=====================================================================//
        /** Sets or retrieves the Font bold style. 
         * <code>
         * // Setting font bold
         * $font = font()->bold(true);
         *
         * // Retrievibg, if the font is bold
         * $is_bold = font()->bold();
         * </code>
         * @return mixed The Font bold style as true, or false or an instance of this Widget
         * @access public
         */
	public function bold($is_bold=null){
		if(func_num_args()>0){
			if(is_bool($is_bold)==false)trigger_error('ERROR: In class <b>'.get_class($this).'</b> in method <b>bold($is_bold)</b>: Parameter <b>$is_bold</b> MUST BE of type Boolean - <b style="color:red">'.gettype($is_bold).'</b> given!',E_USER_ERROR);
		    $this->property("bold",$is_bold);
		    return $this;
		}else{
			return (is_null($this->property("bold"))==true) ? false : $this->property("bold");
		}
	}
	//=====================================================================//
    //  METHOD: bold                                                       //
    //========================== END OF METHOD ============================//
    
    //========================= START OF METHOD ===========================//
    //  METHOD: color                                                      //
    //=====================================================================//
        /** Sets or retrieves the Font color.
         * * <code>
         * // Setting font color
         * $font = font()->color("red");
         *
         * // Retrievibg, if the font color
         * $color = font()->color();
         * </code>
         * @param boolean true or false
         * @return mixed The Font color as String (null, if not set) or an instance of this Font
         * @access public
         */
	public function color($color=null){
		 if(func_num_args()>0){
		    $this->property("color",$color);
		    return $this;
		}else{
			return $this->property("color");
		}
	}
	//=====================================================================//
    //  METHOD: color                                                      //
    //========================== END OF METHOD ============================//
    
    //========================= START OF METHOD ===========================//
    //  METHOD: family                                                     //
    //=====================================================================//
        /** Sets or retrieves the Font family
         * @return mixed The Font family as String (null, if not set) or an instance of this Font
         * @access public
         */
	public function family($family=null){
		 if(func_num_args()>0){
		    $this->property("family",$family);
		    return $this;
		}else{
			return $this->property("family");
		}
	}
	//=====================================================================//
    //  METHOD: family                                                     //
    //========================== END OF METHOD ============================//
    
    //========================= START OF METHOD ===========================//
    //  METHOD: italic                                                     //
    //=====================================================================//
        /** Sets or retrieves the Font italic style
         * @return mixed The Font italic style as true, or false or an instance of this Font
         * @access public
         */
	public function italic($italic=false){
		if(func_num_args()>0){
			if(is_bool($italic)==false)trigger_error('ERROR: In class <b>'.get_class($this).'</b> in method <b>italic($italic)</b>: Parameter <b>$text</b> MUST BE of type Boolean - <b style="color:red">'.gettype($italic).'</b> given!',E_USER_ERROR);
		    $this->property("italic",$italic);
		    return $this;
		}else{
			return is_null($this->property("italic"))?false:$this->property("italic");
		}
	}
	//=====================================================================//
    //  METHOD: italic                                                     //
    //========================== END OF METHOD ============================//
    
    //========================= START OF METHOD ===========================//
    //  METHOD: property                                                   //
    //=====================================================================//
       /** Sets or retrieves the specified style to this Font.
         * @return mixed The property as String (null, if not set) or an instance of this Font
         * @param String the name of the property
	     * @param String the value of the property
         * @access public
         */
    protected function property($property,$value=null){
	    if(func_num_args()>1){
		    $this->property[$property]=$value;
		    return $this;
		}else{
			if(isset($this->property[$property])){ return $this->property[$property]; }
			return null;
		}
	}
	//=====================================================================//
    //  METHOD: __property                                                 //
    //========================== END OF METHOD ============================//
    
    //========================= START OF METHOD ===========================//
    //  METHOD: size                                                       //
    //=====================================================================//
        /** Sets or retrieves the Font size
         * @return mixed The Font size as Integer (null, if not set) or an instance of this Font
         * @access public
         */
	public function size($size=null){
		 if(func_num_args()>0){
    		if(is_integer($size)==false)trigger_error('ERROR: In class <b>'.get_class($this).'</b> in method <b>size($size)</b>: Parameter <b>$size</b> MUST BE of type Integer - <b style="color:red">'.gettype($size).'</b> given!',E_USER_ERROR);
		    $this->property("size",$size);
		    return $this;
		}else{
			return $this->property("size");
		}
	}
	//=====================================================================//
    //  METHOD: size                                                       //
    //========================== END OF METHOD ============================//
    
	//========================= START OF METHOD ===========================//
    //  METHOD: spacing                                                    //
    //=====================================================================//
        /** Sets or retrieves the spacing among the Font leters
         * @return mixed The Font spacing as Integer (null, if not set), or an instance of this Widget
         * @access public
         */
	public function spacing($spacing=false){
		if(func_num_args()>0){
			if(is_integer($spacing)==false)trigger_error('ERROR: In class <b>'.get_class($this).'</b> in method <b>spacing($spacing)</b>: Parameter <b>$spacing</b> MUST BE of type Integer - <b style="color:red">'.gettype($spacing).'</b> given!',E_USER_ERROR);
		    $this->property("spacing",$spacing);
		    return $this;
		}else{
			return $this->property("spacing");
		}
	}
	//=====================================================================//
    //  METHOD: spacing                                                    //
    //========================== END OF METHOD ============================//
    
    //========================= START OF METHOD ===========================//
    //  METHOD: underline                                                  //
    //=====================================================================//
        /** Sets or retrieves the Font underline style
         * @return mixed The Font underline style as true, or false or an instance of this Font
         * @access public
         */
	public function underline($is_underline=false){
		if(func_num_args()>0){
			if(is_bool($is_underline)==false)trigger_error('ERROR: In class <b>'.get_class($this).'</b> in method <b>underline($is_underline)</b>: Parameter <b>$is_underline</b> MUST BE of type Boolean - <b style="color:red">'.gettype($is_underline).'</b> given!',E_USER_ERROR);
		    $this->property("underline",$is_underline);
		    return $this;
		}else{
			return is_null($this->property("underline"))?false:$this->property("underline");
		}
	}
	//=====================================================================//
    //  METHOD: underline                                                  //
    //========================== END OF METHOD ============================//
}
