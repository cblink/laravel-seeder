<?php

namespace Cblink\Seeder;

use Illuminate\Database\Seeder;

/**
 * Class BaseSeeder
 * @package Cblink\Seeder
 */
abstract class BaseSeeder extends Seeder
{

    /**
     * @return string
     */
    abstract public function getSeederName(): string;
}
