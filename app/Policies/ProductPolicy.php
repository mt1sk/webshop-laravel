<?php

namespace App\Policies;

use App\Manager;
use App\Product;
use Illuminate\Auth\Access\HandlesAuthorization;

class ProductPolicy
{
    use HandlesAuthorization;

    public function list(Manager $manager)
    {
        return in_array('product_list', $manager->permissions);
    }

    /**
     * Determine whether the user can view the product.
     *
     * @param  \App\Manager  $manager
     * @param  \App\Product  $product
     * @return mixed
     */
    public function view(Manager $manager, Product $product)
    {
        return in_array('product_view', $manager->permissions);
    }

    /**
     * Determine whether the user can create products.
     *
     * @param  \App\Manager  $manager
     * @return mixed
     */
    public function create(Manager $manager)
    {
        return in_array('product_create', $manager->permissions);
    }

    /**
     * Determine whether the user can update the product.
     *
     * @param  \App\Manager  $manager
     * @param  \App\Product  $product
     * @return mixed
     */
    public function update(Manager $manager, Product $product)
    {
        return in_array('product_update', $manager->permissions);
    }

    /**
     * Determine whether the user can delete the product.
     *
     * @param  \App\Manager  $manager
     * @param  \App\Product  $product
     * @return mixed
     */
    public function delete(Manager $manager, Product $product)
    {
        return in_array('product_delete', $manager->permissions);
    }

    /**
     * Determine whether the user can restore the product.
     *
     * @param  \App\Manager  $manager
     * @param  \App\Product  $product
     * @return mixed
     */
    public function restore(Manager $manager, Product $product)
    {
        //
    }

    /**
     * Determine whether the user can permanently delete the product.
     *
     * @param  \App\Manager  $manager
     * @param  \App\Product  $product
     * @return mixed
     */
    public function forceDelete(Manager $manager, Product $product)
    {
        //
    }
}
