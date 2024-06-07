<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Personal;

class Statuses extends Model
{
    protected $table = 'statuses';

    use HasFactory;

    protected $fillable = [
        'personal_id',
        'date',
        'action_taken',
        'encoded_by',
    ];

    public function personal() {
        return $this->belongsTo(Personal::class, 'per_id');
    }
}
