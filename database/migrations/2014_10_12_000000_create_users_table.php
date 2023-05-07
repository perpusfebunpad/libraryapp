<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('users', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('npm')->unique();
            $table->string('email');
            $table->string('password');
            $table->enum("status", [
                "MAHASISWA", "DOSEN", "TENAGA_DIDIK"
            ]);
            $table->enum("departement", [
                "S1_AKUNTANSI", 
                "S1_MANAJEMEN", 
                "S1_ILMU_EKONOMI", 
                "S1_BISNIS_DIGITAL", 
                "S1_AKUNTANSI_SEKTOR_PUBLIK",
            ]);
            $table->string("phone_number");

            $table->enum("role", [ "normal", "admin",])->default("normal");
            $table->timestamp('email_verified_at')->nullable();
            $table->rememberToken();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('users');
    }
};
