<?php

namespace App\Policies;

use App\Manager;
use App\Brand;
use Illuminate\Auth\Access\HandlesAuthorization;

class BrandPolicy
{
    use HandlesAuthorization;

    public function list(Manager $manager)
    {
        return in_array('brand_list', $manager->permissions);
    }

    /**
     * Determine whether the user can view the brand.
     *
     * @param  \App\Manager  $manager
     * @param  \App\Brand  $brand
     * @return mixed
     */
    public function view(Manager $manager, Brand $brand)
    {
        return in_array('brand_view', $manager->permissions);
    }

    /**
     * Determine whether the user can create brands.
     *
     * @param  \App\Manager  $manager
     * @return mixed
     */
    public function create(Manager $manager)
    {
        return in_array('brand_create', $manager->permissions);
    }

    /**
     * Determine whether the user can update the brand.
     *
     * @param  \App\Manager  $manager
     * @param  \App\Brand  $brand
     * @return mixed
     */
    public function update(Manager $manager, Brand $brand)
    {
        return in_array('brand_update', $manager->permissions);
    }

    /**
     * Determine whether the user can delete the brand.
     *
     * @param  \App\Manager  $manager
     * @param  \App\Brand  $brand
     * @return mixed
     */
    public function delete(Manager $manager, Brand $brand)
    {
        return in_array('brand_delete', $manager->permissions);
    }

    /**
     * Determine whether the user can restore the brand.
     *
     * @param  \App\Manager  $manager
     * @param  \App\Brand  $brand
     * @return mixed
     */
    public function restore(Manager $manager, Brand $brand)
    {
        //
    }

    /**
     * Determine whether the user can permanently delete the brand.
     *
     * @param  \App\Manager  $manager
     * @param  \App\Brand  $brand
     * @return mixed
     */
    public function forceDelete(Manager $manager, Brand $brand)
    {
        //
    }
}
