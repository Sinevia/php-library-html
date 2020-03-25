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

trait ElementJavaScriptTrait {
    protected $js = array();        // Inline JavaScript
    protected $js_files = array();  // External JS Files

    /**
     * Adds an inline JavaScript to this Element
     * @return Element or an instance of this Element
     * @throws \InvalidArgumentException if the supplied argument is not String
     * @access public
     */
    function addJavaScript($js, $priority=0) {
        if (is_string($js) == false) {
            throw new \InvalidArgumentException('In class ' . get_class($this) . ' in method setJavaScipt($id): Parameter $js MUST BE of type String - ' . gettype($js) . ' given!');
        }
        $this->js[] = [$js, $priority, 'script'];
        return $this;
    }

    /**
     * Adds a JavaScript file to the Element
     * @param string $js_file
     * @return Element an instance of this Element
     */
    function addJavaScriptFile($js_file, $priority=0) {
        $this->js_files[] = [$js_file, $priority, 'file'];
        return $this;
    }



    /**
     * Deprecated Use addJavaScript.
     * @return Element or an instance of this Element
     * @throws \InvalidArgumentException if the supplied argument is not String
     * @access public
     */
    function setJavaScript($js) {
        if (is_string($js) == false) {
            throw new \InvalidArgumentException('In class ' . get_class($this) . ' in method setJavaScipt($id): Parameter $js MUST BE of type String - ' . gettype($js) . ' given!');
        }
        $this->addJavaScript($js, 0); // No priority
        return $this;
    }

    /**
     * Deprecated. Use addJavaScriptFile
     * @param string $js_file
     * @return Element
     */
    function setJavaScriptFile($js_file) {
        $this->js_files[] = $js_file;
        return $this;
    }

    protected function _get_js($tab = "", $nl = "") {
        if($this->hasParent()==true){
            return ''; 
        }
        $scripts = array_merge($this->js, $this->js_files);
        $children = $this->childrenTraverse();
        foreach ($children as $child) {
            if ($child instanceof Element) {
                foreach ($child->js as $entry) {
                    $scripts[] = $entry;
                }
                foreach ($child->js_files as $entry) {
                    $scripts[] = $entry;
                }
            }
        }

        // Unify
        foreach ($scripts as $index=>$entry) {
            if(is_array($entry)){
                $js = $entry[0] ?? '';
                $priority = $entry[1] ?? 0;
                $type = $entry[2] ?? 'script';
            } else {
                $js = $entry;
                $priority = 0;
                $type = 'script';
            }
            $scripts[$index] = [$js, $priority, $type];
        }

        array_multisort (array_column($scripts, 1), SORT_NUMERIC, SORT_DESC, $scripts); // Sort by priority

        $html = "";
        foreach ($scripts as $script) {
            $js = $script[0];
            $type = $script[2];

            if ($type == "file") {
                $html .= $tab . '<script type="text/javascript" src="' . $js . '"></script>' . $nl;
            }
            if ($type == "script") {
                $html .= $tab . '<script type="text/javascript">' . $js . '</script>' . $nl;
            }
        }

        return $html;
    }
}