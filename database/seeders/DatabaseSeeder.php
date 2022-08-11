<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        // \App\Models\User::factory(10)->create();
        $this->call(JurusanSeeder::class);
        $this->call(ProdiSeeder::class);
        $this->call(KelasSeeder::class);
        $this->call(MahasiswaSeeder::class);
        $this->call(UserSeeder::class);
    }
}
