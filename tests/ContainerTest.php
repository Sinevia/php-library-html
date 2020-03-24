<?php

class ContainerTest extends \PHPUnit\Framework\TestCase
{
    public function setUp(): void
    {
        parent::setUp();
    }
    public function testInit(){
        $div = new \Sinevia\Html\Container;
        $this->assertEquals($div->toHtml(),'');
    }

    public function testAddChild(){
        $div = new \Sinevia\Html\Container;
        $div->addChild('child1');
        $div->addChild('child2');
        $div->addChild('child3');
        $this->assertEquals($div->toHtml(),'child1child2child3');
    }

    public function testAddJavascript(){
        $container = new \Sinevia\Html\Container;
        $container->setJavascript('alert("Hello")');
        $this->assertEquals($container->toHtml(),'<script type="text/javascript">alert("Hello")</script>');
    }
}