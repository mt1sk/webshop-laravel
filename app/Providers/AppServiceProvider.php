<?php

namespace App\Providers;

use App\Brand;
use App\Product;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        DB::listen(function($query) {
            /*dump($query->sql);*/
            /*dump($query->bindings);*/
        });
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        Product::deleting(function (Product $product) {
            $product->deleteImage();
            $product->deleteImage(['image_num'=>1]);
        });
        Brand::deleting(function (Brand $brand) {
            $brand->deleteImage();
        });
    }
}
