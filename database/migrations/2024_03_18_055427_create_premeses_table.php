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
        Schema::create('premeses', function (Blueprint $table) {
            $table->id();
            $table->string('name')->nullable();
            $table->integer('user_id')->nullable();
            $table->string('province')->nullable();
            $table->string('district')->nullable();
            $table->string('tehsil')->nullable();
            $table->string('uc')->nullable();
            $table->string('village')->nullable();
            $table->string('type')->nullable();
            $table->string('status')->nullable();
            $table->string('latitude')->nullable();
            $table->string('longitude')->nullable();
            $table->integer('quarantine_facility')->nullable();
            $table->string('nearby_hospital')->nullable();
            $table->string('vet_name')->nullable();
            $table->string('vet_contact')->nullable();
            $table->string('assistant_name')->nullable();
            $table->string('assistant_contact')->nullable();
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
        Schema::dropIfExists('premeses');
    }
};
