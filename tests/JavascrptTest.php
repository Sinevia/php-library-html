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
        $container->addJavascript('alert("1")', 1);

        $div = new \Sinevia\Html\Div;
        $div->addJavascript('alert("2")', 2);
        $container->addChild($div);

        $div = new \Sinevia\Html\Div;
        $div->addJavascript('alert("3")', 3);
        $container->addChild($div);

        $result = '';
        $result .= '<div></div>';
        $result .= '<div></div>';        
        $result .= '<script type="text/javascript">alert("1")</script>';
        $result .= '<script type="text/javascript">alert("2")</script>';
        $result .= '<script type="text/javascript">alert("3")</script>';

        $this->assertEquals($container->toHtml(), $result);
    }
}