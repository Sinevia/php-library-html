<?php

// ========================================================================= //
// SINEVIA PUBLIC                                        http://sinevia.com  //
// ------------------------------------------------------------------------- //
// COPYRIGHT (c) 2018 Sinevia Ltd                        All rights resrved! //
// ------------------------------------------------------------------------- //
// LICENCE: All information contained herein is, and remains, property of    //
// Sinevia Ltd at all times.  Any intellectual and technical concepts        //
// are proprietary to Sinevia Ltd and may be covered by existing patents,    //
// patents in process, and are protected by trade secret or copyright law.   //
// Dissemination or reproduction of this information is strictly forbidden   //
// unless prior written permission is obtained from Sinevia Ltd per domain.  //
//===========================================================================//
namespace Sinevia\Html;

    /**
     * The Select creates an HTML control widget for selection of options.
     * It is most often used in Forms.
     * <code>
     * // Creating a new instance of Select
     * $select = new S_Select();
     *     $select->rows(10);
     *     $select->width(200);
     *     for($i=0;$i<100;$i++){
	 *         $select->item($i,$i." years");
     *     }
     *
     * // The same as above using the shortcut function and method chaining
     * $select = s_select()->rows(10)->width(200);
     *     for($i=0;$i<100;$i++){
	 *         $select->item($i,$i." years");
     *     }
     * </code>
     */
class Select extends Element
	//========================= START OF METHOD ===========================//
    //  CONSTRUCTOR: __construct                                           //
    //=====================================================================//
       /**
        * The constructor of this Select widget.
        * @construct
        */
	function __construct($items=array()){
        parent::__construct();
        if(is_array($items)){
	        $this->items = $items;
        }else{
	        s_throw_error("The Items For The Select Widget Must Be An Array!");
	    }
    }
    //=====================================================================//
    //  CONSTRUCTOR: __construct                                           //
    //========================== END OF METHOD ============================//
    
    function item($key,$value,$selected=""){
        if($selected==""){
            $this->items[]=array($key,$value,$selected);
        }else{
            $this->items[]=array($key,$value,' selected="selected"');
        }
    }
    
    //========================= START OF METHOD ===========================//
    //  METHOD: on_change                                                  //
    //=====================================================================//
	   /**
	    * Fires a JavaScript action on text change in the TextField
	    * <code>
	    * // Displays the selected option on change
	    * $select->on_change('alert(this.options[this.selectedIndex].value)');
	    * </code>
	    * @param String the JavaScript action
	    * @todo To add Ajax
	    */
    function on_change($action){
	    if(func_num_args()>0){
    	    if(is_string($action)==false)throw new IllegalArgumentException('In class <b>'.get_class($this).'</b> in method <b>on_change($action)</b>: Parameter <b>$action</b> MUST BE of type String - <b style="color:red">'.gettype($action).'</b> given!',E_USER_ERROR);
		    if($this->attribute("onchange")==null){
			    $this->attribute("onchange",htmlentities($action));
			}else{
				$onchange = html_entity_decode($this->attribute("onchange"));
				if(s::str_ends_with($onchange,";")==false){$onchange .= ";";}
				$this->attribute("onchange",htmlentities($onchange.$action));
			}
			return $this;
		}else{
			return $this->attribute("onchange");
		}
	}
	//=====================================================================//
    //  METHOD: on_change                                                  //
    //========================== END OF METHOD ============================//
    
    //========================= START OF METHOD ===========================//
    //  METHOD: rows                                                       //
    //=====================================================================//
       /** Sets or retrieves the visible rows in the Select widget.
         * @return mixed The rows as Integer (null, if not set) or an instance of this Select
         * @access public
         */
    function rows($rows){
	    if(func_num_args()>0){
		    if(is_int($rows)==false)trigger_error('ERROR: In class <b>'.get_class($this).'</b> in method <b>rows($rows)</b>: Parameter <b>$rows</b> MUST BE of type Integer - <b style="color:red">'.gettype($rows).'</b> given!',E_USER_ERROR);
		    $this->attribute("size",(string)$rows);
		    return $this;
		}else{
			return $this->attribute("size");
		}
    }
	//=====================================================================//
    //  METHOD: rows                                                       //
    //========================== END OF METHOD ============================//
    
    //========================= START OF METHOD ===========================//
    //  METHOD: multiple                                                   //
    //=====================================================================//
       /** Sets or retrieves whether multiple selected options are to be allowed.
         * @return mixed The permission as Boolean or an instance of this Select
         * @access public
         */
    function multiple($multiple){
        if(func_num_args()>0){
		    if(is_bool($multiple)==false)trigger_error('ERROR: In class <b>'.get_class($this).'</b> in method <b>multiple($multiple)</b>: Parameter <b>$multiple</b> MUST BE of type Boolean - <b style="color:red">'.gettype($multiple).'</b> given!',E_USER_ERROR);
		    if($multiple==true){
		        $this->attribute("multiple","multiple");
	        }else{
		        $this->attribute("multiple","");
	        }
		    return $this;
		}else{
			return ($this->attribute("multiple")=="multiple")?true:false;
		}
	    
    }
	//=====================================================================//
    //  METHOD: multiple                                                   //
    //========================== END OF METHOD ============================//
    
    /**
     * Returns the HTML representation of this Select widget
     * @param bool true, compresses the HTML, removing the new lines and indent, false, displays the widget micely indented
     * @param int the level of this widget in the widgets' hierarchy
     * @return String the HTML code of this widget
     */   
    function to_html($compressed=true,$level=0){
	    if($compressed==false){$nl = "\n";$tab="    ";$indent=str_pad("",($level*4));}else{$nl="";$tab="";$indent="";}
        $html = $indent.'<select'.$this->attributes_to_html().'>'.$nl;
            foreach($this->items as $item){
                $html.=$indent.$tab.'<option value="'.$item[0].'"'.$item[2].'>'.$item[1].'</option>'.$nl;
            }
        $html .= $indent.'</select>';
        return $html;
    }
    
       /**
        * Returns the XHTML representation of this Select widget
        * @param bool true, compresses the HTML, removing the new lines and indent, false, displays the widget micely indented
        * @param int the level of this widget in the widgets' hierarchy
        * @return String the HTML code of this widget
        */   
    function toXhtml($compressed=true,$level=0){
        if($compressed==false){$nl = "\n";$tab="    ";$indent=str_pad("",($level*4));}else{$nl="";$tab="";$indent="";}
        $html = $indent.'<select'; if(count($this->attribute)>0){$html .= $this->attributes_to_html();} if(count($this->style)>0){$html .= ' '.$this->styles_to_html();} $html .= '>'.$nl;
            foreach($this->items as $item){
                $html.=$indent.$tab.'<option value="'.$item[0].'"'.$item[2].'>'.$item[1].'</option>'.$nl;
            }
        $html .= $indent.'</select>';
        return $html;
		return $html;
	}
}
