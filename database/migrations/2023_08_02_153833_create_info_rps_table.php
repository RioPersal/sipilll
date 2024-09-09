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
        Schema::create('info_rps', function (Blueprint $table) {
            $table->id();
            $table->string('id_matkul');
            $table->longText('deskripsi')->nullable();
            $table->longText('kajian')->nullable();
            $table->longText('refrensi')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('info_rps');
    }
};
