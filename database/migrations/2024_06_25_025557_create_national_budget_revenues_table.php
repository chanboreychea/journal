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
        Schema::create('national_budget_revenues', function (Blueprint $table) {
            $table->id();
            $table->string('year', 4); //ឆ្នាំអនុវត្ត
            $table->string('enity'); //លេខអង្គភាព
            $table->string('expenditureType'); //ប្រភេទ
            $table->string('clusterAct'); //ចង្កោមសកម្ម
            $table->string('subAccount'); //អនុគណនី
            $table->double('cash');
            $table->text('note')->nullable();
            $table->string('file')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('national_budget_revenues');
    }
};
