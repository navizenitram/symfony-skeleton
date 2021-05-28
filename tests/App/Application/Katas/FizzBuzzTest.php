<?php

namespace App\Application\Katas;

use PHPUnit\Framework\TestCase;

class FizzBuzzTest extends TestCase
{
    public function testGetOne()
    {
        $object = new FizzBuzz();
        self::assertSame($object->getOne(), 1);
    }

}
