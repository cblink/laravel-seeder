<?php

namespace Cblink\Seeder;

use Throwable;
use InvalidArgumentException;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

/**
 * Class DBSeeder
 * @package Cblink\Seeder
 */
class DBSeeder extends Seeder
{
    /**
     * 调用只执行一次的填充
     *
     * @param $class
     * @throws Throwable
     */
    public function callOnce($class)
    {
        $alias = $this->getSeederName($class);

        if (DB::table($this->getTable())->where('name', $alias)->orWhere('seeder', $class)->count()) {
            echo sprintf('continue %s', class_basename(__CLASS__)) . "\n";

            return;
        }

        $this->call($class);

        DB::table($this->getTable())->insert([
            'name' => $alias,
            'seeder' => $class
        ]);
    }

    /**
     * 获取seeder的名称
     *
     * @param $seeder
     * @return mixed
     * @throws Throwable
     */
    public function getSeederName($seeder)
    {
        /**
         * @var BaseSeeder $seeder
         */
        $seeder = is_object($seeder) ? $seeder : app($seeder);

        throw_unless($seeder instanceof BaseSeeder, InvalidArgumentException::class);

        return $seeder->getSeederName();
    }


    /**
     * @return string
     */
    public function getTable(): string
    {
        $prefix = config(sprintf('database.connections.%s.prefix', config('database.default')), '');

        return sprintf('%sseeders', $prefix);
    }
}
