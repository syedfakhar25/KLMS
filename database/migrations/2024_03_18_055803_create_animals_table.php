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
        Schema::create('animals', function (Blueprint $table) {
            $table->id();
            $table->integer('premesis_id')->nullable();
            $table->integer('vaccine_id')->nullable();
            $table->string('species')->nullable();
            $table->string('breed')->nullable();
            $table->string('class')->nullable();
            $table->string('gender')->nullable();
            $table->string('birth_date')->nullable();
            $table->string('dam_tag')->nullable();
            $table->string('old_dam_tag')->nullable();
            $table->string('sire_tag')->nullable();
            $table->string('old_sire_tag')->nullable();
            $table->string('production_type')->nullable();
            $table->string('status')->nullable();
            $table->string('image')->nullable();
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
        Schema::dropIfExists('animals');
    }
};
