<?php

use Illuminate\Database\Seeder;

class ProductsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory(\App\Product::class, 30)->create()->each(function ($product) {
            $product->save();
        });

        $categories = \App\Category::all('id')->pluck('id')->all();
        $c_max = count($categories);
        $brands = \App\Brand::all('id')->pluck('id')->all();
        $b_max = count($brands);
        if ($c_max > 0 || $b_max > 0) {
            foreach (\App\Product::all('id') as $product) {
                if ($c_max > 0) {
                    $product->category_id = $categories[rand(0, $c_max-1)];
                }
                if ($b_max > 0) {
                    $product->brand_id = $brands[rand(0, $b_max-1)];
                }
                $product->save();
            }
        }
    }
}
