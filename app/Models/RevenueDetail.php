<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class RevenueDetail extends Model
{
    use HasFactory;

    protected $table = 'revenue_details';
    protected $keyType = 'string';
    protected $fillable = [
        'revenueId', 'regulatorName', 'amountDolla', 'amountRiel',
    ];

    public function revenue()
    {
        return $this->belongsTo('revenues');
    }
}
