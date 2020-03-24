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
    protected $uid = null; // The auto unique id of this Element

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

    /**
     * @param Object $object
     * @return bool
     */
    function equals($object) {
        return ($this === $object);
    }

    /**
     * Retrieves the display style of this Widget.
     * @return mixed The display style as String (null, if not set)
     * @access public
     */
    function getDisplay() {
        return $this->getProperty("display");
    }

    /**
     * Returns an attribute value from given attribute name
     * <code>
     *     (new Div)->getAttribute("text-align");
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

    /** Retrieves the background color of this Element.
     * <code>
     * // Getting background for webpage
     * (new Webpage)->getBackground("#FFFFFF");
     * </code>
     * @return string | null The background color as String (null, if not set)
     * @access public
     */
    function getBackground() {
        return $this->getProperty('background');
    }

    /**
     * Retrieves the background image URL of this Element.
     * <code>
     * // Setting background image for webpage
     * (new Webpage)->getBackgroundImage();
     * </code>
     * @return $this The background image URL as String (null, if not set)
     * @access public
     */
    function getBackgroundImage() {
        return $this->getProperty('background_image');
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

    function getClass() {
        return $this->attributes["class"];
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

    /**
     * Retrieves the CSS float property of this Widget.
     * 
     * @return mixed The horizontal alignment as String (null, if not set)
     * @throws InvalidArgumentException if parameter $halign is not String
     * @access public
     */
    function getFloat() {
        return $this->getProperty('float');
    }

    /** Sets or retrieves the Font of this Widget.
     * <code>
     * $font = s_font()->size(16)->bold(true);
     * $textfield = s_textfield()->font($font);
     * </code>
     * @param S_Font the font of this Widget
     * @return mixed The Font as Font (null, if not set) or an instance of this Widget
     * @access public
     */
    function getFont() {
        return $this->getProperty('font');
    }

    /**
     * Retrieves the foreground color of this Element.
     * @param string the foreground color (i.e. "blue","#FFFFFF")
     * @return string The foreground color as String (null, if not set)
     * @throws InvalidArgumentException if parameter $color is not String
     * @access public
     */
    function getForeground() {
        return $this->getProperty('foreground');
    }

    /** Sets or retrieves the horizontal alignment of the content of this Widget.
     * 
     * <code>
     * // Setting background for webpage
     * s_paragraph()->halign("right");
     * </code>
     * @param String the horizontal alignment (left,center,right)
     * @return mixed The horizontal alignment as String (null, if not set) or an instance of this Widget
     * @throws InvalidArgumentException if parameter $halign is not String
     * @access public
     */
    function getHalign() {
        return $this->getProperty('halign');
    }

    function getHeight() {
        return $this->getAttribute('height');
    }

    /**
     * Returns the id of this object
     * @return string the id of the object
     * @access public
     */
    function getId() {
        if ($this->id == null) {
            $this->id = 'id_';
        }
        return $this->id;
    }

    /**
     * Returns the name attributes of this Element.
     * @throws \InvalidArgumentException if parameter $name is not String
     * @return string The name as String (null, if not set)
     * @access public
     */
    function getName() {
        return $this->getAttribute('name');
    }
    
    /**
     * Returns the onblur Javascript event(s) attached to this Element.
     * The attached action must be valid JavaScript code, which will be evaluated
     * when the event is triggered.
     * @return string The onblur action as String (null, if not set)
     * @access public
     */
    function getOnBlur() {
        return $this->getAttribute("onblur");
    }

    /**
     * Returns the onclick Javascript event(s) attached to this Element.
     * The attached action must be valid JavaScript code, which will be evaluated
     * when the event is triggered.
     * @return string The onclick action as String (null, if not set)
     * @access public
     */
    function getOnClick() {
        return $this->getAttribute("onclick");
    }
    
    /**
     * Returns the ondblclick Javascript event(s) attached to this Element.
     * The attached action must be valid JavaScript code, which will be evaluated
     * when the event is triggered.
     * @return string The ondblclick action as String (null, if not set)
     * @access public
     */
    function getOnDoubleClick() {
        return $this->getAttribute("ondblclick");
    }

    /**
     * Retrieves the padding of this Element.
     * @return string The padding as String (null, if not set)
     * @access public
     */
    function getPadding() {
        return $this->getCss('padding');
    }

    /**
     * Retrieves the margin of this Element.
     * @return string The margin as String (null, if not set)
     * @access public
     */
    function getMargin() {
        return $this->getCss('margin');
    }

    /**
     * Returns the specified property to this Element.
     * @param String the name of the property
     * @return string The property as String (null, if not set)
     * @throws \InvalidArgumentException if parameter $property is not String
     * @access protected
     */
    protected function getProperty($property) {
        if (is_string($property) == false) {
            throw new \InvalidArgumentException('In class ' . get_class($this) . ' in method property($property,$value): Parameter $property MUST BE of type String - ' . (is_object($property) ? get_class($property) : gettype($property)) . ' given!');
        }

        if (isset($this->property[$property])) {
            return $this->property[$property];
        }
        return null;
    }

    /**
     * Sets the vertical alignment of Panel.
     * @param String horizontal alignment (top,bottom or middle)
     * @return Element an instance of this object
     */
    function getValign() {
        $this->getCss("vertical-align");
        return $this;
    }

    function getWidth() {
        return $this->getAttribute('width');
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

    /** Sets the background color of this Widget.
     * <code>
     * // Setting background for webpage
     * (new Webpage)->setBackground("#FFFFFF");
     * </code>
     * @param String the color name (i.e. "red","#FFFFFF")
     * @return mixed An instance of this Element
     * @throws InvalidArgumentException if parameter $color is not String
     * @access public
     */
    function setBackground($color) {
        if (is_string($color) == false) {
            throw new \InvalidArgumentException('In class <b>' . get_class($this) . '</b> in method <b>background($color)</b>: Parameter <b>$color</b> MUST BE of type String - <b style="color:red">' . (is_object($color) ? get_class($color) : gettype($color)) . '</b> given!');
        }
        $this->setProperty('background', $color);
        $this->setCss('background', $color);
        return $this;
    }

    /**
     * Sets the background image URL of this Widget.
     * You can set the background to be repeated, not to be repeated,
     * or to be horizontally or vertically repeated.
     * <code>
     * // Setting background image for webpage
     * (new Webpage)->setBackgroundImage("/images/bg.gif");
     * // Setting the same background to a form as the webpage
     * (new Form)->setBackgroundImage($webpage->getBackgroundImage());
     * // Setting background with no repeating
     * (new Form)->setBackgroundImage("bg.gif",false);
     * // Repeating the image horizontally
     * (new Form)->setBackgroundImage("bg.gif","h");
     * * // Repeating the image vertically
     * (new Form)->setBackgroundImage("bg.gif","v");
     * </code>
     * @param String the path to the image
     * @param mixed Boolean or String ("yes","y","no","n","vertical","v","horizontal","h")
     * @return mixed The background image URL as String (null, if not set) or an instance of this Widget
     * @throws InvalidArgumentException if parameter $image is not String, or $repeat is not Boolean or String ("yes","y","no","n")
     * @access public
     */
    function setBackgroundImage($image = null, $repeat = "y", $axis = "both") {
        if (is_string($image) == false) {
            throw new \InvalidArgumentException('In class <b>' . get_class($this) . '</b> in method <b>background_image($image,$repeat)</b>: Parameter <b>$image</b> MUST BE of type String - <b style="color:red">' . (is_object($image) ? get_class($image) : gettype($image)) . '</b> given!');
        }

        if (is_string($repeat) == false && is_bool($repeat) == false) {
            throw new \InvalidArgumentException('In class <b>' . get_class($this) . '</b> in method <b>background_image($image,$repeat)</b>: Parameter <b>$repeat</b> MUST BE of type String ("yes","y","no","n") or Boolean (true, false) - <b style="color:red">' . (is_object($repeat) ? get_class($repeat) : gettype($repeat)) . '</b> given!');
        }

        $this->setProperty('background_image', $image);
        $this->setCss('background-image', 'url(' . $image . ')');
        if ($repeat == "yes" || $repeat == "y" || $repeat === true) {
            $repeat = "repeat";
        }
        if ($repeat == "no" || $repeat == "n" || $repeat === false) {
            $repeat = "no-repeat";
        }
        if ($repeat == "vertical" || $repeat == "v") {
            $repeat = "repeat-y";
        }
        if ($repeat == "horizontal" || $repeat == "h") {
            $repeat = "repeat-x";
        }
        $this->setCss('background-repeat', $repeat);
        return $this;
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
            throw new \InvalidArgumentException('In class <b>' . get_class($this) . '</b> in method <b>border($width,$style,$color)</b>: Parameter <b>$width</b> MUST BE of type String - <b style="color:red">' . (is_object($width) ? get_class($width) : gettype($width)) . '</b> given!');
        }
        if (is_string($style) == false) {
            throw new \InvalidArgumentException('In class <b>' . get_class($this) . '</b> in method <b>border($width,$style,$color)</b>: Parameter <b>$style</b> MUST BE of type String - <b style="color:red">' . (is_object($style) ? get_class($style) : gettype($style)) . '</b> given!');
        }
        if (is_string($color) == false) {
            throw new \InvalidArgumentException('In class <b>' . get_class($this) . '</b> in method <b>border($widthe,$style,$color)</b>: Parameter <b>$color</b> MUST BE of type String - <b style="color:red">' . (is_object($color) ? get_class($color) : gettype($color)) . '</b> given!');
        }
        $this->setCss('border', $width . 'px ' . $style . ' ' . $color);
        return $this;
    }

    function addClass($classname = null) {
        if (is_string($classname) == false) {
            throw new \InvalidArgumentException('In class ' . get_class($this) . ' in method classname($classname): Parameter $classname MUST BE of type String - ' . (is_object($classname) ? get_class($classname) : gettype($classname)) . ' given!');
        }
        $classes = explode(' ', ($this->attributes["class"] ?? ''));
        $classes[] = $classname;
        $this->attributes["class"] = implode(' ', $classes);
        return $this;
    }

    function setClass($classname = null) {
        if (is_string($classname) == false) {
            throw new \InvalidArgumentException('In class ' . get_class($this) . ' in method classname($classname): Parameter $classname MUST BE of type String - ' . (is_object($classname) ? get_class($classname) : gettype($classname)) . ' given!');
        }
        $this->attributes["class"] = $classname;
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

    /**
     * Adds a CSS stylesheet file to the Element
     * @param string $css_file
     * @return $this  An instance of this Element
     */
    function setCssFile($css_file) {
        $this->css_files[] = $css_file;
        return $this;
    }

    /**
     * Sets the display style of this Widget.
     * @return $this An instance of this Element
     * @throws InvalidArgumentException if parameter $display is not String
     * @access public
     */
    function setDisplay($display) {
        if (is_string($display) == false) {
            throw new \InvalidArgumentException('In class <b>' . get_class($this) . '</b> in method <b>display($display)</b>: Parameter <b>$display</b> MUST BE of type String - <b style="color:red">' . (is_object($display) ? get_class($display) : gettype($display)) . '</b> given!');
        }
        $this->setCss("display", $display);
        $this->setProperty("display", $display);
        return $this;
    }

    /** Sets the CSS float property of this Widget.
     * 
     * The float property sets where a Widget will appear in another Widget.
     * <b>Note:</b> If there is too little space on a line for the floating
     * Widget, it will jump down on the next line, and continue until a line
     * has enough space.<br />
     * <code>
     * // Floating a Widget left
     * (new Div)->setWidth(200)->setFloat("left");
     * </code>
     * @param String the horizontal alignment (left,center,right)
     * @return mixed An instance of this Widget
     * @throws InvalidArgumentException if parameter $halign is not String
     * @access public
     */
    function setFloat($float = null) {
        if (is_string($float) == false) {
            throw new \InvalidArgumentException('In class <b>' . get_class($this) . '</b> in method <b>float($float)</b>: Parameter <b>$float</b> MUST BE of type String - <b style="color:red">' . (is_object($float) ? get_class($float) : gettype($float)) . '</b> given!');
        }

        // Checking position
        $allowed_params = array("left", "right", "none");
        if (in_array($float, $allowed_params) == false) {
            throw new \InvalidArgumentException('In class <b>' . get_class($this) . '</b> in method <b>float($float)</b>: Parameter <b>$float</b> MUST BE of type String(' . implode(", ", $allowed_params) . ') - <b>' . ($float) . '</b> given!');
        }

        $this->setProperty('flooat', $float);
        $this->setCss('float', $float);

        return $this;
    }

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
            throw new \InvalidArgumentException('In class <b>' . get_class($this) . '</b> in method <b>font($font)</b>: Parameter <b>$fonte</b> MUST BE of type S_Font - <b style="color:red">' . (is_object($font) ? get_class($font) : gettype($font)) . '</b> given!');
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

    /** Sets the foreground color of this Element.
     * <code>
     * $textfield = (new Textfield)->setForeground("red");
     * </code>
     * @param String the foreground color (i.e. "blue","#FFFFFF")
     * @return mixed An instance of this Widget
     * @throws InvalidArgumentException if parameter $color is not String
     * @access public
     */
    function setForeground($color = null) {
        if (is_string($color) == false) {
            throw new \InvalidArgumentException('In class <b>' . get_class($this) . '</b> in method <b>foreground($color)</b>: Parameter <b>$color</b> MUST BE of type String - <b style="color:red">' . (is_object($color) ? get_class($color) : gettype($color)) . '</b> given!');
        }
        $this->setProperty('foreground', $color);
        $this->setCss('color', $color);
        return $this;
    }

    /**
     * Sets the horizontal alignment of the content of this Widget.
     * 
     * <code>
     * // Setting background for webpage
     * (new Span)->setHalign("right");
     * </code>
     * @param String the horizontal alignment (left,center,right)
     * @return mixed The horizontal alignment as String (null, if not set) or an instance of this Widget
     * @throws InvalidArgumentException if parameter $halign is not String
     * @access public
     */
    function setHalign($halign) {
        if (is_string($halign) == false)
            throw new \InvalidArgumentException('In class <b>' . get_class($this) . '</b> in method <b>halign($halign)</b>: Parameter <b>$halign</b> MUST BE of type String - <b style="color:red">' . (is_object($halign) ? get_class($halign) : gettype($halign)) . '</b> given!');
        // Checking position
        $allowed_params = array("left", "center", "right");
        if (in_array($halign, $allowed_params) == false) {
            throw new \InvalidArgumentException('In class <b>' . get_class($this) . '</b> in method <b>halign($halign)</b>: Parameter <b>$halign</b> MUST BE of type String(' . implode(", ", $allowed_params) . ') - <b>' . ($halign) . '</b> given!');
        }
        $this->setProperty('halign', $halign);
        $this->setCss('text-align', $halign);
        return $this;
    }

    function setHeight($value) {
        $this->setAttribute('height', (string) $value);
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
     * Adds a CSS stylesheet to the Element
     * @param unknown $css_file
     * @return \Sinevia\Ui\Element
     */
    function setJavaScriptFile($js_file) {
        $this->js_files[] = $js_file;
        return $this;
    }

    /**
     * Sets the margin of this Element.
     * @param int margin from the top of the widget
     * @param int margin from the left of the widget
     * @param int margin from the bottom of the widget
     * @param int margin from the right the widget
     * @return Element An instance of this Element
     * @throws InvalidArgumentException if parameter $top,$left,$bottom or $right is not Integer
     * @access public
     */
    function setMargin($top = 0, $left = 0, $bottom = 0, $right = 0) {
        if (is_int($top) == false) {
            throw new \InvalidArgumentException('In class <b>' . get_class($this) . '</b> in method <b>margin($top,$left,$bottom,$right)</b>: Parameter <b>$top</b> MUST BE of type Integer - <b style="color:red">' . (is_object($top) ? get_class($top) : gettype($top)) . '</b> given!');
        }

        if (is_int($left) == false) {
            throw new \InvalidArgumentException('In class <b>' . get_class($this) . '</b> in method <b>margin($top,$left,$bottom,$right)</b>: Parameter <b>$left</b> MUST BE of type Integer - <b style="color:red">' . (is_object($left) ? get_class($left) : gettype($left)) . '</b> given!');
        }

        if (is_int($bottom) == false) {
            throw new \InvalidArgumentException('In class <b>' . get_class($this) . '</b> in method <b>margin($top,$left,$bottom,$right)</b>: Parameter <b>$bottom</b> MUST BE of type Integer - <b style="color:red">' . (is_object($bottom) ? get_class($bottom) : gettype($bottom)) . '</b> given!');
        }

        if (is_int($right) == false) {
            throw new \InvalidArgumentException('In class <b>' . get_class($this) . '</b> in method <b>margin($top,$left,$bottom,$right)</b>: Parameter <b>$right</b> MUST BE of type Integer - <b style="color:red">' . (is_object($right) ? get_class($right) : gettype($right)) . '</b> given!');
        }

        $this->setCss('margin', $top . 'px ' . $left . 'px ' . $bottom . 'px ' . $right . 'px;');

        return $this;
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
     * Adds an onblur Javascript event to this Element.
     * The attached action must be valid JavaScript code, which will be evaluated
     * when the event is triggered.
     * @param String the JavaScript action
     * @return Element The on_click action as String (null, if not set) or an instance of this Element
     * @throws \InvalidArgumentException if parameter $action is not String or S_Ajax
     * @access public
     */
    function setOnBlur($action = null) {
//if(is_string($action)==false && ($action instanceof S_Ajax)==false)throw new \InvalidArgumentException('In class '.get_class($this).' in method on_click($action): Parameter $action MUST BE of type String or S_Ajax - '.(is_object($action)?get_class($action):gettype($action)).' given!');
//if(($action instanceof S_Ajax)==true)$action = $action->to_js();
        if ($this->getAttribute("onblur") == null) {
            $this->setAttribute("onblur", htmlentities($action));
        } else {
            $onclick = html_entity_decode($this->getAttribute("onblur"));
            if (substr($onclick, -1) != ";") {
                $onclick .= ";";
            }
            $this->setAttribute("onblur", htmlentities($onclick . $action));
        }
        return $this;
    }

    /**
     * Adds an onclick Javascript event to this Element.
     * The attached action must be valid JavaScript code, which will be evaluated
     * when the event is triggered.
     * @param String the JavaScript action
     * @return Element The on_click action as String (null, if not set) or an instance of this Element
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
    
    /**
     * Adds an ondblclick Javascript event to this Element.
     * The attached action must be valid JavaScript code, which will be evaluated
     * when the event is triggered.
     * @param String the JavaScript action
     * @return Element The ondblclick action as String (null, if not set) or an instance of this Element
     * @throws \InvalidArgumentException if parameter $action is not String or S_Ajax
     * @access public
     */
    function setOnDoubleClick($action = null) {
//if(is_string($action)==false && ($action instanceof S_Ajax)==false)throw new \InvalidArgumentException('In class '.get_class($this).' in method on_click($action): Parameter $action MUST BE of type String or S_Ajax - '.(is_object($action)?get_class($action):gettype($action)).' given!');
//if(($action instanceof S_Ajax)==true)$action = $action->to_js();
        if ($this->getAttribute("ondblclick") == null) {
            $this->setAttribute("ondblclick", htmlentities($action));
        } else {
            $onclick = html_entity_decode($this->getAttribute("ondblclick"));
            if (substr($onclick, -1) != ";") {
                $onclick .= ";";
            }
            $this->setAttribute("ondblclick", htmlentities($onclick . $action));
        }
        return $this;
    }
    
    

    /**
     * Sets the padding of this Widget.
     * @param int padding from the top of the widget
     * @param int padding from the left of the widget
     * @param int padding from the bottom of the widget
     * @param int padding from the right the widget
     * @return Element An instance of this Widget
     * @throws InvalidArgumentException if parameter $top,$left,$bottom or $right is not Integer
     * @access public
     */
    function setPadding($top = 0, $left = 0, $bottom = 0, $right = 0) {
        if (is_int($top) == false) {
            throw new \InvalidArgumentException('In class <b>' . get_class($this) . '</b> in method <b>padding($top,$left,$bottom,$right)</b>: Parameter <b>$top</b> MUST BE of type Integer - <b style="color:red">' . (is_object($top) ? get_class($top) : gettype($top)) . '</b> given!');
        }
        if (is_int($left) == false) {
            throw new \InvalidArgumentException('In class <b>' . get_class($this) . '</b> in method <b>padding($top,$left,$bottom,$right)</b>: Parameter <b>$left</b> MUST BE of type Integer - <b style="color:red">' . (is_object($left) ? get_class($left) : gettype($left)) . '</b> given!');
        }
        if (is_int($bottom) == false) {
            throw new \InvalidArgumentException('In class <b>' . get_class($this) . '</b> in method <b>padding($top,$left,$bottom,$right)</b>: Parameter <b>$bottom</b> MUST BE of type Integer - <b style="color:red">' . (is_object($bottom) ? get_class($bottom) : gettype($bottom)) . '</b> given!');
        }
        if (is_int($right) == false) {
            throw new \InvalidArgumentException('In class <b>' . get_class($this) . '</b> in method <b>padding($top,$left,$bottom,$right)</b>: Parameter <b>$right</b> MUST BE of type Integer - <b style="color:red">' . (is_object($right) ? get_class($right) : gettype($right)) . '</b> given!');
        }
        $this->setCss('padding', $top . 'px ' . $left . 'px ' . $bottom . 'px ' . $right . 'px;');
        return $this;
    }

    function setParent($parent) {
        $parent->addChild($this);
        return $this;
    }

    /**
     * Sets a property name-value pair to this Element
     * Properties represent private data available to the Element
     *
     * @param String the name of the property
     * @param mixed the value of the property
     * @return Element The property as String (null, if not set) or an instance of this Element
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

    /**
     * 
     * @param string $style
     * @return $this
     * @throws \InvalidArgumentException
     */
    function setStyle($style) {
        if (is_string($style) == false) {
            throw new \InvalidArgumentException('In class ' . get_class($this) . ' in method css_style($style): Parameter $style MUST BE of type String - ' . (is_object($style) ? get_class($style) : gettype($style)) . ' given!');
        }

        $styles = explode(';', $style);

        foreach ($styles as $style) {
            if (trim($style) == '') {
                continue;
            }
            $css = explode(':', trim($style));
            $this->setCss(trim($css[0]), trim($css[1]));
        }

        return $this;
    }

    /**
     * Sets the vertical alignment of Panel.
     * @param String horizontal alignment (top,bottom or middle)
     * @return LightPanel an instance of this object
     */
    function setValign($valign) {
        $allowed_params = array("top", "middle", "bottom");

        if (in_array($valign, $allowed_params) == false) {
            trigger_error('ERROR: In class <b>' . get_class($this) . '</b> in method <b>set_valign($halign)</b>: Parameter <b>$valign</b> MUST BE of type String(' . implode(", ", $allowed_params) . ') - <b style="color:red">' . gettype($valign) . '</b> given!', E_USER_ERROR);
        }

        $this->setCss("vertical-align", $valign);

        return $this;
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
            if ($value != "" || $value != null) {
                $styles[] = $name . ':' . $value;
            }
        }
        return ' style="' . addcslashes(implode(";", $styles), '"') . '"'; // Don't remove beginning white space
    }

    // TODO //////////////////////////////
    
    //========================= START OF METHOD ===========================//
    //  METHOD: on_focus                                                   //
    //=====================================================================//
    /** Sets or retrieves the onfocus Javascript event to this widget.
     * The attached action must be valid JavaScript code, which will be evaluated
     * when the event is triggered.
     * @param String the JavaScript action
     * @return mixed The on_focus_click action as String (null, if not set) or an instance of this Widget
     * @throws IllegalArgumentException if parameter $action is not String or S_Ajax
     * @access public
     */
    function on_focus($action = null) {
        if (func_num_args() > 0) {
            if (is_string($action) == false && ($action instanceof S_Ajax) == false)
                throw new IllegalArgumentException('In class <b>' . get_class($this) . '</b> in method <b>on_focus($action)</b>: Parameter <b>$action</b> MUST BE of type String or S_Ajax - <b style="color:red">' . (is_object($action) ? get_class($action) : gettype($action)) . '</b> given!');
            if (($action instanceof S_Ajax) == true)
                $action = $action->to_js();
            if ($this->attribute("onfocus") == null) {
                $this->attribute("onfocus", htmlentities($action));
            } else {
                $onfocus = html_entity_decode($this->attribute("onfocus"));
                if (s::str_ends_with($onfocus, ";") == false) {
                    $onfocus .= ";";
                }
                $this->attribute("onfocus", htmlentities($onfocus . $action));
            }
            return $this;
        } else {
            return $this->attribute("onfocus");
        }
    }

    //=====================================================================//
    //  METHOD: on_focus                                                   //
    //========================== END OF METHOD ============================//
    //========================= START OF METHOD ===========================//
    //  METHOD: on_key_down                                                //
    //=====================================================================//
    /** Sets or retrieves the onkeydown Javascript event to this widget.
     * The attached action must be valid JavaScript code, which will be evaluated
     * when the event is triggered.
     * @param String the JavaScript action
     * @return mixed The on_key_down action as String (null, if not set) or an instance of this Widget
     * @throws IllegalArgumentException if parameter $action is not String or S_Ajax
     * @access public
     */
    function on_key_down($action = null) {
        if (func_num_args() > 0) {
            if (is_string($action) == false && ($action instanceof S_Ajax) == false)
                throw new IllegalArgumentException('In class <b>' . get_class($this) . '</b> in method <b>on_key_down($action)</b>: Parameter <b>$action</b> MUST BE of type String or S_Ajax - <b style="color:red">' . (is_object($action) ? get_class($action) : gettype($action)) . '</b> given!');
            if (($action instanceof S_Ajax) == true)
                $action = $action->to_js();
            if ($this->attribute("onkeydown") == null) {
                $this->attribute("onkeydown", htmlentities($action));
            } else {
                $onkeydown = html_entity_decode($this->attribute("onkeydown"));
                if (s::str_ends_with($onkeydown, ";") == false) {
                    $onkeydown .= ";";
                }
                $this->attribute("onkeydown", htmlentities($onkeydown . $action));
            }
            return $this;
        } else {
            return $this->attribute("onkeydown");
        }
    }

    //=====================================================================//
    //  METHOD: on_key_down                                                //
    //========================== END OF METHOD ============================//
    //========================= START OF METHOD ===========================//
    //  METHOD: on_key_press                                               //
    //=====================================================================//
    /** Sets or retrieves the onkeypress Javascript event to this widget.
     * The attached action must be valid JavaScript code, which will be evaluated
     * when the event is triggered.
     * @param String the JavaScript action
     * @return mixed The on_key_press action as String (null, if not set) or an instance of this Widget
     * @throws IllegalArgumentException if parameter $action is not String or S_Ajax
     * @access public
     */
    function on_key_press($action = null) {
        if (func_num_args() > 0) {
            if (is_string($action) == false && ($action instanceof S_Ajax) == false)
                throw new IllegalArgumentException('In class <b>' . get_class($this) . '</b> in method <b>on_key_press($action)</b>: Parameter <b>$action</b> MUST BE of type String or S_Ajax - <b style="color:red">' . (is_object($action) ? get_class($action) : gettype($action)) . '</b> given!');
            if (($action instanceof S_Ajax) == true)
                $action = $action->to_js();
            if ($this->attribute("onkeypress") == null) {
                $this->attribute("onkeypress", htmlentities($action));
            } else {
                $onkeypress = html_entity_decode($this->attribute("onkeypress"));
                if (s::str_ends_with($onkeypress, ";") == false) {
                    $onkeypress .= ";";
                }
                $this->attribute("onkeypress", htmlentities($onkeypress . $action));
            }
            return $this;
        } else {
            return $this->attribute("onkeypress");
        }
    }

    //=====================================================================//
    //  METHOD: on_key_press                                               //
    //========================== END OF METHOD ============================//
    //========================= START OF METHOD ===========================//
    //  METHOD: on_key_up                                                  //
    //=====================================================================//
    /** Sets or retrieves the onkeyup Javascript event to this widget.
     * The attached action must be valid JavaScript code, which will be evaluated
     * when the event is triggered.
     * @param String the JavaScript action
     * @return mixed The on_key_up action as String (null, if not set) or an instance of this Widget
     * @throws IllegalArgumentException if parameter $action is not String or S_Ajax
     * @access public
     */
    function on_key_up($action = null) {
        if (func_num_args() > 0) {
            if (is_string($action) == false && ($action instanceof S_Ajax) == false)
                throw new IllegalArgumentException('In class <b>' . get_class($this) . '</b> in method <b>on_key_up($action)</b>: Parameter <b>$action</b> MUST BE of type String or S_Ajax - <b style="color:red">' . (is_object($action) ? get_class($action) : gettype($action)) . '</b> given!');
            if (($action instanceof S_Ajax) == true)
                $action = $action->to_js();
            if ($this->attribute("onkeyup") == null) {
                $this->attribute("onkeyup", htmlentities($action));
            } else {
                $onkeyup = html_entity_decode($this->attribute("onkeyup"));
                if (s::str_ends_with($onkeyup, ";") == false) {
                    $onkeyup .= ";";
                }
                $this->attribute("onkeyup", htmlentities($onkeyup . $action));
            }
            return $this;
        } else {
            return $this->attribute("onkeyup");
        }
    }

    //=====================================================================//
    //  METHOD: on_key_up                                                  //
    //========================== END OF METHOD ============================//
    //========================= START OF METHOD ===========================//
    //  METHOD: on_mouse_down                                              //
    //=====================================================================//
    /** Sets or retrieves the onmousedown Javascript event to this widget.
     * The attached action must be valid JavaScript code, which will be evaluated
     * when the event is triggered.
     * @param String the JavaScript action
     * @return mixed The on_mouse_down action as String (null, if not set) or an instance of this Widget
     * @throws IllegalArgumentException if parameter $action is not String or S_Ajax
     * @access public
     */
    function on_mouse_down($action = null) {
        if (func_num_args() > 0) {
            if (is_string($action) == false && ($action instanceof S_Ajax) == false)
                throw new IllegalArgumentException('In class <b>' . get_class($this) . '</b> in method <b>on_mouse_down($action)</b>: Parameter <b>$action</b> MUST BE of type String or S_Ajax - <b style="color:red">' . (is_object($action) ? get_class($action) : gettype($action)) . '</b> given!');
            if (($action instanceof S_Ajax) == true)
                $action = $action->to_js();
            if ($this->attribute("onmousedown") == null) {
                $this->attribute("onmousedown", htmlentities($action));
            } else {
                $onmousedown = html_entity_decode($this->attribute("onmousedown"));
                if (s::str_ends_with($onmousedown, ";") == false) {
                    $onmousedown .= ";";
                }
                $this->attribute("onmousedown", htmlentities($onmousedown . $action));
            }
            return $this;
        } else {
            return $this->attribute("onmousedown");
        }
    }

    //=====================================================================//
    //  METHOD: on_mouse_down                                              //
    //========================== END OF METHOD ============================//
    //========================= START OF METHOD ===========================//
    //  METHOD: on_mouse_move                                              //
    //=====================================================================//
    /** Sets or retrieves the onmousemove Javascript event to this widget.
     * The attached action must be valid JavaScript code, which will be evaluated
     * when the event is triggered.
     * @param String the JavaScript action
     * @return mixed The on_mouse_move action as String (null, if not set) or an instance of this Widget
     * @throws IllegalArgumentException if parameter $action is not String or S_Ajax
     * @access public
     */
    function on_mouse_move($action = null) {
        if (func_num_args() > 0) {
            if (is_string($action) == false && ($action instanceof S_Ajax) == false)
                throw new IllegalArgumentException('In class <b>' . get_class($this) . '</b> in method <b>on_mouse_move($action)</b>: Parameter <b>$action</b> MUST BE of type String or S_Ajax - <b style="color:red">' . (is_object($action) ? get_class($action) : gettype($action)) . '</b> given!');
            if (($action instanceof S_Ajax) == true)
                $action = $action->to_js();
            if ($this->attribute("onmousemove") == null) {
                $this->attribute("onmousemove", htmlentities($action));
            } else {
                $onmousemove = html_entity_decode($this->attribute("onmousemove"));
                if (s::str_ends_with($onmousemove, ";") == false) {
                    $onmousemove .= ";";
                }
                $this->attribute("onmousemove", htmlentities($onmousemove . $action));
            }
            return $this;
        } else {
            return $this->attribute("onmousemove");
        }
    }

    //=====================================================================//
    //  METHOD: on_mouse_move                                              //
    //========================== END OF METHOD ============================//
    //========================= START OF METHOD ===========================//
    //  METHOD: on_mouse_over                                              //
    //=====================================================================//
    /** Sets or retrieves the onmouseover Javascript event to this widget.
     * The attached action must be valid JavaScript code, which will be evaluated
     * when the event is triggered.
     * @param String the JavaScript action
     * @return mixed The on_mouse_over action as String (null, if not set) or an instance of this Widget
     * @throws IllegalArgumentException if parameter $action is not String or S_Ajax
     * @access public
     */
    function on_mouse_over($action = null) {
        if (func_num_args() > 0) {
            if (is_string($action) == false && ($action instanceof S_Ajax) == false)
                throw new IllegalArgumentException('In class <b>' . get_class($this) . '</b> in method <b>on_mouse_over($action)</b>: Parameter <b>$action</b> MUST BE of type String or S_Ajax - <b style="color:red">' . (is_object($action) ? get_class($action) : gettype($action)) . '</b> given!');
            if (($action instanceof S_Ajax) == true)
                $action = $action->to_js();
            if ($this->attribute("onmouseover") == null) {
                $this->attribute("onmouseover", htmlentities($action));
            } else {
                $onmouseover = html_entity_decode($this->attribute("onmouseover"));
                if (s::str_ends_with($onmouseover, ";") == false) {
                    $onmouseover .= ";";
                }
                $this->attribute("onmouseover", htmlentities($onmouseover . $action));
            }
            return $this;
        } else {
            return $this->attribute("onmouseover");
        }
    }

    //=====================================================================//
    //  METHOD: on_mouse_over                                              //
    //========================== END OF METHOD ============================//
    //========================= START OF METHOD ===========================//
    //  METHOD: on_mouse_out                                            //
    //=====================================================================//
    /** Sets or retrieves the onmouseout Javascript event to this widget.
     * The attached action must be valid JavaScript code, which will be evaluated
     * when the event is triggered.
     * @param String the JavaScript action
     * @return mixed The on_mouse_out action as String (null, if not set) or an instance of this Widget
     * @throws IllegalArgumentException if parameter $action is not String or S_Ajax
     * @access public
     */
    function on_mouse_out($action = null) {
        if (func_num_args() > 0) {
            if (is_string($action) == false && ($action instanceof S_Ajax) == false)
                throw new IllegalArgumentException('In class <b>' . get_class($this) . '</b> in method <b>on_mouse_out($action)</b>: Parameter <b>$action</b> MUST BE of type String or S_Ajax - <b style="color:red">' . (is_object($action) ? get_class($action) : gettype($action)) . '</b> given!');
            if (($action instanceof S_Ajax) == true)
                $action = $action->to_js();
            if ($this->attribute("onmouseout") == null) {
                $this->attribute("onmouseout", htmlentities($action));
            } else {
                $onmouseout = html_entity_decode($this->attribute("onmouseout"));
                if (s::str_ends_with($onmouseout, ";") == false) {
                    $onmouseout .= ";";
                }
                $this->attribute("onmouseout", htmlentities($onmouseout . $action));
            }
            return $this;
        } else {
            return $this->attribute("onmouseout");
        }
    }

    //=====================================================================//
    //  METHOD: on_mouse_out                                               //
    //========================== END OF METHOD ============================//
    //========================= START OF METHOD ===========================//
    //  METHOD: opacity                                                    //
    //=====================================================================//
    /** Sets the opacity of this Widget. It will also make opaque all its
     * child widgets.
     * <code>
     * $textfield = s_textfield()->opacity(20);
     * </code>
     * @param int the opaicity (from 0 to 100)
     * @throws IllegalArgumentException if parameter $opacity is not Integer
     * @return mixed The opacity as String (null, if not set) or an instance of this Widget
     * @access public
     */
    function opacity($opacity) {
        if (is_int($opacity) == false)
            throw new IllegalArgumentException('In class <b>' . get_class($this) . '</b> in method <b>opacity($opacity)</b>: Parameter <b>$opacity</b> MUST BE of type Integer - <b style="color:red">' . (is_object($opacity) ? get_class($opacity) : gettype($opacity)) . '</b> given!');
        $this->style('filter', 'alpha(opacity=' . $opacity . ')');
        if ($opacity < 100) {
            $this->style('-moz-opacity', '.' . $opacity);
            $this->style('opacity', '.' . $opacity);
            $this->style('-khtml-opacity', '.' . $opacity);
        } else {
            $this->style('-moz-opacity', '1.0');
            $this->style('opacity', '1.0');
            $this->style('-khtml-opacity', '1.0');
        }
        return $this;
    }

    //=====================================================================//
    //  METHOD: opacity                                                    //
    //========================== END OF METHOD ============================//
}

//===========================================================================//
// CLASS: Element                                                            //
//============================== END OF CLASS ===============================//
