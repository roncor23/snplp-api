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
        Schema::create('disbursements', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('personal_id');
            $table->decimal('principal_loan', 5, 2);
            $table->decimal('interest_during_repayment_period', 5, 2);
            $table->decimal('penalty', 5, 2);
            $table->decimal('total_full_amortization', 5, 2);
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
        Schema::dropIfExists('disbursements');
    }
};
