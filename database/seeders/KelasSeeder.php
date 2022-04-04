<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Kelas;
class KelasSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Kelas::create(
            ['nm_kelas' => 'TI-1A',
            'id_prodi' => '1']
        );
        Kelas::create(
            ['nm_kelas' => 'TI-1B',
            'id_prodi' => '1']
        );
        Kelas::create(
            ['nm_kelas' => 'TI-2A',
            'id_prodi' => '1']
        );
        Kelas::create(
            ['nm_kelas' => 'TI-2B',
            'id_prodi' => '1']
        );
        Kelas::create(
            ['nm_kelas' => 'TI-3A',
            'id_prodi' => '1']
        );
        Kelas::create(
            ['nm_kelas' => 'TI-3B',
            'id_prodi' => '1']
        );
        Kelas::create(
            ['nm_kelas' => 'TI-3C',
            'id_prodi' => '1']
        );
        Kelas::create(
            ['nm_kelas' => 'TI-4A',
            'id_prodi' => '1']
        );
        Kelas::create(
            ['nm_kelas' => 'TI-4B',
            'id_prodi' => '1']
        );
        Kelas::create(
            ['nm_kelas' => 'TI-4C',
            'id_prodi' => '1']
        );
    }
}
