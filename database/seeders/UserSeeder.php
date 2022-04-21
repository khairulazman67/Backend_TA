<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        User::create(
            [
                'name' => 'Muhammad Azman',
                'email' => 'azman.khairul67@gmail.com',
                'id_prodi' => '1',
                'level' => 'ka_prodi',
                'password' => Hash::make('azman123'),
            ]
        );
        User::create(
            [
                'name' => 'Khairul Azman',
                'email' => 'asman.khairul67@yahoo.co.id',
                'id_prodi' => '1',
                'level' => 'staf_prodi',
                'password' => Hash::make('azman123'),
            ]
        );
    }
}
