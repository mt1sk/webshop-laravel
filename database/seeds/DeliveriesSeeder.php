<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Storage;

class DeliveriesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        foreach (\App\Delivery::$originalDir as $dir) {
            if (!Storage::disk('public')->exists($dir)) {
                Storage::disk('public')->makeDirectory($dir);
            }
        }

        factory(\App\Delivery::class, 5)->create()->each(function ($delivery) {
            $delivery->save();
        });
    }
}
