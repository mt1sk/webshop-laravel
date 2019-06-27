<?php

namespace App\Policies;

use App\Manager;
use App\Coupon;
use Illuminate\Auth\Access\HandlesAuthorization;

class CouponPolicy
{
    use HandlesAuthorization;

    public function list(Manager $manager)
    {
        return in_array('coupon_list', $manager->permissions);
    }

    /**
     * Determine whether the user can view the coupon.
     *
     * @param  \App\Manager  $manager
     * @param  \App\Coupon  $coupon
     * @return mixed
     */
    public function view(Manager $manager, Coupon $coupon)
    {
        return in_array('coupon_view', $manager->permissions);
    }

    /**
     * Determine whether the user can create coupons.
     *
     * @param  \App\Manager  $manager
     * @return mixed
     */
    public function create(Manager $manager)
    {
        return in_array('coupon_create', $manager->permissions);
    }

    /**
     * Determine whether the user can update the coupon.
     *
     * @param  \App\Manager  $manager
     * @param  \App\Coupon  $coupon
     * @return mixed
     */
    public function update(Manager $manager, Coupon $coupon)
    {
        return in_array('coupon_update', $manager->permissions);
    }

    /**
     * Determine whether the user can delete the coupon.
     *
     * @param  \App\Manager  $manager
     * @param  \App\Coupon  $coupon
     * @return mixed
     */
    public function delete(Manager $manager, Coupon $coupon)
    {
        return in_array('coupon_delete', $manager->permissions);
    }

    /**
     * Determine whether the user can restore the coupon.
     *
     * @param  \App\Manager  $manager
     * @param  \App\Coupon  $coupon
     * @return mixed
     */
    public function restore(Manager $manager, Coupon $coupon)
    {
        //
    }

    /**
     * Determine whether the user can permanently delete the coupon.
     *
     * @param  \App\Manager  $manager
     * @param  \App\Coupon  $coupon
     * @return mixed
     */
    public function forceDelete(Manager $manager, Coupon $coupon)
    {
        //
    }
}
