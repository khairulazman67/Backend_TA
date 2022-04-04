<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Jurusan;
class JurusanSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Jurusan::create(
            ['nm_jurusan' => 'Teknologi Informasi dan Komputer'],
        );
        Jurusan::create(
            ['nm_jurusan' => 'Teknik Sipil'],
        );
        Jurusan::create(
            ['nm_jurusan' => 'Teknik Mesin'],
        );
        Jurusan::create(
            ['nm_jurusan' => 'Teknik Elektro'],
        );
        Jurusan::create(
            ['nm_jurusan' => 'Tata Niaga'],
        );
    }
}
