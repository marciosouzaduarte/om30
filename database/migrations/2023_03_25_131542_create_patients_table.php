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
        Schema::create('patients', function (Blueprint $table) {
            $table->id();
            $table->uuid('uuid');
            $table->string('name', 50);
            $table->string('mother_name', 50);
            $table->date('dob');
            $table->string('email', 50);
            $table->string('cpf', 11);
            $table->string('cns', 15);
            $table->string('photo', 150)->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('patients');
    }
};
