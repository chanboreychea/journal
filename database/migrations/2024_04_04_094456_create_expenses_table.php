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
            $table->string('year', 4); //ឆ្នាំអនុវត្ត
            $table->string('enity'); //លេខអង្គភាព
            $table->string('expenditureType'); //ប្រភេទ
            $table->string('subAccount'); //អនុគណនី
            $table->string('clusterAct'); //ចង្កោមសកម្ម

            $table->string('expenseGuaranteeNum')->nullable(); //លេខធានាចំណាយ
            $table->date('dateAdv')->nullable(); //កាលបរិច្ឆេទធានា
            $table->double('amountAdv')->nullable(); //ទឹកប្រាក់ធានា
            $table->double('remainingBal')->nullable(); //ឥណទាននៅសល់

            $table->string('manDate')->nullable(); //លេខអាណត្តិ
            $table->date('dateManDate')->nullable(); //កាលបរិច្ឆេទអាណត្តិ
            $table->double('amountMand')->nullable(); //ទឹកប្រាក់អាណត្តិ
            $table->double('remainingBudget')->nullable(); //ឥណទាននៅសល់

            $table->string('manDateCash')->nullable(); //លេខអាណត្តិបើកសាច់ប្រាក់
            $table->date('dateManDateCash')->nullable(); //កាលបរិច្ឆេទបើកសាច់ប្រាក់
            $table->double('amountMandCash')->nullable(); //ទឹកប្រាក់បានបើក
            $table->double('remainingBudgetCash')->nullable(); //ឥណទាននៅសល់

            $table->double('arrear')->nullable(); //សាច់ប្រាក់មិនទាន់បើកពីរតនាជាតិ
            $table->string('file')->nullable();
            $table->text('description')->nullable(); //
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
