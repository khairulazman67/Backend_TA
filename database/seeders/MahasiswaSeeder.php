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
                'NIM' => 1857301065,
                'nama' => 'Defina Humaira Putri',
                'id_kelas' => 9
            ]
        );
        Mahasiswa::create(
            [
                'NIM' => 1857301036,
                'nama' => 'Fauzi Syifani',
                'id_kelas' => 9
            ]
        );
        Mahasiswa::create(
            [
                'NIM' => 1857301009,
                'nama' => 'Ika Wulandari',
                'id_kelas' => 9
            ]
        );
        Mahasiswa::create(
            [
                'NIM' => 1857301038,
                'nama' => 'Khairul Azman',
                'id_kelas' => 9
            ]
        );
        Mahasiswa::create(
            [
                'NIM' => 1857301029,
                'nama' => 'Muhammad Fadil Khairunnas',
                'id_kelas' => 9
            ]
        );
        Mahasiswa::create(
            [
                'NIM' => 1857301070,
                'nama' => 'Muhammad Harris',
                'id_kelas' => 9
            ]
        );
        
        Mahasiswa::create(
            [
                'NIM' => 1857301017,
                'nama' => 'Muhammad Rezeki Ananda',
                'id_kelas' => 9
            ]
        );
        Mahasiswa::create(
            [
                'NIM' => 1857301042,
                'nama' => 'Muhammad Rizal',
                'id_kelas' => 9
            ]
        );
        Mahasiswa::create(
            [
                'NIM' => 1857301068,
                'nama' => 'Muzammil',
                'id_kelas' => 9
            ]
        );
        Mahasiswa::create(
            [
                'NIM' => 1857301032,
                'nama' => 'Nishra Ilkhalissia',
                'id_kelas' => 9
            ]
        );

        Mahasiswa::create(
            [
                'NIM' => 1857301060,
                'nama' => 'Nurul Fatani',
                'id_kelas' => 9
            ]
        );
        Mahasiswa::create(
            [
                'NIM' => 1857301067,
                'nama' => 'Raudhy',
                'id_kelas' => 9
            ]
        );

        Mahasiswa::create(
            [
                'NIM' => 1857301014,
                'nama' => 'Salsabila Akmal',
                'id_kelas' => 9
            ]
        );
        Mahasiswa::create(
            [
                'NIM' => 1857301058,
                'nama' => 'Saydina Ambiya Rizki',
                'id_kelas' => 9
            ]
        );
        Mahasiswa::create(
            [
                'NIM' => 1857301028,
                'nama' => 'Syambari Herian Atmaja',
                'id_kelas' => 9
            ]
        );
        Mahasiswa::create(
            [
                'NIM' => 1857301057,
                'nama' => 'Syifa Zahra',
                'id_kelas' => 9
            ]
        );
        Mahasiswa::create(
            [
                'NIM' => 1857301053,
                'nama' => 'Tajun Nur',
                'id_kelas' => 9
            ]
        );
    }
}
