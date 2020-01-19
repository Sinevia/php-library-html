<?php

class SelectTest extends \PHPUnit\Framework\TestCase
{
    public function setUp(): void
    {
        parent::setUp();
    }

    public function testInit(){
        $select = new \Sinevia\Html\Select;
        $this->assertEquals($select->toHtml(),'<select></select>');
    }

    public function testAddItem(){
        $select = new \Sinevia\Html\Select;
        $select->addItem('1','1');
        $select->addItem('2','2');
        $select->addItem('3','3');
        $this->assertEquals($select->toHtml(),'<select><option value="1">1</option><option value="2">2</option><option value="3">3</option></select>');
    }

    public function testMultiple() {
        $select = new \Sinevia\Html\Select;
        $select->setMultiple(true);
        $this->assertEquals($select->toHtml(),'<select multiple="multiple"></select>');
        $isMultiple = $select->getMultiple();
        $this->assertTrue($isMultiple);
        $select->setMultiple(false);
        $isMultiple = $select->getMultiple();
        $this->assertFalse($isMultiple);
    }

    public function testOnChange() {
        $select = new \Sinevia\Html\Select;
        $select->setOnChange('alert("Hello")');
        $this->assertEquals($select->toHtml(),'<select onchange="alert(&quot;Hello&quot;)"></select>');
        $onChange = $select->getOnChange();
        $this->assertEquals($onChange, 'alert(&quot;Hello&quot;)');
    }

    public function testRows() {
        $select = new \Sinevia\Html\Select;
        $select->setRows(3);
        $this->assertEquals($select->toHtml(),'<select size="3"></select>');
        $rows = $select->getRows();
        $this->assertEquals($rows,3);
    }
}