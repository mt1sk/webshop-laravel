<?php

use Illuminate\Database\Seeder;

class CouponsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        \App\Coupon::where('code', 'mt1sk')->delete();
        \App\Coupon::create([
            'code'  => 'mt1sk',
            'type'  => 'percentage',
            'value' => 50,
        ]);

        factory(\App\Coupon::class, 10)->create()->each(function ($coupon) {
            $coupon->save();
        });
    }
}
