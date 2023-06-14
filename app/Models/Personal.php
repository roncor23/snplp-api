<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Employment;
use App\Models\Disbursement;
use App\Models\Repayment;
use App\Models\Status;

class Personal extends Model
{
    protected $table = 'personal_informations';

    use HasFactory;

    protected $fillable = [
        'last_name',
        'maiden_name',
        'first_name',
        'middle_name',
        'name_ext',
        'course',
        'month_year_graduated',
        'sex',
        'comaker',
        'hei',
        'contact_number',
        'address',
        'email'
    ];

    public function employmentInfo()
    {
        return $this->hasOne(Employment::class);
    }

    public function disbursementInfo()
    {
        return $this->hasOne(Disbursement::class);
    }

    public function repaymentInfo()
    {
        return $this->hasOne(Repayment::class);
    }

    public function statusInfo()
    {
        return $this->hasOne(Status::class);
    }

}
