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
        Schema::create('repayments', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('personal_id');
            $table->string('date_paid')->nullable();
            $table->decimal('amount_paid', 5, 2)->nullable();
            $table->string('confirmation_number')->nullable();
            $table->decimal('total_amount_paid', 5, 2);
            $table->timestamps();
            $table->foreign('personal_id')->references('id')->on('personal_informations')->onUpdate('cascade')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('repayments');
    }
};
