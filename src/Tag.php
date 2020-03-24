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

//============================= START OF CLASS ==============================//
// CLASS: Tag                                                                //
//===========================================================================//

/**
 * The basic constructor for the all the (X)HTML Tags.
 * It contains the most used methods, available for most of the Tags.
 * This class should not be used directly, but its
 * subclasses should be used instead.
 */
class Tag {

    //========================= START OF METHOD ===========================//
    //  METHOD: background                                                 //
    //=====================================================================//
    /** Sets or retrieves the background color of this Tag.
     * <code>
     * // Setting background for webpage
     * s_webpage()->background("#FFFFFF");
     * </code>
     * @param String the color name (i.e. "red","#FFFFFF")
     * @return mixed The background color as String (null, if not set) or an instance of this Tag
     * @throws \InvalidArgumentException if paremeter $color is not String
     * @access public
     */
    function setBackground($color = null) {
        if (func_num_args() > 0) {
            if (is_string($color) == false)
                throw new \InvalidArgumentException('In class ' . get_class($this) . ' in method background($color): Parameter $color MUST BE of type String - ' . (is_object($color) ? get_class($color) : gettype($color)) . ' given!');
            $this->property('background', $color);
            $this->style('background', $color);
            return $this;
        }else {
            return $this->property('background');
        }
    }

    //=====================================================================//
    //  METHOD: background                                                 //
    //========================== END OF METHOD ============================//
    //========================= START OF METHOD ===========================//
    //  METHOD: background_image                                           //
    //=====================================================================//
    /**
     * Sets or retrieves the background image URL of this Tag.
     * You can set the background to be repeated, not to be repeated,
     * or to be horizizontally or vertiaclly repeated.
     * <code>
     * // Setting background image for webpage
     * s_webpage()->background_image(simplest()->root_url."/images/bg.gif");
     * // Setting the same background to a form as the webpage
     * s_form()->background_image(s_webpage()->background_image());
     * // Setting background with no repeating
     * s_form()->background_image("bg.gif",false);
     * // Repeating the image horizontally
     * s_form()->background_image("bg.gif","h");
     * * // Repeating the image vertically
     * s_form()->background_image("bg.gif","v");
     * </code>
     * @param String the path to the image
     * @param mixed Boolean or String ("yes","y","no","n","vertical","v","horizontal","h")
     * @return mixed The background image URL as String (null, if not set) or an instance of this Tag
     * @throws \InvalidArgumentException if paremeter $image is not String, or $repeat is not Boolean or String ("yes","y","no","n")
     * @access public
     */
    function setBackgroundImage($image = null, $repeat = "y", $axis = "both") {
        if (func_num_args() > 0) {
            if (is_string($image) == false)
                throw new \InvalidArgumentException('In class ' . get_class($this) . ' in method background_image($image,$repeat): Parameter $image MUST BE of type String - ' . (is_object($image) ? get_class($image) : gettype($image)) . ' given!');
            if (is_string($repeat) == false && is_bool($repeat) == false)
                throw new \InvalidArgumentException('In class ' . get_class($this) . ' in method background_image($image,$repeat): Parameter $repeat MUST BE of type String ("yes","y","no","n") or Boolean (true, false) - ' . (is_object($repeat) ? get_class($repeat) : gettype($repeat)) . ' given!');
            $this->property('background_image', $image);
            $this->style('background-image', 'url(' . $image . ')');
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
            $this->style('background-repeat', $repeat);
            return $this;
        } else {
            return $this->property('background_image');
        }
    }

    //=====================================================================//
    //  METHOD: background_image                                           //
    //========================== END OF METHOD ============================//
    //========================= START OF METHOD ===========================//
    //  METHOD: border                                                     //
    //=====================================================================//
    /** Sets or retrieves the border of this Tag.
     * The border is specified by its width, style and color.
     * <code>
     * // Setting border to a textfield
     * $textfield = s_textfield()->border(3,"outset","blue");
     * // Getting the border of a textfield
     * echo $textfield->border(); // will print "3px outset blue"
     * </code>
     * @param numeric The width of the border (numeric - Integer or String)
     * @param String The style of the border (solid, outset, inset, dashed, etc.)
     * @param String the color of the border (i.e "red","#FFFFFF")
     * @return mixed The background border as String (null, if not set) or an instance of this Tag
     * @access public
     */
    function setBorder($width = null, $style = "solid", $color = "black") {
        if (func_num_args() > 0) {
            if (is_numeric($width) == false)
                throw new \InvalidArgumentException('In class ' . get_class($this) . ' in method border($width,$style,$color): Parameter $width MUST BE of type String - ' . (is_object($width) ? get_class($width) : gettype($width)) . ' given!');
            if (is_string($style) == false)
                throw new \InvalidArgumentException('In class ' . get_class($this) . ' in method border($width,$style,$color): Parameter $style MUST BE of type String - ' . (is_object($style) ? get_class($style) : gettype($style)) . ' given!');
            if (is_string($color) == false)
                throw new \InvalidArgumentException('In class ' . get_class($this) . ' in method border($widthe,$style,$color): Parameter $color MUST BE of type String - ' . (is_object($color) ? get_class($color) : gettype($color)) . ' given!');
            $this->style('border', $width . 'px ' . $style . ' ' . $color);
            return $this;
        }else {
            return $this->style('border');
        }
    }

    //=====================================================================//
    //  METHOD: border                                                     //
    //========================== END OF METHOD ============================//
    //========================= START OF METHOD ===========================//
    //  METHOD: display                                                    //
    //=====================================================================//
    /** Sets or retrieves the display style of this Tag.
     * @return mixed The display style as String (null, if not set) or an instance of this Tag
     * @throws \InvalidArgumentException if parameter $display is not String
     * @access public
     */
    function setDisplay($display = null) {
        if (func_num_args() > 0) {
            if (is_string($display) == false)
                throw new \InvalidArgumentException('In class ' . get_class($this) . ' in method display($display): Parameter $display MUST BE of type String - ' . (is_object($display) ? get_class($display) : gettype($display)) . ' given!');
            $this->style("display", $display);
            $this->property("display", $display);
            return $this;
        }else {
            return $this->property("display");
        }
    }

    //=====================================================================//
    //  METHOD: display                                                    //
    //========================== END OF METHOD ============================//
    //========================= START OF METHOD ===========================//
    //  METHOD: float                                                      //
    //=====================================================================//
    /** Sets or retrieves the CSS float property of this Tag.
     *
     * The float property sets where a Tag will appear in another Tag.
     * Note: If there is too little space on a line for the floating
     * Tag, it will jump down on the next line, and continue until a line
     * has enough space.<br />
     * <code>
     * // Floating a Tag left
     * s::light_panel()->width(200)->float("left");
     * </code>
     * @param String the horizontal alignment (left,center,right)
     * @return mixed The horizontal alignment as String (null, if not set) or an instance of this Tag
     * @throws \InvalidArgumentException if paremeter $halign is not String
     * @access public
     */
    function setFloat($float = null) {
        if (func_num_args() > 0) {
            if (is_string($float) == false)
                throw new \InvalidArgumentException('In class ' . get_class($this) . ' in method float($float): Parameter $float MUST BE of type String - ' . (is_object($float) ? get_class($float) : gettype($float)) . ' given!');
            // Checking position
            $allowed_params = array("left", "right", "none");
            if (in_array($float, $allowed_params) == false) {
                throw new \InvalidArgumentException('In class ' . get_class($this) . ' in method float($float): Parameter $float MUST BE of type String(' . implode(", ", $allowed_params) . ') - ' . ($float) . ' given!');
            }
            $this->property('flooat', $float);
            $this->style('float', $float);
            return $this;
        } else {
            return $this->property('float');
        }
    }

//=====================================================================//
//  METHOD: float                                                      //
//========================== END OF METHOD ============================//
//========================= START OF METHOD ===========================//
//  METHOD: font                                                       //
//=====================================================================//
    /** Sets or retrieves the Font of this Tag.
     * <code>
     * $font = s_font()->size(16)->bold(true);
     * $textfield = s_textfield()->font($font);
     * </code>
     * @param S_Font the font of this Tag
     * @return mixed The Font as Font (null, if not set) or an instance of this Tag
     * @access public
     */
    function setFont($font = null) {
        if (func_num_args() > 0) {
            if (($font instanceof S_Font) == false)
                throw new \InvalidArgumentException('In class ' . get_class($this) . ' in method font($font): Parameter $fonte MUST BE of type S_Font - ' . (is_object($font) ? get_class($font) : gettype($font)) . ' given!');
            if (!is_null($font->family()))
                $this->style('font-family', $font->family());
            if (!is_null($font->color()))
                $this->style('color', $font->color());
            if (!is_null($font->size()))
                $this->style('font-size', $font->size() . "px");
            if (!is_null($font->bold())) {
                if ($font->bold() == true) {
                    $this->style('font-weight', 'bold');
                } else {
                    $this->style('font-weight', 'normal');
                }
            }
            if (!is_null($font->italic())) {
                if ($font->italic() == true) {
                    $this->style('font-style', 'italic');
                } else {
                    $this->style('font-style', 'normal');
                }
            }
            if (!is_null($font->underline())) {
                if ($font->underline() == true) {
                    $this->style('text-decoration', 'underline');
                } else {
                    $this->style('text-decoration', 'none');
                }
            }
            if (!is_null($font->spacing())) {
                $this->style('letter-spacing', $font->spacing() . 'px');
            }
            $this->property('font', $font);
            return $this;
        } else {
            return $this->property('font');
        }
    }

//=====================================================================//
//  METHOD: font                                                       //
//========================== END OF METHOD ============================//
//========================= START OF METHOD ===========================//
//  METHOD: foreground                                                 //
//=====================================================================//
    /** Sets or retrieves the frontground color of this Tag.
     * <code>
     * $textfield = s_textfield()->foreground("red");
     * </code>
     * @param String the foreground color (i.e. "blue","#FFFFFF")
     * @return mixed The frontground color as String (null, if not set) or an instance of this Tag
     * @throws \InvalidArgumentException if paremeter $color is not String
     * @access public
     */
    function setForeground($color = null) {
        if (func_num_args() > 0) {
            if (is_string($color) == false)
                throw new \InvalidArgumentException('In class ' . get_class($this) . ' in method foreground($color): Parameter $color MUST BE of type String - ' . (is_object($color) ? get_class($color) : gettype($color)) . ' given!');
            $this->property('foreground', $color);
            $this->style('color', $color);
            return $this;
        }else {
            return $this->property('foreground');
        }
    }

//=====================================================================//
//  METHOD: foreground                                                 //
//========================== END OF METHOD ============================//
//========================= START OF METHOD ===========================//
//  METHOD: halign                                                     //
//=====================================================================//
    /** Sets or retrieves the horizontal alignment of the content of this Tag.
     *
     * <code>
     * // Setting background for webpage
     * s_paragraph()->halign("right");
     * </code>
     * @param String the horizontal alignment (left,center,right)
     * @return mixed The horizontal alignment as String (null, if not set) or an instance of this Tag
     * @throws \InvalidArgumentException if paremeter $halign is not String
     * @access public
     */
    function setHalign($halign = null) {
        if (func_num_args() > 0) {
            if (is_string($halign) == false)
                throw new \InvalidArgumentException('In class ' . get_class($this) . ' in method halign($halign): Parameter $halign MUST BE of type String - ' . (is_object($halign) ? get_class($halign) : gettype($halign)) . ' given!');
            // Checking position
            $allowed_params = array("left", "center", "right");
            if (in_array($halign, $allowed_params) == false) {
                throw new \InvalidArgumentException('In class ' . get_class($this) . ' in method halign($halign): Parameter $halign MUST BE of type String(' . implode(", ", $allowed_params) . ') - ' . ($halign) . ' given!');
            }
            $this->property('halign', $halign);
            $this->style('text-align', $halign);
            return $this;
        } else {
            return $this->property('halign');
        }
    }

//=====================================================================//
//  METHOD: halign                                                     //
//========================== END OF METHOD ============================//
//========================= START OF METHOD ===========================//
//  METHOD: height                                                     //
//=====================================================================//
    /** Sets or retrieves the height of this Tag.
     * <code>
     * $textarea = s_textarea()->height(150)->width(200);
     * </code>
     * @return mixed The height in pixels or percentage or an instance of this Tag
     * @throws \InvalidArgumentException if parameter $height is not Integer or String(i.e 100%) or Null
     * @access public
     */
    function setHeight($height = null) {
        if (func_num_args() > 0) {
            if ($height !== null && is_numeric($height) == false && (is_string($height) == true && s::str_ends_with($height, "%")) == false)
                throw new \InvalidArgumentException('In class ' . get_class($this) . ' in method height($height): Parameter $height MUST BE of type Integer or String(i.e 100%) - ' . (is_object($height) ? get_class($height) : gettype($height)) . ' given!');
            if (s::str_ends_with($height, "%") || $height == "auto") {
                $this->style('height', (string) $height);
                $this->property('height', $height);
            } elseif ($height === null) {
                $this->style('height', (string) $height);
                $this->property('height', $height);
            } else {
                $this->style('height', $height . 'px');
                $this->property('height', $height);
            }
            return $this;
        } else {
            return is_numeric($this->property('height')) ? (int) $this->property('height') : $this->property('height');
        }
    }

//=====================================================================//
//  METHOD: height                                                     //
//========================== END OF METHOD ============================//
//========================= START OF METHOD ===========================//
//  METHOD: margin                                                     //
//=====================================================================//
    /** Sets or retrieves the margin of this Tag.
     * @param int margin from the top of the Tag
     * @param int margin from the left of the Tag
     * @param int margin from the bottom of the Tag
     * @param int margin from the right the Tag
     * @return mixed The margin as String (null, if not set) or an instance of this Tag
     * @throws \InvalidArgumentException if parameter $top,$left,$bottom or $right is not Integer
     * @access public
     */
    function setMargin($top = 0, $left = 0, $bottom = 0, $right = 0) {
        if (func_num_args() > 0) {
            if (is_int($top) == false)
                throw new \InvalidArgumentException('In class ' . get_class($this) . ' in method margin($top,$left,$bottom,$right): Parameter $top MUST BE of type Integer - ' . (is_object($top) ? get_class($top) : gettype($top)) . ' given!');
            if (is_int($left) == false)
                throw new \InvalidArgumentException('In class ' . get_class($this) . ' in method margin($top,$left,$bottom,$right): Parameter $left MUST BE of type Integer - ' . (is_object($left) ? get_class($left) : gettype($left)) . ' given!');
            if (is_int($bottom) == false)
                throw new \InvalidArgumentException('In class ' . get_class($this) . ' in method margin($top,$left,$bottom,$right): Parameter $bottom MUST BE of type Integer - ' . (is_object($bottom) ? get_class($bottom) : gettype($bottom)) . ' given!');
            if (is_int($right) == false)
                throw new \InvalidArgumentException('In class ' . get_class($this) . ' in method margin($top,$left,$bottom,$right): Parameter $right MUST BE of type Integer - ' . (is_object($right) ? get_class($right) : gettype($right)) . ' given!');
            $this->style('margin', $top . 'px ' . $left . 'px ' . $bottom . 'px ' . $right . 'px;');
            return $this;
        }else {
            return $this->style('margin');
        }
    }

//=====================================================================//
//  METHOD: margin                                                     //
//========================== END OF METHOD ============================//
//========================= START OF METHOD ===========================//
//  METHOD: on_blur                                                   //
//=====================================================================//
    /** Sets or retrieves the onblur Javascript event to this Tag.
     * The attached action must be valid JavaScript code, which will be evaluated
     * when the event is triggered.
     * @param String the JavaScript action
     * @return mixed The on_blur action as String (null, if not set) or an instance of this Tag
     * @throws \InvalidArgumentException if parameter $action is not String or S_Ajax
     * @access public
     */
    function onBlur($action = null) {
        if (func_num_args() > 0) {
            if (is_string($action) == false && ($action instanceof S_Ajax) == false)
                throw new \InvalidArgumentException('In class ' . get_class($this) . ' in method on_blur($action): Parameter $action MUST BE of type String or S_Ajax - ' . (is_object($action) ? get_class($action) : gettype($action)) . ' given!');
            if (($action instanceof S_Ajax) == true)
                $action = $action->to_js();
            if ($this->attribute("onblur") == null) {
                $this->attribute("onblur", htmlentities($action));
            } else {
                $onblur = html_entity_decode($this->attribute("onblur"));
                if (s::str_ends_with($onblur, ";") == false) {
                    $onblur .= ";";
                }
                $this->attribute("onblur", htmlentities($onblur . $action));
            }
            return $this;
        } else {
            return $this->attribute("onblur");
        }
    }

//=====================================================================//
//  METHOD: on_blur                                                    //
//========================== END OF METHOD ============================//
//========================= START OF METHOD ===========================//
//  METHOD: on_click                                                   //
//=====================================================================//
    /** Sets or retrieves the onclick Javascript event to this Tag.
     * The attached action must be valid JavaScript code, which will be evaluated
     * when the event is triggered.
     * @param String the JavaScript action
     * @return mixed The on_click action as String (null, if not set) or an instance of this Tag
     * @throws \InvalidArgumentException if parameter $action is not String or S_Ajax
     * @access public
     */
    function onClick($action = null) {
        if (func_num_args() > 0) {
            if (is_string($action) == false && ($action instanceof S_Ajax) == false)
                throw new \InvalidArgumentException('In class ' . get_class($this) . ' in method on_click($action): Parameter $action MUST BE of type String or S_Ajax - ' . (is_object($action) ? get_class($action) : gettype($action)) . ' given!');
            if (($action instanceof S_Ajax) == true)
                $action = $action->to_js();
            if ($this->attribute("onclick") == null) {
                $this->attribute("onclick", htmlentities($action));
            } else {
                $onclick = html_entity_decode($this->attribute("onclick"));
                if (s::str_ends_with($onclick, ";") == false) {
                    $onclick .= ";";
                }
                $this->attribute("onclick", htmlentities($onclick . $action));
            }
            return $this;
        } else {
            return $this->attribute("onclick");
        }
    }

//=====================================================================//
//  METHOD: on_click                                                   //
//========================== END OF METHOD ============================//
//========================= START OF METHOD ===========================//
//  METHOD: on_double_click                                            //
//=====================================================================//
    /** Sets or retrieves the ondblclick Javascript event to this Tag.
     * The attached action must be valid JavaScript code, which will be evaluated
     * when the event is triggered.
     * @param String the JavaScript action
     * @return mixed The on_double_click action as String (null, if not set) or an instance of this Tag
     * @throws \InvalidArgumentException if parameter $action is not String or S_Ajax
     * @access public
     */
    function onDoubleClick($action = null) {
        if (func_num_args() > 0) {
            if (is_string($action) == false && ($action instanceof S_Ajax) == false)
                throw new \InvalidArgumentException('In class ' . get_class($this) . ' in method on_double_click($action): Parameter $action MUST BE of type String or S_Ajax - ' . (is_object($action) ? get_class($action) : gettype($action)) . ' given!');
            if (($action instanceof S_Ajax) == true)
                $action = $action->to_js();
            if ($this->attribute("ondblclick") == null) {
                $this->attribute("ondblclick", htmlentities($action));
            } else {
                $ondblclick = html_entity_decode($this->attribute("ondblclick"));
                if (s::str_ends_with($ondblclick, ";") == false) {
                    $ondblclick .= ";";
                }
                $this->attribute("ondblclick", htmlentities($ondblclick . $action));
            }
            return $this;
        } else {
            return $this->attribute("ondblclick");
        }
    }

//=====================================================================//
//  METHOD: on_double_click                                            //
//========================== END OF METHOD ============================//
//========================= START OF METHOD ===========================//
//  METHOD: on_focus                                                   //
//=====================================================================//
    /** Sets or retrieves the onfocus Javascript event to this Tag.
     * The attached action must be valid JavaScript code, which will be evaluated
     * when the event is triggered.
     * @param String the JavaScript action
     * @return mixed The on_focus_click action as String (null, if not set) or an instance of this Tag
     * @throws \InvalidArgumentException if parameter $action is not String or S_Ajax
     * @access public
     */
    function onFocus($action = null) {
        if (func_num_args() > 0) {
            if (is_string($action) == false && ($action instanceof S_Ajax) == false)
                throw new \InvalidArgumentException('In class ' . get_class($this) . ' in method on_focus($action): Parameter $action MUST BE of type String or S_Ajax - ' . (is_object($action) ? get_class($action) : gettype($action)) . ' given!');
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
    /** Sets or retrieves the onkeydown Javascript event to this Tag.
     * The attached action must be valid JavaScript code, which will be evaluated
     * when the event is triggered.
     * @param String the JavaScript action
     * @return mixed The on_key_down action as String (null, if not set) or an instance of this Tag
     * @throws \InvalidArgumentException if parameter $action is not String or S_Ajax
     * @access public
     */
    function onKeyDown($action = null) {
        if (func_num_args() > 0) {
            if (is_string($action) == false && ($action instanceof S_Ajax) == false)
                throw new \InvalidArgumentException('In class ' . get_class($this) . ' in method on_key_down($action): Parameter $action MUST BE of type String or S_Ajax - ' . (is_object($action) ? get_class($action) : gettype($action)) . ' given!');
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
    /** Sets or retrieves the onkeypress Javascript event to this Tag.
     * The attached action must be valid JavaScript code, which will be evaluated
     * when the event is triggered.
     * @param String the JavaScript action
     * @return mixed The on_key_press action as String (null, if not set) or an instance of this Tag
     * @throws \InvalidArgumentException if parameter $action is not String or S_Ajax
     * @access public
     */
    function onKeyPress($action = null) {
        if (func_num_args() > 0) {
            if (is_string($action) == false && ($action instanceof S_Ajax) == false)
                throw new \InvalidArgumentException('In class ' . get_class($this) . ' in method on_key_press($action): Parameter $action MUST BE of type String or S_Ajax - ' . (is_object($action) ? get_class($action) : gettype($action)) . ' given!');
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
    /** Sets or retrieves the onkeyup Javascript event to this Tag.
     * The attached action must be valid JavaScript code, which will be evaluated
     * when the event is triggered.
     * @param String the JavaScript action
     * @return mixed The on_key_up action as String (null, if not set) or an instance of this Tag
     * @throws \InvalidArgumentException if parameter $action is not String or S_Ajax
     * @access public
     */
    function onKeyUp($action = null) {
        if (func_num_args() > 0) {
            if (is_string($action) == false && ($action instanceof S_Ajax) == false)
                throw new \InvalidArgumentException('In class ' . get_class($this) . ' in method on_key_up($action): Parameter $action MUST BE of type String or S_Ajax - ' . (is_object($action) ? get_class($action) : gettype($action)) . ' given!');
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
    /** Sets or retrieves the onmousedown Javascript event to this Tag.
     * The attached action must be valid JavaScript code, which will be evaluated
     * when the event is triggered.
     * @param String the JavaScript action
     * @return mixed The on_mouse_down action as String (null, if not set) or an instance of this Tag
     * @throws \InvalidArgumentException if parameter $action is not String or S_Ajax
     * @access public
     */
    function onMouseDown($action = null) {
        if (func_num_args() > 0) {
            if (is_string($action) == false && ($action instanceof S_Ajax) == false)
                throw new \InvalidArgumentException('In class ' . get_class($this) . ' in method on_mouse_down($action): Parameter $action MUST BE of type String or S_Ajax - ' . (is_object($action) ? get_class($action) : gettype($action)) . ' given!');
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
    /** Sets or retrieves the onmousemove Javascript event to this Tag.
     * The attached action must be valid JavaScript code, which will be evaluated
     * when the event is triggered.
     * @param String the JavaScript action
     * @return mixed The on_mouse_move action as String (null, if not set) or an instance of this Tag
     * @throws \InvalidArgumentException if parameter $action is not String or S_Ajax
     * @access public
     */
    function onMouseMove($action = null) {
        if (func_num_args() > 0) {
            if (is_string($action) == false && ($action instanceof S_Ajax) == false)
                throw new \InvalidArgumentException('In class ' . get_class($this) . ' in method on_mouse_move($action): Parameter $action MUST BE of type String or S_Ajax - ' . (is_object($action) ? get_class($action) : gettype($action)) . ' given!');
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
    /** Sets or retrieves the onmouseover Javascript event to this Tag.
     * The attached action must be valid JavaScript code, which will be evaluated
     * when the event is triggered.
     * @param String the JavaScript action
     * @return mixed The on_mouse_over action as String (null, if not set) or an instance of this Tag
     * @throws \InvalidArgumentException if parameter $action is not String or S_Ajax
     * @access public
     */
    function onMouseOver($action = null) {
        if (func_num_args() > 0) {
            if (is_string($action) == false && ($action instanceof S_Ajax) == false)
                throw new \InvalidArgumentException('In class ' . get_class($this) . ' in method on_mouse_over($action): Parameter $action MUST BE of type String or S_Ajax - ' . (is_object($action) ? get_class($action) : gettype($action)) . ' given!');
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
    /** Sets or retrieves the onmouseout Javascript event to this Tag.
     * The attached action must be valid JavaScript code, which will be evaluated
     * when the event is triggered.
     * @param String the JavaScript action
     * @return mixed The on_mouse_out action as String (null, if not set) or an instance of this Tag
     * @throws \InvalidArgumentException if parameter $action is not String or S_Ajax
     * @access public
     */
    function onMouseOut($action = null) {
        if (func_num_args() > 0) {
            if (is_string($action) == false && ($action instanceof S_Ajax) == false)
                throw new \InvalidArgumentException('In class ' . get_class($this) . ' in method on_mouse_out($action): Parameter $action MUST BE of type String or S_Ajax - ' . (is_object($action) ? get_class($action) : gettype($action)) . ' given!');
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
    /** Sets the opacity of this Tag. It will also make opaque all its
     * child Tags.
     * <code>
     * $textfield = s_textfield()->opacity(20);
     * </code>
     * @param int the opaicity (from 0 to 100)
     * @throws \InvalidArgumentException if parameter $opacity is not Integer
     * @return mixed The opacity as String (null, if not set) or an instance of this Tag
     * @access public
     */
    function setOpacity($opacity) {
        if (is_int($opacity) == false)
            throw new \InvalidArgumentException('In class ' . get_class($this) . ' in method opacity($opacity): Parameter $opacity MUST BE of type Integer - ' . (is_object($opacity) ? get_class($opacity) : gettype($opacity)) . ' given!');
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
//========================= START OF METHOD ===========================//
//  METHOD: padding                                                    //
//=====================================================================//
    /** Sets or retrieves the padding of this Tag.
     * @param int padding from the top of the Tag
     * @param int padding from the left of the Tag
     * @param int padding from the bottom of the Tag
     * @param int padding from the right the Tag
     * @return mixed The padding as String (null, if not set) or an instance of this Tag
     * @throws \InvalidArgumentException if parameter $top,$left,$bottom or $right is not Integer
     * @access public
     */
    function setPadding($top = 0, $left = 0, $bottom = 0, $right = 0) {
        if (func_num_args() > 0) {
            if (is_int($top) == false)
                throw new \InvalidArgumentException('In class ' . get_class($this) . ' in method padding($top,$left,$bottom,$right): Parameter $top MUST BE of type Integer - ' . (is_object($top) ? get_class($top) : gettype($top)) . ' given!');
            if (is_int($left) == false)
                throw new \InvalidArgumentException('In class ' . get_class($this) . ' in method padding($top,$left,$bottom,$right): Parameter $left MUST BE of type Integer - ' . (is_object($left) ? get_class($left) : gettype($left)) . ' given!');
            if (is_int($bottom) == false)
                throw new \InvalidArgumentException('In class ' . get_class($this) . ' in method padding($top,$left,$bottom,$right): Parameter $bottom MUST BE of type Integer - ' . (is_object($bottom) ? get_class($bottom) : gettype($bottom)) . ' given!');
            if (is_int($right) == false)
                throw new \InvalidArgumentException('In class ' . get_class($this) . ' in method padding($top,$left,$bottom,$right): Parameter $right MUST BE of type Integer - ' . (is_object($right) ? get_class($right) : gettype($right)) . ' given!');
            $this->style('padding', $top . 'px ' . $left . 'px ' . $bottom . 'px ' . $right . 'px;');
            return $this;
        }else {
            return $this->style('padding');
        }
    }

//=====================================================================//
//  METHOD: padding                                                    //
//========================== END OF METHOD ============================//
//========================= START OF METHOD ===========================//
//  METHOD: parent                                                     //
//=====================================================================//
    /** Sets or retrieves the parent of this Tag.
     * @return mixed The parent as Tag (null, if not set) or an instance of this Tag
     * @access public
     */
    function setParent($parent = null, $position = null) {
        if (func_num_args() > 0) {
            $parent->child($this, $position);
            return $this;
        } else {
            return $this->parent;
        }
    }

//=====================================================================//
//  METHOD: parent                                                     //
//========================== END OF METHOD ============================//
//========================= START OF METHOD ===========================//
//  METHOD: valign                                                     //
//=====================================================================//
    /** Sets or retrieves the vertical alignment of the content of this
     * Tag.
     * Keep in mind, that not all Tag support vertical alignment.
     *
     * <code>
     * // Vertical aligning the panel's content
     * s::panel()->valign("middle");
     * </code>
     * @param String the vertical alignment (top,middle,bottom)
     * @return mixed The horizontal alignment as String (null, if not set) or an instance of this Tag
     * @throws \InvalidArgumentException if paremeter $valign is not String
     * @access public
     */
    function setValign($valign = null) {
        if (func_num_args() > 0) {
            if (is_string($valign) == false)
                throw new \InvalidArgumentException('In class ' . get_class($this) . ' in method valign($valign): Parameter $valign MUST BE of type String - ' . (is_object($valign) ? get_class($valign) : gettype($valign)) . ' given!');
            // Checking position
            $allowed_params = array("top", "middle", "bottom");
            if (in_array($valign, $allowed_params) == false) {
                throw new \InvalidArgumentException('In class ' . get_class($this) . ' in method valign($valign): Parameter $valign MUST BE of type String(' . implode(", ", $allowed_params) . ') - ' . ($valign) . ' given!');
            }
            $this->property('valign', $valign);
            return $this;
        } else {
            return $this->property('valign');
        }
    }

//=====================================================================//
//  METHOD: valign                                                     //
//========================== END OF METHOD ============================//
//========================= START OF METHOD ===========================//
//  METHOD: width                                                      //
//=====================================================================//
    /** Sets or retrieves the width of this Tag.
     * @param int the width of the Tag
     * @return mixed The width in pixels or percentage or an instance of this Tag
     * @throws \InvalidArgumentException if parameter $width is not Integer or String(i.e 100%)
     * @access public
     */
    function setWidth($width = null) {
        if (func_num_args() > 0) {
            if ($width !== null && is_numeric($width) == false && (is_string($width) == true && s::str_ends_with($width, "%")) == false)
                throw new \InvalidArgumentException('In class ' . get_class($this) . ' in method width($width): Parameter $width MUST BE of type Integer or String(i.e 100%) - ' . (is_object($width) ? get_class($width) : gettype($width)) . ' given!');
            if (s::str_ends_with($width, "%")) {
                $this->style('width', $width);
                $this->property('width', $width);
            } elseif ($width === null) {
                $this->style('width', (string) $width);
                $this->property('width', $width);
            } else {
                $this->style('width', $width . 'px');
                $this->property('width', $width . 'px');
            }
            return $this;
        } else {
            $width = str_replace("px", "", $this->style('width'));
            return is_numeric($width) ? (int) $width : $width;
        }
    }

//=====================================================================//
//  METHOD: width                                                      //
//========================== END OF METHOD ============================//
}

//===========================================================================//
// CLASS: Tag                                                                //
//============================== END OF CLASS ===============================//
