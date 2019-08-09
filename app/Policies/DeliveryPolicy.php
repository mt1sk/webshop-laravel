<?php

namespace App\Policies;

use App\Manager;
use App\Delivery;
use Illuminate\Auth\Access\HandlesAuthorization;

class DeliveryPolicy
{
    use HandlesAuthorization;
    
    public function list(Manager $manager)
    {
        return in_array('delivery_list', $manager->permissions);
    }

    /**
     * Determine whether the user can view the delivery.
     *
     * @param  \App\Manager  $manager
     * @param  \App\Delivery  $delivery
     * @return mixed
     */
    public function view(Manager $manager, Delivery $delivery)
    {
        return in_array('delivery_view', $manager->permissions);
    }

    /**
     * Determine whether the user can create deliveries.
     *
     * @param  \App\Manager  $manager
     * @return mixed
     */
    public function create(Manager $manager)
    {
        return in_array('delivery_create', $manager->permissions);
    }

    /**
     * Determine whether the user can update the delivery.
     *
     * @param  \App\Manager  $manager
     * @param  \App\Delivery  $delivery
     * @return mixed
     */
    public function update(Manager $manager, Delivery $delivery)
    {
        return in_array('delivery_update', $manager->permissions);
    }

    /**
     * Determine whether the user can delete the delivery.
     *
     * @param  \App\Manager  $manager
     * @param  \App\Delivery  $delivery
     * @return mixed
     */
    public function delete(Manager $manager, Delivery $delivery)
    {
        return in_array('delivery_delete', $manager->permissions);
    }

    /**
     * Determine whether the user can restore the delivery.
     *
     * @param  \App\Manager  $manager
     * @param  \App\Delivery  $delivery
     * @return mixed
     */
    public function restore(Manager $manager, Delivery $delivery)
    {
        //
    }

    /**
     * Determine whether the user can permanently delete the delivery.
     *
     * @param  \App\Manager  $manager
     * @param  \App\Delivery  $delivery
     * @return mixed
     */
    public function forceDelete(Manager $manager, Delivery $delivery)
    {
        //
    }
}
