<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Personal;
use App\Models\Repayment;

class Disbursement extends Model
{
    protected $table = 'disbursements';

    use HasFactory;

    
    protected $fillable = [
        'principal_loan',
        'interest_during_repayment_period',
        'penalty',
        'total_full_amortization'
    ];

    public function personal() {
        return $this->belongsTo(Personal::class, 'per_id');
    }

     public function repaymentInfo()
    {
        return $this->hasOne(Repayment::class);
    }
}
