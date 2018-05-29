<?php

//============================= START OF CLASS ==============================//
// CLASS: GridLayout                                                         //
//===========================================================================//
    /**
     * The GridLayout arranges its children table alike in rows and columns.
     * <code>
     * // Creating a new instance of GridLayout
     * $flowlayout = new GridLayout(2);
     * </code>
     */
class GridLayout extends Element {
	//========================= START OF METHOD ===========================//
    //  CONSTRUCTOR: __construct                                           //
    //=====================================================================//
       /**
        * The constructor of GridLayout. As a default the GridLayout stretches to fit its parent
        * widget.
        * @construct
        */
    function __construct($columns=2,$width="100%",$height="100%"){
        parent::__construct();
        $this->containers=array();
        $this->width($width);
        $this->height($height);
        $this->spacing(0);
        $this->padding(0);
        $this->attribute("border","0");
        //$this->display("table");
        // Columns
	    $this->columns($columns);
    }
    //=====================================================================//
    //  CONSTRUCTOR: __construct                                           //
    //========================== END OF METHOD ============================//
    
	//========================= START OF METHOD ===========================//
    //  METHOD: columns                                                    //
    //=====================================================================//
       /**
        * Sets or retrieves the columns of this GridLayout.
        * @param Integer the number of columns
        * @return mixed the number of columns (as Integer) or an instance of this GridLayout
        */
    function columns($columns){
	    if(func_num_args()>0){
		    if(is_int($columns==false)){trigger_error('ERROR: In class <b>'.get_class($this).'</b> in method <b>columns($columns)</b>: Parameter <b>$columns</b> MUST BE of type Integer - <b style="color:red">'.gettype($columns).'</b> given!',E_USER_ERROR);}
		    $this->property("columns",$columns);
	        return $this;
        }else{
	        return $this->property("columns");
	    }
	}
	//=====================================================================//
    //  METHOD: columns                                                    //
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
    //  METHOD: child                                                      //
    //=====================================================================//
       /**
        * Adds a child widget to the specified position of this layout.
        * <code>
        * // Creating a new instance of GridLayout
        * $grid_layout = new GridLayout("vertical");
        * // Adding widgets
        * //TODO
        * </code>
        * @param widget the widget to add
        * @param position the position to add the widget to
        * @return Widget the container containing this child
        * @return void
        */
    function child($widget,$position=null,$align="center",$valign="middle"){
	    //if(is_subclass_of($widget,"Widget"))echo "In add_child start CHILD UID: ".$widget->uid."PARENT UID: ".$this->uid."<br />";
	    if($position!=null && is_int($position)==false)trigger_error('Class <b>'.get_class($this).'</b> in method <b>add_child($widget,$position)</b>: Position Must Be Of Type Integer - <b>'.gettype($position).'</b> Given!',E_USER_ERROR);
	    if($position===null){$position = count($this->containers);}
	    $container = new S_Widget(); $container->parent = $this;
	        $container->widget = $widget;
	        if(is_object($widget) && is_subclass_of($widget,"S_Widget")){
		        $widget->parent($container);
		    }
	        $container->attribute("align",$align);
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
			$this->attribute('width');
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
        // Counting the grid rows
        if(count($this->containers)==0)$this->child(s::label()->text("&nbsp;"));
        $rows = ceil(count($this->containers)/$this->property("columns")); $pointer=0;
        $html = $indent.'<table'; if(count($this->attribute)>0){$html .= $this->attributes_to_html();} if(count($this->style)>0){$html .= ' '.$this->styles_to_html();} $html .= '>'.$nl;
        for($r=0;$r<$rows;$r++){
			$html .= $indent.$tab.'<tr>'.$nl;
			for($c=0;$c<$this->property("columns");$c++){
				if(isset($this->containers[$pointer])){
					$container = $this->containers[$pointer];
					$html .= $indent.$tab.$tab.'<td';if(count($container->attribute)>0){$html .= $container->attributes_to_html();} if(count($container->style)>0){$html .= ' '.$container->styles_to_html();} $html .= '>'.$nl;
					if(is_object($container->widget)==true&&is_subclass_of($container->widget,"S_Widget")){
						$html.=$container->widget->to_html($compressed,($level+3)).$nl;
					}else{
						if($container->widget==""){$html.=$indent.$tab.$tab.$tab."&nbsp;".$nl;}else{$html.=$indent.$tab.$tab.$tab.$container->widget.$nl;}
					}
                    $html.=$indent.$tab.$tab.'</td>'.$nl;
    		        
		        }else{
			        $html .= $indent.$tab.$tab.'<td>'.$nl;
    		        $html.=$indent.$tab.$tab.$tab.'&nbsp;'.$nl;
    		        $html .= $indent.$tab.$tab.'</td>'.$nl;
			    }
		        $pointer+=1;
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
        * Returns the XHTML representation of this GridLayout with its children.
        * @param compressed compresses the HTML, removing the new lines and indent
        * @param level the level of this widget
        * @return String html string
        */
    function toXhtml($compressed=true,$level=0){
        if($compressed==false){$nl = "\n";$tab="    ";$indent=str_pad("",($level*4));}else{$nl="";$tab="";$indent="";}
        // Counting the grid rows
        if(count($this->containers)==0)$this->child(s::label()->text("&nbsp;"));
        $rows = ceil(count($this->containers)/$this->property("columns")); $pointer=0;
        $html = $indent.'<table'; if(count($this->attribute)>0){$html .= $this->attributes_to_html();} if(count($this->style)>0){$html .= ' '.$this->styles_to_html();} $html .= '>'.$nl;
        for($r=0;$r<$rows;$r++){
			$html .= $indent.$tab.'<tr>'.$nl;
			for($c=0;$c<$this->property("columns");$c++){
				if(isset($this->containers[$pointer])){
					$container = $this->containers[$pointer];
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
    		        
		        }else{
			        $html .= $indent.$tab.$tab.'<td>'.$nl;
    		        $html.=$indent.$tab.$tab.$tab.'&nbsp;'.$nl;
    		        $html .= $indent.$tab.$tab.'</td>'.$nl;
			    }
		        $pointer+=1;
		    }
		    $html.=$indent.$tab.'</tr>'.$nl;
	    }
	    $html .= $indent.'</table>';
		return $html;
    }
    //=====================================================================//
    //  METHOD: toXhtml                                                   //
    //========================== END OF METHOD ============================//
}
//===========================================================================//
// CLASS: GridLayout                                                         //
//============================== END OF CLASS ===============================//
