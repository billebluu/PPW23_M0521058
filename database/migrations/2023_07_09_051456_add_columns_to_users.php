<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::table('users', function (Blueprint $table) {
            $table->string('nama');
            $table->string('tempat_lahir');
            $table->date('tgl_lahir');
            $table->string('gender');
            $table->string('alamat');
            $table->string('telepon');
            $table->string('kewarganegaraan');
            $table->string('riwayat_sekolah');
            $table->string('nama_sekolah');
            $table->string('jurusan');
            $table->string('tahun_lulus');
            $table->string('pasfoto')->nullable();
            $table->string('ijazah')->nullable();
            $table->string('transkrip_nilai')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('users', function (Blueprint $table) {
            //
        });
    }
};
