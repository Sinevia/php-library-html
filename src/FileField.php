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
    * Creates an HTML file upload widget
    * <code>
    * // Creating a new Paragraph
    * $file_field = new S_FileField();
    *   $file_field->name("FILE");
    *
    * // The same as above using the shortcut function and method chaining
    * $file_field = s_file_field()->name("FILE");
    * </code>
    * @package GUI
    */
class FileField extends Element {
	//========================= START OF METHOD ===========================//
    //  CONSTRUCTOR: __construct                                           //
    //=====================================================================//
       /**
        * The constructor of this FileField.
        * @construct
        */
	function __construct(){
        parent::__construct();
        $this->attribute("type","file");
    }
    //=====================================================================//
    //  CONSTRUCTOR: __construct                                           //
    //========================== END OF METHOD ============================//
    
    //========================= START OF METHOD ===========================//
    //  METHOD: to_html                                                   //
    //=====================================================================//
       /**
        * Returns the HTML representation of this FileField
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
        * Returns the XHTML representation of this FileField
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
    //  METHOD: to_xhtml                                                    //
    //========================== END OF METHOD ============================//
}
