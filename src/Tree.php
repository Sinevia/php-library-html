<?php

//============================= START OF CLASS ==============================//
// CLASS: S_Tree                                                             //
//===========================================================================//
   /**
    * The S_Tree class provides easy GUI interface for displaying HTML trees.
    *
    * The S_Tree has default icons, but they are easy to be customized. The
    * dynamic of the shown tree is provided by the underlying jQuery library.
    *
    * <code>
    * $tree = new S_Tree();
    *
    * // The same as above using the shortcut function
    * $tree = s_tree();
    *
    * // Adding root node to the tree
    * $root = s_tree_node()->text("Root")->parent($tree);
    * 
    * // Adding subnodes to the root item
    * for($i=0;$i<10;$i++){
    *    $node = s_tree_node()->text("Sub ".$i)->parent($root);
    * }
    * </code>
    * @package GUI
    */
class Tree extends Element {
    private $images = array();
	//========================= START OF METHOD ===========================//
    //  CONSTRUCTOR: __construct                                           //
    //=====================================================================//
       /**
        * The constructor of S_Tree.
        * @construct
        */
	function __construct(){
        parent::__construct();
        $this->js_file(s::surl()."/includes/js/jquery.js");
        $this->js_file(s::surl()."/includes/js/jquery.cookie.js");
        $this->js_file(s::surl()."/includes/js/simplest.js");
        $this->images(s::surl()."/images/plus.gif",s::surl()."/images/minus.gif",s::surl()."/images/folder-closed.gif",s::surl()."/images/folder-opened.gif",s::surl()."/images/file.gif");
    }
    //=====================================================================//
    //  CONSTRUCTOR: __construct                                           //
    //========================== END OF METHOD ============================//
    //========================= START OF METHOD ===========================//
    //  METHOD: child                                                      //
    //=====================================================================//
       /** Adds a node to this tree..
         * @param S_TreeNode the tree node to be added
	     * @return S_Tree the instance of this S_Tree
         * @access public
         */
    function child($tree_node,$position=null){
        if(is_object($tree_node)==false)trigger_error('Class <b>'.get_class($this).'</b> in method <b>child($tree_node)</b>: The Parameter $tree_node MUST BE Of Type S_TreeNode - <b>'.gettype($tree_node).'</b> Given!',E_USER_ERROR);
        if(($tree_node instanceof S_TreeNode)==false)trigger_error('Class <b>'.get_class($this).'</b> in method <b>child($tree_node)</b>: The Parameter $tree_node MUST BE Of Type S_TreeNode - <b>'.get_class($tree_node).'</b> Given!',E_USER_ERROR);
        $this->children[] = $tree_node;
        return $this;
    }
	//=====================================================================//
    //  METHOD: __child                                                    //
    //========================== END OF METHOD ============================//
    
    //========================= START OF METHOD ===========================//
    //  METHOD: images                                                      //
    //=====================================================================//
       /** Customizes the used tree images.
         * @param String the URL for the "plus" image
	     * @param String the URL for the "minus" image
	     * @param String the URL for the "folder-closed" image
	     * @param String the URL for the "folder-opened image
	     * @param String the URL for the "file" image
	     * @return S_Tree the instance of this S_Tree
         * @access public
         */
    function images($plus,$minus,$folder_closed,$folder_opened,$file){
        $this->images[0] = $plus;
        $this->images[1] = $minus;
        $this->images[2] = $folder_closed;
        $this->images[3] = $folder_opened;
        $this->images[4] = $file;
        return $this;
    }
	//=====================================================================//
    //  METHOD: images                                                     //
    //========================== END OF METHOD ============================//
    
    //========================= START OF METHOD ===========================//
    //  METHOD: to_xhtml                                                   //
    //=====================================================================//
       /**
        * Returns the XHTML representation of this UnorderedList with its children.
        * @param compressed compresses the XHTML, removing the new lines and indent
        * @param level the level of this widget
        * @return String html string
        */
    function to_html($compressed=true,$level=0,$id=true){
        return $this->to_xhtml($compressed,$level,$id);
    }
    //=====================================================================//
    //  METHOD: to_html                                                   //
    //========================== END OF METHOD ============================//
    
    //========================= START OF METHOD ===========================//
    //  METHOD: to_xhtml                                                   //
    //=====================================================================//
       /**
        * Returns the XHTML representation of this UnorderedList with its children.
        * @param compressed compresses the XHTML, removing the new lines and indent
        * @param level the level of this widget
        * @return String html string
        */
    function to_xhtml($compressed=true,$level=0,$id=true){
        if($id){
            $this->js("$(document).ready(function(){ s_tree('#".$this->uid."').speed('fast').persist(true).image('plus','".$this->images[0]."').image('minus','".$this->images[1]."').image('folder-closed','".$this->images[2]."').image('folder-opened','".$this->images[3]."').image('file','".$this->images[4]."').init(); });");
	        $this->attribute("id",$this->uid);
        }
        if($compressed==false){$nl = "\n";$tab="    ";$indent=str_pad("",($level*4));}else{$nl="";$tab="";$indent="";}
        $html = $indent.'<ul'; if(count($this->attribute)>0){$html .= $this->attributes_to_html();} if(count($this->style)>0){$html .= ' '.$this->styles_to_html();} $html .= '>'.$nl;
	        for($i=0;$i<count($this->children);$i++){
    	        $html.=$this->children[$i]->to_xhtml($compressed,$level+1).$nl;
	            //$html.=$indent.$tab.'<li>'.$nl.$this->children[$i]->to_xhtml($compressed,$level+2).$nl;
	            //if(isset($this->sublist[$i])){
    	        //     $html.=$this->sublist[$i]->to_xhtml($compressed,$level+3).$nl;
    	        //}
	            //$html.=$indent.$tab.'</li>'.$nl;
            }
        $html .= $indent.'</ul>';
        return $html;
    }
    //=====================================================================//
    //  METHOD: to_xhtml                                                   //
    //========================== END OF METHOD ============================//
}
//===========================================================================//
// CLASS: S_Tree                                                             //
//============================== END OF CLASS ===============================//
