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
 * The FlowLayout arranges its children horizontally in one row or vertically in one column.
 * <code>
 * // Creating a new instance of FlowLayout
 * $flowlayout = new FlowLayout("vertical");
 *
 * // Using the shortcut function
 * $flowlayout = (new FlowLayout)->flow("vertical");
 * </code>
 */
class FlowLayout extends Element {

    /**
     * The constructor of FlowLayout. As a default the FlowLayout stretches to fit its parent
     * widget.
     * @param integer width in pixels, or percentage value of the parent width
     * @param integer height in pixels, or percentage value of the parent height
     * @construct
     */
    function __construct($flow = "vertical", $width = "100%", $height = "100%") {
        parent::__construct();
        $this->containers = array();
        $this->flow("vertical");
        $this->width($width);
        $this->setHeight($height);
        $this->spacing("0");
        $this->padding("0");
        $this->setAttribute("border", "0");
    }

    /**
     * Sets or retrieves the flow of this FlowLayout. The flow might be
     * either "horizontal" or "vertical". The horizontal flow will add
     * the elements in one row startibg from left to right, while
     * the vertical flow will place the cjild element one under the other
     * from top to bottom
     * @param String "horizontal" or "vertical"
     * @return FlowLayout an instance of this FlowLayout
     */
    function flow($flow = null) {
        if (func_num_args() > 0) {
            $allowed_params = array("horizontal", "vertical");
            if (is_string($flow == false)) {
                trigger_error('ERROR: In class <b>' . get_class($this) . '</b> in method <b>flow($flow)</b>: Parameter <b>$flow</b> MUST BE of type String(' . implode(", ", $allowed_params) . ') - <b style="color:red">' . gettype($flow) . '</b> given!', E_USER_ERROR);
            }
            if (in_array($flow, $allowed_params) == false) {
                trigger_error('ERROR: In class <b>' . get_class($this) . '</b> in method <b>flow($flow)</b>: Parameter <b>$flow</b> MUST BE of type String(' . implode(", ", $allowed_params) . ') - <b style="color:red">' . gettype($flow) . '</b> given!', E_USER_ERROR);
            }
            $this->setProperty("flow", $flow);
            return $this;
        } else {
            return $this->getProperty("flow");
        }
    }

    /**
     * Adds a child widget to the specified position of this layout.
     * <code>
     * // Creating a new instance of BorderLayout
     * $flowlayout = new FlowLayout("vertical");
     * // Adding widget
     * $header = $flowlayout->add_child("HEADER");
     * $content = $flowlayout->add_child("CONTENT");
     * $footer = $flowlayout->add_child("FOOTER");
     * </code>
     * @param widget the widget to add
     * @param position the position to add the widget to
     * @return Widget the container containing this child
     * @return void
     */
    function child($widget, $position = null, $halign = "center", $valign = "middle") {
        //echo "In FlowLayout adding:".$widget."<br/>";
        //if(is_subclass_of($widget,"Widget"))echo "In add_child start CHILD UID: ".$widget->uid."PARENT UID: ".$this->uid."<br />";
        if ($position != null && is_int($position) == false)
            trigger_error('Class <b>' . get_class($this) . '</b> in method <b>add_child($widget,$position)</b>: Position Must Be Of Type Integer - <b>' . gettype($position) . '</b> Given!', E_USER_ERROR);
        if ($position === null) {
            $position = count($this->containers);
        }
        $container = new Element();
        $container->parent = $this;
        $container->widget = $widget;
        if (is_object($widget) && is_subclass_of($widget, "Sinevia\Html\Element")) {
            $widget->setParent($container);
        }
        $container->setAttribute("align", $halign);
        $container->setAttribute("valign", $valign);
        //$container->display("table-cell");
        $this->containers[$position] = $container;
        ksort($this->containers);
        $this->children[] = $widget;
        //if(is_subclass_of($widget,"Widget"))echo "In add_child end CHILD UID:".$widget->uid." PARENT UID:".$widget->parent->uid."<br />";
        return $this;
    }

    /**
     * Sets or retrieves the padding of the cells of this FlowLayout.
     * @param Integer the cells' padding
     * @return mixed the spacing (as Integer) or an instance of this Panel
     */
    function padding($padding = null, $left = 0, $bottom = 0, $right = 0) {
        if (func_num_args() > 0) {
            if (is_int($padding == false)) {
                trigger_error('ERROR: In class <b>' . get_class($this) . '</b> in method <b>padding($padding)</b>: Parameter <b>$padding</b> MUST BE of type Integer - <b style="color:red">' . gettype($padding) . '</b> given!', E_USER_ERROR);
            }
            $this->setAttribute("cellpadding", (string) $padding);
            return $this;
        } else {
            return $this->getAttribute("cellpadding");
        }
    }

    /**
     * Sets or retrieves the spacing between the cells of this GridLayout.
     * @param Integer the spacing between cells
     * @return mixed the spacing (as Integer) or an instance of this GridLayout
     */
    function spacing($spacing) {
        if (func_num_args() > 0) {
            if (is_int($spacing == false)) {
                trigger_error('ERROR: In class <b>' . get_class($this) . '</b> in method <b>spacing($spacing)</b>: Parameter <b>$spacing</b> MUST BE of type Integer - <b style="color:red">' . gettype($spacing) . '</b> given!', E_USER_ERROR);
            }
            $this->setAttribute("cellspacing", (string) $spacing);
            return $this;
        } else {
            return $this->getAttribute("cellspacing");
        }
    }

    /** Sets or retrieves the width of this GridLayout.
     * @return mixed The width in pixels or percentage or an instance of this Widget
     * @access public
     */
    function width($width = null) {
        if (func_num_args() > 0) {
            if (substr($width, -1) == "%") {
                $this->setAttribute("width", $width);
            } else {
                $this->setAttribute('width', (string) $width);
            }
            return $this;
        } else {
            $width = $this->getAttribute('width');
            return is_numeric($width) ? (int) $width : $width;
        }
    }

    /**
     * Returns the HTML representation of this BorderLayout with its children.
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
        if (count($this->containers) == 0) {
            $this->child((new Span())->addChild("&nbsp;"));
        }
        
        $html = $indent . '<table' . $this->attributesToHtml() . '>' . $nl;
        if ($this->getProperty("flow") == "vertical") {
            foreach ($this->containers as $container) {
                $html .= $indent . $tab . '<tr>' . $nl;
                $html .= $indent . $tab . $tab . '<td' . $container->attributesToHtml() . '>' . $nl;
                if (is_object($container->widget) == true && is_subclass_of($container->widget, "Sinevia\Html\Element")) {
                    $html .= $container->widget->toHtml($compressed, ($level + 3)) . $nl;
                } else {
                    if ($container->widget == "") {
                        $html .= $indent . $tab . $tab . $tab . "&nbsp;" . $nl;
                    } else {
                        $html .= $indent . $tab . $tab . $tab . $container->widget . $nl;
                    }
                }
                $html .= $indent . $tab . $tab . '</td>' . $nl;
                $html .= $indent . $tab . '</tr>' . $nl;
            }
        } else {
            $html .= $indent . $tab . '<tr>' . $nl;
            foreach ($this->containers as $container) {
                $html .= $indent . $tab . $tab . '<td' . $container->attributesToHtml() . '>' . $nl;
                if (is_object($container->widget) == true && is_subclass_of($container->widget, "Sinevia\Html\Element")) {
                    $html .= $container->widget->toHtml($compressed, ($level + 3)) . $nl;
                } else {
                    if ($container->widget == "") {
                        $html .= $indent . $tab . $tab . $tab . "&nbsp;" . $nl;
                    } else {
                        $html .= $indent . $tab . $tab . $tab . $container->widget . $nl;
                    }
                }
                $html .= $indent . $tab . $tab . '</td>' . $nl;
            }
            $html .= $indent . $tab . '</tr>' . $nl;
        }
        $html .= $indent . '</table>';
        return $html;
    }

    /**
     * Returns the XHTML representation of this FlowLayout with its children.
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
        if (count($this->containers) == 0) {
            $this->child(s_label()->text("&nbsp;"));
        }
        
        $html = $indent . '<table' . $this->attributesToHtml() . '>' . $nl;
        if ($this->getProperty("flow") == "vertical") {
            foreach ($this->containers as $container) {
                $html .= $indent . $tab . '<tr>' . $nl;
                $html .= $indent . $tab . $tab . '<td' . $container->attributesToHtml() . '>' . $nl;
                if (is_object($container->widget) == true && is_subclass_of($container->widget, "Sinevia\Html\Element")) {
                    $html .= $container->widget->toXhtml($compressed, ($level + 3)) . $nl;
                } else {
                    if ($container->widget == "") {
                        $html .= $indent . $tab . $tab . $tab . "&nbsp;" . $nl;
                    } else {
                        $html .= $indent . $tab . $tab . $tab . $container->widget . $nl;
                    }
                }
                $html .= $indent . $tab . $tab . '</td>' . $nl;
                $html .= $indent . $tab . '</tr>' . $nl;
            }
        } else {
            $html .= $indent . $tab . '<tr>' . $nl;
            foreach ($this->containers as $container) {
                $html .= $indent . $tab . $tab . '<td' . $container->attributesToHtml() . '>' . $nl;
                if (is_object($container->widget) == true && is_subclass_of($container->widget, "Sinevia\Html\Element")) {
                    $html .= $container->widget->toXhtml($compressed, ($level + 3)) . $nl;
                } else {
                    if ($container->widget == "") {
                        $html .= $indent . $tab . $tab . $tab . "&nbsp;" . $nl;
                    } else {
                        $html .= $indent . $tab . $tab . $tab . $container->widget . $nl;
                    }
                }
                $html .= $indent . $tab . $tab . '</td>' . $nl;
            }
            $html .= $indent . $tab . '</tr>' . $nl;
        }
        $html .= $indent . '</table>';
        return $html;
    }

}
