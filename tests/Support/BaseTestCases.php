<?php

declare(strict_types=1);

namespace Tests\Support;

use Faker\Factory;
use Faker\Generator;
use PHPUnit\Framework\TestCase;

class BaseTestCases extends TestCase
{
    protected Generator $faker;
    protected function setUp(): void
    {
        parent::setUp();
        $this->faker = Factory::create();
    }
}
