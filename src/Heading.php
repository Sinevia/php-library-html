class Heading extends \Sinevia\Html\Element {
    private $weight = 1;

    /**
     * The constructor of this Table.
     * @construct
     */
    function __construct() {
        parent::__construct();
    }
    
    function getWeight() {
        return $this->weight;
    }

    function setWeight($weight) {
        if (is_int($weight)) {
            throw new \InvalidArgumentException('In class ' . get_class($this) . ' in method setWeight($weight): Parameter $weight MUST BE of type Integer - ' . (is_object($weight) ? get_class($weight) : gettype($weight)) . ' given!');
        }
        
        $this->weight = $weight;        
        return $this;
    }

    /**
     * Returns the HTML representation of this Element with its children.
     * @param compressed compresses the HTML, removing the new lines and indent
     * @param level the level of this widget
     * @return String html string
     */
    function toHtml($compressed = true, $level = 0) {
        if ($compressed == false) {
            $nl = "\n";
            $tab = "    ";
            $indent = str_pad("", ($level * 4));
        } else {
            $nl = "";
            $tab = "";
            $indent = "";
        }
        if ($this->getProperty('text') == null) {
            $this->getProperty('text', "&nbsp;");
        }
        $html = $indent . '<h' . $this->weight . $this->attributesToHtml() . $this->cssToHtml() . '>' . $nl;
        foreach ($this->children as $child) {
            if (is_object($child) && is_subclass_of($child, "Sinevia\Html\Element")) {
                $html .= $child->toHtml($compressed, $level + 1) . $nl;
            } else {
                if ($child == '') {
                    $child = '&nbsp;';
                }
                $html .= $indent . $tab . $child . $nl;
            }
        }
        $html .= $indent . '</h' . $this->weight . '>';
        return $html;
    }

    /**
     * Returns the XHTML representation of this Element with its children.
     * @param compressed compresses the XHTML, removing the new lines and indent
     * @param level the level of this widget
     * @return String html string
     */
    function toXhtml($compressed = true, $level = 0) {
        if ($compressed == false) {
            $nl = "\n";
            $tab = "    ";
            $indent = str_pad("", ($level * 4));
        } else {
            $nl = "";
            $tab = "";
            $indent = "";
        }
        if ($this->getProperty('text') == null) {
            $this->getProperty('text', "&nbsp;");
        }
        $html = $indent . '<h' . $this->weight . '' . $this->attributesToHtml() . $this->cssToHtml() . '>' . $nl;
        foreach ($this->children as $child) {
            if (is_object($child) && is_subclass_of($child, "Sinevia\Html\Element")) {
                $html .= $child->toXhtml($compressed, $level + 1) . $nl;
            } else {
                if ($child == '') {
                    $child = '&nbsp;';
                }
                $html .= $indent . $tab . $child . $nl;
            }
        }
        $html .= $indent . '</h' . $this->weight . '>';
        return $html;
    }

}
