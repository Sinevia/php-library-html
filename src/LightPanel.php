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
// CLASS: LightPanel                                                       //
//===========================================================================//
/**
 * Creates an HTML LightPanel. LightPanel uses div as outer container.
 * Take care that for the moment the vertical alignment "middle" has
 * problems with IE. If you intend to use it,please consider the usage
 * of the Panel widget.
 * 
 * <code>
 * // Creating a new LightPanel
 * $panel = new LightPanel();
 *   $panel->child(new Label("Panel"));
 *   $panel->halign("center");
 *   $panel->valign("top");
 *   $panel->width("100");
 *
 * // The same as above using the shortcut function and method chaining
 * $panel = (new LightPanel)->child(new Label("Panel"))->halign("center")->valign("top")->width("100");
 * </code>
 * @package GUI
 */
class LightPanel extends Element {

    //========================= START OF METHOD ===========================//
    //  CONSTRUCTOR: __construct                                           //
    //=====================================================================//
    /**
     * The constructor of this LightPanel.
     * @construct
     */
    function __construct($width = "100%", $height = "100%", $halign = "center", $valign = "middle") {
        parent::__construct();
        $this->setWidth($width);
        $this->setHeight($height);
        $this->setHalign($halign);
        $this->setValign($valign);
    }

    /**
     * Returns the HTML representation of this TextArea
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
        $html = $indent . '<div' . $this->attributesToHtml() . $this->cssToHtml() . '>' . $nl;
        foreach ($this->children as $child) {
            if (is_object($child) && is_subclass_of($child, "Sinevia\Html\Element")) {
                $html .= $child->toHtml($compressed, $level + 1) . $nl;
            } else {
                $html .= $indent . $tab . $child . $nl;
            }
        }
        $html .= $indent . '</div>';
        return $html;
    }

    /**
     * Returns the XHTML representation of this LightPanel
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
        $html = $indent . '<div' . $this->attributesToHtml() . $this->cssToHtml() . '>' . $nl;
        foreach ($this->children as $child) {
            if (is_object($child) && is_subclass_of($child, "Sinevia\Html\Element")) {
                $html .= $child->toXhtml($compressed, $level + 1) . $nl;
            } else {
                $html .= $indent . $tab . $child . $nl;
            }
            $html .= $indent . '</div>';
            return $html;
        }
    }

}
