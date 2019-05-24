<?php

use Illuminate\Database\Seeder;

class BrandsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory(\App\Brand::class, 5)->create()->each(function ($brand) {
            $brand->save((array)factory(\App\Brand::class)->make());
        });
        $brands = ['Apple', 'Samsung', 'Philips', 'LG', 'Xiaomi'];
        foreach (\App\Brand::all() as $i=>$b) {
            $b->name = $b->meta_title = $b->meta_keywords = $b->meta_description = $brands[$i];
            $b->save();
        }
    }
}
