##一、安装phpunit
➜ wget https://phar.phpunit.de/phpunit.phar //最新版本支持 PHP 7.0, 和 PHP 7.1
➜ wget https://phar.phpunit.de/phpunit-5.7.phar //支持于 PHP 5.6, PHP 7.0 和 PHP 7.1，PHPUnit 5 将于2018年02月02日结束维护支持,目前还是建议使用5.7版本

➜ chmod +x phpunit-5.7.phar

➜ sudo mv phpunit-5.7.phar /usr/local/bin/phpunit

➜ phpunit --version

##二、搭建测试项目
本次测试项目的目录结构如下
```
├── phpunit.xml
├── src
│   ├── autoload.php
│   ├── Money.php
└── tests
    └── MoneyTest.php
```
自动载入代码
```
<?php

function __autoload($class){
    include $class.'.php';
}

spl_autoload_register('__autoload');
```
项目代码在src/Money.php
```
<?php

class Money
{
    public $amount;

    public function __construct($amount)
    {
        $this->amount = $amount;
    }

    public function getAmount()
    {
        return $this->amount;
    }

    public function negate()
    {
        return new Money(-1*$this->amount);
    }
}
```
与之对应的单元测试是tests目录下的MoneyTest.php，注意单元测试文件名以*Test.php，这样以后指定tests目录便可以执行目录下的所有测试。
```
<?php

class MoneyTest extends PHPUnit_Framework_TestCase
{
    public function testCanBeNegated()
    {
        $a = new Money(1);

        $b = $a->negate();

        $this->assertEquals(-1, $b->getAmount());
    }
}
```
##三、实战
* 快速体验

> 经过第二部测试项目的搭建，我们可以运行底下的命令快速查看测试结果

1、第一种方式
```
phpunit --bootstrap src/Money.php tests/MoneyTest.php

#运行结果
[root@s2 auto_test]# phpunit --bootstrap src/Money.php tests/MoneyTest.php 
PHPUnit 5.7.21 by Sebastian Bergmann and contributors.
.                                                                   1 / 1 (100%)
Time: 94 ms, Memory: 12.00MB

OK (1 test, 1 assertion)
```
2、第二种方式
```
#第二种方式跟第一种基本一样，只不过是变成是自动引入
phpunit --bootstrap src/autoload.php tests/MoneyTest

#运行结果
[root@s2 auto_test]# phpunit --bootstrap src/autoload.php tests/MoneyTest
PHPUnit 5.7.21 by Sebastian Bergmann and contributors.
.                                                                   1 / 1 (100%)

Time: 87 ms, Memory: 12.00MB

OK (1 test, 1 assertion)
```
3、第三种方式
```
#如果要执行MoneyTest，在项目根目录下执行：
phpunit tests/MoneyTest

#如果要执行tests目录下的所有测试，在项目根目录下执行：
phpunit tests
```
4、第四种方式
虽然可以自动载入，但是要执行的命令更长了。我们还可以写一个配置文件来为项目指定bootstrap，这样就不用每次都写在命令里了
```
#展示了一个最小化的 phpunit.xml 例子,它将在递归遍历 tests 时添加所有在 *Test.php 文件中找到的 *Test 类
<phpunit bootstrap="src/autoload.php">
    <testsuites>
        <testsuite name="money">
            <directory>tests</directory>
        </testsuite>
    </testsuites>
</phpunit>

#指定文件测试顺序
<phpunit bootstrap="src/autoload.php">
    <testsuites>
        <testsuite name="money">
            <file>tests/HelloTest.php</file>
            <file>tests/MoneyTest.php</file>
            <file>tests/SiteTest.php</file>
        </testsuite>
    </testsuites>
</phpunit>
```

