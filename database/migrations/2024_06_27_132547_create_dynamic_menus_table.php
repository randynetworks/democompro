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
        Schema::create('dynamic_menus', function (Blueprint $table) {
            $table->id();            
            $table->string('navbar');
            $table->string('navbar_en');
            $table->text('deskripsi');
            $table->text('deskripsi_en');
            $table->longText('body');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('dynamic_menus');
    }
};
