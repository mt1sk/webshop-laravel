<?php

use Illuminate\Database\Seeder;
use App\Manager;
use Illuminate\Support\Facades\Hash;

class ManagersSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Manager::where('email', 'mt1sk@mail.ru')->delete();
        Manager::create([
            'name'      => 'mt1sk',
            'email'     => 'mt1sk@mail.ru',
            'password'  => Hash::make('1234')
        ]);
    }
}
