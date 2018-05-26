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

//============================= START OF CLASS ==============================//
// CLASS: Input                                                           //
//===========================================================================//
class Input extends Element {
    const TYPE_FILE = 'file';
    const TYPE_HIDDEN = 'hidden';
    const TYPE_TEXT = 'text';
    
    /**
     * The constructor of this LightPanel.
     * @construct
     */
    function __construct() {
        parent::__construct();
    }

    public function setPlaceHolder($text) {
        if (is_string($text) == false) {
            throw new \InvalidArgumentException('In class ' . get_class($this) . ' in method setPlaceHolder($text): Parameter $text MUST BE of type String - ' . (is_object($text) ? get_class($text) : gettype($text)) . ' given!');
        }
        $this->setAttribute("placeholder", $text);
        return $this;
    }
    
    public function setType($type) {
        if (is_string($type) == false AND is_numeric($type) == false) {
            throw new \InvalidArgumentException('In class ' . get_class($this) . ' in method setType($type): Parameter $type MUST BE of type String - ' . (is_object($text) ? get_class($type) : gettype($type)) . ' given!');
        }
        $this->setAttribute("type", $type);
        return $this;
    }

    public function setValue($text) {
        if (is_string($text) == false AND is_numeric($text) == false) {
            throw new \InvalidArgumentException('In class ' . get_class($this) . ' in method setValue($text): Parameter $text MUST BE of type String - ' . (is_object($text) ? get_class($text) : gettype($text)) . ' given!');
        }
        $this->setAttribute("value", $text);
        return $this;
    }

    /**
     * Returns the HTML representation of this widget
     * @param Boolean whether the HTML output should be compressed
     * @param Integer the level of nesting of this widget
     * @return String the HTML representation of this widget
     */
    function toHtml($compressed = true, $level = 0) {
        if ($compressed == false) {
            $nl = "\n";
            $tab = "    ";
            $indent = str_pad("", ($level * 4));
        } else {
            $nl = "";
            $tab = "";
            $indent = "";
        }
        $html = $indent . '<input' . $this->attributesToHtml() . $this->cssToHtml() . '>' . $nl;
        return $html;
    }

    /**
     * Returns the XHTML representation of this widget
     * @param Boolean whether the XHTML output should be compressed
     * @param Integer the level of nesting of this widget
     * @return String the XHTML representation of this widget
     */
    function toXhtml($compressed = true, $level = 0) {
        if ($compressed == false) {
            $nl = "\n";
            $tab = "    ";
            $indent = str_pad("", ($level * 4));
        } else {
            $nl = "";
            $tab = "";
            $indent = "";
        }
        $html = $indent . '<input' . $this->attributesToHtml() . $this->cssToHtml() . '/>' . $nl;
        return $html;
    }

}

//===========================================================================//
// CLASS: Input                                                              //
//============================== END OF CLASS ===============================//
