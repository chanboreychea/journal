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
        Schema::create('revenue_details', function (Blueprint $table) {
            $table->id();
            $table->foreignId('revenueId')->constrained('revenues')->onDelete('cascade');
            $table->string('regulatorName', 100);
            $table->float('amountDolla')->nullable();
            $table->float('amountRiel')->nullable();
            $table->double('totalAmountWithRate')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('revenue_details');
    }
};
