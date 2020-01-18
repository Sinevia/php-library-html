<?php

class ElementTest extends \PHPUnit\Framework\TestCase
{
    public function setUp(): void
    {
        parent::setUp();
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
}