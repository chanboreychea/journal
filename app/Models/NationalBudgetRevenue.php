<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class NationalBudgetRevenue extends Model
{
    use HasFactory;

    protected $table = 'national_budget_revenues';
    protected $primaryKey = 'id';
    protected $keyType = 'string';
    protected $fillable = [
        'id',
        'year',
        'enity',
        'expenditureType',
        'subAccount',
        'clusterAct',
        'cash',
        'note',
        'file'
    ];
}
