<?php

class SelectTest extends \PHPUnit\Framework\TestCase
{
    public function setUp(): void
    {
        parent::setUp();
    }

    public function testInit(){
        $select = new \Sinevia\Html\Select;
        $this->assertEquals($select->toHtml(),'<select ></select>');
    }

    public function testAddItem(){
        $select = new \Sinevia\Html\Select;
        $select->addItem('1','1');
        $select->addItem('2','2');
        $select->addItem('3','3');
        $this->assertEquals($select->toHtml(),'<select ><option value="1">1</option><option value="2">2</option><option value="3">3</option></select>');
    }

    public function testOnChange(){
        $select = new \Sinevia\Html\Select;
        $select->onChange('alert("Hello")');
        $this->assertEquals($select->toHtml(),'<select onchange="alert(&quot;Hello&quot;)"></select>');
    }
}