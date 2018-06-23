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
 * The class Element is the base object, that all of the HTML elements
 * are based on.
 * <code>
 * // Creating a new instance of Element
 * $object = new Element();
 * </code>
 */
class Element {

    protected $attributes = array(); // Attributes
    protected $css = array();       // Inline CSS
    protected $css_files = array(); // External CSS Files
    protected $children = array();  // Children
    protected $id = '';             // ID
    protected $js = array();        // Inline JavaScript
    protected $js_files = array();  // External JS Files
    protected $layout = null;       // Layout
    public $parent = null;       // Parent :: Public because of child!:: Don't use directly!
    protected $property = array();  // Properties

    /**
     * The constructor of Element
     * @construct
     */

    function __construct() {
        $this->uid = uniqid(); // Setting auto unique id
    }

    /** The destructor avoids possible memory leaks for PHP
     * @return void
     * @access public
     */
    public function __destruct() {
        $this->children = null;
        $this->parent = null;
    }

    /**
     * Converts the Element attributes to (X)HTML
     * @return String the Element attributes
     * @access private
     */
    protected function attributesToHtml() {
        $this->attributes['id'] = $this->id;

        if (count($this->attributes) < 1) {
            return '';
        }

        ksort($this->attributes);
        $attributes = array();
        foreach ($this->attributes as $name => $value) {
            if ($value != "" || $value != null) {
                $attributes[] = $name . '="' . addcslashes($value, '"') . '"';
            }
        }
        return " " . implode(" ", $attributes);
    }

    /** Adds a child element to this Element
     * @return Element The instance of this Element
     * @param Element the child Element
     * @param int the position of the child Element
     * @access public
     */
    function addChild($element, $position = null) {
        if ($this->layout != null) {
            $element->parent = $this->layout->addChild($element, $position);
        } else {
            $this->children[] = $element;
            if ($element instanceof Element) {
                $element->parent = $this;
                // Passing CSS and JS up to the Webpage Tag
// 				$this->js_files = array_merge($this->js_files,$element->js_files);
// 				$this->jss = array_merge($this->js,$element->js);
// 				$this->css_files = array_merge($this->css_files,$element->css_files);
// 				$this->css = array_merge($this->css,$element->css);
            }
        }
        return $this;
    }

    /** Returns, whether the Element has children
     * @access public
     */
    function hasChildren() {
        return count($this->children) ? true : false;
    }

    /** Returns the children of this Element.
     * @access public
     */
    function getChildren() {
        return $this->children;
    }

    /**
     * Traverses and returns the children with all sub children
     * @return Element[]
     */
    function childrenTraverse() {
        $children = array();
        foreach ($this->children as $child) {
            $children[] = $child;
            if ($child instanceof Element) {
                $children = array_merge($child->childrenTraverse(), $children);
            }
        }
        return $children;
    }

    function equals($object) {
        return ($this === $object);
    }

    /**
     * Returns an attribute value from given attribute name
     * <code>
     *     $html_panel->getAttribute("text-align");
     * </code>
     * @return string The attribute as String (null, if not set)
     * @param String the name of the attribute
     * @access public
     */
    function getAttribute($attribute) {
        if (isset($this->attribute[$attribute])) {
            return $this->attributes[$attribute];
        }
        return null;
    }

    /**
     * Returns an css value from given css name
     * <code>
     *     $button->getCss("color");
     * </code>
     * @return string The css style as String (null, if not set)
     * @param String the name of the css
     */
    public function getCss($style) {
        if (isset($this->style[$style])) {
            return $this->style[$style];
        }
        return null;
    }

    function getClass() {
        return $this->attributes["class"];
    }

    /**
     * Sets the border of this widget.
     * The border is specified by its width, style and color.
     * <code>
     * // Setting border to a textfield
     * $textfield = (new Textfield)->setBorder(3,"outset","blue");
     * // Getting the border of a textfield
     * echo $textfield->getBorder(); // will print "3px outset blue"
     * </code>
     * @param numeric The width of the border (numeric - Integer or String)
     * @param String The style of the border (solid, outset, inset, dashed, etc.)
     * @param String the color of the border (i.e "red","#FFFFFF")
     * @return mixed an instance of this Widget
     * @access public
     */
    function setBorder($width = null, $style = "solid", $color = "black") {
        if (is_numeric($width) == false) {
            throw new IllegalArgumentException('In class <b>' . get_class($this) . '</b> in method <b>border($width,$style,$color)</b>: Parameter <b>$width</b> MUST BE of type String - <b style="color:red">' . (is_object($width) ? get_class($width) : gettype($width)) . '</b> given!');
        }
        if (is_string($style) == false) {
            throw new IllegalArgumentException('In class <b>' . get_class($this) . '</b> in method <b>border($width,$style,$color)</b>: Parameter <b>$style</b> MUST BE of type String - <b style="color:red">' . (is_object($style) ? get_class($style) : gettype($style)) . '</b> given!');
        }
        if (is_string($color) == false) {
            throw new IllegalArgumentException('In class <b>' . get_class($this) . '</b> in method <b>border($widthe,$style,$color)</b>: Parameter <b>$color</b> MUST BE of type String - <b style="color:red">' . (is_object($color) ? get_class($color) : gettype($color)) . '</b> given!');
        }
        $this->setCss('border', $width . 'px ' . $style . ' ' . $color);
        return $this;
    }

    /**
     * Retrieves the border of this widget.
     * The border is specified by its width, style and color.
     * <code>
     * // Setting border to a textfield
     * $textfield = (new Textfield)->setBorder(3,"outset","blue");
     * // Getting the border of a textfield
     * echo $textfield->getBorder(); // will print "3px outset blue"
     * </code>
     * @return string The background border as String (null, if not set) or an instance of this Widget
     * @access public
     */
    function getBorder() {
        return $this->getCss('border');
    }

    function setClass($classname = null) {
        if (is_string($classname) == false) {
            throw new \InvalidArgumentException('In class ' . get_class($this) . ' in method classname($classname): Parameter $classname MUST BE of type String - ' . (is_object($classname) ? get_class($classname) : gettype($classname)) . ' given!');
        }
        $this->attributes["class"] = $classname;
        return $this;
    }

    function setStyle($style) {
        if (is_string($style) == false) {
            throw new \InvalidArgumentException('In class ' . get_class($this) . ' in method css_style($style): Parameter $style MUST BE of type String - ' . (is_object($style) ? get_class($style) : gettype($style)) . ' given!');
        }
        $styles = explode(';', $style);
        foreach ($styles as $style) {
            if (trim($style) == '')
                continue;
            $css = explode(':', trim($style));
            $this->setCss(trim($css[0]), trim($css[1]));
        }
        return $this;
    }

    /**
     * Adds a CSS stylesheet to the Element
     * @param unknown $css_file
     * @return \Sinevia\Ui\Element
     */
    function setCssFile($css_file) {
        $this->css_files[] = $css_file;
        return $this;
    }

    /**
     * Adds a CSS stylesheet to the Element
     * @param unknown $css_file
     * @return \Sinevia\Ui\Element
     */
    function setJavaScriptFile($js_file) {
        $this->js_files[] = $js_file;
        return $this;
    }

    /**
     * Returns the id of this object
     * @return string the id of the object
     * @access public
     */
    function getId() {
        return $this->id;
    }

    /**
     * Returns the name attributes of this Element.
     * @throws \InvalidArgumentException if parameter $name is not String
     * @return string The name as String (null, if not set)
     * @access public
     */
    function getName($name = null) {
        return $this->getAttribute('name');
    }

    /**
     * Sets the name attribute of this Element.
     * @param String the name of the Element
     * @throws \InvalidArgumentException if parameter $name is not String
     */
    public function setName($name) {
        if (is_string($name) == false)
            throw new \InvalidArgumentException('In class ' . get_class($this) . ' in method name($name): Parameter $name MUST BE of type String - ' . (is_object($name) ? get_class($name) : gettype($name)) . ' given!');
        $this->setAttribute('name', $name);
        return $this;
    }

    /**
     * Returns the specified property to this Element.
     * @param String the name of the property
     * @return String The property as String (null, if not set)
     * @throws \InvalidArgumentException if parameter $property is not String
     * @access protected
     */
    protected function getProperty($property) {
        if (is_string($property) == false)
            throw new \InvalidArgumentException('In class ' . get_class($this) . ' in method property($property,$value): Parameter $property MUST BE of type String - ' . (is_object($property) ? get_class($property) : gettype($property)) . ' given!');

        if (isset($this->property[$property])) {
            return $this->property[$property];
        }
        return null;
    }

    /** Sets and attribute name value pair to this object
     * <code>
     *     $div->setAttribure("text-align","center");
     * </code>
     * @return Element an instance of this Element
     * @param String the name of the attribute
     * @param String the value of the attribute
     * @throws \InvalidArgumentException if parameter $attribute or $value is not String
     * @access public
     */
    function setAttribute($attribute, $value) {
        if (is_string($attribute) == false) {
            throw new \InvalidArgumentException('In class ' . get_class($this) . ' in method setAttribute($attribute,$value): Parameter $attribute MUST BE of type String. ' . (is_object($attribute) ? get_class($attribute) : gettype($attribute)) . ' given!');
        }

        if (is_string($value) == false && is_null($value) == false) {
            throw new \InvalidArgumentException('In class ' . get_class($this) . ' in method setAttribute($attribute,$value): Parameter $value MUST BE of type String. ' . (is_object($value) ? get_class($value) : gettype($value)) . ' given!');
        }

        // Updating the ID in the global dataspace
        if (strtolower($attribute) == "id") {
            $this->setId($value);
        }

        $this->attributes[$attribute] = $value;
        return $this;
    }

    /** Sets and css name value pair to this object
     * <code>
     *     $button->setCss("color","red");
     * </code>
     * @return Element an instance of this Element
     * @param String the name of the css
     * @param String the value of the css
     * @throws \InvalidArgumentException if parameter $style or $value is not String
     * @access public
     */
    function setCss($name, $value) {
        if (is_string($name) == false) {
            throw new \InvalidArgumentException('In class ' . get_class($this) . ' in method set_css($name,$value): Parameter $name MUST BE of type String' . (is_object($attribute) ? get_class($name) : gettype($name)) . ' given!');
        }
        if (is_string($value) == false) {
            throw new \InvalidArgumentException('In class ' . get_class($this) . ' in method set_css($name,$value): Parameter $value MUST BE of type String' . (is_object($value) ? get_class($value) : gettype($value)) . ' given!');
        }
        $this->css[$name] = $value;
        return $this;
    }

    /** Sets the id of this object
     * @return Element or an instance of this Element
     * @throws \InvalidArgumentException if id is not String
     * @access public
     */
    function setId($id) {
        if (is_string($id) == false) {
            throw new \InvalidArgumentException('In class ' . get_class($this) . ' in method id($id): Parameter $id MUST BE of type String - ' . gettype($id) . ' given!');
        }
        $this->id = $id;
        return $this;
    }

    /**
     * Adds an inline JavaScript of this Element
     * @return Element or an instance of this Element
     * @throws \InvalidArgumentException if the supplied argument is not String
     * @access public
     */
    function setJavaScript($js) {
        if (is_string($js) == false) {
            throw new \InvalidArgumentException('In class ' . get_class($this) . ' in method setJavaScipt($id): Parameter $js MUST BE of type String - ' . gettype($js) . ' given!');
        }
        $this->js[] = $js;
        return $this;
    }

    /**
     * Returns the onclick Javascript event(s) attached to this Element.
     * The attached action must be valid JavaScript code, which will be evaluated
     * when the event is triggered.
     * @param String the JavaScript action
     * @return mixed The on_click action as String (null, if not set) or an instance of this Element
     * @throws \InvalidArgumentException if parameter $action is not String or S_Ajax
     * @access public
     */
    function getOnClick() {
        return $this->getAttribute("onclick");
    }

    /**
     * Adds an onclick Javascript event to this Element.
     * The attached action must be valid JavaScript code, which will be evaluated
     * when the event is triggered.
     * @param String the JavaScript action
     * @return mixed The on_click action as String (null, if not set) or an instance of this Element
     * @throws \InvalidArgumentException if parameter $action is not String or S_Ajax
     * @access public
     */
    function setOnClick($action = null) {
//if(is_string($action)==false && ($action instanceof S_Ajax)==false)throw new \InvalidArgumentException('In class '.get_class($this).' in method on_click($action): Parameter $action MUST BE of type String or S_Ajax - '.(is_object($action)?get_class($action):gettype($action)).' given!');
//if(($action instanceof S_Ajax)==true)$action = $action->to_js();
        if ($this->getAttribute("onclick") == null) {
            $this->setAttribute("onclick", htmlentities($action));
        } else {
            $onclick = html_entity_decode($this->getAttribute("onclick"));
            if (substr($onclick, -1) != ";") {
                $onclick .= ";";
            }
            $this->setAttribute("onclick", htmlentities($onclick . $action));
        }
        return $this;
    }

    function setParent($parent) {
        $parent->addChild($this);
        return $this;
    }

    /** Retrieves the padding of this Widget.
     * @return string The padding as String (null, if not set)
     * @access public
     */
    function getPadding() {
        return $this->getCss('padding');
    }

    /** Sets the padding of this Widget.
     * @param int padding from the top of the widget
     * @param int padding from the left of the widget
     * @param int padding from the bottom of the widget
     * @param int padding from the right the widget
     * @return mixed An instance of this Widget
     * @throws IllegalArgumentException if parameter $top,$left,$bottom or $right is not Integer
     * @access public
     */
    function setPadding($top = 0, $left = 0, $bottom = 0, $right = 0) {
        if (is_int($top) == false) {
            throw new IllegalArgumentException('In class <b>' . get_class($this) . '</b> in method <b>padding($top,$left,$bottom,$right)</b>: Parameter <b>$top</b> MUST BE of type Integer - <b style="color:red">' . (is_object($top) ? get_class($top) : gettype($top)) . '</b> given!');
        }
        if (is_int($left) == false) {
            throw new IllegalArgumentException('In class <b>' . get_class($this) . '</b> in method <b>padding($top,$left,$bottom,$right)</b>: Parameter <b>$left</b> MUST BE of type Integer - <b style="color:red">' . (is_object($left) ? get_class($left) : gettype($left)) . '</b> given!');
        }
        if (is_int($bottom) == false) {
            throw new IllegalArgumentException('In class <b>' . get_class($this) . '</b> in method <b>padding($top,$left,$bottom,$right)</b>: Parameter <b>$bottom</b> MUST BE of type Integer - <b style="color:red">' . (is_object($bottom) ? get_class($bottom) : gettype($bottom)) . '</b> given!');
        }
        if (is_int($right) == false) {
            throw new IllegalArgumentException('In class <b>' . get_class($this) . '</b> in method <b>padding($top,$left,$bottom,$right)</b>: Parameter <b>$right</b> MUST BE of type Integer - <b style="color:red">' . (is_object($right) ? get_class($right) : gettype($right)) . '</b> given!');
        }
        $this->setCss('padding', $top . 'px ' . $left . 'px ' . $bottom . 'px ' . $right . 'px;');
        return $this;
    }

    /**
     * Sets a property name-value pair to this Element
     * Properties represent private data available to the Element
     *
     * @param String the name of the property
     * @param mixed the value of the property
     * @return mixed The property as String (null, if not set) or an instance of this Element
     * @throws \InvalidArgumentException if parameter $property is not String
     * @access protected
     */
    protected function setProperty($property, $value) {
        if (is_string($property) == false) {
            throw new \InvalidArgumentException('In class ' . get_class($this) . ' in method property($property,$value): Parameter $property MUST BE of type String - ' . (is_object($property) ? get_class($property) : gettype($property)) . ' given!');
        }
        $this->property[$property] = $value;
        return $this;
    }

    function getHeight() {
        return $this->getAttribute('height');
    }

    //========================= START OF METHOD ===========================//
    //  METHOD: font                                                       //
    //=====================================================================//
    /** Sets or retrieves the Font of this Widget.
     * <code>
     * $font = s_font()->size(16)->bold(true);
     * $textfield = s_textfield()->font($font);
     * </code>
     * @param S_Font the font of this Widget
     * @return mixed The Font as Font (null, if not set) or an instance of this Widget
     * @access public
     */
    function getFont($font = null) {
        return $this->property('font');
    }

    //=====================================================================//
    //  METHOD: font                                                       //
    //========================== END OF METHOD ============================//
    //========================= START OF METHOD ===========================//
    //  METHOD: font                                                       //
    //=====================================================================//
    /** Sets or retrieves the Font of this Widget.
     * <code>
     * $font = s_font()->size(16)->bold(true);
     * $textfield = s_textfield()->font($font);
     * </code>
     * @param S_Font the font of this Widget
     * @return mixed The Font as Font (null, if not set) or an instance of this Widget
     * @access public
     */
    function setFont($font = null) {
        if (($font instanceof Font) == false) {
            throw new IllegalArgumentException('In class <b>' . get_class($this) . '</b> in method <b>font($font)</b>: Parameter <b>$fonte</b> MUST BE of type S_Font - <b style="color:red">' . (is_object($font) ? get_class($font) : gettype($font)) . '</b> given!');
        }
        if (!is_null($font->family())) {
            $this->setCss('font-family', $font->family());
        }
        if (!is_null($font->color())) {
            $this->setCss('color', $font->color());
        }
        if (!is_null($font->size())) {
            $this->setCss('font-size', $font->size() . "px");
        }
        if (!is_null($font->bold())) {
            if ($font->bold() == true) {
                $this->setCss('font-weight', 'bold');
            } else {
                $this->setCss('font-weight', 'normal');
            }
        }
        if (!is_null($font->italic())) {
            if ($font->italic() == true) {
                $this->setCss('font-style', 'italic');
            } else {
                $this->setCss('font-style', 'normal');
            }
        }
        if (!is_null($font->underline())) {
            if ($font->underline() == true) {
                $this->setCss('text-decoration', 'underline');
            } else {
                $this->setCss('text-decoration', 'none');
            }
        }
        if (!is_null($font->spacing())) {
            $this->setCss('letter-spacing', $font->spacing() . 'px');
        }

        $this->setProperty('font', $font);

        return $this;
    }

    //=====================================================================//
    //  METHOD: font                                                       //
    //========================== END OF METHOD ============================//

    function setHeight($value) {
        $this->setAttribute('height', (string) $value);
        return $this;
    }

    function getWidth() {
        return $this->getAttribute('width');
    }

    function setWidth($value) {
        $this->setAttribute('width', (string) $value);
        return $this;
    }

    /**
     * Returns the HTML representation of this Element
     * @param Boolean whether the (X)HTML output should be compressed
     * @param Integer the level of nesting of this Element
     * @return String the (X)HTML representation of this Element
     */
    function toHtml($compressed = true, $level = 0) {
        if (strtolower(get_class($this)) == "Element") {
            throw new \RuntimeException("Class " . get_class($this) . " method toHtml() can not be used drectly. Use its subclasses instead!", E_USER_ERROR);
        } else {
            throw new \RuntimeException('Class ' . get_class($this) . ' has to implement its own toHtml() method!');
        }
    }

    /**
     * Returns the XHTML representation of this Element
     * @param Boolean whether the (X)HTML output should be compressed
     * @param Integer the level of nesting of this Element
     * @return String the (X)HTML representation of this Element
     */
    function toXhtml($compressed = true, $level = 0) {
        if (strtolower(get_class($this)) == "Element") {
            throw new \RuntimeException('In class ' . get_class($this) . ' method toXhtml() cannot be used directly. Use its subclasses instead!');
        } else {
            throw new \RuntimeException('Class ' . get_class($this) . ' has to implement its own toXhtml() method!');
        }
    }

    /**
     * Converts the Element styles to (X)HTML
     * @return String the Element style
     */
    protected function cssToHtml() {
        if (count($this->css) < 1) {
            return '';
        }
        ksort($this->css);
        $styles = array();
        foreach ($this->css as $name => $value) {
            if ($value != "" || $value != null)
                $styles[] = $name . ':' . $value;
        }
        return ' style="' . addcslashes(implode(";", $styles), '"') . '"'; // Don't remove beginning white space
    }

}

//===========================================================================//
// CLASS: Element                                                            //
//============================== END OF CLASS ===============================//
