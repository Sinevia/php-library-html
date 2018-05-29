<?php
/**
 * @package GUI
 */
//============================= START OF CLASS ==============================//
// CLASS: SplitPanel                                                       //
//===========================================================================//
   /**
    * The SplitPanel class creates a splitted panel.
    * WARNING: Works only with IE and Mozilla Firefox. Opera support pending.
    * <code>
    * // Creating a new SplitPanel
    * $split_panel = new S_SplitPanel();
    *   $split_panel->flow("vertical");
    *   $split_panel->child("LEFT","center","middle");
    *   $split_panel->child("RIGHT","left","top");
    *
    * // The same as above using the shortcut function and method chaining
    * $split_panel = s_split_panel()->flow("vertical");
    *     $split_panel->child("LEFT","center","middle")->child("RIGHT","left","top");
    * </code>
    * @package GUI
    * @todo Opera Support, TEST
    */
class SplitPanel extends FlowLayout{
	protected $divider;
	protected $image = array();
    //========================= START OF METHOD ===========================//
    //  CONSTRUCTOR: __construct                                           //
    //=====================================================================//
       /**
        * The constructor of this SplitPanel.
        * @construct
        */
	function __construct(){
		parent::__construct();
		$this->js_file(s::surl()."/includes/js/jquery.js");
        $this->js_file(s::surl()."/includes/js/simplest.js");
        $this->js_file(s::surl()."/includes/js/jquery.ui/ui.mouse.js");
        $this->js_file(s::surl()."/includes/js/jquery.ui/ui.draggable.js");
	}
    //=====================================================================//
    //  CONSTRUCTOR: __construct                                           //
    //========================== END OF METHOD ============================//
    
    //========================= START OF METHOD ===========================//
    //  METHOD: child                                                      //
    //=====================================================================//
       /**
        * Adds a child widget to this SplitPanel
        * Only to children are allowed
        * @param Boolean whether the HTML output should be compressed
        * @param Integer the level of nesting of this widget
        * @return String the HTML representation of this widget
        */
	function child($widget,$position=null,$halign="center",$valign="middle"){
		if(count($this->containers)==2){
			s::exception('TooMuchChildrenException','In class <b>'.get_class($this).'</b> in method <b>child($widget,$position=null,$halign="center",$valign="middle")</b>: Trying to add more than two children. Only two are allowed!');
		}
	    if(count($this->containers)==1){
	    	$container = new S_Widget(); $container->parent = $this;
	    	$container->widget = "&nbsp;";
	        $container->attribute("align",$halign);
	        $container->attribute("valign",$valign);
	        $container->style("font-size","1px");
	        $this->divider = $container;
		    $this->containers[$position] = $container;	
		}
		return parent::child($widget,$position,$halign,$valign);
	}
    //=====================================================================//
    //  METHOD: child                                                      //
    //========================== END OF METHOD ============================//
    
    //========================= START OF METHOD ===========================//
    //  METHOD: divider                                                   //
    //=====================================================================//
       /**
        * Returns the divider widget of this SplitPanel
        * @return S_Widget the divider of this SplitPanel
        */
	function divider(){
		return $this->divider;
	}
    //=====================================================================//
    //  METHOD: divider                                                    //
    //========================== END OF METHOD ============================//
	
    //========================= START OF METHOD ===========================//
    //  METHOD: divider_image                                              //
    //=====================================================================//
       /**
        * Sets a divider image to this SplitPanel.
        * If not set the default divider image of the framework is shown.
        * @param S_Image the divider image to be shown
        * @param String the horizontal alignment of the image (left,center,right)
        * @param String the vertical alignment of the image (top,middle,bottom)
        * @return S_SplitPanel the instance of this SplitPanel
        */
	function divider_image($image,$halign="center",$valign="middle"){
		$this->image = array("image"=>$image,"halign"=>$halign,"valign"=>$valign);
		return $this;		
	}
    //=====================================================================//
    //  METHOD: divider_image                                              //
    //========================== END OF METHOD ============================//
    
    //========================= START OF METHOD ===========================//
    //  METHOD: step                                                       //
    //=====================================================================//
       /**
        * Sets the step of this SplitPanel divider.
        * In order the divider to be placed exactly under the mouse pointer,
        * this method should be put for every browser. The exact step differs
        * according to the individual settings of your SplitPanel, and the
        * image set for the divider. 
        * @param Integer the steps of the divider
        * @param String the browser name ("ie","mozilla") //Opera not supported
        * @return S_SplitPanel the instance of this SplitPanel
        * @todo Opera support
        */
	function step($step,$browser){
		if($browser=="ie")$this->property("step-ie",$step);
		if($browser=="mozilla")$this->property("step-moz",$step);
		return $this;
	}
    //=====================================================================//
    //  METHOD: step                                                       //
    //========================== END OF METHOD ============================//
    
    //========================= START OF METHOD ===========================//
    //  METHOD: to_html                                                    //
    //=====================================================================//
       /**
        * Returns the HTML representation of this SplitPanel
        * @param Boolean whether the HTML output should be compressed
        * @param Integer the level of nesting of this widget
        * @return String the HTML representation of this widget
        */
    function to_html($compressed=true,$level=0){
        return $this->to_xhtml($compressed,$level);
    }
    //=====================================================================//
    //  METHOD: to_html                                                    //
    //========================== END OF METHOD ============================//
    
    //========================= START OF METHOD ===========================//
    //  METHOD: to_xhtml                                                   //
    //=====================================================================//
       /**
        * Returns the XHTML representation of this SplitPanel
        * @param Boolean whether the XHTML output should be compressed
        * @param Integer the level of nesting of this widget
        * @return String the XHTML representation of this widget
        */
	function to_xhtml($compressed=true,$level=0){
		if(count($this->children)==0){$this->child(new S_Label());$this->child(new S_Label());}
		// Applying image
		if(count($this->image)==0){
			if($this->flow()=="horizontal"){
				$image = new S_Image(); $image->url(s::surl()."/images/splitter-h.jpg");
				$this->divider_image($image);
			}else{
				$image = new S_Image(); $image->url(s::surl()."/images/splitter-v.jpg");
				$this->divider_image($image);
			}
		}
		$this->divider->widget = $this->image["image"];
	    $this->divider->attribute("align",$this->image["halign"]);
	    $this->divider->attribute("valign",$this->image["valign"]);
	    //Applying step
	    $step="";
	    if($this->property("step-ie")){$step.=".step('".$this->property("step-ie")."','ie')";}
	    if($this->property("step-moz")){$step.=".step('".$this->property("step-moz")."','mozilla')";}
		//Adding initiating JavaScript
		$this->js("$(document).ready(function(){ s_split_panel('".$this->divider->id()."')".$step.";});");
	        
		if($this->property("flow")=="vertical"){
			if($this->divider->height()==null)$this->divider->height(2);
		}else{
			if($this->divider->width()==null)$this->divider->width(2);
		}
		return parent::to_xhtml($compressed,$level);
	}
    //=====================================================================//
    //  METHOD: to_xhtml                                                   //
    //========================== END OF METHOD ============================//
}
//===========================================================================//
// CLASS: S_SplitPanel                                                       //
//============================== END OF CLASS ===============================//
