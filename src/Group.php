<?php

//============================= START OF CLASS ==============================//
// CLASS: S_Group                                                            //
//===========================================================================//
   /**
    * The S_Group class groups all its children together with a desired title.
    *
    * The S_Group widget is not identical with the FIELDSET tag because some
    * cross-browser issues arise from it. However it provides the same functionality.
    * By default all the child elements in the widget are left centered.
    * <code>
    * $group = new S_Group();
    *     $group->title("Details");
    *
    * // Using shortcut function
    * $group = s_group()->title("Details");
    *
    * // Adding a text area widget to the group
    * $details = s_text_area()->parent($group)->text("User details...");
    * </code>
    * @package GUI
    */
class Group extends Element {
	//========================= START OF METHOD ===========================//
    //  CONSTRUCTOR: __construct                                           //
    //=====================================================================//
       /**
        * The constructor of S_Group.
        * @construct
        */
    function __construct(){
        parent::__construct();
        // Resolving some browser issues, however there is still difference from IE and FF
        //if(s_browser_detection("browser")=="ie"){
		//	$this->css_style("fieldset{ position: relative; margin-top:1em; padding-top:.75em;border:1px solid black;}");
		//	$this->css_style("legend{ position:absolute; top: -.5em; left: -2px; color:black;}");
	    //}
	    $this->border(1,"solid","black");
	    $this->style("position","relative");
	    $this->style("margin-top","12px");
	    $this->style("padding-top","12px");
	    $this->style("text-align","left");
    }
    //=====================================================================//
    //  CONSTRUCTOR: __construct                                           //
    //========================== END OF METHOD ============================//
    
    //========================= START OF METHOD ===========================//
    //  METHOD: title                                                      //
    //=====================================================================//
       /** Sets or retrieves the title of this Group.
         * To the title several CSS styles are changed, in order to give an uniform
         * look and feel for all the browsers. The following CSS styles are changed:
         * <ul>
         *     <li>position:absolute</li>
         *     <li>top:-12px</li>
         *     <li>left:10px</li>
         *     <li>background:white</li>
         *     <li>padding:2px 6px</li>
         *     <li>font-size:12px</li>
         * </ul>
         * However, these styles are not final, and easily can be further changed.
         * <code>
         * $group = s_group()->title("Test");
         * $title = $group->title();
         * // Setting red background of title
         * $title->background("red");
         * </code>
         * @param mixed String or S_Label
         * @return mixed The title as String (null, if not set) or an instance of this Group
         * @access public
         */
    function title($title=null){
	    if(func_num_args()>0){
		    if(is_string($title)==false&&($title instanceof S_Label)==false)trigger_error('ERROR: In class <b>'.get_class($this).'</b> in method <b>title($title)</b>: Parameter <b>$title</b> MUST BE of type String or S_Label - <b style="color:red">'.gettype($title).'</b> given!',E_USER_ERROR);
		    if(is_string($title)){$title = s::label()->text($title);}
		        $title->border(1,"solid","black");
		        $title->style("position","absolute");
		        $title->style("top","-12px");
		        $title->style("left","10px");
		        $title->style("background","white");
		        $title->style("padding","2px 4px");
		        $title->style("font-size","12px");
		    $this->property('title',$title);
		    return $this;
		}else{
			return $this->property('title');
		}
	}
	//=====================================================================//
    //  METHOD: title                                                      //
    //========================== END OF METHOD ============================//
    
    //========================= START OF METHOD ===========================//
    //  METHOD: to_html                                                    //
    //=====================================================================//
       /**
        * Returns the HTML representation of this Widget
        * @param Boolean whether the HTML output should be compressed
        * @param Integer the level of nesting of this Widget
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
        * Returns the XHTML representation of this Group
        * @param Boolean whether the (X)HTML output should be compressed
        * @param Integer the level of nesting of this Widget
        * @return String the XHTML representation of this widget
        */
    function to_xhtml($compressed=true,$level=0){
        if($compressed==false){$nl = "\n";$tab="    ";$indent=str_pad("",($level*4));}else{$nl="";$tab="";$indent="";}
        $xhtml = $indent.'<div'; if(count($this->attribute)>0){$xhtml .= $this->attributes_to_html();} if(count($this->style)>0){$xhtml .= ' '.$this->styles_to_html();} $xhtml .= '>'.$nl;
        if($this->property("title")!=null){
            $xhtml .= $indent.$tab.$this->property('title')->to_xhtml($compressed,$level+1).$nl;           
        }
        foreach($this->children as $child){
		    if(is_object($child) && is_subclass_of($child,"S_Widget")){
		        $xhtml .= $child->to_html($compressed,$level+1).$nl;
			}else{
			    $xhtml .= $indent.$tab.$child.$nl;
			}
		}
        $xhtml .= $indent.'</div>';
        return $xhtml;
    }
    //=====================================================================//
    //  METHOD: to_xhtml                                                   //
    //========================== END OF METHOD ============================//
}
//===========================================================================//
// CLASS: S_Group                                                            //
//============================== END OF CLASS ===============================//
