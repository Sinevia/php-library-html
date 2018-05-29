<?php

class Skin{
    function apply($widget){
	    $class_name = strtolower(get_class($widget));
      if(method_exists($this,$class_name)==true)$this->$class_name($widget);
	  }
}
