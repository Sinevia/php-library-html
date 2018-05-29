<?php

    /**
     * The FlowLayout arranges its children horizontally in one row or vertically in one column.
     * <code>
     * // Creating a new instance of FlowLayout
     * $flowlayout = new S_FlowLayout("vertical");
     *
     * // Using theshortcut function
     * $flowlayout = s_flow_layout()->flow("vertical");
     * </code>
     */
class FlowLayout extends Element {
	//========================= START OF METHOD ===========================//
    //  CONSTRUCTOR: __construct                                           //
    //=====================================================================//
       /**
        * The constructor of FlowLayout. As a default the FlowLayout stretches to fit its parent
        * widget.
        * @param integer width in pixels, or percentage value of the parent width
        * @param integer height in pixels, or percentage value of the parent height
        * @construct
        */
    function __construct($flow="vertical",$width="100%",$height="100%"){
        parent::__construct();
        $this->containers=array();
        $this->flow("vertical");
        $this->width($width);
        $this->height($height);
        $this->spacing("0");
        $this->padding("0");
        $this->attribute("border","0");
    }
	//=====================================================================//
    //  METHOD: __construct                                                //
    //========================== END OF METHOD ============================//
    
	//========================= START OF METHOD ===========================//
    //  METHOD: flow                                                       //
    //=====================================================================//
       /**
        * Sets or retrieves the flow of this FlowLayout. The flow might be
        * either "horizontal" or "vertical". The horizontal flow will add
        * the elements in one row startibg from left to right, while
        * the vertical flow will place the cjild element one under the other
        * from top to bottom
        * @param String "horizontal" or "vertical"
        * @return FlowLayout an instance of this FlowLayout
        */
    function flow($flow=null){
	    if(func_num_args()>0){
		    $allowed_params = array("horizontal","vertical");
		    if(is_string($flow==false)){trigger_error('ERROR: In class <b>'.get_class($this).'</b> in method <b>flow($flow)</b>: Parameter <b>$flow</b> MUST BE of type String('.implode(", ",$allowed_params).') - <b style="color:red">'.gettype($flow).'</b> given!',E_USER_ERROR);}
		    if(in_array($flow,$allowed_params)==false){
		        trigger_error('ERROR: In class <b>'.get_class($this).'</b> in method <b>flow($flow)</b>: Parameter <b>$flow</b> MUST BE of type String('.implode(", ",$allowed_params).') - <b style="color:red">'.gettype($flow).'</b> given!',E_USER_ERROR);
		    }
		    $this->property("flow",$flow);
	        return $this;
        }else{
	        return $this->property("flow");
	    }
	}
	//=====================================================================//
    //  METHOD: flow                                                       //
    //========================== END OF METHOD ============================//
	
    //========================= START OF METHOD ===========================//
    //  METHOD: child                                                      //
    //=====================================================================//
       /**
        * Adds a child widget to the specified position of this layout.
        * <code>
        * // Creating a new instance of BorderLayout
        * $flowlayout = new FlowLayout("vertical");
        * // Adding widget
        * $header = $flowlayout->add_child("HEADER");
        * $content = $flowlayout->add_child("CONTENT");
        * $footer = $flowlayout->add_child("FOOTER");
        * </code>
        * @param widget the widget to add
        * @param position the position to add the widget to
        * @return Widget the container containing this child
        * @return void
        */
    function child($widget,$position=null,$halign="center",$valign="middle"){
	    //echo "In FlowLayout adding:".$widget."<br/>";
	    //if(is_subclass_of($widget,"Widget"))echo "In add_child start CHILD UID: ".$widget->uid."PARENT UID: ".$this->uid."<br />";
	    if($position!=null && is_int($position)==false)trigger_error('Class <b>'.get_class($this).'</b> in method <b>add_child($widget,$position)</b>: Position Must Be Of Type Integer - <b>'.gettype($position).'</b> Given!',E_USER_ERROR);
	    if($position===null){$position = count($this->containers);}
	    $container = new S_Widget(); $container->parent = $this;
	        $container->widget = $widget;
	        if(is_object($widget) && is_subclass_of($widget,"S_Widget")){
		        $widget->parent($container);
		    }
	        $container->attribute("align",$halign);
	        $container->attribute("valign",$valign);
	        //$container->display("table-cell");
		$this->containers[$position] = $container;	ksort($this->containers);
		$this->children[]=$widget;
		//if(is_subclass_of($widget,"Widget"))echo "In add_child end CHILD UID:".$widget->uid." PARENT UID:".$widget->parent->uid."<br />";
		return $this;
    }
    //=====================================================================//
    //  METHOD: child                                                      //
    //========================== END OF METHOD ============================//
    
    //========================= START OF METHOD ===========================//
    //  METHOD: padding                                                    //
    //=====================================================================//
       /**
        * Sets or retrieves the padding of the cells of this FlowLayout.
        * @param Integer the cells' padding
        * @return mixed the spacing (as Integer) or an instance of this Panel
        */
    function padding($padding=null,$left=0,$bottom=0,$right=0){
	    if(func_num_args()>0){
		    if(is_int($padding==false)){trigger_error('ERROR: In class <b>'.get_class($this).'</b> in method <b>padding($padding)</b>: Parameter <b>$padding</b> MUST BE of type Integer - <b style="color:red">'.gettype($padding).'</b> given!',E_USER_ERROR);}
		    $this->attribute("cellpadding",(string)$padding);
	        return $this;
        }else{
	        return $this->attribute("cellpadding");
	    }
	}
	//=====================================================================//
    //  METHOD: padding                                                    //
    //========================== END OF METHOD ============================//
    
    //========================= START OF METHOD ===========================//
    //  METHOD: spacing                                                    //
    //=====================================================================//
       /**
        * Sets or retrieves the spacing between the cells of this GridLayout.
        * @param Integer the spacing between cells
        * @return mixed the spacing (as Integer) or an instance of this GridLayout
        */
    function spacing($spacing){
	    if(func_num_args()>0){
		    if(is_int($spacing==false)){trigger_error('ERROR: In class <b>'.get_class($this).'</b> in method <b>spacing($spacing)</b>: Parameter <b>$spacing</b> MUST BE of type Integer - <b style="color:red">'.gettype($spacing).'</b> given!',E_USER_ERROR);}
		    $this->attribute("cellspacing",(string)$spacing);
	        return $this;
        }else{
	        return $this->attribute("cellspacing");
	    }
	}
	//=====================================================================//
    //  METHOD: spacing                                                    //
    //========================== END OF METHOD ============================//
    
    //========================= START OF METHOD ===========================//
    //  METHOD: width                                                      //
    //=====================================================================//
       /** Sets or retrieves the width of this GridLayout.
         * @return mixed The width in pixels or percentage or an instance of this Widget
         * @access public
         */
    function width($width=null){
	    if(func_num_args()>0){
		    if(s::str_ends_with($width,"%")){
			    $this->attribute("width",$width);
	        }else{
		        $this->attribute('width',(string)$width);
		    }
		    return $this;
		}else{
			$width = $this->attribute('width');
			return is_numeric($width)?(int)$width:$width;
		}
	}
	//=====================================================================//
    //  METHOD: __width                                                    //
    //========================== END OF METHOD ============================//
    
    //========================= START OF METHOD ===========================//
    //  METHOD: to_html                                                    //
    //=====================================================================//
       /**
        * Returns the HTML representation of this BorderLayout with its children.
        * @param compressed compresses the HTML, removing the new lines and indent
        * @param level the level of this widget
        * @return String html string
        */
    function toHtml($compressed=true,$level=0){
        if($compressed==false){$nl = "\n";$tab="    ";$indent=str_pad("",($level*4));}else{$nl="";$tab="";$indent="";}
        if(count($this->containers)==0)$this->child(s_label()->text("&nbsp;"));
        $html = $indent.'<table'; if(count($this->attribute)>0){$html .= $this->attributes_to_html();} if(count($this->style)>0){$html .= ' '.$this->styles_to_html();} $html .= '>'.$nl;
		if($this->property("flow")=="vertical"){		
			foreach($this->containers as $container){
				$html .= $indent.$tab.'<tr>'.$nl;
				$html .= $indent.$tab.$tab.'<td';if(count($container->attribute)>0){$html .= $container->attributes_to_html();} if(count($container->style)>0){$html .= ' '.$container->styles_to_html();} $html .= '>'.$nl;
				if(is_object($container->widget)==true&&is_subclass_of($container->widget,"S_Widget")){
        		    $html.=$container->widget->to_html($compressed,($level+3)).$nl;
    		    }else{
	    		    if($container->widget==""){$html.=$indent.$tab.$tab.$tab."&nbsp;".$nl;}else{$html.=$indent.$tab.$tab.$tab.$container->widget.$nl;}
                }
                $html.=$indent.$tab.$tab.'</td>'.$nl;
    		    $html.=$indent.$tab.'</tr>'.$nl;
		    }
		}else{
			$html .= $indent.$tab.'<tr>'.$nl;
			foreach($this->containers as $container){
				$html .= $indent.$tab.$tab.'<td';if(count($container->attribute)>0){$html .= $container->attributes_to_html();} if(count($container->style)>0){$html .= ' '.$container->styles_to_html();} $html .= '>'.$nl;
				if(is_object($container->widget)==true&&is_subclass_of($container->widget,"S_Widget")){
        		    $html.=$container->widget->to_html($compressed,($level+3)).$nl;
    		    }else{
	    		    if($container->widget==""){$html.=$indent.$tab.$tab.$tab."&nbsp;".$nl;}else{$html.=$indent.$tab.$tab.$tab.$container->widget.$nl;}
                }
                $html.=$indent.$tab.$tab.'</td>'.$nl;
		    }
		    $html.=$indent.$tab.'</tr>'.$nl;
	    }
		$html .= $indent.'</table>';
		return $html;
    }
    //=====================================================================//
    //  METHOD: to_html                                                    //
    //========================== END OF METHOD ============================//
    
    //========================= START OF METHOD ===========================//
    //  METHOD: to_xhtml                                                    //
    //=====================================================================//
       /**
        * Returns the XHTML representation of this FlowLayout with its children.
        * @param compressed compresses the XHTML, removing the new lines and indent
        * @param level the level of this widget
        * @return String html string
        */
    function toXhtml($compressed=true,$level=0){
        if($compressed==false){$nl = "\n";$tab="    ";$indent=str_pad("",($level*4));}else{$nl="";$tab="";$indent="";}
        if(count($this->containers)==0)$this->child(s::label()->text("&nbsp;"));
        $html = $indent.'<table'; if(count($this->attribute)>0){$html .= $this->attributes_to_html();} if(count($this->style)>0){$html .= ' '.$this->styles_to_html();} $html .= '>'.$nl;
		if($this->property("flow")=="vertical"){
			foreach($this->containers as $container){
				// START: Vertical Align
				if($container->valign()!==null)$container->attribute("valign",$container->valign());
				// END: Vertical Align
				$html .= $indent.$tab.'<tr>'.$nl;
				$html .= $indent.$tab.$tab.'<td';if(count($container->attribute)>0){$html .= $container->attributes_to_html();} if(count($container->style)>0){$html .= ' '.$container->styles_to_html();} $html .= '>'.$nl;
				if(is_object($container->widget)==true&&is_subclass_of($container->widget,"S_Widget")){
        		    $html.=$container->widget->to_xhtml($compressed,($level+3)).$nl;
    		    }else{
	    		    if($container->widget==""){$html.=$indent.$tab.$tab.$tab."&nbsp;".$nl;}else{$html.=$indent.$tab.$tab.$tab.$container->widget.$nl;}
                }
                $html.=$indent.$tab.$tab.'</td>'.$nl;
    		    $html.=$indent.$tab.'</tr>'.$nl;
		    }
		}else{
			$html .= $indent.$tab.'<tr>'.$nl;
			foreach($this->containers as $container){
				// START: Vertical Align
				if($container->valign()!==null)$container->attribute("valign",$container->valign());
				// END: Vertical Align
				$html .= $indent.$tab.$tab.'<td';if(count($container->attribute)>0){$html .= $container->attributes_to_html();} if(count($container->style)>0){$html .= ' '.$container->styles_to_html();} $html .= '>'.$nl;
				if(is_object($container->widget)==true&&is_subclass_of($container->widget,"S_Widget")){
        		    $html.=$container->widget->to_xhtml($compressed,($level+3)).$nl;
    		    }else{
	    		    if($container->widget==""){$html.=$indent.$tab.$tab.$tab."&nbsp;".$nl;}else{$html.=$indent.$tab.$tab.$tab.$container->widget.$nl;}
                }
                $html.=$indent.$tab.$tab.'</td>'.$nl;
		    }
		    $html.=$indent.$tab.'</tr>'.$nl;
	    }
		$html .= $indent.'</table>';
		return $html;
    }
    //=====================================================================//
    //  METHOD: to_xhtml                                                    //
    //========================== END OF METHOD ============================//
}
