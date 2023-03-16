<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Registration extends Model
{
    use HasFactory;

    protected $fillable = [
        'vaccine_center_id',
        'nid',
        'name',
        'gender',
        'date_of_birth',
        'email',
        'mobile',
        'schedule_date',
        'status',
    ];

    public function vaccineCenter()
    {
        return $this->belongsTo(VaccineCenter::class);
    }
}
