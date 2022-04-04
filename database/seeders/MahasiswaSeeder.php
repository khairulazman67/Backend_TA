<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Mahasiswa;
class MahasiswaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Mahasiswa::create(
            [
                'NIM' => 1857301038,
                'nama' => 'Khairul Azman',
                'id_kelas' => 9
            ]
        );
    }
}
