# AdminPanel plugin for CakePHP

## Installation

You can install this plugin into your CakePHP application using [composer](https://getcomposer.org).

The recommended way to install composer packages is:

```
composer require your-name-here/AdminPanel
```

##Bake Theme

```
php bin/cake.php bake controller --plugin AdminPanel --theme AdminPanel Test
```



## Important! Note

for Server in BlogsController Upload remove the webroot part here:

```php
$targetDir = 'webroot' . DS . 'files' . DS . 'Blogs' . DS . 'image' . DS;
if (!file_exists($targetDir)) {
    mkdir($targetDir, 0755, true);
}
```


into this

```php
$targetDir = 'files' . DS . 'Blogs' . DS . 'image' . DS;
if (!file_exists($targetDir)) {
    mkdir($targetDir, 0755, true);
}
```
