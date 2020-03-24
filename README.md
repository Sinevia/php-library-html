# PHP Library HTML

![No Dependencies](https://img.shields.io/badge/no-dependencies-success.svg)
![Tests](https://github.com/Sinevia/php-library-html/workflows/Test/badge.svg)
[![Gitpod Ready-to-Code](https://img.shields.io/badge/Gitpod-Ready--to--Code-blue?logo=gitpod)](https://gitpod.io/#https://github.com/Sinevia/php-library-html) 

Programatically generate valid HTML.

## Introduction ##
This library helps generate valid HTML/XHTML using PHP. It has most of the HTML elements, as well as additional elements like Webpage, BorderLayout, etc.

## Installation

1. Via Composer
```
composer require sinevia/php-library-html
```

2. Manual
Download this folder

## Examples

### 1. Image ###
```
$image = (new \Sinevia\Html\Image)
        ->setUrl('http://help.jpg')->setAlt('Help')
        ->setOnClick('$("#info").toggle()')
        ->toXhtml();
```

### 2. Input ###
```
$inputFirstName = (new \Sinevia\Html\Input)
        ->setName('FirstName')
        ->setValue($firstName)
        ->setPlaceHolder('Your first name')
        ->addClass('form-control')
        ->toXhtml();
```     

### 3. Select ###

- Select editor list
```
echo (new Sinevia\Html\Select)
        ->addItems(App\Models\Articles\Article::getEditorList())
        ->setSelectedItem($wysiwyg)
        ->addClass('form-control')
        ->setName('Wysiwyg')
        ->toHtml();
```
- Select Birthday Day/Month/Year
```
$selectBirthDay = (new \Sinevia\Html\Select)
        ->setName('BirthDay')
        ->setSelectedItem($birthDay)
        ->addClass('form-control')
        ->addItem("", "- Select day -")
        ->addItems(array_combine(range(1, 31), range(1, 31)))
        ->setSelectedItem($birthDay)
        ->toXhtml();

$selectBirthMonth = (new \Sinevia\Html\Select)
        ->setName('BirthMonth')
        ->addClass('form-control')
        ->addItem("", "- Select month -")
        ->addItems(array_combine(range(1, 12), array_map(function($v) {
                            return date('F', mktime(0, 0, 0, $v, 1));
                        }, range(1, 12))))
        ->setSelectedItem($birthMonth)
        ->toXhtml();

$selectBirthYear = (new \Sinevia\Html\Select)
        ->setName('BirthYear')
        ->addClass('form-control')
        ->addItem("", "- Select year -")
        ->addItems(array_combine(range(1930, 2020), range(1930, 2020)))
        ->setSelectedItem($birthYear)
        ->toXhtml();
```

### 4. Webpage ###
```
$webpage = (new \Sinevia\Html\Webpage)
        ->setTitle('Hello')
        ->addChild('Hello World');
echo $webpage->toHtml();
```


