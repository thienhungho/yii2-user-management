Yii2 User Management System
====================
User Management System for Yii2

Installation
------------

The preferred way to install this extension is through [composer](http://getcomposer.org/download/).

Either run

```
php composer.phar require --prefer-dist thienhungho/yii2-user-management "*"
```

or add

```
"thienhungho/yii2-user-management": "*"
```

to the require section of your `composer.json` file.

Usage
------------

add components user to your `main.php` file.

```php
...
'components'          => [
    ...
    'user' => [
        'identityClass' => '\ThienHungHo\models\User',
    ],
    ...
],
...
```