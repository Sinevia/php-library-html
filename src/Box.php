<?php

namespace Sinevia\Html;

//============================= START OF CLASS ==============================//
// CLASS: Box                                                              //
//===========================================================================//
/**
 * The Box class provides widget for layout of different componets.
 * When adding a title to it, it displays a nice titled box.
 * <code>
 * $box = new S_Box();
 *     $box->title("TITLE")->border(1,"solid",black);
 *     $box->title()->background("black")->foreground("white");
 *     $box->child("CONTENT 1",null,"left");
 *     $box->child("CONTENT 2",null,"center");
 *     $box->child("CONTENT 2",null,"right");
 * $template->display();
 * </code>
 * @package GUI
 */
class Box extends BorderLayout {

    private $content_layout = false;

    final public function __construct() {
        parent::__construct();
        $this->setWidth(0);
        $this->setHeight(1);
        $this->content_layout = new FlowLayout();
        parent::addChild($this->content_layout, "center");
    }

    function addChild($widget, $position = null, $halign = "center", $valign = "middle") {
        $this->content_layout->addChild($widget, null, $halign, $valign);
        return $this;
    }

    function getTitle() {
        return $this->getProperty('title');
    }

    function setTitle($title = null, $halign = "center", $valign = "middle") {
        if (is_string($title) == false && ($title instanceof S_Label) == false) {
            trigger_error('ERROR: In class <b>' . get_class($this) . '</b> in method <b>title($title)</b>: Parameter <b>$title</b> MUST BE of type String or S_Label - <b style="color:red">' . gettype($title) . '</b> given!', E_USER_ERROR);
        }
        if (is_string($title)) {
            $label = new Span();
            $label->addChild($title);
        }
        $label->setCss("display", "block");
        $this->setProperty('title', $label);
        parent::addChild($label, "top", $halign, $valign);
        return $this;
    }

    function setSkin($skin) {
        if (is_string($skin) == false && ($skin instanceof Skin) == false) {
            trigger_error('ERROR: In class <b>' . get_class($this) . '</b> in method <b>title($title)</b>: Parameter <b>$title</b> MUST BE of type String or S_Skin - <b style="color:red">' . gettype($skin) . '</b> given!', E_USER_ERROR);
        }
        if (($skin instanceof Skin)) {
            $skin->apply($this);
        } else {
            try {
                $skin_name = $skin . "_Skin";
                $skin = new $skin_name();
                $skin->apply($this);
            } catch (Exception $e) {
                
            }
        }
        return $this;
    }

}
