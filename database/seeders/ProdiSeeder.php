<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Prodi;
class ProdiSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Prodi::create(
            ['nm_prodi' => 'Teknik Informatika',
            'id_jurusan' => '1']
        );
        Prodi::create(
            ['nm_prodi' => 'Teknologi Rekayasa Komputer dan Jaringan',
            'id_jurusan' => '1']
        );
        Prodi::create(
            ['nm_prodi' => 'Teknologi Rekayasa Multimedia',
            'id_jurusan' => '1']
        );
    }
}
