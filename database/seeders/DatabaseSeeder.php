<?php

namespace Database\Seeders;

use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        User::factory(30)->create();

        User::factory()->create([
            'name' => 'ekalderr',
            'email' => 'ekalderr@rawr.com',
            'password' => Hash::make('123456789'),
            'role' => 'staff',
            'phone' => '082169696969',
        ]);

        User::factory()->create([
            'name' => 'ical',
            'email' => 'ical@lek.com',
            'password' => Hash::make('123456789'),
            'role' => 'admin',
            'phone' => '082125046969',
        ]);

        User::factory()->create([
            'name' => 'haikal',
            'email' => 'haikal@alfatih.com',
            'password' => Hash::make('123456789'),
            'role' => 'user',
            'phone' => '086969696969',
        ]);

    }
}
