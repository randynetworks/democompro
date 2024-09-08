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
        Schema::create('kontak_kamis', function (Blueprint $table) {
            $table->id();
            $table->string('email')->unique();
            $table->string('phone');
            $table->string('location');
            $table->text('maps');
            $table->string('instagram');
            $table->string('url_instagram');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('kontak_kamis');
    }
};
