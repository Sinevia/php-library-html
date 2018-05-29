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
 * Creates an HTML unordered list.
 * <code>
 * // Creating a new instance of UnorderedList
 * $ul = new UnorderedList();
 *     $ul->background("yellow");
 *     for($i=0;$i<100;$i++){
 *         $ul->item($i." years");
 *     }
 * </code>
 * @package GUI
 * // The same as above using the shortcut function and method chaining
 * $ul = (new UnorderedList)->background("yellow");
 *     for($i=0;$i<100;$i++){
 *         $ul->item($i." years");
 *     }
 * </code>
 */
class UnorderedList extends Element {

    //========================= START OF METHOD ===========================//
    //  CONSTRUCTOR: __construct                                           //
    //=====================================================================//
    /**
     * The constructor of UnorderedList
     * @construct
     */
    function __construct() {
        parent::__construct();
        //$this->style("padding-left","30px");
    }

    //=====================================================================//
    //  CONSTRUCTOR: __construct                                           //
    //========================== END OF METHOD ============================//
    //========================= START OF METHOD ===========================//
    //  METHOD: child                                                      //
    //=====================================================================//
    /** Adds a list item to this UnorderedList.
     * @param mixed the list item (String as S_Widget)
     * @param S_UnorderedList sublist to this list item
     * @return S_UnorderedList the instance of this S_UnorderedList
     * @access public
     */
    function child($child, $sublist = null) {
        if (is_string($child) == false && is_subclass_of($child, "Sinevia\Html\Element") == false) {
            trigger_error('Class <b>' . get_class($this) . '</b> in method <b>child($child,$sublist)</b>: The Parameter $child MUST BE Of Type String or a Subclass of S_Widget <b>' . gettype($child) . '</b> Given!', E_USER_ERROR);
        }

        $id = count($this->children);

        if ($sublist !== null) {
            // TODO:add message for not objects with gettype
            if (($sublist instanceof OrderedList) == false && ($sublist instanceof UnorderedList) == false) {
                trigger_error('Class <b>' . get_class($this) . '</b> in method <b>child($child,$sublist)</b>: The Parameter $sublist MUST BE Of Type S_OrderedList or S_UnorderedList <b>' . get_class($sublist) . '</b> Given!', E_USER_ERROR);
            }
            $this->sublist[$id] = $sublist;
        }

        $this->children[$id] = $child;
    }

    //=====================================================================//
    //  METHOD: __child                                               //
    //========================== END OF METHOD ============================//
    //========================= START OF METHOD ===========================//
    //  METHOD: to_html                                                   //
    //=====================================================================//
    /**
     * Returns the HTML representation of this UnorderedList with its children.
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
        $html = $indent . '<ul' . $this->attributesToHtml() . '>' . $nl;
        for ($i = 0; $i < count($this->children); $i++) {
            if (is_object($this->children[$i]) && is_subclass_of($this->children[$i], "Sinevia\Html\Element")) {
                $html .= $indent . $tab . '<li>' . $nl . $this->children[$i]->toHtml($compressed, $level + 2) . $nl;
                if (isset($this->sublist[$i])) {
                    $html .= $this->sublist[$i]->toHtml($compressed, $level + 3) . $nl;
                }
                $html .= $indent . $tab . '</li>' . $nl;
            } else {
                if (isset($this->sublist[$i])) {
                    $html .= $indent . $tab . '<li>' . $this->children[$i] . $nl;
                    $html .= $this->sublist[$i]->toHtml($compressed, $level + 3) . $nl;
                    $html .= $indent . $tab . '</li>' . $nl;
                } else {
                    $html .= $indent . $tab . '<li>' . $this->children[$i] . '</li>' . $nl;
                }
            }
        }
        $html .= $indent . '</ul>';
        return $html;
    }

    //=====================================================================//
    //  METHOD: toHtml                                                   //
    //========================== END OF METHOD ============================//
    //========================= START OF METHOD ===========================//
    //  METHOD: toXhtml                                                   //
    //=====================================================================//
    /**
     * Returns the XHTML representation of this UnorderedList with its children.
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
        $html = $indent . '<ul';
        if (count($this->attribute) > 0) {
            $html .= $this->attributes_to_html();
        } if (count($this->style) > 0) {
            $html .= ' ' . $this->styles_to_html();
        } $html .= '>' . $nl;
        for ($i = 0; $i < count($this->children); $i++) {
            if (is_object($this->children[$i]) && is_subclass_of($this->children[$i], "Sinevia\Html\Element")) {
                $html .= $indent . $tab . '<li>' . $nl . $this->children[$i]->toXhtml($compressed, $level + 2) . $nl;
                if (isset($this->sublist[$i])) {
                    $html .= $this->sublist[$i]->toXhtml($compressed, $level + 3) . $nl;
                }
                $html .= $indent . $tab . '</li>' . $nl;
            } else {
                if (isset($this->sublist[$i])) {
                    $html .= $indent . $tab . '<li>' . $this->children[$i] . $nl;
                    $html .= $this->sublist[$i]->toXhtml($compressed, $level + 3) . $nl;
                    $html .= $indent . $tab . '</li>' . $nl;
                } else {
                    $html .= $indent . $tab . '<li>' . $this->children[$i] . '</li>' . $nl;
                }
            }
        }
        $html .= $indent . '</ul>';
        return $html;
    }

    //=====================================================================//
    //  METHOD: toXhtml                                                   //
    //========================== END OF METHOD ============================//
}
