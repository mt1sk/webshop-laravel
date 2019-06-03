<?php

namespace App\Policies;

use App\Manager;
use Illuminate\Auth\Access\HandlesAuthorization;

class ManagerPolicy
{
    use HandlesAuthorization;

    public function list(Manager $manager)
    {
        return in_array('manager_list', $manager->permissions);
    }

    /**
     * Determine whether the user can view the manager.
     *
     * @param  \App\Manager  $manager
     * @param  \App\Manager  $entity
     * @return mixed
     */
    public function view(Manager $manager, Manager $entity)
    {
        return in_array('manager_view', $manager->permissions);
    }

    /**
     * Determine whether the user can create managers.
     *
     * @param  \App\Manager  $manager
     * @return mixed
     */
    public function create(Manager $manager)
    {
        return in_array('manager_create', $manager->permissions);
    }

    /**
     * Determine whether the user can update the manager.
     *
     * @param  \App\Manager  $manager
     * @param  \App\Manager  $entity
     * @return mixed
     */
    public function update(Manager $manager, Manager $entity)
    {
        return in_array('manager_update', $manager->permissions);
    }

    /**
     * Determine whether the user can delete the manager.
     *
     * @param  \App\Manager  $manager
     * @param  \App\Manager  $entity
     * @return mixed
     */
    public function delete(Manager $manager, Manager $entity)
    {
        return in_array('manager_delete', $manager->permissions);
    }

    /**
     * Determine whether the user can restore the manager.
     *
     * @param  \App\Manager  $manager
     * @param  \App\Manager  $entity
     * @return mixed
     */
    public function restore(Manager $manager, Manager $entity)
    {
        //
    }

    /**
     * Determine whether the user can permanently delete the manager.
     *
     * @param  \App\Manager  $manager
     * @param  \App\Manager  $entity
     * @return mixed
     */
    public function forceDelete(Manager $manager, Manager $entity)
    {
        //
    }
}
