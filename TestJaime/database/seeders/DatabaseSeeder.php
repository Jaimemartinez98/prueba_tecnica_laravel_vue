<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        DB::table('users')->insert([
            'name' => 'Jaime',
            'email' => 'jaimemartinez0605@gmail.com',
            'password' => '$2y$10$ZS96Q6aXvXmP0sC.qkcxoepNk3iMbelVwPYUTWm6BXFn.c0/rN3jC',
        ]);
    }
}
