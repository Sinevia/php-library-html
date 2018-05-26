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
// CLASS: Hyperlink                                                        //
//===========================================================================//
/**
 * The Hyperlink class represents a hyperlink on the webpage.
 *
 * The Hyperlink keep all the features of the normal HTML hyperlink, and
 * additionally allows the use of images. The Hyperlink object can display
 * either text, an image, or both.
 * 
 * <code>
 * $hyperlink = new Hyperlink();
 *     $hyperlink->setText("Yahoo");
 *     $hyperlink->setUrl("http://www.yahoo.com");
 *
 * // The same as above using the shortcut function and method chaining
 * $hyperlink = Ui::Hyperlink()->setText("Yahoo")->setUrl("http://www.yahoo.com");
 * </code>
 * @package GUI
 */
class Hyperlink extends Element {

    /**
     * The constructor of this Hyperlink.
     * @construct
     */
    function __construct() {
        parent::__construct();
        $this->setAttribute("href", "#");
    }

    /**
     * Returns the text of this Hyperlink.
     * @return String The text as String (null, if not set)
     */
    public function getText() {
        return $this->getProperty('text');
    }

    /**
     * Sets he text of this Hyperlink.
     * @param String the text to be shown
     * @return Hyperlink the instance of this Hyperlink
     * @throws \InvalidArgumentException if parameter $text is not is not String
     */
    public function setText($text = null) {
        if (is_string($text) == false) {
            throw new \InvalidArgumentException('In class <b>' . get_class($this) . '</b> in method <b>text($text)</b>: Parameter <b>$text</b> MUST BE of type String - <b>' . (is_object($text) ? get_class($text) : gettype($text)) . '</b> given!');
        }
        $this->setProperty('text', $text);
        return $this;
    }

    /**
     * Returns the image of this Hyperlink.
     * @param Image the image to be shown in this Hyperlink
     * @return Image The image as Image
     */
    public function getImage($image = null) {
        return $this->getProperty('image');
    }

    /**
     * Sets the image of this Hyperlink.
     * @param Image the image to be shown in this Hyperlink
     * @return Hyperlink the instance of this Hyperlink
     * @throws \InvalidArgumentException if parameter $image is not of type S_Image
     * @access public
     */
    function setImage($image) {
        if (($image instanceof Image) == false) {
            throw new \InvalidArgumentException('In class <b>' . get_class($this) . '</b> in method <b>image($image)</b>: Parameter <b>$image</b> MUST BE of type S_Image - <b>' . (is_object($image) ? get_class($image) : gettype($image)) . '</b> given!');
        }
        $this->setProperty('image', $image);
        return $this;
    }

    /**
     * Returns the title of this Hyperlink.
     *
     * The title is shown, when the user places the mouse over the Hyperlink.
     * on the webpage.
     * @return String The title as String (null, if not set)
     */
    public function getTitle() {
        return $this->getAttribute("title");
    }

    /**
     * Sets the title of this Hyperlink.
     * The title is shown, when the user places the mouse over the Hyperlink.
     * on the webpage.
     * 
     * @param String the title to be shown
     * @return Hyperlink the instance of this Hyperlink
     * @throws \InvalidArgumentException if parameter $title is not is not String
     */
    public function setTitle($title) {
        if (is_string($title) == false) {
            throw new \InvalidArgumentException('In class ' . get_class($this) . ' in method title($title): Parameter $title MUST BE of type String - ' . (is_object($title) ? get_class($title) : gettype($title)) . ' given!');
        }
        $this->setAttribute("title", $title);
        return $this;
    }

    /**
     * Returns the URL of this Hyperlink.
     * on the webpage.
     * @return String The URL as String (null, if not set)
     */
    public function getUrl() {
        return $this->getAttribute("href");
    }

    /**
     * Sets the URL of this Hyperlink.
     * on the webpage.
     * @param String the URL of the hyperlink
     * @return mixed The URL as String (null, if not set) or the instance of this Hyperlink
     * @throws IllegalArgumentException if parameter $url is not is not String
     */
    public function setUrl($url) {
        if (is_string($url) == false) {
            if (is_string($url) == false) {
                throw new \InvalidArgumentException('In class <b>' . get_class($url) . '</b> in method <b>setUrl($url)</b>: Parameter <b>$url</b> MUST BE of type String - <b>' . (is_object($url) ? get_class($url) : gettype($url)) . '</b> given!');
            }
        }
        $this->setAttribute("href", $url);
        return $this;
    }

    /**
     * Returns the HTML representation of this Hyperlink with its children.
     * @param compressed compresses the XHTML, removing the new lines and indent
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
        $html = $indent . '<a' . $this->attributesToHtml() . $this->cssToHtml() . '>' . $nl;
        if ($this->getProperty("image") != null) {
            $html .= $this->getProperty("image")->toHtml($compressed, $level + 1) . $nl;
        }
        if ($this->getProperty("text") != null) {
            $html .= $indent . $tab . $this->getProperty("text") . $nl;
        }
        foreach ($this->children as $child) {
            if (is_object($child) && is_subclass_of($child, "Sinevia\Ui\Element")) {
                $html .= $child->toHtml($compressed, $level + 1) . $nl;
            } else {
                $html .= $indent . $tab . $child . $nl;
            }
        }
        $html .= $indent . '</a>';
        return $html;
    }

    /**
     * Returns the XHTML representation of this Hyperlink with its children.
     * @param compressed compresses the XHTML, removing the new lines and indent
     * @param level the level of this widget
     * @return String html string
     */
    function to_xhtml($compressed = true, $level = 0) {
        if ($compressed == false) {
            $nl = "\n";
            $tab = "    ";
            $indent = str_pad("", ($level * 4));
        } else {
            $nl = "";
            $tab = "";
            $indent = "";
        }
        $html = $indent . '<a' . $this->attributesToHtml() . $this->cssToHtml() . '>' . $nl;
        if ($this->getProperty("image") != null) {
            $html .= $this->getProperty("image")->toXhtml($compressed, $level + 1) . $nl;
        }
        if ($this->getProperty("text") != null) {
            $html .= $indent . $tab . $this->getProperty("text") . $nl;
        }
        foreach ($this->children as $child) {
            if (is_object($child) && is_subclass_of($child, "Sinevia\Ui\Element")) {
                $html .= $child->toXhtml($compressed, $level + 1) . $nl;
            } else {
                $html .= $indent . $tab . $child . $nl;
            }
        }
        $html .= $indent . '</a>';
        return $html;
    }

}

//===========================================================================//
// CLASS: Hyperlink                                                          //
//============================== END OF CLASS ===============================//
