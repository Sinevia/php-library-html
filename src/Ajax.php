<?php

//============================= START OF CLASS ==============================//
// CLASS: S_Ajax                                                             //
//===========================================================================//
    /**
     * The class S_Ajax provides Ajax capability to the Simplest Widgets.
     * <code>
     * // Creating a new ajax call
     * $ajax = new S_Ajax();
     * $ajax->method("post");
     * $ajax->url("http://server.com");
     * $ajax->on_success("alert(data)");
     * $ajax->on_error("alert('Error')");
     * $button->on_click($ajax->to_js());
     *
     * // Using the shortcut function s_ajax()
     * $button->on_click(s_ajax->url("http://server.com")->method("post")->on_success("alert(data)")->to_js());
     * </code>
     */
class Ajax{
    private $property = array();
    function __construct(){
        $this->async(true);
        $this->cache(true);
        $this->method("post");
        $this->property("processData",false);
    }
    //========================= START OF METHOD ===========================//
    //  METHOD: data                                                       //
    //=====================================================================//
       /** Sets or retrieves the expected data to be received from the Ajax request.
         * @param String the method for Ajax request (html,json,jsonp,script,text,xml)
         * @return mixed The request type as String or an instance of this class
         * @throws AjaxIllegalArgumentException if $data_type is not String (html,json,jsonp,script,text,xml)
         * @access public
         */
    function data($data_type=null){
        if(func_num_args()>0){
            $allowed_params = array("html","json","jsonp","script","text","xml");
		    if(is_string($data_type)==false){throw new S_AjaxIllegalArgumentException('In class <b>'.get_class($this).'</b> in method <b>data($data_type)</b>: Parameter <b>$data_type</b> MUST BE of type String('.implode(", ",$allowed_params).') - <b style="color:red">'.(is_object($data_type)?get_class($data_type):gettype($data_type)).'</b> given!');}
		    if(in_array(strtolower($data_type),$allowed_params)==false){
		        throw new S_AjaxIllegalArgumentException('In class <b>'.get_class($this).'</b> in method <b>in method <b>data($data_type)</b>: Parameter <b>$data_type</b> MUST BE of type String('.implode(", ",$allowed_params).') - <b style="color:red">'.$data_type.'</b> given!');
		    }
		    $this->property("dataType",strtolower($data_type));
		    return $this;
		}else{
			return $this->property("dataType");
		}
    }
	//=====================================================================//
    //  METHOD: __data                                                     //
    //========================== END OF METHOD ============================//
    
    //========================= START OF METHOD ===========================//
    //  METHOD: method                                                     //
    //=====================================================================//
       /** Sets or retrieves the specified request method for Ajax.
         * @param String the method for Ajax request (get or post)
         * @return mixed The request type as String or an instance of this class
         * @throws AjaxIllegalArgumentException if $mehod is not String (post or get)
         * @access public
         */
    function method($method=null){
        if(func_num_args()>0){
            $allowed_params = array("get","post");
		    if(is_string($method)==false){throw new S_AjaxIllegalArgumentException('In class <b>'.get_class($this).'</b> in method <b>$method($method)</b>: Parameter <b>$method</b> MUST BE of type String('.implode(", ",$allowed_params).') - <b style="color:red">'.(is_object($method)?get_class($method):gettype($method)).'</b> given!');}
		    if(in_array(strtolower($method),$allowed_params)==false){
		        throw new S_AjaxIllegalArgumentException('In class <b>'.get_class($this).'</b> in method <b>in method <b>method($method)</b>: Parameter <b>$method</b> MUST BE of type String('.implode(", ",$allowed_params).') - <b style="color:red">'.$method.'</b> given!',E_USER_ERROR);
		    }
		    $this->property("type",strtolower($method));
		    return $this;
		}else{
			return $this->property("type");
		}
    }
	//=====================================================================//
    //  METHOD: method                                                     //
    //========================== END OF METHOD ============================//
    
    //========================= START OF METHOD ===========================//
    //  METHOD: url                                                        //
    //=====================================================================//
       /** Sets or retrieves the URL, to which the Ajax request is to be directed.
         * @param String the URL for the Ajax request
         * @return mixed The URL as String or an instance of this class
         * @throws AjaxIllegalArgumentException if $url is not String
         * @access public
         */
    function url($url=null){
        if(func_num_args()>0){
            if(is_string($url)==false){
                throw new S_AjaxIllegalArgumentException('In class <b>'.get_class($this).'</b> in method <b>url($url)</b>: Argument <b>$url</b> MUST BE of type String - <b style="color:red">'.(is_object($url)?get_class($url):gettype($url)).'</b> given!');
		    }
		    $this->property("url",$url);
		    return $this;
		}else{
			return $this->property("url");
		}
    }
	//=====================================================================//
    //  METHOD: url                                                        //
    //========================== END OF METHOD ============================//
    
    //========================= START OF METHOD ===========================//
    //  METHOD: async                                                      //
    //=====================================================================//
       /** Sets or retrieves the asyncronious property of the Ajax request.
         * It specifies whether the requests are to be synchronious or not.
         * @param Boolean true for async, false otherwise
         * @return mixed The async as Boolean or an instance of this class
         * @throws AjaxIllegalArgumentException if $is_async is not Boolean
         * @access public
         */
    function async($is_async=null){
        if(func_num_args()>0){
            if(is_bool($is_async)==false){
                throw new S_AjaxIllegalArgumentException('In class <b>'.get_class($this).'</b> in method <b>async($is_async)</b>: Argument <b>$is_async</b> MUST BE of type Boolean - <b style="color:red">'.(is_object($is_async)?get_class($is_async):gettype($is_async)).'</b> given!');
		    }
		    $this->property("async",$is_async);
		    return $this;
		}else{
			return $this->property("async");
		}
    }
	//=====================================================================//
    //  METHOD: async                                                      //
    //========================== END OF METHOD ============================//
    
    //========================= START OF METHOD ===========================//
    //  METHOD: on_success                                                 //
    //=====================================================================//
       /** Sets or retrieves the JavaScript action to be executed after the
         * successful retrieve of the Ajax request. The received data is contained
         * in the JavaScript data variable. If the received data is JavaScript,
         * then it is executed, without taking into account, if on_success is set.
         * <code>
         * $ajax = s_ajax()->url("someurl")->on_success("alert(data)");
         * </code>
         * @param String the JavaScript action to be executed
         * @return mixed The JavaScript action as String or an instance of this class
         * @throws AjaxIllegalArgumentException if $js is not String
         * @access public
         */
    function on_success($js=null){
        if(func_num_args()>0){
            if(is_string($js)==false){
                throw new S_AjaxIllegalArgumentException('In class <b>'.get_class($this).'</b> in method <b>on_success($js)</b>: Argument <b>$js</b> MUST BE of type String - <b style="color:red">'.(is_object($js)?get_class($js):gettype($js)).'</b> given!');
		    }
		    $this->property("success",$js);
		    return $this;
		}else{
			return $this->property("success");
		}
    }
	//=====================================================================//
    //  METHOD: on_success                                                 //
    //========================== END OF METHOD ============================//
    
    //========================= START OF METHOD ===========================//
    //  METHOD: cache                                                      //
    //=====================================================================//
    function cache($is_cached=null){
        if(func_num_args()>0){
            if(is_bool($is_cached)==false){
                throw new S_AjaxIllegalArgumentException('In class <b>'.get_class($this).'</b> in method <b>cache($is_cached)</b>: Argument <b>$is_cached</b> MUST BE of type Boolean - <b style="color:red">'.(is_object($is_cached)?get_class($is_cached):gettype($is_cached)).'</b> given!');
		    }
		    $this->property("cache",$is_cached);
		    return $this;
		}else{
			return $this->property("cache");
		}
    }
	//=====================================================================//
    //  METHOD: cache                                                      //
    //========================== END OF METHOD ============================//
    
    //========================= START OF METHOD ===========================//
    //  METHOD: on_before_send                                             //
    //=====================================================================//
       /** Sets or retrieves the JavaScript action to be executed before
         * the Ajax request is being send.
         * <code>
         * $ajax = s_ajax()->url("someurl")->on_before_send("alert('Sending...')");
         * </code>
         * @param String the JavaScript action to be executed
         * @return mixed The JavaScript action as String or an instance of this class
         * @throws AjaxIllegalArgumentException if $js is not String
         * @access public
         */
    function on_before_send($js=null){
        if(func_num_args()>0){
            if(is_string($js)==false){
                throw new S_AjaxIllegalArgumentException('In class <b>'.get_class($this).'</b> in method <b>on_before_send($js)</b>: Argument <b>$js</b> MUST BE of type String - <b style="color:red">'.(is_object($js)?get_class($js):gettype($js)).'</b> given!');
		    }
		    $this->property("beforeSend",$js);
		    return $this;
		}else{
			return $this->property("beforeSend");
		}
    }
	//=====================================================================//
    //  METHOD: on_before_send                                             //
    //========================== END OF METHOD ============================//
    
    //========================= START OF METHOD ===========================//
    //  METHOD: on_complete                                                //
    //=====================================================================//
    function on_complete($js=null){
        if(func_num_args()>0){
            if(is_string($js)==false){
                throw new S_AjaxIllegalArgumentException('In class <b>'.get_class($this).'</b> in method <b>on_complete($js)</b>: Argument <b>$js</b> MUST BE of type String - <b style="color:red">'.(is_object($js)?get_class($js):gettype($js)).'</b> given!');
		    }
		    $this->property("complete",$js);
		    return $this;
		}else{
			return $this->property("complete");
		}
    }
	//=====================================================================//
    //  METHOD: on_complete                                                //
    //========================== END OF METHOD ============================//
    
    //========================= START OF METHOD ===========================//
    //  METHOD: on_error                                                   //
    //=====================================================================//
    function on_error($js=null){
        if(func_num_args()>0){
            if(is_string($js)==false){
                throw new S_AjaxIllegalArgumentException('In class <b>'.get_class($this).'</b> in method <b>on_error($js)</b>: Argument <b>$js</b> MUST BE of type String - <b style="color:red">'.(is_object($js)?get_class($js):gettype($js)).'</b> given!');
		    }
		    $this->property("error",$js);
		    return $this;
		}else{
			return $this->property("error");
		}
    }
	//=====================================================================//
    //  METHOD: on_error                                                   //
    //========================== END OF METHOD ============================//
    
    //========================= START OF METHOD ===========================//
    //  METHOD: timeout                                                    //
    //=====================================================================//
    function timeout($timespan=null){
        if(func_num_args()>0){
            if(is_int($timespan)==false){
                throw new S_AjaxIllegalArgumentException('In class <b>'.get_class($this).'</b> in method <b>timeout($timespan)</b>: Argument <b>$timepsan</b> MUST BE Integer - <b style="color:red">'.(is_object($timespan)?get_class($timespan):gettype($timespan)).'</b> given!');
		    }
		    $this->property("timeout",$timespan);
		    return $this;
		}else{
			return $this->property("timeout");
		}
    }
	//=====================================================================//
    //  METHOD: timeout                                                    //
    //========================== END OF METHOD ============================//
    
    //========================= START OF METHOD ===========================//
    //  METHOD: replace                                                    //
    //=====================================================================//
       /**
        * Replaces the given widget, with the returned data.
        *
        * @param mixed $widget the widget to be replaced, or the ID of the widget.
        * @throws S_AjaxIllegalArgumentException if parameter $widget is not String or S_Widget
        * @return mixed the widget (as S_Widget or ID) or an instance of this widget
        */
    function replace($widget=null){
        if(func_num_args()>0){
            if(is_string($widget)==false&&($widget instanceof S_Widget)==false){
                throw new S_AjaxIllegalArgumentException('In class <b>'.get_class($this).'</b> in method <b>replace($widget)</b>: Argument <b>$widget</b> MUST BE String or subclass of S_Widget - <b style="color:red">'.(is_object($widget)?get_class($widget):gettype($widget)).'</b> given!');
		    }
            ($widget instanceof S_Widget)?$id = $widget->id():$id = $widget;
            $this->property("replace",$id);
            return $this;
		}else{
			return $this->property("replace");
		}
    }
	//=====================================================================//
    //  METHOD: replace                                                    //
    //========================== END OF METHOD ============================//
    
    //========================= START OF METHOD ===========================//
    //  METHOD: update                                                     //
    //=====================================================================//
       /**
        * Updates the content of the widget, with the returned data. Use it
        *  mainly with widgets containing HTML (LightPanel, Label).
        *
        * @param mixed $widget the widget to be updated, or the ID of the widget.
        * @throws S_AjaxIllegalArgumentException if parameter $widget is not String or S_Widget
        * @return mixed the widget (as S_Widget or ID) or an instance of this widget
        */
    function update($widget=null){
        if(func_num_args()>0){
            if(is_string($widget)==false&&($widget instanceof S_Widget)==false){
                throw new S_AjaxIllegalArgumentException('In class <b>'.get_class($this).'</b> in method <b>update($widget)</b>: Argument <b>$widget</b> MUST BE String or subclass of S_Widget - <b style="color:red">'.(is_object($widget)?get_class($widget):gettype($widget)).'</b> given!');
		    }
		    ($widget instanceof S_Widget)?$id = $widget->id():$id = $widget;
            $this->property("update",$id);
		    return $this;
		}else{
			return $this->property("update");
		}
    }
    //=====================================================================//
    //  METHOD: update                                                     //
    //========================== END OF METHOD ============================//
    
    //========================= START OF METHOD ===========================//
    //  METHOD: param                                                      //
    //=====================================================================//
    function param($name,$value=null){
        if(func_num_args()>1){
            if($this->property("param")==null)$this->property("param",array());
            $param = $this->property("param");
            if(is_string($name)==false)throw new S_AjaxIllegalArgumentException('In class <b>'.get_class($this).'</b> in method <b>param($name,$value)</b>: Argument <b>$name</b> MUST BE of type String - <b style="color:red">'.(is_object($name)?get_class($name):gettype($name)).'</b> given!');
            // if String
            if(is_string($value)){$param[$name]=$value;}
            // if TextField, TextArea
            elseif(($value instanceof S_TextField)==true||($value instanceof S_TextArea)==true){
                $param[$name]='"+document.getElementById("'.$value->id().'").value+"';
            }
            // else Not Supported
            else{
                throw new S_AjaxIllegalArgumentException('In class <b>'.get_class($this).'</b> in method <b>param($name,$value)</b>: Argument <b>$value</b> MUST BE of type String, S_TextField or S_TextArea - <b style="color:red">'.(is_object($value)?get_class($value):gettype($value)).'</b> given!');
            }
		    $this->property("param",$param);
		    return $this;
		}else{
    		if(is_string($name)){
    		    if($this->property("param")==null)return null;
    		    $param = $this->property("param");
			    return (isset($param[$name])==true)?$param[$name]:null;
			}elseif(($name instanceof S_TextField)==true||($name instanceof S_TextArea)==true){
    			s_alert($name->name());
                $param[$name->name()]='"+document.getElementById("'.$name->id().'").value+"';
                $this->property("param",$param);
            }else{
                throw new S_AjaxIllegalArgumentException('In class <b>'.get_class($this).'</b> in method <b>param($name)</b>: Argument <b>$name</b> MUST BE of type String, S_TextField or S_TextArea - <b style="color:red">'.(is_object($name)?get_class($name):gettype($name)).'</b> given!');
            }
            return $this;
		}
    }
	//=====================================================================//
    //  METHOD: param                                                      //
    //========================== END OF METHOD ============================//
    
    //========================= START OF METHOD ===========================//
    //  METHOD: to_js                                                      //
    //=====================================================================//
    function to_js(){
        if($this->property("url")==null){ throw new S_AjaxNoUrlException('In class <b>'.get_class($this).'</b> URL must be specified using method <b>url($url)</b>');}
        if($this->property("success")==null&&$this->property("replace")==null&&$this->property("update")==null&&$this->property("dataType")!="script"){ throw new S_AjaxNoOnSuccessException('In class <b>'.get_class($this).'</b> success action must be specified using method <b>on_success($js)</b>');}
        
        // Shall we not update or replace?
        if($this->property("replace")==null&&$this->property("update")==null){
            $this->property("success","function (data, textStatus){".$this->property("success").";this;}");
        }
        else{
            // Update
            if($this->property("update")!==null){
                //Firefox problem - bug? $this->property("success","function (data, textStatus){\$(".$this->property("update").").empty();\$(".$this->property("update").").append(data);this;}");
                $this->property("success",'function (data, textStatus){$("'.$this->property("update").'").empty().html(data);this;}');
                // Removing update
                $this->property = s::array_key_delete($this->property,"update");
            }
            // Replace
            else{
                $this->property("success",'function (data, textStatus){$("#'.$this->property("replace").'").after(data).parent().find("#'.$this->property("replace").'").remove();this;}');
                // Removing replace
                $this->property = s::array_key_delete($this->property,"replace");
            }
        }
        // Is there custom user error?
        if($this->property("error")==null){
            $this->property("error","function (XMLHttpRequest, textStatus, errorThrown){alert('Status: '+textStatus+'\\nError: '+errorThrown);this;}");
        }else{
            $this->property("error","function (XMLHttpRequest, textStatus, errorThrown){".$this->property("error").";this;}");
        }
        if($this->property("beforeSend")!==null){
            $this->property("beforeSend","function (XMLHttpRequest){".$this->property("beforeSend").";this;}");
        }
        if($this->property("complete")!==null){
            $this->property("complete","function (XMLHttpRequest, textStatus){".$this->property("complete").";this;}");
        }
        // Are there params?
        if($this->property("param")!==null){
            $params = $this->property("param");
            $data = array();
            foreach($params as $name=>$value){
                $data[] = $name.'='.$value;
            }
            $data = implode("&",$data);
            $this->property = s::array_key_delete($this->property,"param");
            $this->property("data",$data);
        }
        $keys = array();
        foreach($this->property as $key=>$value){
            if($key=="success"){  $keys[] = $key.':'.$value; }
            elseif($key=="error"){$keys[] = $key.':'.$value; }
            elseif($key=="complete"){$keys[] = $key.':'.$value; }
            elseif($key=="beforeSend"){$keys[] = $key.':'.$value; }
            elseif($key=="async"){$keys[] = $key.':'.$value; }
            elseif($key=="cache"){$keys[] = $key.':'.$value; }
            else{ $keys[] = $key.':"'.$value.'"'; }
        }
        $jquery = "$.ajax({".implode(",",$keys)."})";
        //return "alert('".$jquery."')";
        return $jquery;
    }
	//=====================================================================//
    //  METHOD: to_js                                                      //
    //========================== END OF METHOD ============================//
    
    //========================= START OF METHOD ===========================//
    //  METHOD: property                                                   //
    //=====================================================================//
       /** Sets or retrieves the specified properties to this Ajax.
         * @return mixed The property as String (null, if not set) or an instance of this Font
         * @param String the name of the property
	     * @param String the value of the property
         * @access public
         */
    protected function property($property,$value=null){
	    if(func_num_args()>1){
		    $this->property[$property]=$value;
		    return $this;
		}else{
			if(isset($this->property[$property])){ return $this->property[$property]; }
			return null;
		}
	}
	//=====================================================================//
    //  METHOD: property                                                 //
    //========================== END OF METHOD ============================//
}
//===========================================================================//
// CLASS: S_Ajax                                                             //
//============================== END OF CLASS ===============================//
class S_AjaxIllegalArgumentException extends Exception{}
class S_AjaxNoUrlException extends Exception{}
class S_AjaxNoOnSuccessException extends Exception{}
