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
        Schema::create('persentases', function (Blueprint $table) {
            $table->id();
            $table->string('id_kelas');
            $table->string('persentase1')->nullable();
            $table->string('persentase2')->nullable();
            $table->string('persentase3')->nullable();
            $table->string('persentase4')->nullable();
            $table->string('persentase5')->nullable();
            $table->string('persentase6')->nullable();
            $table->string('persentase7')->nullable();
            $table->string('persentase8')->nullable();
            $table->string('persentase9')->nullable();
            $table->string('persentase10')->nullable();
            $table->string('persentase11')->nullable();
            $table->string('persentase12')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('persentases');
    }
};
