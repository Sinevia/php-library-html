# PHP Library HTML

![No Dependencies](https://img.shields.io/badge/no-dependencies-success.svg)
![Tests](https://github.com/Sinevia/php-library-html/workflows/Test/badge.svg)
[![Gitpod Ready-to-Code](https://img.shields.io/badge/Gitpod-Ready--to--Code-blue?logo=gitpod)](https://gitpod.io/#https://github.com/Sinevia/php-library-html) 

## Installation

1. Via Composer
```
composer require sinevia/php-library-html
```

2. Manual
Download this folder

## Examples

1. Select
```
echo (new Sinevia\Html\Select)
        ->addItems(App\Models\Articles\Article::getEditorList())
        ->setSelectedItem($wysiwyg)
        ->addClass('form-control')
        ->setName('Wysiwyg')
        ->toHtml();
```
