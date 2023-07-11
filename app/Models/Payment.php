<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Payment extends Model
{
    protected $table = 'payments';

    use HasFactory;

    protected $fillable = [
        'personal_id',
        'date_paid',
        'amount_paid',
        'confirmation_number',
    ];

    public function personal() {
        return $this->belongsTo(Personal::class, 'per_id');
    }
}
