<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Personal;

class Employment extends Model
{
    protected $table = 'employment_informations';

    use HasFactory;

    protected $fillable = [
        'first_date_employment',
        'company_name',
        'job_title',
        'department',
        'company_address',
        'no_years_emp'
    ];

    public function personal() {
        return $this->belongsTo(Personal::class);
    }

}
