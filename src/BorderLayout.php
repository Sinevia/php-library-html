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
// CLASS: BorderLayout                                                       //
//===========================================================================//
/**
 * The BorderLayout class is an advanced layout.
 *
 * It arranges its children in five regions: top, bottom, left, right, and center.
 * Each region may contain no more than one widget.
 * <code>
 * // Creating a new instance of BorderLayout
 * $borderlayout = new BorderLayout();
 *     $borderlayout->addChild("HEADER","top");
 *     $borderlayout->addChild("CONTENT","center");
 *     $borderlayout->addChild("FOOTER","bottom");
 *     $borderlayout->addChild("MENU","left");
 *     $borderlayout->addChild("ADDS","right");
 *
 * // Using the shortcut function
 * $borderlayout = (new BorderLayout())->addTop("HEADER")->addCenter("CONTENT")->addBottom("FOOTER")->addLeft("MENU")->addRight("ADDS");
 * </code>
 * @package GUI
 */
class BorderLayout extends Element {

    //========================= START OF METHOD ===========================//
    //  CONSTRUCTOR: __construct                                           //
    //=====================================================================//
    /**
     * The constructor of S_BorderLayout.
     * As a default the BorderLayout stretches to fit its parent widget.
     * @construct
     */
    function __construct() {
        parent::__construct();
        $this->containers = array();
        $this->setWidth("100%");
        $this->setHeight("100%");
        $this->setSpacing(0);
        $this->setPadding(0);
        $this->setAttribute("border", "0");
    }

    /**
     * Adds a child widget to this Layout.
     *
     * The child is added to the specified position (top, bottom, center, left, right).
     * <code>
     * // Creating a new instance of BorderLayout
     * $borderlayout = new S_BorderLayout();
     * // Adding top widget
     * $borderlayout->child("HEADER","top");
     * // Adding left widget
     * $borderlayout->child("LEFT","left","center","top");
     * // Adding center widget
     * $borderlayout->child("CENTER","center","left");
     * // Adding right widget
     * $borderlayout->child("RIGHT","right","center","top");
     * // Adding bottom widget
     * $borderlayout->child("FOOTER","bottom");
     * </code>
     * @param widget the widget to add
     * @param position the position to add to (top, bottom, center, left, right)
     * @param String horizontal alignment ("left","center","right")
     * @param String vertical alignment ("top","middle","bottom")
     * @throws IllegalArgumentException if the supplied parameters, are not of the right type
     * @return void
     */
    function addChild($widget, $position = "center", $halign = "center", $valign = "middle") {
        //Obsolete:07.02.2007: if(is_string($widget)==true)$widget=s_label()->text($widget);
        // Checking widget
        if (is_string($widget) == false && ($widget instanceof Element) == false) {
            throw new \RuntimeException('In class <b>' . get_class($this) . '</b> in method <b>child($widget,$position,$halign,$valign)</b>: Parameter <b>$widget</b> MUST BE a String or sublass of Sinevia\Html\Element - <b>' . (is_object($widget) ? get_class($widget) : gettype($widget)) . '</b> given!');
        }
        if (is_string($position) == false) {
            throw new \RuntimeException('In class <b>' . get_class($this) . '</b> in method <b>child($widget,$position,$halign,$valign)</b>: Parameter <b>$position</b> MUST BE of type String - <b>' . (is_object($position) ? get_class($position) : gettype($position)) . '</b> given!');
        }
        // Checking position
        $allowed_params = array("top", "bottom", "left", "right", "center");
        if (in_array($position, $allowed_params) == false) {
            throw new \RuntimeException('In class <b>' . get_class($this) . '</b> in method <b>child($widget,$position,$halign,$valign)</b>: Parameter <b>$position</b> MUST BE of type String(' . implode(", ", $allowed_params) . ') - <b>' . ($position) . '</b> given!');
        }
        // Checking horizontal alignment
        if (is_string($halign) == false) {
            throw new \RuntimeException('In class <b>' . get_class($this) . '</b> in method <b>child($widget,$position,$halign,$valign)</b>: Parameter <b>$halign</b> MUST BE of type String - <b>' . (is_object($halign) ? get_class($halign) : gettype($halign)) . '</b> given!');
        }
        // Checking vertical alignment
        if (is_string($valign) == false) {
            throw new \RuntimeException('In class <b>' . get_class($this) . '</b> in method <b>child($widget,$position,$halign,$valign)</b>: Parameter <b>$valign</b> MUST BE of type String - <b>' . (is_object($valign) ? get_class($valign) : gettype($valign)) . '</b> given!');
        }

        $position = strtolower($position);
        $container = new Element();
        $container->parent = $this;
        $container->widget = $widget;
        if (is_object($widget) && is_subclass_of($widget, "Sinevia\Html\Element")) {
            $widget->parent = $container;
        }
        if ($position == "top" || $position == "bottom") {
            $container->setHeight("1");
        }
        if ($position == "left" || $position == "right") {
            $container->setWidth("1");
        }
        $container->setAttribute("align", $halign);
        $container->setAttribute("valign", $valign);
        $this->containers[$position] = $container;
        $this->children[] = $widget;
    }

    /**
     * Sets or retrieves the padding of the cells of this Layout.
     * @param Integer the cells' padding
     * @throws IllegalArgumentException if parameter $padding is not Integer
     * @return mixed the spacing (as Integer) or an instance of this widget
     */
    function getPadding($padding = null, $left = 0, $bottom = 0, $right = 0) {
        return (int) $this->getAttribute("cellpadding");
    }

    /**
     * Sets the padding of the cells of this Layout.
     * @param Integer the cells' padding
     * @throws IllegalArgumentException if parameter $padding is not Integer
     * @return mixed the spacing (as Integer) or an instance of this widget
     */
    function setPadding($padding = null, $left = 0, $bottom = 0, $right = 0) {
        if (is_int($padding) == false) {
            throw new IllegalArgumentException('In class <b>' . get_class($this) . '</b> in method <b>padding($padding)</b>: Parameter <b>$padding</b> MUST BE of type Integer - <b>' . (is_object($padding) ? get_class($padding) : gettype($padding)) . '</b> given!');
        }
        $this->setAttribute("cellpadding", (string) $padding);
        return $this;
    }

    /**
     * Sets the spacing between the cells of this Layout.
     * @param Integer the spacing between cells
     * @throws IllegalArgumentException if parameter $spacing is not Integer
     * @return mixed the spacing (as Integer) or an instance of this widget
     */
    function setSpacing($spacing) {
        if (is_int($spacing) == false) {
            throw new IllegalArgumentException('In class <b>' . get_class($this) . '</b> in method <b>spacing($spacing)</b>: Parameter <b>$spacing</b> MUST BE of type Integer - <b>' . (is_object($spacing) ? get_class($spacing) : gettype($spacing)) . '</b> given!');
        }
        $this->setAttribute("cellspacing", (string) $spacing);
        return $this;
    }

    /**
     * Gets the spacing between the cells of this Layout.
     * @param Integer the spacing between cells
     * @throws IllegalArgumentException if parameter $spacing is not Integer
     * @return mixed the spacing (as Integer) or an instance of this widget
     */
    function getSpacing($spacing = null) {
        return (int) $this->getAttribute("cellspacing");
    }

    function addTop($widget, $halign = "center", $valign = "middle") {
        $this->addChild($widget, "top", $halign, $valign);
        return $this;
    }

    function addBottom($widget, $halign = "center", $valign = "middle") {
        $this->addChild($widget, "bottom", $halign, $valign);
        return $this;
    }

    function addLeft($widget, $halign = "center", $valign = "middle") {
        $this->addChild($widget, "left", $halign, $valign);
        return $this;
    }

    function addRight($widget, $halign = "center", $valign = "middle") {
        $this->addChild($widget, "right", $halign, $valign);
        return $this;
    }

    function addCenter($widget, $halign = "center", $valign = "middle") {
        $this->addChild($widget, "center", $halign, $valign);
        return $this;
    }

    /** Sets the width of this BorderLayout.
     * @return mixed The width in pixels or percentage or an instance of this Widget
     * @throws IllegalArgumentException if parameter $width is not Integer or String(i.e 100%)
     * @tested true
     * @access public
     */
    function setWidth($width) {
        if ($width !== null && is_numeric($width) == false && (is_string($width) == true && substr($width, -1) == "%") == false) {
            throw new IllegalArgumentException('In class <b>' . get_class($this) . '</b> in method <b>width($width)</b>: Parameter <b>$width</b> MUST BE of type Integer or String(i.e "100%") - <b style="color:red">' . (is_object($width) ? get_class($width) : gettype($width)) . '</b> given!');
        }
        if (substr($width, -1) == "%") {
            $this->setAttribute('width', $width);
        } elseif ($width === null) {
            $this->setCss('width', (string) $width);
            $this->setProperty('width', $width);
        } else {
            $this->setAttribute('width', (string) $width);
        }
        return $this;
    }

    //========================= START OF METHOD ===========================//
    //  METHOD: width                                                      //
    //=====================================================================//
    /** Gets the width of this BorderLayout.
     * @return mixed The width in pixels or percentage or an instance of this Widget
     * @throws IllegalArgumentException if parameter $width is not Integer or String(i.e 100%)
     * @tested true
     * @access public
     */
    function getWidth($width = null) {
        $width = str_replace("px", "", $this->attribute('width'));
        return is_numeric($width) ? (int) $width : $width;
    }

    //=====================================================================//
    //  METHOD: width                                                    //
    //========================== END OF METHOD ============================//
    //========================= START OF METHOD ===========================//
    //  METHOD: to_html                                                    //
    //=====================================================================//
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
            $this->addChild("&nbsp;", "center");
        }

        $html = $indent . '<table' . $this->attributesToHtml() . $this->cssToHtml() . '>' . $nl;

        // TOP CONTAINER
        if (isset($this->containers['top']) == true) {
            $container = $this->containers['top'];
            $html .= $indent . $tab . '<tr>' . $nl;
            $html .= $indent . $tab . $tab . '<td';
            if (count($container->attributes) > 0) {
                $html .= $container->attributesToHtml();
            } if (count($container->css) > 0) {
                $html .= ' ' . $container->cssToHtml();
            } $html .= '>' . $nl;
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
        if (isset($this->containers["left"]) || isset($this->containers["right"]) || isset($this->containers["center"])) {
            $html .= $indent . $tab . '<tr>' . $nl;
        }
        if (isset($this->containers["left"]) || isset($this->containers["right"])) {
            $html .= $indent . $tab . $tab . '<td>' . $nl;
            $html .= $indent . '<table  border="0" cellpadding="0" cellspacing="0" width="100%" style="height:100%">' . $nl;
            $html .= $indent . $tab . '<tr>' . $nl;
        }
        // LEFT CONTAINER
        if (isset($this->containers['left']) == true) {
            $container = $this->containers['left'];
            $html .= $indent . $tab . $tab . '<td';
            if (count($container->attributes) > 0) {
                $html .= $container->attributesToHtml();
            } if (count($container->css) > 0) {
                $html .= ' ' . $container->cssToHtml();
            } $html .= '>' . $nl;
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
        // CENTER CONTAINER
        if (isset($this->containers['center']) == true) {
            $container = $this->containers['center'];
            $html .= $indent . $tab . $tab . '<td';
            if (count($container->attributes) > 0) {
                $html .= $container->attributesToHtml();
            } if (count($container->css) > 0) {
                $html .= ' ' . $container->cssToHtml();
            } $html .= '>' . $nl;

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
        // RIGHT CONTAINER
        if (isset($this->containers['right']) == true) {
            $container = $this->containers['right'];
            $html .= $indent . $tab . $tab . '<td';
            if (count($container->attributes) > 0) {
                $html .= $container->attributesToHtml();
            } if (count($container->css) > 0) {
                $html .= ' ' . $container->cssToHtml();
            } $html .= '>' . $nl;
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
        if (isset($this->containers["left"]) || isset($this->containers["right"])) {
            $html .= $indent . $tab . '</tr>' . $nl;
            $html .= $indent . '</table>' . $nl;
            $html .= $indent . $tab . $tab . '</td>' . $nl;
        }
        if (isset($this->containers["left"]) || isset($this->containers["right"]) || isset($this->containers["center"])) {
            $html .= $indent . $tab . '</tr>' . $nl;
        }
        // BOTTOM CONTAINER
        if (isset($this->containers['bottom']) == true) {
            $container = $this->containers['bottom'];
            $html .= $indent . $tab . '<tr>' . $nl;
            $html .= $indent . $tab . $tab . '<td';
            if (count($container->attributes) > 0) {
                $html .= $container->attributesToHtml();
            } if (count($container->css) > 0) {
                $html .= ' ' . $container->cssToHtml();
            } $html .= '>' . $nl;
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
        $html .= $indent . '</table>';
        return $html;
    }

    //=====================================================================//
    //  METHOD: toHtml                                                    //
    //========================== END OF METHOD ============================//
    //========================= START OF METHOD ===========================//
    //  METHOD: toXhtml                                                   //
    //=====================================================================//
    /**
     * Returns the XHTML representation of this BorderLayout with its children.
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
        if (count($this->containers) == 0)
            $this->child(g::label()->text("&nbsp;"), "center");
        $html = $indent . '<table';
        if (count($this->attributes) > 0) {
            $html .= $this->attributesToHtml();
        } if (count($this->css) > 0) {
            $html .= ' ' . $this->cssToHtml();
        } $html .= '>' . $nl;

        // TOP CONTAINER
        if (isset($this->containers['top']) == true) {
            $container = $this->containers['top'];
            // START: Vertical Align
            if ($container->valign() !== null)
                $container->getAttribute("valign", $container->valign());
            // END: Vertical Align
            $html .= $indent . $tab . '<tr>' . $nl;
            $html .= $indent . $tab . $tab . '<td';
            if (count($container->attributes) > 0) {
                $html .= $container->attributesToHtml();
            } if (count($container->css) > 0) {
                $html .= ' ' . $container->cssToHtml();
            } $html .= '>' . $nl;
            if (is_object($container->widget) == true && is_subclass_of($container->widget, "Sinevia\Html\Element")) {
                $html .= $container->widget->to_xhtml($compressed, ($level + 3)) . $nl;
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
        if (isset($this->containers["left"]) || isset($this->containers["right"]) || isset($this->containers["center"])) {
            $html .= $indent . $tab . '<tr>' . $nl;
        }
        if (isset($this->containers["left"]) || isset($this->containers["right"])) {
            $html .= $indent . $tab . $tab . '<td>' . $nl;
            $html .= $indent . '<table  border="0" cellpadding="0" cellspacing="0" width="100%" style="height:100%">' . $nl;
            $html .= $indent . $tab . '<tr>' . $nl;
        }
        // LEFT CONTAINER
        if (isset($this->containers['left']) == true) {
            $container = $this->containers['left'];
            // START: Vertical Align
            if ($container->valign() !== null)
                $container->attribute("valign", $container->valign());
            // END: Vertical Align
            $html .= $indent . $tab . $tab . '<td';
            if (count($container->attributes) > 0) {
                $html .= $container->attributesToHtml();
            } if (count($container->css) > 0) {
                $html .= ' ' . $container->cssToHtml();
            } $html .= '>' . $nl;
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
        // CENTER CONTAINER
        if (isset($this->containers['center']) == true) {
            $container = $this->containers['center'];
            // START: Vertical Align
            if ($container->valign() !== null)
                $container->attribute("valign", $container->valign());
            // END: Vertical Align
            $html .= $indent . $tab . $tab . '<td';
            if (count($container->attributes) > 0) {
                $html .= $container->attributesToHtml();
            } if (count($container->css) > 0) {
                $html .= ' ' . $container->cssToHtml();
            } $html .= '>' . $nl;
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
        // RIGHT CONTAINER
        if (isset($this->containers['right']) == true) {
            $container = $this->containers['right'];
            // START: Vertical Align
            if ($container->valign() !== null)
                $container->attribute("valign", $container->valign());
            // END: Vertical Align
            $html .= $indent . $tab . $tab . '<td';
            if (count($container->attributes) > 0) {
                $html .= $container->attributesToHtml();
            } if (count($container->css) > 0) {
                $html .= ' ' . $container->cssToHtml();
            } $html .= '>' . $nl;
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
        if (isset($this->containers["left"]) || isset($this->containers["right"])) {
            $html .= $indent . $tab . '</tr>' . $nl;
            $html .= $indent . '</table>' . $nl;
            $html .= $indent . $tab . $tab . '</td>' . $nl;
        }
        if (isset($this->containers["left"]) || isset($this->containers["right"]) || isset($this->containers["center"])) {
            $html .= $indent . $tab . '</tr>' . $nl;
        }
        // BOTTOM CONTAINER
        if (isset($this->containers['bottom']) == true) {
            $container = $this->containers['bottom'];
            // START: Vertical Align
            if ($container->valign() !== null)
                $container->attribute("valign", $container->valign());
            // END: Vertical Align
            $html .= $indent . $tab . '<tr>' . $nl;
            $html .= $indent . $tab . $tab . '<td';
            if (count($container->attributes) > 0) {
                $html .= $container->attributesToHtml();
            } if (count($container->css) > 0) {
                $html .= ' ' . $container->cssToHtml();
            } $html .= '>' . $nl;
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
        $html .= $indent . '</table>';
        return $html;
    }

    //=====================================================================//
    //  METHOD: toXhtml                                                   //
    //========================== END OF METHOD ============================//
}

//===========================================================================//
// CLASS: BorderLayout                                                     //
//============================== END OF CLASS ===============================//
