<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Expense extends Model
{
    use HasFactory;

    protected $table = 'expenses';
    protected $primaryKey = 'id';
    protected $keyType = 'string';
    protected $fillable = [
        'year',
        'enity',
        'expenditureType',
        'subAccount',
        'clusterAct',

        'expenseGuaranteeNum',
        'dateAdv',
        'amountAdv',
        'remainingBal',

        'manDate',
        'dateManDate',
        'amountMand',
        'remainingBudget',

        'manDateCash',
        'dateManDateCash',
        'amountMandCash',
        'remainingBudgetCash',

        'arrear',
        'file',
        'description'
    ];
}
