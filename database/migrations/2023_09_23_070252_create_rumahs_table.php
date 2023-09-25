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
        Schema::create('rumahs', function (Blueprint $table) {
            $table->id();
            $table->string('nama')->length(100);
            $table->string('nik')->length(20);
            $table->string('nokk')->length(20);
            $table->text('alamat');
            $table->string('pekerjaan')->length(50);
            $table->date('tanggal_lahir');
            $table->string('tempat_lahir');
            $table->string('longitude')->nullable();
            $table->string('latitude')->nullable();
            $table->string('foto_sebelum')->nullable();
            $table->string('foto_sesudah')->nullable();
            $table->text('keterangan');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('rumahs');
    }
};
