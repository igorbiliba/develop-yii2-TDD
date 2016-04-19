Test 1
============================

для демонстрации программы нужно выполнить в корне:
~~~
php yii work
~~~
на экране появятся данные тестовой модели с конвертацией валют.

Установка
------------

### Install via Composer

в корне проекта
~~~
php composer.phar global require "fxp/composer-asset-plugin:~1.1.1"
php composer.phar create-project --prefer-dist --stability=dev yiisoft/yii2-app-basic basic
~~~

CONFIGURATION
-------------

### Database

После установки необходимо настроить базу `config/db.php`:

```php
return [
    'class' => 'yii\db\Connection',
    'dsn' => 'mysql:host=localhost;dbname=yii2basic',
    'username' => 'root',
    'password' => '',
    'charset' => 'utf8',
];
```
