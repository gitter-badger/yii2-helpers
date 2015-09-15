Helpers of Yii 2 Extension
==========================

[![Join the chat at https://gitter.im/vistart/yii2-helpers](https://badges.gitter.im/Join%20Chat.svg)](https://gitter.im/vistart/yii2-helpers?utm_source=badge&utm_medium=badge&utm_campaign=pr-badge&utm_content=badge)
The helpers for Yii 2 application.

Installation
------------

The preferred way to install this extension is through [composer](http://getcomposer.org/download/).

Either run

```
php composer.phar require --prefer-dist vistart/yii2-helpers "*"
```

or add

```
"vistart/yii2-helpers": "*"
```

to the require section of your `composer.json` file.


Usage
-----

Once the extension is installed, simply use it in your code by  :

```php
<?= \vistart\Helpers\Ip::IPv4toInteger('192.168.1.1'); ?>
```