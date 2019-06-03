<?php

namespace App\Providers;

use App\Brand;
use App\Category;
use App\Manager;
use App\Policies\BrandPolicy;
use App\Policies\CategoryPolicy;
use App\Policies\ManagerPolicy;
use App\Policies\ProductPolicy;
use App\Product;
use Illuminate\Support\Facades\Gate;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * The policy mappings for the application.
     *
     * @var array
     */
    protected $policies = [
        Manager::class => ManagerPolicy::class,
        Product::class => ProductPolicy::class,
        Category::class => CategoryPolicy::class,
        Brand::class => BrandPolicy::class,
    ];

    /**
     * Register any authentication / authorization services.
     *
     * @return void
     */
    public function boot()
    {
        $this->registerPolicies();

        //
    }
}
