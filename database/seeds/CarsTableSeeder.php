<?php

use App\Car;
use Faker\Factory as Faker;
use Illuminate\Database\Seeder;

class CarsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker = Faker::create();
        $cars = [];

        for ($i = 1; $i <= 50; $i++) {
            $cars[] = [
                'id'          => $i,
                'name'        => 'Car ' . intval($i + 100),
                'description' => $faker->paragraph,
                'capacity'    => mt_rand(10, 100),
            ];
        }

        Car::insert($cars);
    }
}
