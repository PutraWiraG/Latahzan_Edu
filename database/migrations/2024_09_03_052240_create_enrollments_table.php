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
        Schema::create('enrollments', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('id_siswa'); 
            $table->unsignedBigInteger('id_jadwal'); 
            $table->date('enrollment_date');
            $table->string('status', 50)->default('Pending');
            $table->string('pesan');
            $table->boolean('cancel_siswa')->default(false);
            $table->boolean('cancel_teacher')->default(false);
            $table->timestamps();

            $table->foreign('id_siswa')->references('id')->on('students')->onDelete('cascade');
            $table->foreign('id_jadwal')->references('id')->on('jadwals')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('enrollments');
    }
};
