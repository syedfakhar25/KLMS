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
        Schema::create('owenerships', function (Blueprint $table) {
            $table->id();
            $table->integer('premesis_id');
            $table->string('owner_name')->nullable();
            $table->string('address')->nullable();
            $table->string('number')->nullable();
            $table->string('cnic')->nullable();
            $table->string('company_name')->nullable();
            $table->string('reg_no')->nullable();
            $table->string('type')->nullable();
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
        Schema::dropIfExists('owenerships');
    }
};
