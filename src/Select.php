<?php

// ========================================================================= //
// SINEVIA PUBLIC                                        http://sinevia.com  //
// ------------------------------------------------------------------------- //
// COPYRIGHT (c) 2020 Sinevia Ltd                        All rights resrved! //
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
 * $select = new Select();
 * $select->rows(10);
 * $select->width(200);
 * for($i=0;$i<100;$i++){
 *     $select->item($i,$i." years");
 * }
 *
 * // The same as above using the shortcut function and method chaining
 * $select = (new Select())->rows(10)->width(200);
 * for($i=0;$i<100;$i++){
 *   $select->addItem($i,$i." years");
 * }
 * </code>
 */
class Select extends Element
{

    protected $items = [];

    /**
     * The constructor of this Select widget.
     * @construct
     */
    function __construct($items = array())
    {
        parent::__construct();
        if (is_array($items)) {
            $this->addItems($items);
        } else {
            throw new \InvalidArgumentException("The Items For The Select Widget Must Be An Array!");
        }
    }

    /**
     * Adds an item to the options
     * @param string $key
     * @param string $value
     * @param string $selected
     */
    function addItem($key, $value, $selected = "")
    {
        if ($selected == "") {
            $this->items[] = array($key, $value, $selected);
        } else {
            $this->items[] = array($key, $value, ' selected="selected"');
        }
        return $this;
    }

    /**
     * Adds an array of items to the options
     * @param array $items Associative array
     * @return $this
     */
    function addItems($items)
    {
        if (is_array($items) == false) {
            throw new \InvalidArgumentException('In class <b>' . get_class($this) . '</b> in method <b>addItems($action)</b>: Parameter <b>$items</b> MUST BE of type Array - <b style="color:red">' . gettype($$items) . '</b> given!', E_USER_ERROR);
        }
        foreach ($items as $key => $value) {
            $this->addItem($key, $value);
        }
        return $this;
    }

    /**
     * Retrieves if this select is multiple
     * @return boolean The multiple as Boolean
     * @access public
     */
    function getMultiple()
    {
        return ($this->getAttribute("multiple") == "multiple") ? true : false;
    }

    /**
     * Retrieves the onchange event.
     * @return mixed The onchange event as String (null, if not set)
     * @access public
     */
    function getOnChange()
    {
        return $this->getAttribute("onchange");
    }

    /**
     * Retrieves the visible rows in the Select widget.
     * @return mixed The rows as Integer (null, if not set)
     * @access public
     */
    function getRows()
    {
        return $this->getAttribute("size");
    }

    /**
     * Returns the HTML representation of this Select widget
     * @param bool true, compresses the HTML, removing the new lines and indent, false, displays the widget micely indented
     * @param int the level of this widget in the widgets' hierarchy
     * @return String the HTML code of this widget
     */
    function toHtml($compressed = true, $level = 0)
    {
        if ($compressed == false) {
            $nl = "\n";
            $tab = "    ";
            $indent = str_pad("", ($level * 4));
        } else {
            $nl = "";
            $tab = "";
            $indent = "";
        }
        $html = $indent . '<select' . $this->attributesToHtml() . $this->cssToHtml() . '>' . $nl;
        foreach ($this->items as $item) {
            $html .= $indent . $tab . '<option value="' . $item[0] . '"' . $item[2] . '>' . $item[1] . '</option>' . $nl;
        }
        $html .= $indent . '</select>';
        return $html;
    }

    /**
     * Returns the XHTML representation of this Select widget
     * @param bool true, compresses the HTML, removing the new lines and indent, false, displays the widget micely indented
     * @param int the level of this widget in the widgets' hierarchy
     * @return String the HTML code of this widget
     */
    function toXhtml($compressed = true, $level = 0)
    {
        if ($compressed == false) {
            $nl = "\n";
            $tab = "    ";
            $indent = str_pad("", ($level * 4));
        } else {
            $nl = "";
            $tab = "";
            $indent = "";
        }
        $html = $indent . '<select' . $this->attributesToHtml() . $this->cssToHtml() . '>' . $nl;
        foreach ($this->items as $item) {
            $html .= $indent . $tab . '<option value="' . $item[0] . '"' . $item[2] . '>' . $item[1] . '</option>' . $nl;
        }
        $html .= $indent . '</select>';
        return $html;
    }

    /**
     * Sets whether multiple selected options are to be allowed.
     * @return void The permission as Boolean or an instance of this Select
     * @access public
     */
    function setMultiple($isMultiple)
    {
        if (is_bool($isMultiple) == false) {
            throw new \InvalidArgumentException('ERROR: In class <b>' . get_class($this) . '</b> in method <b>setMultiple($multiple)</b>: Parameter <b>$isMultiple</b> MUST BE of type Boolean - <b style="color:red">' . gettype($isMultiple) . '</b> given!');
        }

        if ($isMultiple == true) {
            $this->setAttribute("multiple", "multiple");
        } else {
            $this->setAttribute("multiple", "");
        }

        return $this;
    }

    /**
     * Fires a JavaScript action on text change in the TextField
     * <code>
     * // Displays the selected option on change
     * $select->setOnChange('alert(this.options[this.selectedIndex].value)');
     * </code>
     * @param String the JavaScript action
     * @todo To add Ajax
     */
    function setOnChange($action)
    {
        if (is_string($action) == false) {
            throw new \InvalidArgumentException('In class <b>' . get_class($this) . '</b> in method <b>onChange($action)</b>: Parameter <b>$action</b> MUST BE of type String - <b style="color:red">' . gettype($action) . '</b> given!', E_USER_ERROR);
        }

        if ($this->getAttribute("onchange") == null) {
            $this->setAttribute("onchange", htmlentities($action));
        } else {
            $onchange = html_entity_decode($this->getAttribute("onchange"));
            if (Utils::stringEndsWith($onchange, ";") == false) {
                $onchange .= ";";
            }
            $this->setAttribute("onchange", htmlentities($onchange . $action));
        }
        return $this;
    }

    /**
     * Sets the visible rows in the Select widget.
     * @return mixed The rows as Integer (null, if not set) or an instance of this Select
     * @access public
     */
    function setRows($numberOfRows)
    {
        if (is_int($numberOfRows) == false) {
            throw new \InvalidArgumentException('ERROR: In class <b>' . get_class($this) . '</b> in method <b>rows($rows)</b>: Parameter <b>$rows</b> MUST BE of type Integer - <b style="color:red">' . gettype($numberOfRows) . '</b> given!');
        }

        $this->setAttribute("size", (string) $numberOfRows);

        return $this;
    }

    /**
     * Sets the selected item by key
     * @param string $key
     * @return $this
     */
    function setSelectedItem($key)
    {
        foreach ($this->items as $index => $entry) {
            if ($entry[0] == $key) {
                $entry[2] = 'selected="selected"';
            } else {
                $entry[2] = "";
            }
            $this->items[$index] = $entry;
        }
        return $this;
    }
}
