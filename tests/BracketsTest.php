<?php

use PHPUnit\Framework\TestCase;

class BracketsTest extends TestCase
{
    public function testCheckBrackets()
    {
       require 'brackets.php';

       $this->assertEquals(true, checkBrackets('(a+[b])'));
       $this->assertEquals(false, checkBrackets('(a+(b)'));
       $this->assertEquals(false, checkBrackets('(c{d)}'));
       $this->assertEquals(false, checkBrackets('((}}'));
       $this->assertEquals(true, checkBrackets('(){[][]}()'));
       $this->assertEquals(true, checkBrackets('([][])'));
       $this->assertEquals(false, checkBrackets('{'));
       $this->assertEquals(false, checkBrackets('))(('));
    }
}