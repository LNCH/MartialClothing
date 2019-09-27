<?php

use App\Domains\User\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UsersSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        User::create([
            'name' => 'Steve Jobs',
            'email' => 'steve@apple.com',
            'password' => Hash::make('password')
        ]);

        User::create([
            'name' => 'Bill Gates',
            'email' => 'bill@microsoft.com',
            'password' => Hash::make('password')
        ]);
    }
}
