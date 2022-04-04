<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddForeignKeysToMahasiswas extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('mahasiswas', function (Blueprint $table) {
            // $table->foreign('id_jurusan','id_jurusan_fk2')->references('id')->
            // on('jurusans')->onUpdate('CASCADE')->onDelete('RESTRICT');

            // $table->foreign('id_prodi','id_prodi_fk2')->references('id')->
            // on('prodis')->onUpdate('CASCADE')->onDelete('RESTRICT');

            $table->foreign('id_kelas','id_kelas_fk1')->references('id')->
            on('kelas')->onUpdate('CASCADE')->onDelete('RESTRICT');

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('mahasiswas', function (Blueprint $table) {
            // Schema::dropIfExists('id_jurusan_fk2');
            // Schema::dropIfExists('id_prodi_fk2');
            Schema::dropIfExists('id_kelas_fk2');
        });
    }
}
