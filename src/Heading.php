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

class Heading extends Element {
    private $weight = 1;

    /**
     * The constructor of this Table.
     * @construct
     */
    function __construct() {
        parent::__construct();
    }
    
    /**
     * Returns the text of this Heading.
     * @return String The text as String (null, if not set)
     */
    public function getText() {
        return $this->getProperty('text');
    }

    /**
     * Sets he text of this Heading.
     * @param String the text to be shown
     * @return Heading the instance of this Heading
     * @throws \InvalidArgumentException if parameter $text is not is not String
     */
    public function setText($text = null) {
        if (is_string($text) == false) {
            throw new \InvalidArgumentException('In class <b>' . get_class($this) . '</b> in method <b>text($text)</b>: Parameter <b>$text</b> MUST BE of type String - <b>' . (is_object($text) ? get_class($text) : gettype($text)) . '</b> given!');
        }
        $this->setProperty('text', $text);
        return $this;
    }
    
    /**
     * Returns the weight of this Heading.
     * @return int The weight as integer (1, if not set)
     */
    function getWeight() {
        return $this->weight;
    }

    /**
     * Sets the weight of this Heading (an integer of 1 to 6).
     * @param int the weight to be shown
     * @return Heading the instance of this Heading
     * @throws \InvalidArgumentException if parameter $text is not is not an integer
     */
    function setWeight($weight) {
        if (is_int($weight)) {
            throw new \InvalidArgumentException('In class ' . get_class($this) . ' in method setWeight($weight): Parameter $weight MUST BE of type Integer - ' . (is_object($weight) ? get_class($weight) : gettype($weight)) . ' given!');
        }
        
        $this->weight = $weight;        
        return $this;
    }

    /**
     * Returns the HTML representation of this Element with its children.
     * @param compressed compresses the HTML, removing the new lines and indent
     * @param level the level of this widget
     * @return String html string
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
        
        $html = $indent . '<h' . $this->weight . $this->attributesToHtml() . $this->cssToHtml() . '>' . $nl;
        
        if ($this->getProperty("text") != null) {
            $html .= $indent . $tab . $this->getProperty("text") . $nl;
        }
        
        foreach ($this->children as $child) {
            if (is_object($child) && is_subclass_of($child, "Sinevia\Html\Element")) {
                $html .= $child->toHtml($compressed, $level + 1) . $nl;
            } else {
                if ($child == '') {
                    $child = '&nbsp;';
                }
                $html .= $indent . $tab . $child . $nl;
            }
        }
        $html .= $indent . '</h' . $this->weight . '>';
        return $html;
    }

    /**
     * Returns the XHTML representation of this Element with its children.
     * @param compressed compresses the XHTML, removing the new lines and indent
     * @param level the level of this widget
     * @return String html string
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
        if ($this->getProperty('text') == null) {
            $this->getProperty('text', "&nbsp;");
        }
        $html = $indent . '<h' . $this->weight . '' . $this->attributesToHtml() . $this->cssToHtml() . '>' . $nl;
        foreach ($this->children as $child) {
            if (is_object($child) && is_subclass_of($child, "Sinevia\Html\Element")) {
                $html .= $child->toXhtml($compressed, $level + 1) . $nl;
            } else {
                if ($child == '') {
                    $child = '&nbsp;';
                }
                $html .= $indent . $tab . $child . $nl;
            }
        }
        $html .= $indent . '</h' . $this->weight . '>';
        return $html;
    }

}
