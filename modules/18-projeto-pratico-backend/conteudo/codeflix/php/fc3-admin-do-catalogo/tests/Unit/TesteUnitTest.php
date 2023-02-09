<?php

namespace Testes\Unit;

use Core\Teste;
use PHPUnit\Framework\TestCase;

class TesteUnitTest extends TestCase
{
    public function testMethodFoo()
    {
        $teste = new Teste();
        $this->assertEquals('bar', $teste->foo());
    }
}