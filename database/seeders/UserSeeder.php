<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    /**
     * @return void
     */
    public function run(): void
    {
        User::factory()->create([
            'name' => 'Dråfølin',
            'email' => 'derg@drafolin.ch',
            'password' => env('ADMIN_PASSWORD', '')
        ]);
    }
}
