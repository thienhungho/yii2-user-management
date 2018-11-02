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

Add components user to your `AppConfig` file.

```php
...
'components'          => [
    ...
    'user' => [
        'identityClass' => '\thienhungho\UserManagement\models\User',
    ],
    ...
],
...
```

Add module UserManage to your `AppConfig` file.

```php
...
'modules'          => [
    ...
    'user-manage' => [
        'class' => '\thienhungho\UserManagement\modules\UserManage\UserManage',
    ],
    ...
],
...
```

Add module UserProfile to your `AppConfig` file.

```php
...
'modules'          => [
    ...
    'user-profile' => [
        'class' => 'BaseApp\ums\modules\UserProfile\UserProfile',
        'layout' => '@backend/views/layouts/main2',
    ],
    ...
],
...
```