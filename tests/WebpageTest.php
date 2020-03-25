<?php

class WebpageTest extends \PHPUnit\Framework\TestCase
{
    public function setUp(): void
    {
        parent::setUp();
    }

    public function testInit(){
        $webpage = new \Sinevia\Html\Webpage;

        $html = '<!DOCTYPE html>';
        $html .= '<html>';
        $html .= '<head>';
        $html .= '<meta charset="utf-8">';
        $html .= '<title>Undefined</title>';
        $html .= '<style>html,body{width:100%;height:100%;}</style>';
        $html .= '</head>';
        $html .= '<body lang="en">';
        $html .= '<p>&nbsp;</p>';
        $html .= '</body>';
        $html .= '</html>';
        
        $this->assertEquals($webpage->toHtml(), $html);
    }

    public function testAddTitle(){
        $webpage = new \Sinevia\Html\Webpage;
        $webpage->setTitle('Title Added');

        $html = '<!DOCTYPE html>';
        $html .= '<html>';
        $html .= '<head>';
        $html .= '<meta charset="utf-8">';
        $html .= '<title>Title Added</title>';
        $html .= '<style>html,body{width:100%;height:100%;}</style>';
        $html .= '</head>';
        $html .= '<body lang="en">';
        $html .= '<p>&nbsp;</p>';
        $html .= '</body>';
        $html .= '</html>';
        
        $this->assertEquals($webpage->toHtml(), $html);
    }

    public function testAddJavaScript(){
        $webpage = new \Sinevia\Html\Webpage;
        $webpage->addJavaScript('alert(1)');
        $webpage->addJavaScriptFile('1000',1000);

        $html = '<!DOCTYPE html>';
        $html .= '<html>';
        $html .= '<head>';
        $html .= '<meta charset="utf-8">';
        $html .= '<title>Undefined</title>';
        $html .= '<style>html,body{width:100%;height:100%;}</style>';
        $html .= '</head>';
        $html .= '<body lang="en">';
        $html .= '<p>&nbsp;</p>';
        $html .= '<script type="text/javascript" src="1000"></script>';
        $html .= '<script type="text/javascript">alert(1)</script>';
        $html .= '</body>';
        $html .= '</html>';
        
        $this->assertEquals($webpage->toHtml(), $html);
    }
}