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
            $table->string('tempat_lahir')->nullable()->change();
            $table->date('tgl_lahir')->nullable()->change();
            $table->string('gender')->nullable()->change();
            $table->string('alamat')->nullable()->change();
            $table->string('telepon')->nullable()->change();
            $table->string('kewarganegaraan')->nullable()->change();
            $table->string('riwayat_sekolah')->nullable()->change();
            $table->string('nama_sekolah')->nullable()->change();
            $table->string('jurusan')->nullable()->change();
            $table->integer('tahun_lulus')->nullable()->change();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        //
    }
};
