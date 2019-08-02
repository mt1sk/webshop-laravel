<?php

namespace App\Policies;

use App\Manager;
use App\Payment;
use Illuminate\Auth\Access\HandlesAuthorization;

class PaymentPolicy
{
    use HandlesAuthorization;

    public function list(Manager $manager)
    {
        return in_array('payment_list', $manager->permissions);
    }

    /**
     * Determine whether the user can view the payment.
     *
     * @param  \App\Manager  $manager
     * @param  \App\Payment  $payment
     * @return mixed
     */
    public function view(Manager $manager, Payment $payment)
    {
        return in_array('payment_view', $manager->permissions);
    }

    /**
     * Determine whether the user can create payments.
     *
     * @param  \App\Manager  $manager
     * @return mixed
     */
    public function create(Manager $manager)
    {
        return in_array('payment_create', $manager->permissions);
    }

    /**
     * Determine whether the user can update the payment.
     *
     * @param  \App\Manager  $manager
     * @param  \App\Payment  $payment
     * @return mixed
     */
    public function update(Manager $manager, Payment $payment)
    {
        return in_array('payment_update', $manager->permissions);
    }

    /**
     * Determine whether the user can delete the payment.
     *
     * @param  \App\Manager  $manager
     * @param  \App\Payment  $payment
     * @return mixed
     */
    public function delete(Manager $manager, Payment $payment)
    {
        return in_array('payment_delete', $manager->permissions);
    }

    /**
     * Determine whether the user can restore the payment.
     *
     * @param  \App\Manager  $manager
     * @param  \App\Payment  $payment
     * @return mixed
     */
    public function restore(Manager $manager, Payment $payment)
    {
        //
    }

    /**
     * Determine whether the user can permanently delete the payment.
     *
     * @param  \App\Manager  $manager
     * @param  \App\Payment  $payment
     * @return mixed
     */
    public function forceDelete(Manager $manager, Payment $payment)
    {
        //
    }
}
