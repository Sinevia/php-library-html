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
}