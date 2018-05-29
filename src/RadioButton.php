<?php

/**
    * The RadioButton class creates a radio button widget.
    * <code>
    * // Creating a new RadioButton
    * $radio_button = new S_RadioButton();
    *   $radio_button->value("New");
    *   $radio_button->checked(true);
    *
    * // The same as above using the shortcut function and method chaining
    * $radio_button = s_radio_button()->value("New")->checked(true);
    * </code>
    * @package GUI
    * @todo TEST
    */
class RadioButton extends Element {
    //========================= START OF METHOD ===========================//
    //  CONSTRUCTOR: __construct                                           //
    //=====================================================================//
       /**
        * The constructor of this RadioButton.
        * @construct
        */
	function __construct(){
        parent::__construct();
        $this->attribute("type","radio");
        $this->checked(false);
    }
    //=====================================================================//
    //  CONSTRUCTOR: __construct                                           //
    //========================== END OF METHOD ============================//
    
    //========================= START OF METHOD ===========================//
    //  METHOD: checked                                                    //
    //=====================================================================//
       /** Sets or retrieves the text of of this RadioButton.
         * @return mixed The checked status as bolean (null, if not set) or an instance of this RadioButton
         * @access public
         */
    function checked($is_checked=null){
	    if(func_num_args()>0){
		    if(is_bool($is_checked)==false)s_exception('IllegalArgumentException','In class <b>'.get_class($this).'</b> in method <b>checked($is_checked)</b>: Parameter <b>$is_checked</b> MUST BE of type Boolean - <b style="color:red">'.gettype($is_checked).'</b> given!',E_USER_ERROR);
		    //$this->attribute('checked',(string)$is_checked);
		    $is_checked?$this->attribute('checked','checked'):$this->attribute('checked',null);
		    return $this;
		}else{
			//return $this->attribute('checked');
			return ($this->attribute('checked')=='checked')?true:false;
		}
	}
	//=====================================================================//
    //  METHOD: checked                                                    //
    //========================== END OF METHOD ============================//
    
	//========================= START OF METHOD ===========================//
    //  METHOD: value                                                      //
    //=====================================================================//
       /** Sets or retrieves the value attribute of this RadioButton.
         * @param String the name of the widget
         * @throws IllegalArgumentException if parameter $name is not String
         * @return mixed The padding as String (null, if not set) or an instance of this Widget
         * @access public
         */
    function value($value=null){
	    if(func_num_args()>0){
		    if(is_string($value)==false)s_exception('IllegalArgumentException','In class <b>'.get_class($this).'</b> in method <b>value($value)</b>: Parameter <b>$value</b> MUST BE of type String - <b style="color:red">'.(is_object($value)?get_class($value):gettype($value)).'</b> given!');
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
        * Returns the HTML representation of this RadioButton
        * @param Boolean whether the HTML output should be compressed
        * @param Integer the level of nesting of this widget
        * @return String the HTML representation of this widget
        */
    function toHtml($compressed=true,$level=0){
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
        * Returns the XHTML representation of this RadioButton
        * @param Boolean whether the XHTML output should be compressed
        * @param Integer the level of nesting of this widget
        * @return String the XHTML representation of this widget
        */
    function toXhtml($compressed=true,$level=0){
	    if($compressed==false){$nl = "\n";$tab="    ";$indent=str_pad("",($level*4));}else{$nl="";$tab="";$indent="";}
	    $html = $indent.'<input'; if(count($this->attribute)>0){$html .= $this->attributes_to_html();} if(count($this->style)>0){$html .= ' '.$this->styles_to_html();} $html .= ' />';
        return $html;
    }
    //=====================================================================//
    //  METHOD: to_xhtml                                                   //
    //========================== END OF METHOD ============================//
}
