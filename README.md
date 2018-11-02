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

### Migration

Run the following command in Terminal for database migration:

```
yii migrate/up --migrationPath=@vendor/thienhungho/UserManagement/migrations
```

Or use the [namespaced migration](http://www.yiiframework.com/doc-2.0/guide-db-migrations.html#namespaced-migrations) (requires at least Yii 2.0.10):

```php
// Add namespace to console config:
'controllerMap' => [
    'migrate' => [
        'class' => 'yii\console\controllers\MigrateController',
        'migrationNamespaces' => [
            'thienhungho\UserManagement\migrations\namespaced',
        ],
    ],
],
```

Then run:
```
yii migrate/up
```

Config
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
        'class' => '\thienhungho\UserManagement\modules\UserProfile\UserProfile',
        'layout' => '@backend/views/layouts/main2',
    ],
    ...
],
...
```
Models
------------

[User](https://github.com/thienhungho/yii2-user-management/blob/master/docs/models/User.php)

Modules
------------

[UserBase](https://github.com/thienhungho/yii2-user-management/tree/master/src/modules/UserBase), [UserManage](https://github.com/thienhungho/yii2-user-management/tree/master/src/modules/UserManage), [UserProfile](https://github.com/thienhungho/yii2-user-management/tree/master/src/modules/UserProfile), [UserSetting](https://github.com/thienhungho/yii2-user-management/tree/master/src/modules/UserSetting)

Functions
------------

[Core](https://github.com/thienhungho/yii2-user-management/tree/master/src/functions/core.php)