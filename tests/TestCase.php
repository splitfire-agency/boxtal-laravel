<?php

namespace Emc\Tests;

use Emc\Providers\BoxtalServiceProvider;

class TestCase extends \Orchestra\Testbench\TestCase
{
    public function setUp(): void
    {
        parent::setUp();
    }

    protected function getPackageProviders($app)
    {
        return [BoxtalServiceProvider::class];
    }
}
