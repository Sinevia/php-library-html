<?php

   /**
    * The CheckBox class creates a check box widget.
    * <code>
    * // Creating a new RadioButton
    * $check_box = new S_CheckBox();
    *   $check_box->value("New");
    *   $check_box->checked(true);
    *
    * // The same as above using the shortcut function and method chaining
    * $check_box = s_check_box()->value("New")->checked(true);
    * </code>
    * @package GUI
    * @todo TEST
    */
class CheckBox extends Element {
    //========================= START OF METHOD ===========================//
    //  CONSTRUCTOR: __construct                                           //
    //=====================================================================//
       /**
        * The constructor of this CheckBox.
        * @construct
        */
	function __construct(){
        parent::__construct();
        $this->attribute("type","checkbox");
        $this->checked(false);
    }
    //=====================================================================//
    //  CONSTRUCTOR: __construct                                           //
    //========================== END OF METHOD ============================//
    
    //========================= START OF METHOD ===========================//
    //  METHOD: checked                                                    //
    //=====================================================================//
       /** Sets or retrieves the text of of this CheckBox.
         * @return mixed The checked status as bolean (null, if not set) or an instance of this CheckBox
         * @access public
         */
    function checked($is_checked=null){
	    if(func_num_args()>0){
		    if(is_bool($is_checked)==false)throw new IllegalArgumentException('In class <b>'.get_class($this).'</b> in method <b>checked($is_checked)</b>: Parameter <b>$is_checked</b> MUST BE of type Boolean - <b style="color:red">'.gettype($is_checked).'</b> given!',E_USER_ERROR);
		    $is_checked?$this->attribute('checked','checked'):$this->attribute('checked',null);
		    return $this;
		}else{
			return ($this->attribute('checked')=='checked')?true:false;
		}
	}
	//=====================================================================//
    //  METHOD: checked                                                    //
    //========================== END OF METHOD ============================//
    
	//========================= START OF METHOD ===========================//
    //  METHOD: value                                                      //
    //=====================================================================//
       /** Sets or retrieves the value attribute of this CheckBox.
         * @param String the name of the widget
         * @throws IllegalArgumentException if parameter $name is not String
         * @return mixed The padding as String (null, if not set) or an instance of this Widget
         * @access public
         */
    function value($value=null){
	    if(func_num_args()>0){
		    if(is_string($value)==false)throw new IllegalArgumentException('In class <b>'.get_class($this).'</b> in method <b>value($value)</b>: Parameter <b>$value</b> MUST BE of type String - <b style="color:red">'.(is_object($value)?get_class($value):gettype($value)).'</b> given!');
		    $this->attribute('value',$value);
	        return $this;
		}else{
			return $this->attribute('value');
		}
	}
	//=====================================================================//
    //  METHOD: value                                                       //
    //========================== END OF METHOD ============================//
    
    //========================= START OF METHOD ===========================//
    //  METHOD: to_html                                                   //
    //=====================================================================//
       /**
        * Returns the HTML representation of this CheckBox
        * @param Boolean whether the HTML output should be compressed
        * @param Integer the level of nesting of this widget
        * @return String the HTML representation of this widget
        */
    function to_html($compressed=true,$level=0){
	    if($compressed==false){$nl = "\n";$tab="    ";$indent=str_pad("",($level*4));}else{$nl="";$tab="";$indent="";}
	    $html = $indent.'<input'; if(count($this->attribute)>0){$html .= $this->attributes_to_html();} if(count($this->style)>0){$html .= ' '.$this->styles_to_html();} $html .= ' />';
        return $html;
    }
    //=====================================================================//
    //  METHOD: to_html                                                    //
    //========================== END OF METHOD ============================//
    
    //========================= START OF METHOD ===========================//
    //  METHOD: to_xhtml                                                   //
    //=====================================================================//
       /**
        * Returns the XHTML representation of this CheckBox
        * @param Boolean whether the XHTML output should be compressed
        * @param Integer the level of nesting of this widget
        * @return String the XHTML representation of this widget
        */
    function to_xhtml($compressed=true,$level=0){
	    if($compressed==false){$nl = "\n";$tab="    ";$indent=str_pad("",($level*4));}else{$nl="";$tab="";$indent="";}
	    $html = $indent.'<input'; if(count($this->attribute)>0){$html .= $this->attributes_to_html();} if(count($this->style)>0){$html .= ' '.$this->styles_to_html();} $html .= ' />';
        return $html;
    }
    //=====================================================================//
    //  METHOD: to_xhtml                                                   //
    //========================== END OF METHOD ============================//
}
//===========================================================================//
// CLASS: S_CheckBox                                                         //
//============================== END OF CLASS ===============================//
