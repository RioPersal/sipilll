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
        Schema::create('rincian_rps', function (Blueprint $table) {
            $table->id();
            $table->string('id_matkul');
            $table->string('week');
            $table->longText('sub_cpmk')->nullable();
            $table->longText('asesmen')->nullable();
            $table->longText('kajian')->nullable();
            $table->longText('metode')->nullable();
            $table->longText('time')->nullable();
            $table->longText('pengalaman')->nullable();
            $table->longText('media')->nullable();
            $table->longText('fasilitator')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('rincian_rps');
    }
};
