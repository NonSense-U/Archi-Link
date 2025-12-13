<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    use WithoutModelEvents;

    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // User::factory(10)->create();

        User::factory()->create([
            'name' => 'akikon',
            'username' => 'testUser1',
            'email' => 'akikon@gmail.com',
        ]);


        User::factory()->create([
            'name' => 'Test User',
            'username' => 'testUser2',
            'email' => 'testUser2@gmail.com',
        ]);


        $this->call(
            [
                RolesAndPermissionsSeeder::class,
                PostSeeder::class
            ]
        );
    }
}
