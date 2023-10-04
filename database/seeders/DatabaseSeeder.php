<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;

use App\Models\Device;
use App\Models\History;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // \App\Models\User::factory(10)->create();
        $this->call(RoleSeeder::class);
        \App\Models\User::factory()->create([
            'name' => 'aldan',
            'email' => 'aldan@gmail.com',
            'password' => bcrypt('aldan123'),
            'roles' => 1
        ]);
        Device::factory()->create([
            'nama_device' => 'device1',
        ]);
    }
}
