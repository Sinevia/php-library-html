<?php

class SectionTest extends \PHPUnit\Framework\TestCase
{
    public function setUp(): void
    {
        parent::setUp();
    }
    public function testInit(){
        $div = new \Sinevia\Html\Section;
        $this->assertEquals($div->toHtml(),'<section></section>');
    }

    public function testAddItem(){
        $div = new \Sinevia\Html\Section;
        $div->addChild('child1');
        $div->addChild('child2');
        $div->addChild('child3');
        $this->assertEquals($div->toHtml(),'<section>child1child2child3</section>');
    }
}