<?php
/**
 * @package GUI
 */
//============================= START OF CLASS ==============================//
// CLASS: S_TreeNode                                                         //
//===========================================================================//
   /**
    * The S_TreeNode class provides easy interface for adding nodes to the S_Tree widget.
    *
    * The S_TreeNode can easily taka as its children all types of widgets, including
    * images, hyperlinks, labels. The children widgets can additionaly be customized
    * providing flexibility. For example how to create trees, refer to the documentation
    * for the S_Tree class.
    *
    * <code>
    * $node = new S_TreeNode();
    *
    * // The same as above using the shortcut function
    * $node = s_tree_node();
    *
    * // Adding a hyperlink to the node
    * $hyperlink = s_hyperlink()->parent($node)->url("http://server.com");
    * // Adding custom text options: red color and boldness
    * $hyperlink->font(s_font()->color("red")->bold(true));
    * 
    * </code>
    * @package GUI
    */
class TreeNode extends Element {
    private $child_tree = null;
    //========================= START OF METHOD ===========================//
    //  CONSTRUCTOR: __construct                                           //
    //=====================================================================//
       /**
        * The constructor of S_TreeNode.
        * @construct
        */
	function __construct(){
        parent::__construct();
        $this->text("Unnamed");
    }    
    //=====================================================================//
    //  CONSTRUCTOR: __construct                                           //
    //========================== END OF METHOD ============================//
    
    //========================= START OF METHOD ===========================//
    //  METHOD: text                                                       //
    //=====================================================================//
       /** Sets or retrieves the text of this TreeNode.
         * @param mixed String or a subclass of S_Widget
         * @return mixed The text as String (null, if not set) or an instance of this TreeNode
         * @access public
         */
    function text($text=null){
	    if(func_num_args()>0){
		    if(is_string($text)==false && ($text instanceof S_Widget)==false)trigger_error('ERROR: In class <b>'.get_class($this).'</b> in method <b>text($text)</b>: Parameter <b>$text</b> MUST BE of type String - <b style="color:red">'.gettype($text).'</b> given!',E_USER_ERROR);
		    $this->property('text',$text);
		    return $this;
		}else{
			return $this->property('text');
		}
	}
	//=====================================================================//
    //  METHOD: text                                                       //
    //========================== END OF METHOD ============================//
    
    //========================= START OF METHOD ===========================//
    //  METHOD: child                                                      //
    //=====================================================================//
       /** Adds a sub node to this node.
         * @param S_TreeNode the tree node to be added as subnode
	     * @return S_Tree the instance of this S_Tree
         * @access public
         */
    function child($tree_node,$position=null){
        if(is_object($tree_node)==false)trigger_error('Class <b>'.get_class($this).'</b> in method <b>child($tree_node)</b>: The Parameter $tree_node MUST BE Of Type S_TreeNode - <b>'.gettype($tree_node).'</b> Given!',E_USER_ERROR);
        if(($tree_node instanceof S_TreeNode)==false)trigger_error('Class <b>'.get_class($this).'</b> in method <b>child($tree_node)</b>: The Parameter $tree_node MUST BE Of Type S_TreeNode - <b>'.get_class($tree_node).'</b> Given!',E_USER_ERROR);
        if(is_null($this->child_tree))$this->child_tree = new S_Tree();
        $this->child_tree->child($tree_node);
        return $this;
    }
	//=====================================================================//
    //  METHOD: __child                                                    //
    //========================== END OF METHOD ============================//
    
    //========================= START OF METHOD ===========================//
    //  METHOD: to_xhtml                                                   //
    //=====================================================================//
       /**
        * Returns the XHTML representation of this S_TreeNode with its children.
        * @param compressed compresses the XHTML, removing the new lines and indent
        * @param level the level of this widget
        * @return String html string
        */
    function to_xhtml($compressed=true,$level=0){
	    if($compressed==false){$nl = "\n";$tab="    ";$indent=str_pad("",($level*4));}else{$nl="";$tab="";$indent="";}
        $html = $indent.'<li'; if(count($this->attribute)>0){$html .= $this->attributes_to_html();} if(count($this->style)>0){$html .= ' '.$this->styles_to_html();} $html .= '>'.$nl;
	        if($this->text() instanceof S_Widget){
    	        $html.=$indent.$tab.$this->text()->to_xhtml().$nl;
	        }else{
    	        $html.=$indent.$tab.$this->text().$nl;
    	    }
	        if(is_null($this->child_tree)==false){
    	        $html.=$this->child_tree->to_xhtml($compressed,$level+1,false).$nl;
    	    }
        $html .= $indent.'</li>';
        return $html;
    }
    //=====================================================================//
    //  METHOD: to_xhtml                                                   //
    //========================== END OF METHOD ============================//
}
//===========================================================================//
// CLASS: S_TreeNode                                                         //
//============================== END OF CLASS ===============================//
