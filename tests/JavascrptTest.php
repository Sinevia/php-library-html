<?php

class JavascriptTest extends \PHPUnit\Framework\TestCase
{
    public function setUp(): void
    {
        parent::setUp();
    }
    public function testInit(){
        $div = new \Sinevia\Html\Div;
        $this->assertEquals($div->toHtml(),'<div></div>');
    }

    public function testAddJavascript(){
        $container = new \Sinevia\Html\Container;
        $container->addJavascript('alert("Hello")', 1);
        $this->assertEquals($container->toHtml(),'<script type="text/javascript">alert("Hello")</script>');
    
        $container = new \Sinevia\Html\Div;
        $container->addJavascript('alert("Hello")', 1);
        $this->assertEquals($container->toHtml(),'<div></div><script type="text/javascript">alert("Hello")</script>');
    }

    public function testAddJavascriptChildren(){
        $container = new \Sinevia\Html\Container;
        $container->addJavascript('alert("Hello")', 1);
        $this->assertEquals($container->toHtml(),'<script type="text/javascript">alert("Hello")</script>');
    }
}