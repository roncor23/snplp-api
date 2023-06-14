<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Personal;

class Repayment extends Model
{
    protected $table = 'repayments';

    use HasFactory;

    protected $fillable = [
        'date_paid',
        'amount_paid',
        'confirmation_number',
        'total_amount_paid'
    ];

    public function personal() {
        return $this->belongsTo(Personal::class, 'per_id');
    }
}
