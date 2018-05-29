<?php

   /**
    * An HTML MenuItem widget for the Menu.
    * <code>
    * $menu_item = new S_MenuItem();
    *     $menu_item->child("Help");
    *     $menu_item->mouse_over_color("beige");
    *     $menu_item->mouse_out_color("white");
    *
    * // The same as above using the shortcut function and method chaining
    * $menu_item = s_menu_item()->child("Help")->mouse_over_color("beige")->mouse_out_color("white");
    * </code>
    * @package GUI
    */
class MenuItem extends Element {
    private $submenu = null;
	function __construct(){
        parent::__construct();
        $this->widget = "&nbsp;";
        if(is_object($this->widget) && is_subclass_of($this->widget,"Widget")){ $this->widget->set_style("display","block"); }
        $this->style("text-align","left");
        $this->level = 0;
        $this->submenu = null;
    }
    function child($widget,$position=null){
	    parent::child($widget,$position);
	    if($widget instanceof S_Menu){
		    $widget->level = $this->level+1;
		    $this->submenu = $widget;
		}else{
			$this->widget = $widget;
		}
		return $this;
	}
    function alignment($alignment){
	    if(func_num_args()>0){
		    $allowed_params = array("left","center","right");
		    if(is_string($alignment==false)){trigger_error('ERROR: In class <b>'.get_class($this).'</b> in method <b>alignment($alignment)</b>: Parameter <b>$alignment</b> MUST BE of type String('.implode(", ",$allowed_params).') - <b style="color:red">'.gettype($alignment).'</b> given!',E_USER_ERROR);}
		    if(in_array($alignment,$allowed_params)==false){
		        trigger_error('ERROR: In class <b>'.get_class($this).'</b> in method <b>alignment($alignment)</b>: Parameter <b>$alignment</b> MUST BE of type String('.implode(", ",$allowed_params).') - <b style="color:red">'.$alignment.'</b> given!',E_USER_ERROR);
		    }
	        $this->style("text-align",$alignment);
	        return $this;
        }else{
	        return $this->style("text-align");
	    }
	}
    function mouse_over_color($color){
	    if(func_num_args()>0){
		    if(is_string($color==false)){throw new IllegalArgumentException('In class <b>'.get_class($this).'</b> in method <b>mouse_over_color($color)</b>: Parameter <b>$color</b> MUST BE of type String - <b style="color:red">'.gettype($color).'</b> given!',E_USER_ERROR);}
		    $this->property("mouseovercolor",$color);
		    $this->on_mouse_over('this.style.background="'.$color.'"');
			return $this;
        }else{
	        return $this->property("mouseovercolor");
	    }		
	}
	function mouse_out_color($color){
		if(func_num_args()>0){
		    if(is_string($color==false)){throw new IllegalArgumentException('In class <b>'.get_class($this).'</b> in method <b>mouse_out_color($color)</b>: Parameter <b>$color</b> MUST BE of type String - <b style="color:red">'.gettype($color).'</b> given!',E_USER_ERROR);}
		    $this->property("mouseoutcolor",$color);
		    $this->on_mouse_out('this.style.background="'.$color.'"');
			return $this;
        }else{
	        return $this->property("mouseoutcolor");
	    }	
		
		return $this;
	}
	function mouse_over_image($image,$repeat=true){
		$this->set_property("mouseoverimage",$image);
		$this->on_mouse_over('this.style.backgroundImage="url('.$image.')";');
		if($repeat==true){
			$this->on_mouse_over('this.style.backgroundRepeat="repeat"');
		}
		return $this;
	}
	function mouse_out_image($image,$repeat=true){
		$this->set_property("mouseoutimage",$image);
		$this->on_mouse_out('this.style.backgroundImage="url('.$image.')";');
		if($repeat==true){
			$this->on_mouse_out('this.style.backgroundRepeat="repeat"');
		}
		return $this;
	}
    //========================= START OF METHOD ===========================//
    //  METHOD: to_html                                                    //
    //=====================================================================//
       /**
        * Returns the HTML representation of this MenuItem with its children.
        * @param compressed compresses the HTML, removing the new lines and indent
        * @param level the level of this widget
        * @return String html string
        */
    function to_html($compressed=true,$level=0){
        if($compressed==false){$nl = "\n";$tab="    ";$indent=str_pad("",($level*4));}else{$nl="";$tab="";$indent="";}
        // Setting the submenu id
        if($this->submenu!=null){
	        $submenu_id = $this->submenu->get_id();
	        if(is_null($submenu_id)){$submenu_id = $this->submenu->uid; $this->submenu->set_id($submenu_id); }
	        $this->on_mouse_over('document.getElementById("'.$submenu_id.'").style.display="block";');
	        $this->on_mouse_out('document.getElementById("'.$submenu_id.'").style.display="none";');
	    }
	    
	    // Displaying the element
	    $this->style("position","relative"); /* make the list elements a containing block for the nested lists */
	    $html = $indent.'<li'; if(count($this->attribute)>0){$html .= $this->attributes_to_html();} if(count($this->style)>0){$html .= ' '.$this->styles_to_html();} $html .= '>'.$nl;
		if(is_object($this->widget) && is_subclass_of($this->widget,"S_Widget")){
			if($this->widget instanceof S_Hyperlink && $this->widget->image!=null){$this->widget->set_style("text-decoration","none");}
		    $html .= $this->widget->to_html($compressed,$level+1).$nl;
	    }else{
		    $html .= $indent.$tab.$this->widget.$nl;
		}
		// Displaying the submenu, if such exists
        foreach($this->children as $child){
	        if($child instanceof Menu){
		        $child->style("display","none");
		        if($this->style("float")=="left"){
			        $child->style("top", "100%"); // y - under containing li element
			        $child->style("left", "0px"); // x - under containing li element
			    }else{
				    $child->style("top", "0px");    // y - next to containing li element
				    $child->style("left", "100%");  // x - right of containing li element
		        }
		        $child->style("width", "100%"); // width based on containing li element
		        $child->style("position", "absolute");
		        $child->style("z-index", "500");
		        if(mvcs_browser_detection("browser")=="ie"){
			        $child->style("float", "left");
			    }
		        //$child->set_style("margin-left",($child->level*15).'px');
		        $html .= $child->to_html($compressed,$level+1).$nl;
	        }
	    }		    
	    $html .= $indent.'</li>';
		return $html;
    }
    //=====================================================================//
    //  METHOD: to_html                                                    //
    //========================== END OF METHOD ============================//
    
    //========================= START OF METHOD ===========================//
    //  METHOD: to_xhtml                                                   //
    //=====================================================================//
       /**
        * Returns the XHTML representation of this MenuItem with its children.
        * @param compressed compresses the HTML, removing the new lines and indent
        * @param level the level of this widget
        * @return String html string
        */
    function to_xhtml($compressed=true,$level=0){
        if($compressed==false){$nl = "\n";$tab="    ";$indent=str_pad("",($level*4));}else{$nl="";$tab="";$indent="";}
        // Setting the submenu id
        if($this->submenu!=null){
	        $submenu_id = $this->submenu->id();
	        $this->on_mouse_over('document.getElementById("'.$submenu_id.'").style.display="block";');
	        $this->on_mouse_out('document.getElementById("'.$submenu_id.'").style.display="none";');
	    }
	    
	    // Displaying the element
	    $this->style("position","relative"); /* make the list elements a containing block for the nested lists */
	    $html = $indent.'<li'; if(count($this->attribute)>0){$html .= $this->attributes_to_html();} if(count($this->style)>0){$html .= ' '.$this->styles_to_html();} $html .= '>'.$nl;
		if(is_object($this->widget) && is_subclass_of($this->widget,"S_Widget")){
			if($this->widget instanceof S_Hyperlink && $this->widget->image()!=null){$this->widget->style("text-decoration","none");}
		    $html .= $this->widget->to_xhtml($compressed,$level+1).$nl;
	    }else{
		    $html .= $indent.$tab.$this->widget.$nl;
		}
		// Displaying the submenu, if such exists
        foreach($this->children as $child){
	        if($child instanceof S_Menu){
		        $child->style("display","none");
		        if($this->style("float")=="left"){
			        $child->style("top", "100%"); // y - under containing li element
			        $child->style("left", "0px"); // x - under containing li element
			    }else{
				    $child->style("top", "0px");    // y - next to containing li element
				    $child->style("left", "100%");  // x - right of containing li element
		        }
		        if($child->style("width")==null){
			        $child->style("width", "100%"); // width based on containing li element
		        }
		        $child->style("position", "absolute");
		        $child->style("z-index", "500");
		        if(s::browser_detection("browser")=="ie"){
			        $child->style("float", "left");
			    }
		        //$child->set_style("margin-left",($child->level*15).'px');
		        $html .= $child->to_xhtml($compressed,$level+1).$nl;
	        }
	    }		    
	    $html .= $indent.'</li>';
		return $html;
    }
    //=====================================================================//
    //  METHOD: to_xhtml                                                   //
    //========================== END OF METHOD ============================//
}
