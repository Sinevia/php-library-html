<?php

// ========================================================================= //
// SINEVIA PUBLIC                                        http://sinevia.com  //
// ------------------------------------------------------------------------- //
// COPYRIGHT (c) 2016 Sinevia Ltd                        All rights resrved! //
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
// CLASS: Webpage                                                            //
//===========================================================================//
/**
 * The Webpage class is the main outer container that holds all the Widgets.
 * It also provides handy interface for specifying webpage details, like
 * placing a favicon, enable/disable scrolling etc.
 * <code>
 * $webpage = new Webpage();
 * $webpage->child("The simplest webpage possible!");
 * $webpage->display();
 * </code>
 */
class Webpage extends Element {

    protected $title;
    protected $favicon = null;
    protected $metas = array();

    /**
     * The constructor of this Webpage.
     * @construct
     */
    function __construct() {
        parent::__construct();
        // Sets the css style for this webpage
        //$this->css_style("html,body{margin:0px;padding:0px;height:100%;border:none;overflow:auto;}");
        // Crossbrowser issues resolved
        //$this->css_style("div,dl,dt,dd,ul,ol,li,h1,h2,h3,h4,h5,h6,pre,form,fieldset,input,textarea,p,blockquote,th,td{margin:0px;padding:0px;}");
        /* Output - HTML default */
        $this->setOutput("html");
        /* Encoding - UTF-8 default */
        $this->setEncoding("UTF-8");
        /* Language - EN default */
        $this->setLanguage("en");
    }

    /**
     * Returns the description of the Webpage.
     * @return string The description as String (null, if not set)
     * @param String the description (i.e. "The freely avalable online library.")
     * @access public
     */
    function getDescription() {
        return $this->getMeta("description");
    }

    /** Sets the description of the Webpage.
     * @return Webpage an instance of this Webpage
     * @param String the description (i.e. "The freely avalable online library.")
     * @access public
     */
    function setDescription($description) {
        $this->setMeta("decription", $description);
        return $this;
    }

    /**
     * Displays the Webpage to the screen.
     * @param compressed compresses the output, removing the new lines and indent
     * @return void
     */
    function display($compressed = true) {
        if ($this->getOutput() == "xhtml") {
            echo($this->toXhtml($compressed));
            exit;
        } elseif ($this->getOutput() == "html") {
            echo($this->toHtml($compressed));
            exit;
        } else {
            trigger_error('ERROR: In class ' . get_class($this) . ' in method display($compressed): Unknow output MUST BE html or xhtml - <b style="color:red">' . $this->output() . ' given!', E_USER_ERROR);
        }
    }

    /**
     * Returns the encoding chrset of the webpage.
     * @return String The encoding as String (null, if not set)
     */
    public function getEncoding() {
        return $this->getProperty('encoding');
// 		if($this->getMeta("content-type")!=null){
// 			$encoding = str_replace("text/html; charset=","",$this->getMeta("content-type"));
// 			return $encoding;
// 		}
// 		return null;
    }

    /**
     * Sets the encoding charset of the webpage.
     * @return Webpage an instance of this Webpage
     * @param String the name of the encoding charset (i.e. utf-8)
     */
    public function setEncoding($encoding) {
        $this->setProperty('encoding', strtolower($encoding));
        return $this;
    }

    /**
     * Returns the keywords of the Webpage.
     * @return String the keywords as String (null, if not set)
     */
    public function getKeywords() {
        return $this->getMeta("keywords");
    }

    /**
     * Sets the keywords of the Webpage.
     * @return Webpage an instance of this Webpage
     * @param String the keywords, divided by column (i.e. books,electronic)
     * @access public
     */
    public function setKeywords($keywords) {
        $this->setMeta("keywords", $keywords);
        return $this;
    }

    /**
     * Returns the language of the webpage.
     * @return string The language as String (null, if not set)
     * @access public
     */
    public function getLanguage() {
        return $this->getAttribute("lang");
    }

    /**
     * Sets the language of the webpage.
     * @return Webpage an instance of this Webpage
     * @param String the name of the language (i.e. da,en, etc.)
     * @access public
     */
    public function setLanguage($language) {
        $this->setAttribute("lang", strtolower($language));
        return $this;
    }

    /**
     * Gets a meta tags associated with the Webpage.
     * @return string The meta tag as String (null, if not set)
     * @param String the name of the meta tag
     * @access public
     */
    function getMeta($meta) {
        if (isset($this->metas[$meta])) {
            return $this->metas[$meta];
        }
        return null;
    }

    /**
     * Sets a meta tag to Webpage.
     * @return Webpage an instance of this Webpage
     * @param String the name of the meta tag
     * @param String the value of the meta tag
     * @access public
     */
    function setMeta($meta, $value) {
        $this->metas[$meta] = $value;
        return $this;
    }

    /**
     * Retuns the onload Javascript event attached to this Webpage.
     * @return string The onload action as String (null, if not set)
     * @access public
     */
    function getOnLoad() {
        return $this->getAttribute("onload");
    }

    /**
     * Sets the onload Javascript event to this Webpage.
     * The attached action must be valid JavaScript code, which will be evaluated
     * when this page is fully loaded.
     * @param String the onload JavaScript action
     * @return Webpage an instance of this Widget
     * @access public
     */
    function setOnLoad($action) {
        //if(is_string($action)==false && ($action instanceof S_Ajax)==false)s_exception('IllegalArgumentException','In class '.get_class($this).' in method on_load($action): Parameter $action MUST BE of type String or S_Ajax - <b style="color:red">'.(is_object($action)?get_class($action):gettype($action)).' given!');
        //if(($action instanceof S_Ajax)==true)$action = $action->to_js();
        if ($this->getAttribute("onload") == null) {
            $this->getAttribute("onload", htmlentities($action));
        } else {
            $onload = html_entity_decode($this->getAttribute("onload"));
            if (substr($onload, -1) != ";") {
                $onload .= ";";
            }
            $this->setAttribute("onload", htmlentities($onload . $action));
        }
        return $this;
    }

    /**
     * Returns the onunload Javascript event attached to this Webpage.
     * @access public
     */
    function getOnUnload($action) {
        return $this->getAttribute("onunload");
    }

    /**
     * Sets the onunload Javascript event to this Webpage.
     * The attached action must be valid JavaScript code, which will be evaluated
     * when this page is being closed.
     * @param String the JavaScript action
     * @return mixed The on_unload action as String (null, if not set) or an instance of this Widget
     * @access public
     */
    function setOnUnload($action) {
        // if(is_string($action)==false && ($action instanceof S_Ajax)==false)s_exception('IllegalArgumentException','In class '.get_class($this).' in method on_unload($action): Parameter $action MUST BE of type String or S_Ajax - <b style="color:red">'.(is_object($action)?get_class($action):gettype($action)).' given!');
        // if(($action instanceof S_Ajax)==true)$action = $action->to_js();
        if ($this->getAttribute("ononload") == null) {
            $this->getAttribute("onunload", htmlentities($action));
        } else {
            $onunload = html_entity_decode($this->getAttribute("onunload"));
            if (substr($onunload, -1) != ";") {
                $onunload .= ";";
            }
            $this->setAttribute("onunload", htmlentities($onunload . $action));
        }
        return $this;
    }

    /**
     * Returns the specified output of this Webpage.
     * @return string The output of this Webpage as String (null, if not set)
     * @access public
     */
    function getOutput() {
        return $this->getProperty('output');
    }

    /** Sets or retrieves the output of this Webpage.
     * @return mixed The output of this Webpage as String (null, if not set) or an instance of this Webpage
     * @access public
     */
    function setOutput($output) {
        if (is_string($output) == false) {
            throw new IllegalArgumentException('In class ' . get_class($this) . ' in method output($output): Parameter $output MUST BE of type String - <b style="color:red">' . (is_object($title) ? get_class($title) : gettype($title)) . ' given!');
        }
        $this->setProperty('output', $output);
        return $this;
    }

    /**
     * Returns the title of this Webpage.
     * @return string the title as String (null, if not set)
     * @access public
     */
    function getTitle() {
        return $this->property('title');
    }

    /** Sets the title of this Webpage.
     * @return Webpage an instance of this Webpage
     * @access public
     */
    function setTitle($title) {
        if (is_string($title) == false) {
            throw new InvalidArgumentException('In class ' . get_class($this) . ' in method name($title): Parameter $titlee MUST BE of type String - <b style="color:red">' . (is_object($title) ? get_class($title) : gettype($title)) . ' given!');
        }
        $this->setProperty('title', $title);
        return $this;
    }

    function getScroll() {
        return ($this->setAttribute('scrolling') == "yes") ? true : false;
    }

    /**
     * Sets whether scrolling is allowed
     * @param boolean $scroll
     * @throws InvalidArgumentException
     * @return Webpage
     */
    function setScroll($scroll) {
        if (is_bool($scroll) == false) {
            throw new InvalidArgumentException('In class ' . get_class($this) . ' in method setScroll($scroll): Parameter $scroll MUST BE of type Boolean - <b style="color:red">' . gettype($scroll) . ' given!');
        }
        $scroll ? $this->setCss('overflow', 'auto') : $this->setCss('overflow', 'hidden');
        return $this;
    }

    /**
     * Sets or retrieves the favicon of this Webpage.
     * @return string The favicon of this Webpage as String (null, if not set)
     * @access public
     */
    function getFavicon() {
        return $this->getProperty('favicon');
    }

    /**
     * Sets the favicon of this Webpage.
     * @return Webpage an instance of this Webpage
     * @access public
     */
    function setFavicon($favicon) {
        if (is_string($favicon) == false) {
            throw new InvalidArgumentException('In class ' . get_class($this) . ' in method favicon($favicon): Parameter $favicon MUST BE of type String - <b style="color:red">' . gettype($favicon) . ' given!');
        }
        $this->getProperty('favicon', $favicon);
        return $this;
    }

    /**
     * Returns the HTML representation of this Webpage with its children.
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
        if ($this->getProperty('title') == null) {
            $this->setProperty('title', "Undefined");
        }
        $html = '<!DOCTYPE html>' . $nl;
        $html .= '<html>' . $nl;
        // START: HEAD
        $html .= '<head>' . $nl;
        /* Meta tags */
        $html .= $tab . '<meta charset="' . $this->getEncoding() . '">' . $nl;
        foreach ($this->metas as $meta => $content) {
            $html .= $tab . '<meta name="' . $meta . '" content="' . $content . '">' . $nl;
        }
        /* Title */
        $html .= $tab . '<title>' . $this->getProperty('title') . '</title>' . $nl;
        /* Favicon */
        if ($this->getProperty("favicon") != null)
            $html .= $tab . '<link rel="icon" href="' . $this->getProperty("favicon") . '" type="image/x-icon">' . $nl;
        /* CSS and JavaScript */
        $html .= 'S_INLINE_CSS_AND_SCRIPTS';
        $html .= '</head>' . $nl;
        // END HEAD
        // START: BODY
        $html .= '<body' . $this->attributesToHtml() . $this->cssToHtml() . '>' . $nl;
        if (count($this->children) < 1) {
            $this->children[] = '<p>&nbsp;</p>'; // Empty space to validate the empty page
        }
        foreach ($this->children as $child) {
            if (is_object($child) && is_subclass_of($child, "Sinevia\Html\Element")) {
                $html .= $child->toHtml($compressed, $level + 1) . $nl;
            } else {
                $html .= $indent . $tab . $child . $nl;
            }
        }
        $html .= '</body>' . $nl;
        // END: BODY
        $html .= '</html>';

        // GETTING THE CSS AND JS :: HACK IN ORDER TO INITIALIZE ALL
        $inline_css_and_scripts = "";
        /* External CSS Files */
        $inline_css_and_scripts .= $this->_get_css_files($tab, $nl);
        /* Inline CSS Styles */
        $inline_css_and_scripts .= $this->_get_css($tab, $nl);
        /* External JavaScript Files */
        $inline_css_and_scripts .= $this->_get_js_files($tab, $nl);
        /* Inline JavaScript Scripts */
        $inline_css_and_scripts .= $this->_get_js($tab, $nl);
        /* Adding all (external and inline) CSS and JavaScript */
        $html = implode($inline_css_and_scripts, explode('S_INLINE_CSS_AND_SCRIPTS', $html));
        return $html;
    }

    /**
     * Returns the XHTML representation of this Webpage with its children.
     * @param compressed compresses the XHTML, removing the new lines and indent
     * @param level the level of this widget
     * @return String xhtml string
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
        if ($this->getProperty('title') == null) {
            $this->setProperty('title', "Undefined");
        }
        /* Encoding - UTF-8 default */
        $encoding = $this->getEncoding();
        if ($encoding == null)
            $encoding = "UTF-8";
        // Internet Explorer 7.0 Has Bugs With Layout Display in Strict Mode!!!
        $xhtml = '<?xml version="1.0" encoding="' . $encoding . '"?>' . $nl;
        //$xhtml .= '<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.1//EN" "http://www.w3.org/TR/xhtml11/DTD/xhtml11.dtd">'.$nl;
        $xhtml .= '<!DOCTYPE html>' . $nl;
        $xhtml .= '<html xmlns="http://www.w3.org/1999/xhtml">' . $nl;
        /* Language - EN default */
        $language = $this->getLanguage();
        if ($language == null)
            $language = "en";
        $xhtml .= '<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="' . $language . '">' . $nl;
        // START: HEAD
        $xhtml .= '<head>' . $nl;
        /* Meta tags */
        foreach ($this->metas as $meta => $content) {
            $xhtml .= $tab . '<meta http-equiv="' . $meta . '" content="' . $content . '" />' . $nl;
        }
        /* Title */
        $xhtml .= $tab . '<title>' . $this->getProperty('title') . '</title>' . $nl;
        /* Favicon */
        if ($this->getProperty("favicon") != null)
            $xhtml .= $tab . '<link rel="icon" href="' . $this->getProperty("favicon") . '" type="image/x-icon" />' . $nl;
        /* CSS and JavaScript */
        $xhtml .= 'S_INLINE_CSS_AND_SCRIPTS';
        $xhtml .= '</head>' . $nl;
        // END HEAD
        // START: BODY
        $xhtml .= '<body' . $this->attributesToHtml() . $this->cssToHtml() . '>' . $nl;
        if (count($this->children) < 1)
            $this->children[] = '<p>&nbsp;</p>'; // Empty space to validate the empty page
        foreach ($this->children as $child) {
            if (is_object($child) && is_subclass_of($child, "Sinevia\Html\Element")) {
                $xhtml .= $child->toXhtml($compressed, $level + 1) . $nl;
            } else {
                $xhtml .= $indent . $tab . $child . $nl;
            }
        }
        $xhtml .= '</body>' . $nl;
        // END: BODY
        $xhtml .= '</html>';

        // GETTING THE CSS AND JS :: HACK IN ORDER TO INITIALIZE ALL
        $inline_css_and_scripts = "";
        /* External CSS Files */
        $inline_css_and_scripts .= $this->_get_css_files($tab, $nl);
        /* Inline CSS Styles */
        $inline_css_and_scripts .= $this->_get_css($tab, $nl);
        /* External JavaScript Files */
        $inline_css_and_scripts .= $this->_get_js_files($tab, $nl);
        /* Inline JavaScript Scripts */
        $inline_css_and_scripts .= $this->_get_js($tab, $nl);
        /* Adding all (external and inline) CSS and JavaScript */
        $xhtml = implode($inline_css_and_scripts, explode('S_INLINE_CSS_AND_SCRIPTS', $xhtml));
        return $xhtml;
    }

    private function _get_css($tab = "", $nl = "") {
        $inline_css_and_scripts = "";
        foreach ($this->css as $css) {
            $inline_css_and_scripts .= $tab . '<style type="text/css">' . $css . '</style>' . $nl;
        }
        $children = $this->childrenTraverse();
        foreach ($children as $child) {
            if ($child instanceof Element) {
                foreach ($child->css as $css) {
                    $inline_css_and_scripts .= $tab . '<style type="text/css">' . $css . '</style>' . $nl;
                }
            }
        }
        return $inline_css_and_scripts;
    }

    private function _get_css_files($tab = "", $nl = "") {
        $inline_css_and_scripts = "";
        foreach ($this->css_files as $css) {
            if ($this->getOutput() == "html") {
                $inline_css_and_scripts .= $tab . '<link rel="stylesheet" type="text/css" media="all" href="' . $css . '">' . $nl;
            } else {
                $inline_css_and_scripts .= $tab . '<link rel="stylesheet" type="text/css" media="all" href="' . $css . '" />' . $nl;
            }
        }
        $children = $this->childrenTraverse();
        foreach ($children as $child) {
            if ($child instanceof Element) {
                foreach ($child->css_files as $css) {
                    if ($this->getOutput() == "html") {
                        $inline_css_and_scripts .= $tab . '<link rel="stylesheet" type="text/css" media="all" href="' . $css . '">' . $nl;
                    } else {
                        $inline_css_and_scripts .= $tab . '<link rel="stylesheet" type="text/css" media="all" href="' . $css . '" />' . $nl;
                    }
                }
            }
        }
        return $inline_css_and_scripts;
    }

    private function _get_js($tab = "", $nl = "") {
        $inline_css_and_scripts = "";
        foreach ($this->js as $js) {
            $inline_css_and_scripts .= $tab . '<script type="text/javascript">' . $js . '</script>' . $nl;
        }
        $children = $this->childrenTraverse();
        foreach ($children as $child) {
            if ($child instanceof Element) {
                foreach ($child->js as $js) {
                    $inline_css_and_scripts .= $tab . '<script type="text/javascript">' . $js . '</script>' . $nl;
                }
            }
        }
        return $inline_css_and_scripts;
    }

    private function _get_js_files($tab = "", $nl = "") {
        $inline_css_and_scripts = "";
        $js_files = $this->js_files;
        foreach ($this->childrenTraverse() as $child) {
            if ($child instanceof Element) {
                $js_files = array_merge($js_files, $child->js_files);
            }
        }
        $js_files = array_unique($js_files);
        foreach ($js_files as $js) {
            $inline_css_and_scripts .= $tab . '<script src="' . $js . '" type="text/javascript"></script>' . $nl;
        }
        return $inline_css_and_scripts;
    }

}

//===========================================================================//
// CLASS: Webpage                                                            //
//============================== END OF CLASS ===============================//
