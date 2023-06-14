<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Personal;

class Status extends Model
{
    protected $table = 'status_payments';

    use HasFactory;

    protected $fillable = [
        'status',
        'submitted_nbi'
    ];

    public function personal() {
        return $this->belongsTo(Personal::class, 'per_id');
    }
}
