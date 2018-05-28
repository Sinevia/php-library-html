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
// CLASS: Textarea                                                           //
//===========================================================================//
class Textarea extends Element {

    /**
     * The constructor of this LightPanel.
     * @construct
     */
    function __construct() {
        parent::__construct();
    }
    
    public function setValue($text) {
        if (is_string($text) == false AND is_numeric($text) == false AND is_null($text) == false) {
            throw new \InvalidArgumentException('In class ' . get_class($this) . ' in method setValue($text): Parameter $text MUST BE of type String - ' . (is_object($text) ? get_class($text) : gettype($text)) . ' given!');
        }
        $this->addChild($text);
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
        $html = $indent . '<textarea' . $this->attributesToHtml() . $this->cssToHtml() . '>';
        foreach ($this->children as $child) {
            if (is_object($child) && is_subclass_of($child, "Sinevia\Html\Element")) {
                $html .= $child->toHtml($compressed, $level + 1) . $nl;
            } else {
                $html .= $child;
            }
        }
        $html .= '</textarea>';
        return $html;
    }

    //=====================================================================//
    //  METHOD: toHtml                                                    //
    //========================== END OF METHOD ============================//
    //========================= START OF METHOD ===========================//
    //  METHOD: toXhtml                                                   //
    //=====================================================================//
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
        $html = $indent . '<textarea' . $this->attributesToHtml() . $this->cssToHtml() . '>';
        foreach ($this->children as $child) {
            if (is_object($child) && is_subclass_of($child, "Sinevia\Html\Element")) {
                $html .= $child->toXhtml($compressed, $level + 1) . $nl;
            } else {
                $html .= $child;
            }
        }
        $html .= '</textarea>';
        return $html;
    }

    //=====================================================================//
    //  METHOD: toXhtml                                                   //
    //========================== END OF METHOD ============================//
}

//===========================================================================//
// CLASS: Textarea                                                           //
//============================== END OF CLASS ===============================//
