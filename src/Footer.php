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
// CLASS: Footer                                                            //
//===========================================================================//
/**
 * The Footer class serves as a container for the footer elements on the page.
 * <code>
 * $label = new Footer();
 *     $label->addChild("LABEL 1");
 *     
 * // Using the shortcut function
 * $label = Ui::Footer()->addChild"LABEL 1");
 * </code>
 */
class Footer extends Element {

    /**
     * The constructor of this Label.
     * @construct
     */
    function __construct() {
        parent::__construct();
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
        if ($this->getProperty('text') == null) {
            $this->getProperty('text', "&nbsp;");
        }
        $html = $indent . '<footer' . $this->attributesToHtml() . $this->cssToHtml() . '>' . $nl;
        foreach ($this->children as $child) {
            if (is_object($child) && is_subclass_of($child, "Sinevia\Html\Element")) {
                $html .= $child->toHtml($compressed, $level + 1) . $nl;
            } else {
                if ($child == '')
                    $child = '&nbsp;';
                $html .= $indent . $tab . $child . $nl;
            }
        }
        $html .= $indent . '</footer>';
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
        $html = $indent . '<footer' . $this->attributesToHtml() . $this->cssToHtml() . '>' . $nl;
        foreach ($this->children as $child) {
            if (is_object($child) && is_subclass_of($child, "Sinevia\Html\Element")) {
                $html .= $child->toXhtml($compressed, $level + 1) . $nl;
            } else {
                if ($child == '')
                    $child = '&nbsp;';
                $html .= $indent . $tab . $child . $nl;
            }
        }
        $html .= $indent . '</footer>';
        return $html;
    }

}

//===========================================================================//
// CLASS: Footer                                                             //
//============================== END OF CLASS ===============================//
