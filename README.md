# PHP Library HTML

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
