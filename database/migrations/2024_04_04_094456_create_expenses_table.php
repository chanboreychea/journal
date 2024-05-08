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
            $table->string('expenseGuaranteeNum')->nullable(); //លេខធានាចំណាយ
            $table->date('dateAdv')->nullable(); //កាលបរិច្ឆេទធានា
            $table->string('subAccount'); //អនុគណនី
            $table->string('clusterAct'); //ចង្កោមសកម្ម
            $table->double('amountAdv'); //ទឹកប្រាក់ធានា
            $table->double('remainingBal'); //ឥណទាននៅសល់
            $table->text('description')->nullable(); //
            $table->string('manDate'); //លេខអាណត្តិ
            $table->date('dateManDate'); //កាលបរិច្ឆេទអាណត្តិ
            $table->double('amountMand'); //ទឹកប្រាក់អាណត្តិ
            $table->double('ramainingBudget'); //ឥណទាននៅសល់
            $table->string('manDateCash'); //លេខអាណត្តិបើកសាច់ប្រាក់
            $table->date('dateManDateCash'); //កាលបរិច្ឆេទបើកសាច់ប្រាក់
            $table->double('amountMandCash'); //ទឹកប្រាក់បានបើក
            $table->double('remainingBudgetCash'); //ឥណទាននៅសល់
            $table->double('arrear')->nullable(); //សាច់ប្រាក់មិនទាន់បើកពីរតនាជាតិ
            $table->string('file')->nullable();
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
