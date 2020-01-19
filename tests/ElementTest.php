<?php

class ElementTest extends \PHPUnit\Framework\TestCase
{
    public function setUp(): void
    {
        parent::setUp();
    }



    public function testAttributesToHtml(){
        $element = new \Sinevia\Html\Element;

        $testMethod = new \ReflectionMethod($element,'attributesToHtml');
        $testMethod->setAccessible(true);

        $this->assertEquals($testMethod->invoke($element),'');
        
        $element->setAttribute('key1','value1');
        $this->assertEquals($element->getAttribute('key1'),'value1');
        $element->setAttribute('key2','value2');
        $this->assertEquals($element->getAttribute('key2'),'value2');
 
        $this->assertEquals($testMethod->invoke($element),' key1="value1" key2="value2"');
    }

    public function testCssToHtml(){
        $element = new \Sinevia\Html\Element;

        $testMethod = new \ReflectionMethod($element,'cssToHtml');
        $testMethod->setAccessible(true);

        $this->assertEquals($testMethod->invoke($element),'');
        
        $element->setCss('key1','value1');
        $this->assertEquals($element->getCss('key1'),'value1');
        $element->setCss('key2','value2');
        $this->assertEquals($element->getCss('key2'),'value2');
 
        $this->assertEquals($testMethod->invoke($element),' style="key1:value1;key2:value2"');
    }

    public function testSetGetAttribute(){
        $element = new \Sinevia\Html\Element;
        $element->setAttribute('key1','value1');
        $this->assertEquals($element->getAttribute('key1'),'value1');
        $element->setAttribute('key2','value2');
        $this->assertEquals($element->getAttribute('key2'),'value2');
        $this->assertEquals($element->getAttribute('key1'),'value1');
    }

    public function testSetGetChildren(){
        $element = new \Sinevia\Html\Element;
        $element->addChild('child1');
        $element->addChild('child2');
        $children = $element->getChildren();
        $this->assertEquals(count($children),2);
        $this->assertEquals($children[0],'child1');
        $this->assertEquals($children[1],'child2');
    }

    public function testOnBlur() {
        $element = new \Sinevia\Html\Element;
        $element->setOnBlur('alert("Hello")');
        $onEvent = $element->getOnBlur();
        $this->assertEquals($onEvent, 'alert(&quot;Hello&quot;)');
        $element->setOnBlur('alert("Hello1")');
        $onEvent = $element->getOnBlur();
        $this->assertEquals($onEvent, 'alert(&quot;Hello&quot;);alert(&quot;Hello1&quot;)');
    }

    public function testOnClick() {
        $element = new \Sinevia\Html\Element;
        $element->setOnClick('alert("Hello")');
        $onEvent = $element->getOnClick();
        $this->assertEquals($onEvent, 'alert(&quot;Hello&quot;)');
        $element->setOnClick('alert("Hello1")');
        $onEvent = $element->getOnClick();
        $this->assertEquals($onEvent, 'alert(&quot;Hello&quot;);alert(&quot;Hello1&quot;)');
    }

    public function testOnDoubleClick() {
        $element = new \Sinevia\Html\Element;
        $element->setOnDoubleClick('alert("Hello")');
        $onEvent = $element->getOnDoubleClick();
        $this->assertEquals($onEvent, 'alert(&quot;Hello&quot;)');
        $element->setOnDoubleClick('alert("Hello1")');
        $onEvent = $element->getOnDoubleClick();
        $this->assertEquals($onEvent, 'alert(&quot;Hello&quot;);alert(&quot;Hello1&quot;)');
    }

    public function testOnFocus() {
        $element = new \Sinevia\Html\Element;
        $element->setOnFocus('alert("Hello")');
        $onEvent = $element->getOnFocus();
        $this->assertEquals($onEvent, 'alert(&quot;Hello&quot;)');
        $element->setOnFocus('alert("Hello1")');
        $onEvent = $element->getOnFocus();
        $this->assertEquals($onEvent, 'alert(&quot;Hello&quot;);alert(&quot;Hello1&quot;)');
    }

    public function testOnKeyDown() {
        $element = new \Sinevia\Html\Element;
        $element->setOnKeyDown('alert("Hello")');
        $onEvent = $element->getOnKeyDown();
        $this->assertEquals($onEvent, 'alert(&quot;Hello&quot;)');
        $element->setOnKeyDown('alert("Hello1")');
        $onEvent = $element->getOnKeyDown();
        $this->assertEquals($onEvent, 'alert(&quot;Hello&quot;);alert(&quot;Hello1&quot;)');
    }

    public function testOnKeyPress() {
        $element = new \Sinevia\Html\Element;
        $element->setOnKeyPress('alert("Hello")');
        $onEvent = $element->getOnKeyPress();
        $this->assertEquals($onEvent, 'alert(&quot;Hello&quot;)');
        $element->setOnKeyPress('alert("Hello1")');
        $onEvent = $element->getOnKeyPress();
        $this->assertEquals($onEvent, 'alert(&quot;Hello&quot;);alert(&quot;Hello1&quot;)');
    }

    public function testOnKeyUp() {
        $element = new \Sinevia\Html\Element;
        $element->setOnKeyUp('alert("Hello")');
        $onEvent = $element->getOnKeyUp();
        $this->assertEquals($onEvent, 'alert(&quot;Hello&quot;)');
        $element->setOnKeyUp('alert("Hello1")');
        $onEvent = $element->getOnKeyUp();
        $this->assertEquals($onEvent, 'alert(&quot;Hello&quot;);alert(&quot;Hello1&quot;)');
    }

    public function testOnMouseDown() {
        $element = new \Sinevia\Html\Element;
        $element->setOnMouseDown('alert("Hello")');
        $onEvent = $element->getOnMouseDown();
        $this->assertEquals($onEvent, 'alert(&quot;Hello&quot;)');
        $element->setOnMouseDown('alert("Hello1")');
        $onEvent = $element->getOnMouseDown();
        $this->assertEquals($onEvent, 'alert(&quot;Hello&quot;);alert(&quot;Hello1&quot;)');
    }

    public function testOnMouseMove() {
        $element = new \Sinevia\Html\Element;
        $element->setOnMousemove('alert("Hello")');
        $onEvent = $element->getOnMouseMove();
        $this->assertEquals($onEvent, 'alert(&quot;Hello&quot;)');
        $element->setOnMouseMove('alert("Hello1")');
        $onEvent = $element->getOnMouseMove();
        $this->assertEquals($onEvent, 'alert(&quot;Hello&quot;);alert(&quot;Hello1&quot;)');
    }

    public function testOnMouseOut() {
        $element = new \Sinevia\Html\Element;
        $element->setOnMouseOut('alert("Hello")');
        $onEvent = $element->getOnMouseOut();
        $this->assertEquals($onEvent, 'alert(&quot;Hello&quot;)');
        $element->setOnMouseOut('alert("Hello1")');
        $onEvent = $element->getOnMouseOut();
        $this->assertEquals($onEvent, 'alert(&quot;Hello&quot;);alert(&quot;Hello1&quot;)');
    }

    public function testOnMouseOver() {
        $element = new \Sinevia\Html\Element;
        $element->setOnMouseOver('alert("Hello")');
        $onEvent = $element->getOnMouseOver();
        $this->assertEquals($onEvent, 'alert(&quot;Hello&quot;)');
        $element->setOnMouseOver('alert("Hello1")');
        $onEvent = $element->getOnMouseOver();
        $this->assertEquals($onEvent, 'alert(&quot;Hello&quot;);alert(&quot;Hello1&quot;)');
    }

    public function testOnMouseUp() {
        $element = new \Sinevia\Html\Element;
        $element->setOnMouseUp('alert("Hello")');
        $onEvent = $element->getOnMouseUp();
        $this->assertEquals($onEvent, 'alert(&quot;Hello&quot;)');
        $element->setOnMouseUp('alert("Hello1")');
        $onEvent = $element->getOnMouseUp();
        $this->assertEquals($onEvent, 'alert(&quot;Hello&quot;);alert(&quot;Hello1&quot;)');
    }

    public function testSetGetOpacity(){
        $element = new \Sinevia\Html\Element;
        $element->setOpacity(12);
        $this->assertEquals($element->getOpacity(), '.12');
    }

    public function testToHtmlThrowingRuntimeException(){
        $element = new \Sinevia\Html\Element;
        try {
            $element->toHtml();
        } catch (\RuntimeException $e) {
            $this->assertEquals($e->getCode(), 0);
            $this->assertEquals($e->getMessage(),'Class Sinevia\Html\Element has to implement its own toHtml() method!');
            return;
        }

        $this->fail();
    }
}