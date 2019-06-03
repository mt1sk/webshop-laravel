<?php

namespace App\Policies;

use App\Manager;
use App\Category;
use Illuminate\Auth\Access\HandlesAuthorization;

class CategoryPolicy
{
    use HandlesAuthorization;

    public function list(Manager $manager)
    {
        return in_array('category_list', $manager->permissions);
    }

    /**
     * Determine whether the user can view the category.
     *
     * @param  \App\Manager  $manager
     * @param  \App\Category  $category
     * @return mixed
     */
    public function view(Manager $manager, Category $category)
    {
        return in_array('category_view', $manager->permissions);
    }

    /**
     * Determine whether the user can create categories.
     *
     * @param  \App\Manager  $manager
     * @return mixed
     */
    public function create(Manager $manager)
    {
        return in_array('category_create', $manager->permissions);
    }

    /**
     * Determine whether the user can update the category.
     *
     * @param  \App\Manager  $manager
     * @param  \App\Category  $category
     * @return mixed
     */
    public function update(Manager $manager, Category $category)
    {
        return in_array('category_update', $manager->permissions);
    }

    /**
     * Determine whether the user can delete the category.
     *
     * @param  \App\Manager  $manager
     * @param  \App\Category  $category
     * @return mixed
     */
    public function delete(Manager $manager, Category $category)
    {
        return in_array('category_delete', $manager->permissions);
    }

    /**
     * Determine whether the user can restore the category.
     *
     * @param  \App\Manager  $manager
     * @param  \App\Category  $category
     * @return mixed
     */
    public function restore(Manager $manager, Category $category)
    {
        //
    }

    /**
     * Determine whether the user can permanently delete the category.
     *
     * @param  \App\Manager  $manager
     * @param  \App\Category  $category
     * @return mixed
     */
    public function forceDelete(Manager $manager, Category $category)
    {
        //
    }
}
