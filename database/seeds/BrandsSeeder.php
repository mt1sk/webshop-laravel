<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Storage;

class BrandsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        foreach (\App\Brand::$originalDir as $dir) {
            if (!Storage::disk('public')->exists($dir)) {
                Storage::disk('public')->makeDirectory($dir);
            }
        }

        factory(\App\Brand::class, 5)->create()->each(function ($brand) {
            $brand->save();
        });
        $brands = ['Apple', 'Samsung', 'Philips', 'LG', 'Xiaomi'];
        foreach (\App\Brand::all() as $i=>$b) {
            $b->name = $b->meta_title = $b->meta_keywords = $b->meta_description = $brands[$i];
            $b->save();
        }
    }
}
