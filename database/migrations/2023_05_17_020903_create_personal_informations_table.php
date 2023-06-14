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
        Schema::create('personal_informations', function (Blueprint $table) {
            $table->id();
            $table->string('last_name');
            $table->string('maiden_name')->nullable();
            $table->string('first_name');
            $table->string('middle_name')->nullable();
            $table->string('name_ext')->nullable();
            $table->string('course')->nullable();
            $table->string('month_year_graduated')->nullable();
            $table->string('sex');
            $table->string('comaker')->nullable();
            $table->string('hei')->nullable();
            $table->string('contact_number')->nullable();
            $table->string('address')->nullable();
            $table->string('email')->nullable();
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
        Schema::dropIfExists('personal_informations');
    }
};
