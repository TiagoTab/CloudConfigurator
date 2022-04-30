<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {

        //Set a default admin as an example
        User::insert
        ([
            'name' => 'Tiago Gonçalves',
            'email' => 'tiago@redetab.com',
            'email_verified_at' => now(),
            'password' => Hash::make('CloudConfig#demo'),
        ]);

         \App\Models\User::factory(10)->create();


    }
}
