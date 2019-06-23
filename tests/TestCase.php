<?php

namespace Tests;

use PHPUnit\Framework\TestCase as PhpUnitTestCase;
use Mockery as m;

class TestCase extends PhpUnitTestCase
{
    protected function tearDown(): void {
        m::close();
    }
}