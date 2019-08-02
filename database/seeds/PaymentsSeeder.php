<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Storage;

class PaymentsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        foreach (\App\Payment::$originalDir as $dir) {
            if (!Storage::disk('public')->exists($dir)) {
                Storage::disk('public')->makeDirectory($dir);
            }
        }

        factory(\App\Payment::class, 5)->create()->each(function ($payment) {
            $payment->save();
        });
    }
}
