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
class Box extends BorderLayout{
	private $content_layout = false;
    final public function __construct(){
	    parent::__construct();
		$this->width(0); $this->height(1);		    
		$this->content_layout = new S_FlowLayout();
		parent::child($this->content_layout,"center");
	}
	function child($widget,$position=null,$halign="center",$valign="middle"){
	    $this->content_layout->child($widget,null,$halign,$valign);
		return $this;
	}
	function title($title=null,$halign="center",$valign="middle"){
	    if(func_num_args()>0){
		    if(is_string($title)==false&&($title instanceof S_Label)==false)trigger_error('ERROR: In class <b>'.get_class($this).'</b> in method <b>title($title)</b>: Parameter <b>$title</b> MUST BE of type String or S_Label - <b style="color:red">'.gettype($title).'</b> given!',E_USER_ERROR);
		    if(is_string($title)){$label = new S_Label();$label->text($title);}
				$label->style("display","block");
		    $this->property('title',$label);
			parent::child($label,"top",$halign,$valign);
		    return $this;
		}else{
			return $this->property('title');
		}
	}
	function skin($skin){
	    if(is_string($skin)==false&&($skin instanceof S_Skin)==false)trigger_error('ERROR: In class <b>'.get_class($this).'</b> in method <b>title($title)</b>: Parameter <b>$title</b> MUST BE of type String or S_Skin - <b style="color:red">'.gettype($skin).'</b> given!',E_USER_ERROR);
		if(($skin instanceof S_Skin)){
		    $skin->apply($this);
		}else{
		    try{
		        $skin_name = $skin."_Skin";
		        $skin = new $skin_name();
			    $skin->apply($this);
		    }catch(Exception $e){}
		}
		return $this;
	}
}
