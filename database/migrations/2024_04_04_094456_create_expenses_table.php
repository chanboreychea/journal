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
        Schema::create('expenses', function (Blueprint $table) {
            $table->id();
            $table->foreignId('catId')->constrained('categories')->onDelete('cascade');
            $table->string('year', 4);
            $table->string('enity');
            $table->string('file')->nullable();
            $table->date('dateAdv');
            $table->string('subAccount');
            $table->string('clusterAct');
            $table->double('amountAdv');
            $table->double('remainingBal');
            $table->text('description')->nullable();
            $table->date('manDate');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('expenses');
    }
};
