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
// CLASS: Button                                                        //
//===========================================================================//
/**
 * The Button class represents a button on the webpage.
 *
 * The Button keep all the features of the normal HTML button widget, and
 * additionally allows the use of images.
 * <code>
 * // Creating a new Button
 * $button = new Button();
 *   $button->setText("Submit");
 *   $button->setType("submit");
 *
 * // The same as above using the shortcut function and method chaining
 * $button = Ui::Button()->setText("Submit")->setType("submit");
 * </code>
 */
class Button extends Element {

    /**
     * The constructor of Button.
     * @construct
     */
    function __construct() {
        parent::__construct();
        $this->setFlow("horizontal");
        $this->setType("button");
    }

    /**
     * Returns the visible text of this Button.
     * @return String The text as String (null, if not set)
     * @access public
     */
    function getText() {
        return $this->getProperty('text');
    }

    /**
     * Sets the visible text of this Button.
     * @param String the text to be shown
     * @return Button the instance of this Button
     * @throws \InvalidArgumentException if parameter $text is not is not String
     * @access public
     */
    function setText($text) {
        if (is_string($text) == false) {
            throw new \InvalidArgumentException('In class ' . get_class($this) . ' in method text($text): Parameter $text MUST BE of type String - ' . (is_object($text) ? get_class($text) : gettype($text)) . ' given!');
        }
        $this->setProperty('text', $text);
        return $this;
    }

    /**
     * Returns the title of this Button.
     *
     * The title is shown, when the user places the mouse over the button.
     * on the webpage.
     * @return String The title as String (null, if not set)
     */
    public function getTitle() {
        return $this->getAttribute("title");
    }

    /**
     * Sets the title of this Button.
     * The title is shown, when the user places the mouse over the button.
     * on the webpage.
     * 
     * @param String the title to be shown
     * @return Button the instance of this Button
     * @throws \InvalidArgumentException if parameter $title is not is not String
     */
    public function setTitle($title) {
        if (is_string($title) == false) {
            throw new \InvalidArgumentException('In class ' . get_class($this) . ' in method title($title): Parameter $title MUST BE of type String - ' . (is_object($title) ? get_class($title) : gettype($title)) . ' given!');
        }
        $this->setAttribute("title", $title);
        return $this;
    }

    /** Sets or retrieves the value attribute of this Button.
     * @return mixed The text as String (null, if not set) or the instance of this Button
     * @throws IllegalArgumentException if parameter $text is not is not String
     * @access public
     */
    function getValue() {
        return $this->getAttribute();
    }

    /** Sets the value attribute of this Button.
     * @return mixed The text as String (null, if not set) or the instance of this Button
     * @throws IllegalArgumentException if parameter $text is not is not String
     * @access public
     */
    function setValue($value = null) {
        if (is_string($value) == false) {
            throw new IllegalArgumentException('In class ' . get_class($this) . ' in method value($value): Parameter $value MUST BE of type String - ' . (is_object($value) ? get_class($value) : gettype($value)) . ' given!');
        }
        $this->setAttribute('value', $value);
        return $this;
    }

    /**
     * Returns the flow of this Button.
     * The flow might be either "horizontal" or "vertical". The horizontal
     * flow will place the image left of the text, while the vertical flow
     * will place the text under the image.
     * @throws IllegalArgumentException if parameter $flow is not is not String ("horizontal", "vertical")
     * @return String The flow as String
     */
    function getFlow() {
        return $this->getProperty("flow");
    }

    /**
     * Sets the flow of this Button.
     * The flow might be either "horizontal" or "vertical". The horizontal
     * flow will place the image left of the text, while the vertical flow
     * will place the text under the image.
     * @param String "horizontal" or "vertical"
     * @throws IllegalArgumentException if parameter $flow is not is not String ("horizontal", "vertical")
     * @return mixed The flow as String or the instance of this Button
     */
    function setFlow($flow) {
        $allowed_params = array("horizontal", "vertical");
        if (is_string($flow) == false) {
            throw new IllegalArgumentException('In class ' . get_class($this) . ' in method flow($flow): Parameter $flow MUST BE of type String - ' . (is_object($flow) ? get_class($flow) : gettype($flow)) . ' given!');
        }
        if (in_array($flow, $allowed_params) == false) {
            throw new IllegalArgumentException('In class ' . get_class($this) . ' in method flow($flow): Parameter $flow MUST BE of type String ("horizontal","vertical") - "' . ($flow) . '" given!');
        }
        $this->setProperty("flow", $flow);
        return $this;
    }

    /**
     * Returns the image of this Button.
     * @param Html_Image the image to be shown in this button
     * @return Html_Image the image as Html_Image or the instance of this Button
     * @throws IllegalArgumentException if parameter $image is not of type S_Image
     * @access public
     */
    function getImage($image = null) {
        return $this->getProperty('image');
    }

    /**
     * Sets or retrieves the image of this Button.
     * @param S_Image the image to be shown in this button
     * @return mixed The image as S_Image or the instance of this Button
     * @throws IllegalArgumentException if parameter $image is not of type S_Image
     * @access public
     */
    function setImage($image) {
        if (($image instanceof S_Image) == false) {
            throw new IllegalArgumentException('In class ' . get_class($this) . ' in method image($image): Parameter $image MUST BE of type S_Image - ' . (is_object($image) ? get_class($image) : gettype($image)) . ' given!');
        }
        $this->setProperty('image', $image);
        return $this;
    }

    /**
     * Returns the type of this Button.
     *
     * Supports the following types:button,submit,reset. The type are used
     * for the following:
     * <ul>
     *     <li>submit - if the button is in a form, submits the form</li>
     *     <li>reset - if the button is in a form, resets the form values</li>
     *     <li>button - normal button</li>
     * </ul>
     * @return String The type as String (null, if not set)
     * @throws IllegalArgumentException if parameter $type is not String ("submit", "reset", "button")
     * @access public
     */
    function getType($type = null) {
        return $this->getAttribute('type');
    }

    /**
     * Sets the type of this Button.
     *
     * Supports the following types:button,submit,reset. The type are used
     * for the following:
     * <ul>
     *     <li>submit - if the button is in a form, submits the form</li>
     *     <li>reset - if the button is in a form, resets the form values</li>
     *     <li>button - normal button</li>
     * </ul>
     * @param String the type (i.e "submit", "reset", "button")
     * @return Button an instance of this Button
     * @throws IllegalArgumentException if parameter $type is not String ("submit", "reset", "button")
     */
    public function setType($type) {
        if (is_string($type) == false) {
            throw new IllegalArgumentException('In class ' . get_class($this) . ' in method type($type): Parameter $type MUST BE of type String - ' . (is_object($type) ? get_class($type) : gettype($type)) . ' given!');
        }
        $allowed_params = array("button", "submit", "reset");
        if (in_array($type, $allowed_params) == false) {
            throw new IllegalArgumentException('In class ' . get_class($this) . ' in method type($type): Parameter $type MUST BE of type String ("button","submit","reset") - "' . ($type) . '" given!');
        }
        $this->setAttribute('type', $type);
        return $this;
    }

    /**
     * Returns the HTML representation of this Button
     * @param Boolean whether the HTML output should be compressed
     * @param Integer the level of nesting of this Widget
     * @return String the HTML representation of this widget
     */
    function toHtml($compressed = true, $level = 0) {
        $html = $this->toXhtml($compressed, $level);
        return $html;
    }

    /**
     * Returns the XHTML representation of this Button
     * @param Boolean whether the XHTML output should be compressed
     * @param Integer the level of nesting of this Widget
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
        $html = $indent . '<button' . $this->attributesToHtml() . $this->cssToHtml() . '>' . $nl;
        if ($this->getFlow() == "vertical") {
            $html .= $indent . $tab;
            if (is_object($this->getImage()) && is_subclass_of($this->image(), "Element")) {
                $html .= $this->getImage()->toXhtml($compressed, $level) . '<br />';
            }
            if (is_object($this->getText()) && is_subclass_of($this->getText(), "Element")) {
                $html .= $this->getText()->toXhtml($compressed, $level);
            } elseif ($this->text() !== null) {
                $html .= ' <span>' . $this->getText() . '</span>';
            }
            $html .= $nl;
        } else {
            $html .= $indent . $tab;
            if (is_object($this->getImage()) && is_subclass_of($this->image(), "Element")) {
                $html .= $this->getImage()->toXhtml($compressed, $level);
            }
            if (is_object($this->getText()) && is_subclass_of($this->getText(), "Element")) {
                $html .= $this->getText()->toXhtml($compressed, $level);
            } elseif ($this->getText() !== null) {
                $html .= ' <span>' . $this->getText() . '</span>';
            }
            $html .= $nl;
        }
        $html .= $indent . '</button>';
        return $html;
    }

}

//===========================================================================//
// CLASS: Button                                                             //
//============================== END OF CLASS ===============================//
