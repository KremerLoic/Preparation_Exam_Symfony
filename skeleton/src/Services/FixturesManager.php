<?php
/**
 * Created by PhpStorm.
 * User: loic
 * Date: 11/06/18
 * Time: 14:07
 */

namespace App\Services;


use Faker\Factory;
use Faker\Generator;

class FixturesManager
{

    protected $faker;
    public function __construct()
    {
        $this->faker = Factory::create();
    }
    /**
     * @return Generator
     */
    public function getFaker(){
        return $this->faker;
    }

}