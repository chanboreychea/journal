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
        Schema::create('revenues', function (Blueprint $table) {
            $table->id();
            $table->date('date');
            $table->string('noFsa');
            $table->string('orderReference');
            $table->date('dateOfBankIncomeCard')->nullable();
            $table->double('totalAmount')->nullable();
            $table->double('rate')->nullable();
            $table->double('dollaExchangeToRiel')->nullable();
            $table->string('bank')->nullable();
            $table->string('file')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('revenues');
    }
};
