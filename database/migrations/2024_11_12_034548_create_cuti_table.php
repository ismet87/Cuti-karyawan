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
        Schema::create('cuti', function (Blueprint $table) {
            $table->id();
            $table->integer('karyawan_id');
            $table->date('tgl_awal');
            $table->date('tgl_akhir');
            $table->integer('lama_cuti');
            $table->integer('keterangan');
            $table->integer('jenis_cuti_id');
            $table->datetime('tgl_entri');
            $table->integer('sisa_cuti');
            $table->enum('status', ['pending', 'disetujui', 'ditolak'])->default('pending');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('cuti');
    }
};
