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
        Schema::create('ucapans', function (Blueprint $table) {
            $table->id();
            $table->string('gambar');
            $table->string('nama')->nullable();
            $table->integer('id_jabatan_fk');
            $table->longText('deskripsi')->nullable();
            $table->longText('deskripsi_en')->nullable();
            $table->longText('tagline')->nullable();
            $table->longText('tagline_en')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('ucapans');
    }
};
