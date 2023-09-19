<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;

use App\Models\JobStatus;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        \App\Models\User::factory(2)->create();

        \App\Models\User::factory()->create([
             'name' => 'drfoxg',
             'email' => 'drfoxg@gmail.com',
             'password' => Hash::make('wow1945wow'),
         ]);

         \App\Models\User::factory()->create([
            'name' => 'fionflex',
            'email' => 'fionflex@gmail.com',
            'password' => Hash::make('wow1945wow'),
         ]);

         \App\Models\User::factory()->create([
            'name' => 'Иван',
            'email' => 'gop@mail.ru',
            'password' => Hash::make('12345678'),
         ]);

         $this->call([
            JobStateSeeder::class,
            EmployerHasWokerSeeder::class,
            JobSeeder::class,
         ]);
    }
}
