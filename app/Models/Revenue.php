<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Revenue extends Model
{
    use HasFactory;

    protected $table = 'revenues';
    protected $primaryKey = 'id';
    protected $keyType = 'string';
    protected $fillable = [
        'date', 'noFsa', 'orderReference', 'dateOfBankIncomeCard', 'bank', 'file'
    ];

    public function revenueDetail()
    {
        return $this->hasMany('revenue_details', 'revenueId');
    }
}
