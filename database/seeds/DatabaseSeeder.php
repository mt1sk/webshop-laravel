<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $this->call([
            ManagersSeeder::class,
            CategoriesSeeder::class,
            BrandsSeeder::class,
            ProductsSeeder::class,
            CouponsSeeder::class,
            PaymentsSeeder::class,
            DeliveriesSeeder::class,
        ]);
    }
}
