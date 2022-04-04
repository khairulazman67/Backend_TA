<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddForeignKeysToPelanggarans extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('pelanggarans', function (Blueprint $table) {
            $table->foreign('NIM','id_mahasiswa_fk1')->references('NIM')->
            on('mahasiswas')->onUpdate('CASCADE')->onDelete('RESTRICT');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('id_mahasiswa_fk1', function (Blueprint $table) {
            Schema::dropIfExists('id_mahasiswa_fk1');
        });
    }
}
