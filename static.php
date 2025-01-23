<?php

namespace PHP;

class Foo
{
    public static $fooStatic = "foo";

    public function getStatic(): string
    {
        return self::$fooStatic;
    }
}

class Boo extends Foo
{
    public static $fooStatic = "boo";

    public function getParentStatic(): string
    {
        return parent::$fooStatic;
    }
}



print(Foo::$fooStatic) . "\n";
$foo = new Foo();
print($foo->getStatic()) . "\n";
print($foo::$fooStatic) . "\n";


print(Boo::$fooStatic) . "\n";
$boo = new Boo();
print($boo->getParentStatic()) . "\n";
